@extends('neon.layouts.app')

@section('content')

    <style>
        .red-button-with-animate {
            min-width: auto;
            padding: 0;
            height: 45px;
            width: 45px;
            background-color: darkred;
        }
        .film-container:hover {
            transform: scale(1.01);
        }

        .film-container2 {
            box-shadow: 0 -40px 100px, 0 0 2px, 0 0 1em #338fee, 0 0 0.5em #b625c5, 0 0 0.1em #300472;
            border-radius: 10px;
            overflow: hidden;
            position: relative;
        }

        .film-img-container {
            height: 350px;
            max-width: 230px;
            min-width: 230px;
        }

        .film-desc-container {
            max-width: 200px;
            margin: auto;
        }
        .favorite-button {
            position: absolute;
            height: 50px;
            width: 50px;
            right: 0;
            background-color: unset;
            cursor: pointer;
        }
        .favorite-button:hover {
            transform: scale(1.05);
        }
    </style>

    <div class="flex-column-center" style="min-height: inherit;">

        <div class="flex-center w-100 py-20 pos-sticky top-0 z-1">
            <div class="w-80 pos-rel">
                <input style="padding: 16px;" type="text" placeholder="Введите название(сериал , фильм , мультфильм)" class="text-center search-field">
                <span class="pos-abs cp" style="right: 10px; top: 35%;" onclick="clearSearchField()">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                  <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                </svg>
            </span>
            </div>
            <button class="red-button-with-animate search-film-button">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-search color-pink" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"></path>
                </svg>
            </button>
        </div>

        <div class="find-films-main-container">

            <div class="flex-wrap find-films-container" style="justify-content: center;">

{{--                @for($i = 0; $i < 1; $i++)--}}
{{--                    <div class="flex cp film-container">--}}

