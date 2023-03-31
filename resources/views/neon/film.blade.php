@extends('neon.layouts.app')

@section('content')

    <style>

        .iframe-container {
            max-height: 100vh;
            max-width: 100vw;
            height: 400px;
            width: 700px;
            margin: auto;
        }

        .container-2 {
            height: 400px;
            min-width: 235px;
        }

        #iframe {
            width: 100%;
            height: 100%;
            position: relative;
        }

        .shadow-neon {
            box-shadow: 0 0 1em #338fee, 0 0 0.5em #b625c5, 0 0 0.1em #300472;
            padding: 30px;
        }

        .film-title {
            font-size: 40px;
        }

        @media screen and (max-width: 768px) {
            .iframe-container {
                height: auto;
                width: auto;
            }

            .container-1 {
                flex-direction: column;
            }

            .container-2 {
                height: auto;
            }

            #iframe {
                width: calc(100vw - 10px); /*padding*/
                /*height: 350px;*/
                position: relative;
            }

            .shadow-neon {
                box-shadow: unset;
                padding: 5px;
            }
        }

        @media screen and (max-width: 768px) {
            #iframe {
                height: 180px;
            }
            .red-button-with-animate {
                width: auto;
            }
            .container-2 {
                min-width: 100%;
            }

            .film-title {
                font-size: 20px;
            }
        }

        .bezel {
            -webkit-animation: bezel-fadeout .1s linear 1 normal forwards;
            animation: bezel-fadeout .1s linear 1 normal forwards;
        }

        .bezel {
            position: absolute;
            left: 50%;
            top: 50%;
            width: 100px;
            height: 100px;
            margin-left: -50px;
            margin-top: -50px;
            background: rgba(255, 255, 255, 0.5);
            border-radius: 100px;
            pointer-events: none;
            cursor: pointer;
            transition: transform 50ms;
        }

        .bezel:hover {
            transform: scale(1.1);
        }

        .bezel-icon {
            width: 100%;
            height: 100%;
            position: absolute;
            left: 5px;
        }

        @if($filmBackDropUrl)
        .backdrop {
            background-image: url("{{$filmBackDropUrl}}");
            background-repeat: no-repeat;
            background-size: cover;
            border-radius: 20px;
            width: 100%;
        }
        .backdrop-shadow {
            background-image: linear-gradient(to right, rgb(6 6 6) 150px, rgba(43, 41, 41, 0.8) 100%);
        }
        @endif
    </style>

{{--    <script src="https://player.svetacdn.in/storage/default_players/s_v120.js"></script>--}}
{{--    <link rel="stylesheet" href="https://player.svetacdn.in/iframe.css">--}}

