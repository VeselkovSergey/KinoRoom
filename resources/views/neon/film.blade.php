@extends('neon.layouts.app')

@section('content')

    <style>
        .font-size-20 {
            font-size: 20px;
        }

        .iframe-container {
            max-height: 100vh;
            max-width: 100vw;
            height: 400px;
            width: 700px;
            margin: auto;
        }

        .container-2 {
            height: 350px;
            min-width: 235px;
        }

        #iframe {
            width: 100%;
            height: 100%;
            position: relative;
        }

        .shadow-neon {
            box-shadow: 0 0 1em #338fee, 0 0 0.5em #b625c5, 0 0 0.1em #300472; padding: 60px;
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
                width: calc(100vw - 120px);
                height: 350px;
                position: relative;
            }

            .shadow-neon {
                box-shadow: unset;
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
        }

        .bezel {
            -webkit-animation: bezel-fadeout .1s linear 1 normal forwards;
            animation: bezel-fadeout .1s linear 1 normal forwards;
        }

        .bezel {
            position: absolute;
            /*left: calc(50% - 20px);*/
            left: 50%;
            top: 50%;
            /*top: calc(50% - 34.14px);*/
            width: 52px;
            height: 52px;
            z-index: 19;
            margin-left: -26px;
            margin-top: -26px;
            background: rgba(0,0,0,0.5);
            border-radius: 26px;
            pointer-events: none;
        }

        .bezel-icon {
            width: 40px;
            height: 40px;
            margin: 6px;
        }
    </style>

    <script src="https://player.svetacdn.in/storage/default_players/s_v120.js"></script>
    <link rel="stylesheet" href="https://player.svetacdn.in/iframe.css">

    <div class="flex-center mb-20" style="min-height: inherit;">
        <div class="flex-column-center w-100 shadow-neon" style="border-radius: 20px 0 20px 20px;">
            <div class="mb-60 color-white film-title" style="font-size: 50px;">{{$filmTitle}}</div>
            <div class="flex w-100 container-1">
                <div>
                    <div class="container-2" style="">
                        <img src="{{$filmPosterUrl}}" alt="">
                    </div>
                    <div>
                        <button class="red-button-with-animate" onclick="searchFilm()" style="min-width: 100%;">СМОТРЕТЬ</button>
                    </div>
                </div>

                <div class="iframe-container">
                    <div id="iframe">
                        <img src="{{asset('preview.jpg')}}" alt="" onclick="searchFilm()">
                        <div class="bezel" role="status" aria-label="Смотреть">
                            <div class="bezel-icon">
                                <svg height="100%" version="1.1" viewBox="0 0 36 36" width="100%">
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

    <script>

        const iframeContainer = document.body.querySelector('.iframe-container');

        function searchFilm() {
            fetch('https://apitmdb.cub.watch/3/'+"{{($isSerial === 'true' ? 'tv' : 'movie')}}"+'/'+"{{$filmId}}"+'/external_ids?api_key=4ef0d7355d9ffb5151e987764708ce96&language=ru')
                .then((response) => {
                    return response.json();
                })
                .then((data) => {
                    getFilmFiles(data.imdb_id, {{$isSerial}}, "{{$filmTitle}}");
                });
        }

        const VIDEO_CDN_API_TOKEN = '3i40G5TSECmLF77oAqnEgbx61ZWaOYaE';

        function getFilmFiles(imdbId, isSerial, title) {
            fetch('https://cdn.svetacdn.in/api/'+(isSerial ? 'tv-series' : 'short')+'?api_token=' + VIDEO_CDN_API_TOKEN + (imdbId ? ('&imdb_id=' + imdbId) : ('&title=' + title)))
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

            fetch('https:'+iframeSrc+'?api_token=' + VIDEO_CDN_API_TOKEN)
                .then((response) => {
                    response.text()
                        .then((raw) => {


                            let newIframe = raw.replace(/\n/g, '').replace('/iframe.js', '{{asset('assets/js/videocdn.js')}}');
                            let math1 = newIframe.match(/<body[^>]+>(.*)<\/body>/);

                            document.getElementById('iframe').innerHTML = math1[1];

                            document.body.querySelectorAll('#videocdn_js').forEach((el) => el.remove());
                            let myScript = document.createElement('script');
                            myScript.src = '{{asset('assets/js/videocdn.js')}}'
                            myScript.id = 'videocdn_js'
                            document.body.append(myScript);

                            // iframeContainer.classList.remove('hide');
                        });
                });

        }

    </script>

@endsection