{{--                        <div class="p-10 flex film-container1">--}}
{{--                            <div class="film-container2">--}}
{{--                                <div class="film-img-container">--}}
{{--                                    <img src="https://avatars.mds.yandex.net/get-kinopoisk-image/1599028/2e19bab7-5044-4f9b-87cb-2c47b963ef23/orig" alt="">--}}
{{--                                </div>--}}
{{--                                <div class="color-white text-center film-desc-container">название фильма</div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                    </div>--}}
{{--                @endfor--}}

            </div>

        </div>

    </div>

    <script>

        const searchField = document.body.querySelector('.search-field');

        document.body.querySelector('.search-film-button').addEventListener('click', () => {
            startSearch(searchField.value);

        });

        searchField.addEventListener('keypress', (event) => {
            if (event.key === 'Enter') {
                startSearch(event.target.value);
            }
        });

        function clearSearchField() {
            searchField.value = '';
        }

        function startSearch(query) {
            if (query.length > 2) {
                // document.body.querySelector('.find-films-main-container').classList.toggle('hide');
                findFilmsContainer.innerHTML = '';
                searchFilms(query);
                searchSerials(query);
            }
        }

        const findFilmsContainer = document.body.querySelector('.find-films-container');

        function searchFilms(query) {
            const SEARCH_API_URL = 'https://apitmdb.cub.watch/3/search/movie?api_key=4ef0d7355d9ffb5151e987764708ce96&language=ru&query=';

            fetch(SEARCH_API_URL + query)
                .then((response) => {
                    return response.json();
                })
                .then((data) => {
                    generateFilmsCards(data.results, findFilmsContainer);
                });
        }

        function searchSerials(query) {
            const SEARCH_API_URL = 'https://apitmdb.cub.watch/3/search/tv?api_key=4ef0d7355d9ffb5151e987764708ce96&language=ru&query=';

            fetch(SEARCH_API_URL + query)
                .then((response) => {
                    return response.json();
                })
                .then((data) => {
                    generateFilmsCards(data.results, findFilmsContainer, true);
                });
        }

        const FILM_POSTER_URL = 'https://image.tmdb.org/t/p/w400';

        function generateFilmsCards(filmsObjects, container, isSerial = false) {

            // if (Object.keys(filmsObjects).length > 0) {
            //     const titleCategory = document.createElement('h3');
            //     titleCategory.style.width = '100%'
            //     titleCategory.style.color = 'white'
            //     titleCategory.innerHTML = isSerial ? 'Сериалы' : 'Фильмы';
            //     container.append(titleCategory);
            // }

            filmsObjects
                .sort((prev, next) => {
                    let prevDate = prev.release_date ?? prev.first_air_date;
                    let nextDate = next.release_date ?? next.first_air_date;

                    return Date.parse(nextDate) - Date.parse(prevDate);
                })
                .forEach((filmObject) => {
                    const id = filmObject.id;
                    const title = filmObject.title ?? filmObject.name;
                    const description = filmObject.overview;
                    const poster = filmObject.poster_path !== null ? FILM_POSTER_URL + filmObject.poster_path : 'https://bpic.588ku.com/back_pic/05/10/88/62598e75d484d19.jpg!/fh/300/quality/90/unsharp/true/compress/true';
                    const releaseDate = filmObject.release_date ?? filmObject.first_air_date;

                    const filmContainer = document.createElement('div');
                    filmContainer.addEventListener('click', () => location.href = "{{route('film')}}" + '?id=' + id + '&isSerial=' + isSerial)
                    filmContainer.className = 'flex cp film-container';
                    container.append(filmContainer);

                    const filmContainer1 = document.createElement('div');
                    filmContainer1.className = 'p-10 flex film-container1';
                    filmContainer.append(filmContainer1);

                    const filmContainer2 = document.createElement('div');
                    filmContainer2.className = 'film-container2';
                    filmContainer1.append(filmContainer2);

                    // const favoriteButton = document.createElement('button');
                    // favoriteButton.innerHTML = '<svg height="100%" class="neon-svg" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 490.706 490.706" style="filter: drop-shadow( 0px 1px 1px #008cff );" xml:space="preserve"> <g> <g> <path d="M490.133,178.037c-1.493-4.373-5.547-7.253-10.133-7.36H309.653l-54.187-163.2c-1.813-5.547-7.893-8.64-13.44-6.827 c-3.2,1.067-5.76,3.627-6.827,6.827l-54.187,164.267H10.667C4.8,170.784,0,175.477,0,181.45c0,3.307,1.493,6.4,4.16,8.427 l136.96,107.2L81.493,476.49c-1.92,5.547,1.067,11.627,6.72,13.547c3.307,1.067,6.933,0.533,9.707-1.493l147.52-107.52 L392.96,486.09c4.8,3.413,11.413,2.347,14.827-2.453c1.92-2.773,2.453-6.293,1.493-9.493L350.187,292.81L486.4,189.984 C490.133,187.21,491.627,182.41,490.133,178.037z M331.307,280.224c-3.627,2.773-5.12,7.467-3.733,11.84l51.413,157.76 l-127.36-90.773c-3.733-2.667-8.747-2.667-12.48,0.107l-126.827,92.48l51.413-154.88c1.387-4.267,0-8.96-3.52-11.733L41.6,192.01 h147.093c4.587,0,8.64-2.987,10.133-7.36l46.507-140.16l46.507,140.16c1.493,4.373,5.547,7.253,10.133,7.36h146.133 L331.307,280.224z"></path> </g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> </svg>';
                    // favoriteButton.className = 'favorite-button';
                    // filmContainer2.append(favoriteButton);

                    const filmImgContainer = document.createElement('div');
                    filmImgContainer.className = 'film-img-container';
                    filmContainer2.append(filmImgContainer);

                    const posterContainer = document.createElement('img');
                    posterContainer.src = poster;
                    filmImgContainer.append(posterContainer);

                    const titleContainer = document.createElement('div');
                    titleContainer.className = 'color-white text-center film-desc-container';
                    titleContainer.innerHTML = title + ' (' + releaseDate + ')';
                    filmContainer2.append(titleContainer);
                });
        }
    </script>

@endsection