{{--    <script src="https://52.svetacdn.in/Assets/pj.js?v=1111"></script>--}}
{{--    <link rel="stylesheet" href="https://52.svetacdn.in/Assets/iframe.css">--}}

    <div class="flex-center mb-20" style="min-height: inherit;">
        <div class="backdrop">
            <div class="flex-column-center w-100 shadow-neon backdrop-shadow" style="border-radius: 20px;">
                <div class="mb-30 color-white film-title">{{$filmTitle}}</div>
                <div class="flex w-100 container-1">
                    <div>
                        <div class="container-2" style="">
                            <img src="{{$filmPosterUrl}}" alt="">
                        </div>
                        <div style="display: none;">
                            <button class="red-button-with-animate" onclick="searchFilm()" style="min-width: 100%;">СМОТРЕТЬ</button>
                        </div>
                    </div>

                    <div class="iframe-container">
                        <div id="iframe">
                            <img class="cp" src="{{asset('preview.jpg')}}" alt="" onclick="searchFilm()">
                            <div class="bezel" role="status" aria-label="Смотреть">
                                <div class="bezel-icon">
                                    <svg height="100%" viewBox="0 0 36 36" width="100%">
                                        <use class="svg-shadow" xlink:href="#id-89"></use>
                                        <path class="svg-fill" d="M 12,26 18.5,22 18.5,14 12,10 z M 18.5,22 25,18 25,18 18.5,14 z" id="id-89"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="film-desc color-white p-10">{{$filmDescription}}</div>
                </div>
            </div>
        </div>
    </div>

    <script>

        function putWatched() {
            const filmObject = {
                id: "{{$filmInfo->id}}",
                title: "{{$filmInfo->title ?? $filmInfo->name}}",
                poster_path: "{{$filmInfo->poster_path}}",
                release_date: "{{$filmInfo->release_date ?? $filmInfo->first_air_date}}",
                isSerial: "{{$isSerial}}",
            }

            let watched = localStorage.getItem("watched") ? JSON.parse(localStorage.getItem("watched")) : []

            const findIndex = watched.findIndex((film) => {
                console.log(film, filmObject)
                return film.id === filmObject.id && film.isSerial === filmObject.isSerial
            })

            if (findIndex !== -1) {
                watched.splice(findIndex, 1)
            }

            watched.unshift(filmObject)

            localStorage.setItem("watched", JSON.stringify(watched))
        }

        const iframeContainer = document.body.querySelector('.iframe-container');

        function searchFilm() {
            getFilmFiles("{{$filmImdbId}}", {{$isSerial}}, "{{$filmTitle}}");
        }

        const VIDEO_CDN_API_TOKEN = '3i40G5TSECmLF77oAqnEgbx61ZWaOYaE';

        function getFilmFiles(imdbId, isSerial, title) {
            // fetch('https://cdn.svetacdn.in/api/'+(isSerial ? 'tv-series' : 'short')+'?api_token=' + VIDEO_CDN_API_TOKEN + (imdbId ? ('&imdb_id=' + imdbId) : ('&title=' + title)))
            // fetch('https://videocdn.tv/api/'+(isSerial ? 'tv-series' : 'short')+'?api_token=' + VIDEO_CDN_API_TOKEN + (imdbId ? ('&imdb_id=' + imdbId) : ('&title=' + title)))
            fetch('https://videocdn.tv/api/short?api_token=' + VIDEO_CDN_API_TOKEN + (imdbId ? ('&imdb_id=' + imdbId) : ('&title=' + title)))
                .then((response) => {
                    return response.json();
                })
                .then((data) => {
                    if (data?.data[0]?.iframe_src) {
                        parseVideoFiles(data.data[0]);
                        // clearFilmsContainer();
                        // clearFilmInfoContainer();
                        // clearSerialsContainer();
                    } else {
                        alert('Нет данных');
                    }
                });
        }

        function parseVideoFiles(data) {

            const iframeSrc = data.iframe_src;

            LoaderShow(document.getElementById('iframe'))

            fetch('https:'+iframeSrc+'?api_token=' + VIDEO_CDN_API_TOKEN)
                .then((response) => {
                    response.text()
                        .then((raw) => {


                            const domain = data.iframe_src.split("/")

                            if (!domain[2]) {
                                alert('Что то сломалось')
                            }

                            {{--let newIframe = raw.replace(/\n/g, '').replace('rek_array', '{{asset('assets/js/videocdn.js')}}');--}}
                            let newIframe = raw.replace(/\n/g, '')
                                .replaceAll('"/Assets', '"//' + domain[2] + '/Assets')
                                // .replaceAll('head', 'div')
                                // .replaceAll('body', 'div')

                            // console.log(newIframe)

                            // let math1 = newIframe.match(/<html[^>]+>(.*)<\/html>/);
                            let math1 = newIframe.match(/<html>(.*)<\/html>/);

                            // console.log(math1)

                            document.getElementById('iframe').innerHTML = math1[1];
                            // document.getElementById('iframe').innerHTML = data.iframe;
                            LoaderShow(document.getElementById('iframe'))

                            document.getElementById('iframe').querySelector("#rek_array").value = ""
                            document.getElementById('iframe').querySelector("#host").value = ""
                            document.getElementById('iframe').querySelector("#client_id").value = ""
                            // document.getElementById('iframe').querySelector("#autoplay").value = "1"
                            document.getElementById('iframe').querySelector("#downloadBtn").value = "0"

                            let count = 1
                            document.getElementById('iframe').querySelectorAll('script').forEach((element) => {
                                if (
                                    !element.src.includes('pj.js')
                                    && !element.src.includes('fb.js')
                                    // && !element.src.includes('p2p-media-loader')
                                    && !element.src.includes('email-decode.min.js')
                                ) {
                                    setTimeout(() => {
                                        let myScript = document.createElement('script');
                                        myScript.src = element.src
                                        document.body.append(myScript);
                                    }, 1 * 1000 * count++)
                                }
                            })

                            setTimeout(() => {
                                let myScript = document.createElement('script');
                                myScript.src = '{{asset('assets/js/pj.js')}}' + '?v=' + Date.now()
                                document.body.append(myScript);
                            }, 1 * 1000 * count++)

                            setTimeout(() => {
                                LoaderHide()
                                putWatched()
                            }, 1 * 1000 * count++)

                            {{--document.body.querySelectorAll('#videocdn_js').forEach((el) => el.remove());--}}


                            // iframeContainer.classList.remove('hide');
                        });
                });

        }

    </script>

@endsection
