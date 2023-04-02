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

        .videoContainer video {
            height: 100%;
            background-color: black;
        }

        #iframe:hover .translations {
            opacity: 1;
        }

        .translations {
            position: absolute;
            top: 10px;
            left: 10px;
            opacity: 0;
        }

        #iframe:hover .seasons {
            opacity: 1;
        }

        .seasons {
            position: absolute;
            top: 35px;
            left: 10px;
            opacity: 0;
        }

        #iframe:hover .series {
            opacity: 1;
        }

        .series {
            position: absolute;
            top: 60px;
            left: 10px;
            opacity: 0;
        }

        #iframe:hover .quality {
            opacity: 1;
        }

        .quality {
            position: absolute;
            top: 35px;
            left: 10px;
            opacity: 0;
        }

        #iframe.isSerial .quality {
            top: 85px;
        }

        .seasons, .series, .translations, .quality {
            max-width: calc(100% - 20px);
        }
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
                            <div class="videoContainer flex-center">

                            </div>
                            <div class="preview-poster flex-center">
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
                </div>
                <div>
                    <div class="film-desc color-white p-10">{{$filmDescription}}</div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/hls.js@latest"></script>

    <script>
        // const link = "//cloud.cdnland.in/797b1976a2317ccc03e2506170aaddc3:2023040115/movies/df8229e4592978f160c2ad69a5139cd86ab745ce/1080.mp4:hls:manifest.m3u8"

        function setVideo(link, container, startTime = 0) {

            container.innerHTML = ""

            const videoElement = document.createElement('video');
            videoElement.setAttribute("controls", "")
            container.append(videoElement)

            if (Hls.isSupported()) {
                // var videoElement = document.getElementById('video');
                var hls = new Hls();
                hls.loadSource(link);
                hls.attachMedia(videoElement);
                hls.on(Hls.Events.MANIFEST_PARSED, function () {
                    // videoElement.play();
                    videoElement.currentTime = Number(startTime)
                });
            } else if (videoElement.canPlayType('application/vnd.apple.mpegurl')) {
                videoElement.src = link;
                videoElement.addEventListener('canplay', function () {
                    // videoElement.play();
                    videoElement.currentTime = Number(startTime)
                });
            }
        }

    </script>


    <script>

        let filmObject = {
            id: "{{$filmInfo->id}}",
            title: "{{$filmInfo->title ?? $filmInfo->name}}",
            poster_path: "{{$filmInfo->poster_path}}",
            release_date: "{{$filmInfo->release_date ?? $filmInfo->first_air_date}}",
            isSerial: "{{$isSerial}}",
            was: {
                translate: 0,
                season: 0,
                series: 0,
                quality: 0,
                time: 0,
            }
        }

        function putWatched() {

            let watched = localStorage.getItem("watched") ? JSON.parse(localStorage.getItem("watched")) : []

            const findIndex = watched.findIndex((film) => {
                return film.id === filmObject.id && film.isSerial === filmObject.isSerial
            })

            if (findIndex !== -1) {
                filmObject.was = watched[findIndex].was
                watched.splice(findIndex, 1)
            }

            watched.unshift(filmObject)

            localStorage.setItem("watched", JSON.stringify(watched))
        }

        const updateWatchedTime = ({translate, season, series, quality, time}) => {
            let watched = localStorage.getItem("watched") ? JSON.parse(localStorage.getItem("watched")) : []
            const findIndex = watched.findIndex((film) => {
                return film.id === filmObject.id && film.isSerial === filmObject.isSerial
            })
            watched[findIndex].was = {
                translate: translate ?? watched[findIndex].was.translate,
                season: season ?? watched[findIndex].was.season,
                series: series ?? watched[findIndex].was.series,
                quality: quality ?? watched[findIndex].was.quality,
                time: time ?? watched[findIndex].was.time,
            }
            localStorage.setItem("watched", JSON.stringify(watched))
            filmObject.was = watched[findIndex].was
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

        const useNewMethod = false

        function parseVideoFiles(data) {

            const iframeSrc = data.iframe_src;

            useNewMethod && document.body.querySelector('.preview-poster')?.remove()
            LoaderShow(document.getElementById('iframe'))

            fetch('https:'+iframeSrc+'?api_token=' + VIDEO_CDN_API_TOKEN)
                .then((response) => {
                    response.text()
                        .then((raw) => {

                            // new method
                            if (useNewMethod) {
                                generateVideoContainer(raw)
                                return
                            }

                            const domain = data.iframe_src.split("/")

                            if (!domain[2]) {
                                alert('Что то сломалось')
                            }

                            {{--let newIframe = raw.replace(/\n/g, '').replace('rek_array', '{{asset('assets/js/videocdn.js')}}');--}}
                            let newIframe = raw.replace(/\n/g, '')
                                .replaceAll('"/Assets', '"//' + domain[2] + '/Assets')
                                // .replaceAll('head', 'div')
                                // .replaceAll('body', 'div')

                            // let math1 = newIframe.match(/<html[^>]+>(.*)<\/html>/);
                            let math1 = newIframe.match(/<html>(.*)<\/html>/);

                            document.getElementById('iframe').innerHTML = math1[1];
                            // document.getElementById('iframe').innerHTML = data.iframe;
                            LoaderShow(document.getElementById('iframe'))

                            document.getElementById('iframe').querySelector("#rek_array").value = ""
                            document.getElementById('iframe').querySelector("#host").value = "svetacdn.in"
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

        const generateVideoContainer = (raw) => {
            putWatched()
            const clearRaw = raw.replace(/\n/g, '')
                .replaceAll(/link/g, 'link-bac')
                .replaceAll(/script/g, 'script-bac')

            let trashElement = document.createElement('div');
            trashElement.innerHTML = clearRaw
            document.body.append(trashElement);

            const translations = trashElement.querySelector(".translations")
            document.getElementById("iframe").append(translations)

            const filesRaw = JSON.parse(trashElement.querySelector("#files").value)

            trashElement.remove()

            let files = {}

            const getQuality = (data) => {
                const res = data.match(/[\[](.*)[\]](.*)/)
                const qualityType = res[1]
                const qualityLink = res[2]
                return {
                    qualityType: qualityType,
                    qualityLink: qualityLink
                }
            }

            const getQualityLink = (qualityArr) => {
                if (filmObject.was.quality) return qualityArr[filmObject.was.quality]
                let currentLink = qualityArr["1080p"]
                if (!qualityArr["1080p"]) {
                    currentLink = qualityArr["720p"]
                } else if (!qualityArr["720p"]) {
                    currentLink = qualityArr["480p"]
                } else if (!qualityArr["480p"]) {
                    currentLink = qualityArr["360p"]
                } else if (!qualityArr["360p"]) {
                    currentLink = qualityArr["240p"]
                }
                return currentLink
            }

            Object.keys(filesRaw).forEach((translation) => {

                if (!files[translation]) {
                    files[translation] = {}
                }

                const data = filesRaw[translation]
                if (typeof data === "string") {
                    const qualityArr = data.split(',')
                    qualityArr.forEach((quality) => {
                        const {qualityType, qualityLink} = getQuality(quality)
                        files[translation][qualityType] = qualityLink
                    })
                } else {
                    const seasons = data
                    seasons.forEach((season, seasonIndex) => {
                        // const seasonTitle = season.comment
                        if (!files[translation][seasonIndex]) {
                            files[translation][seasonIndex] = {}
                        }
                        const series = season.folder
                        series.forEach((seriesItem, index) => {
                            if (!files[translation][seasonIndex][index]) {
                                files[translation][seasonIndex][index] = {}
                            }
                            const seriesItemFiles = seriesItem.file
                            const qualityArr = seriesItemFiles.split(',')
                            qualityArr.forEach((quality) => {
                                const {qualityType, qualityLink} = getQuality(quality)
                                files[translation][seasonIndex][index][qualityType] = qualityLink
                            })
                        })
                    })
                }
            })

            const createSeasonsSelector = (seasons) => {
                document.getElementById("iframe")?.querySelector(".seasons")?.remove()
                let seasonsContainer = document.createElement('div')
                seasonsContainer.classList.add("seasons")
                let seasonsSelector = document.createElement('select')
                seasonsContainer.append(seasonsSelector)
                Object.keys(seasons).forEach((index) => {
                    let seasonOption = document.createElement('option')
                    seasonOption.label = `${Number(index) + 1} сезон`
                    seasonOption.value = index
                    if (index === (filmObject.was.season || "0")) {
                        seasonOption.selected = true
                    }
                    seasonsSelector.append(seasonOption)
                })
                document.getElementById("iframe").append(seasonsContainer)

                createSeriesSelector(files[translationsSelect.value][seasonsSelector.value])

                seasonsSelector.addEventListener("change", () => {
                    updateWatchedTime({time: 0})
                    createSeriesSelector(files[translationsSelect.value][seasonsSelector.value])
                })
            }

            const createSeriesSelector = (series) => {
                document.getElementById("iframe")?.querySelector(".series")?.remove()

                const seasonsSelector = document.getElementById("iframe").querySelector(".seasons select")

                let seriesContainer = document.createElement('div')
                seriesContainer.classList.add("series")
                let seriesSelector = document.createElement('select')
                seriesContainer.append(seriesSelector)
                Object.keys(series).forEach((index) => {
                    let seasonOption = document.createElement('option')
                    seasonOption.label = `${Number(index) + 1} серия`
                    seasonOption.value = index
                    if (index === (filmObject.was.series || "0")) {
                        seasonOption.selected = true
                    }
                    seriesSelector.append(seasonOption)
                })
                document.getElementById("iframe").append(seriesContainer)
                createQualitySelector(files[translationsSelect.value][seasonsSelector.value][filmObject.was.series || 0])

                seriesSelector.addEventListener("change", () => {
                    updateWatchedTime({time: 0})
                    createQualitySelector(files[translationsSelect.value][seasonsSelector.value][seriesSelector.value])
                })
            }

            let timerForTime = null

            const createQualitySelector = (qualityArr) => {
                document.getElementById("iframe")?.querySelector(".quality")?.remove()
                let qualityContainer = document.createElement('div')
                qualityContainer.classList.add("quality")
                let qualitySelector = document.createElement('select')
                qualityContainer.append(qualitySelector)
                let lastQuality = null
                Object.keys(qualityArr).forEach((qualityType) => {
                    let qualityOption = document.createElement('option')
                    qualityOption.label = qualityType
                    qualityOption.value = qualityArr[qualityType]
                    lastQuality = qualityType
                    qualitySelector.append(qualityOption)
                })
                qualitySelector.querySelector(`[label='${(filmObject.was.quality || lastQuality)}']`).selected = true
                document.getElementById("iframe").append(qualityContainer)

                const seasonsSelector = document.getElementById("iframe").querySelector(".seasons select")
                const seriesSelector = document.getElementById("iframe").querySelector(".series select")

                updateWatchedTime({
                    translate: translationsSelect.value,
                    season: seasonsSelector?.value,
                    series: seriesSelector?.value,
                    quality: qualitySelector.selectedOptions[0].getAttribute("label"),
                    time: filmObject.was.time,
                })
                setVideo(qualitySelector.value, document.body.querySelector(".videoContainer"), filmObject.was.time)

                clearInterval(timerForTime)
                timerForTime = setInterval(() => {
                    updateWatchedTime({
                        translate: translationsSelect.value,
                        season: seasonsSelector?.value,
                        series: seriesSelector?.value,
                        quality: qualitySelector.selectedOptions[0].getAttribute("label"),
                        time: document.body.querySelector(".videoContainer").querySelector('video').currentTime,
                    })
                }, 5000)

                qualitySelector.addEventListener("change", () => {
                    setVideo(qualitySelector.value, document.body.querySelector(".videoContainer"), filmObject.was.time)

                    clearInterval(timerForTime)
                    timerForTime = setInterval(() => {
                        updateWatchedTime({
                            translate: translationsSelect.value,
                            season: seasonsSelector?.value,
                            series: seriesSelector?.value,
                            quality: qualitySelector.selectedOptions[0].getAttribute("label"),
                            time: document.body.querySelector(".videoContainer").querySelector('video').currentTime,
                        })
                    }, 5000)
                })
            }

            const translationsSelect = translations.querySelector("select")
            filmObject.was.translate && (translationsSelect.value = filmObject.was.translate)
            updateWatchedTime({translate: translationsSelect.value})
            translationsSelect.addEventListener("change", () => {
                updateWatchedTime({time: 0})
                if (typeof filesRaw[translationsSelect.value] === "string") {
                    createQualitySelector(files[translationsSelect.value])
                } else {
                    createSeasonsSelector(files[translationsSelect.value])
                }
            })

            document.body.querySelector(".videoContainer").style.height = "100%"
            if (typeof filesRaw[translationsSelect.value] === "string") {
                createQualitySelector(files[translationsSelect.value])
                document.getElementById("iframe").classList.remove("isSerial")
            } else {
                createSeasonsSelector(files[translationsSelect.value])
                document.getElementById("iframe").classList.add("isSerial")
            }

            LoaderHide()
        }

    </script>

@endsection
