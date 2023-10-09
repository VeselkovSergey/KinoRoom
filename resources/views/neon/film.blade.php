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
                min-height: 180px;
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
    </style>

    {{--    <script src="https://player.svetacdn.in/storage/default_players/s_v120.js"></script>--}}
    {{--    <link rel="stylesheet" href="https://player.svetacdn.in/iframe.css">--}}

    {{--    <script src="https://52.svetacdn.in/Assets/pj.js?v=1111"></script>--}}
    {{--    <link rel="stylesheet" href="https://52.svetacdn.in/Assets/iframe.css">--}}

    <div class="flex-center mb-20" style="min-height: inherit;">
        <div class="backdrop">
            <div class="flex-column-center w-100 shadow-neon backdrop-shadow" style="border-radius: 20px;">
                <h2 class="mb-30 color-white film-title">{{$filmTitle}}</h2>
                <div class="flex w-100 container-1">
                    <div>
                        <div class="container-2" style="">
                            <img src="{{$filmPosterUrl}}" alt="Обложка для {{$filmTitle}}">
                        </div>
                        <div style="display: none;">
                            <button class="red-button-with-animate" onclick="searchFilm()" style="min-width: 100%;">
                                СМОТРЕТЬ
                            </button>
                        </div>
                    </div>

                    <style>
                        .play-pause-button.paused [data-type="play"] {
                            display: none;
                        }

                        .play-pause-button [data-type="pause"] {
                            display: none;
                        }

                        .play-pause-button.paused [data-type="pause"] {
                            display: inline;
                        }

                        .volume-mute-container.muted [data-type="volume"] {
                            display: none;
                        }

                        .volume-mute-container [data-type="mute"] {
                            display: none;
                        }

                        .volume-mute-container.muted [data-type="mute"] {
                            display: inline;
                        }

                        .progress-point-wrapper {
                            transition: opacity 250ms;
                            opacity: 0;
                        }

                        .progress-bar:hover .progress-point-wrapper {
                            opacity: 1;
                        }

                        .volume-bar {
                            transition: opacity 250ms;
                            opacity: 0;
                        }

                        .play-pause-button:hover,
                        .volume-container:hover,
                        .full-screen-button:hover,
                        .picture-in-picture-button:hover,
                        .menu-button:hover {
                            background-color: #80808030;
                        }

                        .volume-container:hover .volume-bar {
                            opacity: 1;
                        }

                        .volume-point-wrapper {
                            transition: opacity 250ms;
                            opacity: 0;
                        }

                        .volume-bar:hover .volume-point-wrapper {
                            opacity: 1;
                        }

                        input[type="range"] {
                            border: unset;
                            outline: unset;
                            box-shadow: unset;
                            padding: 0;
                            margin: 0;
                            cursor: pointer;
                        }

                        .controls {
                            display: none;

                            position: absolute;
                            color: white;
                            bottom: 10px;
                            width: 100%;
                        }

                        .controls.active.show,
                        .controls:hover.active {
                            display: block;
                        }

                        .up-control {
                            margin-bottom: 20px;
                        }

                        .up-control > *:not(:last-child) {
                            margin-right: 20px;
                        }

                        #iframe .controls .menu-button {
                            position: relative;
                        }

                        #iframe .controls .menu-button .settings-container {
                            display: none;
                            position: absolute;
                            bottom: 30px;
                            right: 0;
                            padding-bottom: 10px;
                        }

                        #iframe .controls .menu-button:active .settings-container,
                        #iframe .controls .menu-button:hover .settings-container {
                            display: block;
                        }

                        #iframe .controls .menu-button .settings-container select {
                            width: 150px;
                            padding: 5px 10px;
                            margin-bottom: 5px;
                        }

                        .controls.for-safari {
                            /*bottom: 0;*/
                        }

                        .controls.for-safari .up-control {
                            margin-bottom: 0;
                        }

                        .controls.for-safari .time,
                        .controls.for-safari .volume-container,
                        .controls.for-safari .full-screen-button,
                        .controls.for-safari .picture-in-picture-button,
                        .controls.for-safari .progress-bar {
                            display: none!important;
                        }

                        .controls.for-safari .menu-button {
                            margin-left: auto;
                        }

                    </style>

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
                                            <path class="svg-fill"
                                                  d="M 12,26 18.5,22 18.5,14 12,10 z M 18.5,22 25,18 25,18 18.5,14 z"
                                                  id="id-89"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <div class="controls">
                                <div style="padding: 15px;">
                                    <div class="up-control" style="display: flex;">
                                        <div class="play-pause-button"
                                             style="display: flex;justify-content: center;align-items: center; padding: 8px;border-radius: 30px; cursor: pointer;"
                                             onclick="this.classList.toggle('paused')">
                                            <svg data-type="play" xmlns="http://www.w3.org/2000/svg" width="20"
                                                 height="20" fill="currentColor" class="bi bi-play-fill"
                                                 viewBox="0 0 16 16">
                                                <path
                                                    d="m11.596 8.697-6.363 3.692c-.54.313-1.233-.066-1.233-.697V4.308c0-.63.692-1.01 1.233-.696l6.363 3.692a.802.802 0 0 1 0 1.393z"></path>
                                            </svg>
                                            <svg data-type="pause" xmlns="http://www.w3.org/2000/svg" width="20"
                                                 height="20" fill="currentColor" class="bi bi-pause-fill"
                                                 viewBox="0 0 16 16">
                                                <path
                                                    d="M5.5 3.5A1.5 1.5 0 0 1 7 5v6a1.5 1.5 0 0 1-3 0V5a1.5 1.5 0 0 1 1.5-1.5zm5 0A1.5 1.5 0 0 1 12 5v6a1.5 1.5 0 0 1-3 0V5a1.5 1.5 0 0 1 1.5-1.5z"></path>
                                            </svg>
                                        </div>
                                        <div class="time"
                                             style="display: flex; align-items: center; margin-right: auto;">
                                            00:00 / 00:00
                                        </div>
                                        <div class="volume-container"
                                             style="display: flex;justify-content: center;align-items: center;padding: 8px 10px;border-radius: 30px;">
                                            <div class="volume-bar"
                                                 style="width: 100px;background-color: #2f2f2f;height: 5px;display: flex;align-items: center;margin-right: 10px;border-radius: 10px; display: none;">
                                                <input type="range" min="0" max="100" value="100">
                                            </div>
                                            <div class="volume-mute-container"
                                                 style="display: flex; justify-content: center; align-items: center; cursor: pointer;"
                                                 onclick="this.classList.toggle('muted')">
                                                <svg data-type="volume" xmlns="http://www.w3.org/2000/svg" width="20"
                                                     height="20" fill="currentColor" class="bi bi-volume-up-fill"
                                                     viewBox="0 0 16 16">
                                                    <path
                                                        d="M11.536 14.01A8.473 8.473 0 0 0 14.026 8a8.473 8.473 0 0 0-2.49-6.01l-.708.707A7.476 7.476 0 0 1 13.025 8c0 2.071-.84 3.946-2.197 5.303l.708.707z"></path>
                                                    <path
                                                        d="M10.121 12.596A6.48 6.48 0 0 0 12.025 8a6.48 6.48 0 0 0-1.904-4.596l-.707.707A5.483 5.483 0 0 1 11.025 8a5.483 5.483 0 0 1-1.61 3.89l.706.706z"></path>
                                                    <path
                                                        d="M8.707 11.182A4.486 4.486 0 0 0 10.025 8a4.486 4.486 0 0 0-1.318-3.182L8 5.525A3.489 3.489 0 0 1 9.025 8 3.49 3.49 0 0 1 8 10.475l.707.707zM6.717 3.55A.5.5 0 0 1 7 4v8a.5.5 0 0 1-.812.39L3.825 10.5H1.5A.5.5 0 0 1 1 10V6a.5.5 0 0 1 .5-.5h2.325l2.363-1.89a.5.5 0 0 1 .529-.06z"></path>
                                                </svg>
                                                <svg data-type="mute" xmlns="http://www.w3.org/2000/svg" width="20"
                                                     height="20" fill="currentColor" class="bi bi-volume-mute-fill"
                                                     viewBox="0 0 16 16">
                                                    <path
                                                        d="M6.717 3.55A.5.5 0 0 1 7 4v8a.5.5 0 0 1-.812.39L3.825 10.5H1.5A.5.5 0 0 1 1 10V6a.5.5 0 0 1 .5-.5h2.325l2.363-1.89a.5.5 0 0 1 .529-.06zm7.137 2.096a.5.5 0 0 1 0 .708L12.207 8l1.647 1.646a.5.5 0 0 1-.708.708L11.5 8.707l-1.646 1.647a.5.5 0 0 1-.708-.708L10.793 8 9.146 6.354a.5.5 0 1 1 .708-.708L11.5 7.293l1.646-1.647a.5.5 0 0 1 .708 0z"></path>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="full-screen-button"
                                             style="display: flex; justify-content: center; align-items: center; padding: 8px;border-radius: 30px; cursor:pointer;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                 fill="currentColor" class="bi bi-aspect-ratio-fill"
                                                 viewBox="0 0 16 16">
                                                <path
                                                    d="M0 12.5v-9A1.5 1.5 0 0 1 1.5 2h13A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 12.5zM2.5 4a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 1 0V5h2.5a.5.5 0 0 0 0-1h-3zm11 8a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-1 0V11h-2.5a.5.5 0 0 0 0 1h3z"></path>
                                            </svg>
                                        </div>
                                        <div class="picture-in-picture-button"
                                             style="display: flex; justify-content: center; align-items: center; padding: 8px;border-radius: 30px; cursor:pointer;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                 fill="currentColor" class="bi bi-pip" viewBox="0 0 16 16">
                                                <path
                                                    d="M0 3.5A1.5 1.5 0 0 1 1.5 2h13A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 12.5v-9zM1.5 3a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-13z"/>
                                                <path
                                                    d="M8 8.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-.5.5h-5a.5.5 0 0 1-.5-.5v-3z"/>
                                            </svg>
                                        </div>
                                        <div class="menu-button"
                                             style="display: flex; justify-content: center; align-items: center; padding: 8px;border-radius: 30px;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                 fill="currentColor" class="bi bi-gear-fill" viewBox="0 0 16 16">
                                                <path
                                                    d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872l-.1-.34zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z"></path>
                                            </svg>
                                            <div class="settings-container">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="progress-bar"
                                         style="border-radius: 10px;width: 100%;background-color: #2f2f2f;height: 5px;display: flex;align-items: center;">
                                        <input class="progress" type="range" min="0" max="100" value="100">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <p class="film-desc color-white p-10">{{$filmDescription}}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="was-watch" style="color: white; background-color: black;">

    </div>

    <script src="https://cdn.jsdelivr.net/npm/hls.js@latest"></script>

    <style>
        .no-cursor .videoContainer {
            cursor: none !important;
        }
    </style>

    <script>

        let timerNoCursor;

        window.addEventListener('mousemove', () => {
            if (timerNoCursor) {
                document.documentElement.classList.remove('no-cursor')
                clearTimeout(timerNoCursor)
                timerNoCursor = 0
            }

            timerNoCursor = setTimeout(() => document.documentElement.classList.add('no-cursor'), 3000)
        })

        function triggerEvent(elem, event) {
            elem.dispatchEvent(new Event(event));
        }

        const isSafari = navigator.userAgent.toLowerCase().indexOf('mac') !== -1
        if (isSafari) {
            document.body.querySelector('.controls').classList.add('for-safari')
        }

        const getHumanTime = (rawSeconds) => {
            rawSeconds = isNaN(rawSeconds) ? 0 : rawSeconds
            const round = Math.round(rawSeconds)
            const hours = Math.trunc(round / 60 / 60)
            const minutes = Math.trunc((round - (hours * 3600)) / 60)
            const seconds = (round - (hours * 3600) - (minutes * 60))
            return `${hours > 0 ? hours + ":" : ""}${minutes < 10 ? "0" + minutes : minutes}:${seconds < 10 ? "0" + seconds : seconds}`
        }

        document.addEventListener("keydown", keyDownTextField, false);

        function keyDownTextField(e) {
            if (!videoElement) {
                return
            }
            const keyCode = e.keyCode
            if (keyCode === 32) {   // space
                videoElement.paused ? videoElement.play() : videoElement.pause()
            } else if (keyCode === 39) {    //arrow right
                videoElement.currentTime += 10
            } else if (keyCode === 37) {    // arrow left
                videoElement.currentTime -= (videoElement.currentTime < 10 ? videoElement.currentTime : 10)
            }
        }

        let videoElement = null

        function setVideo(link, container, startTime = 0) {

            let isFirstSetTime = true

            container.innerHTML = ""

            videoElement = document.createElement('video');
            // videoElement.setAttribute("controls", "")
            videoElement.setAttribute("autoplay", "")
            if (isSafari) {
                videoElement.setAttribute("muted", "")
                // videoElement.setAttribute("playsinline", "")
                // videoElement.setAttribute("allowfullscreen", "")
            }
            container.append(videoElement)

            const controlsContainer = document.body.querySelector(".controls")
            controlsContainer.classList.add("active")

            if (false && Hls.isSupported()) {  //toDo WTF???
                let hls = new Hls();
                hls.loadSource(link);
                hls.attachMedia(videoElement);
                hls.on(Hls.Events.MANIFEST_PARSED, function () {
                    // videoElement.play();
                    if (isFirstSetTime) {
                        isFirstSetTime = false
                        videoElement.currentTime = Number(startTime)
                        videoElement.muted = false
                    }
                    controlsContainer.classList.add("active")
                });
                hls.on(Hls.Events.ERROR, function (error, data) {
                    // console.log(error, data)
                    //https://github.com/video-dev/hls.js/blob/master/docs/API.md#fifth-step-error-handling
                    if (data.type === Hls.ErrorTypes.NETWORK_ERROR) {
                        FlashMessage("Ошибка воспроизведения. Попробуйте другой перевод.")
                    }
                });
            } else /*if (videoElement.canPlayType('application/vnd.apple.mpegurl'))*/ {  //toDo WTF???
                videoElement.src = link;
                videoElement.addEventListener('canplay', function () {
                    // videoElement.play();
                    if (isFirstSetTime) {
                        isFirstSetTime = false
                        videoElement.currentTime = Number(startTime)
                        videoElement.muted = false
                    }
                    controlsContainer.classList.add("active")
                });
            }

            videoElement.addEventListener("waiting", (event) => {
                LoaderShow(container)
            })
            videoElement.addEventListener("canplay", (event) => {
                LoaderHide()
            })

            let timerContainerShow = null
            const showControlContainer = () => {
                if (controlsContainer.classList.contains("active")) {
                    clearTimeout(timerContainerShow)
                    controlsContainer.classList.add("show")
                    timerContainerShow = setTimeout(() => {
                        controlsContainer.classList.remove("show")
                    }, 5 * 1000)
                }
            }
            container.addEventListener("mousemove", showControlContainer)
            container.addEventListener("touchmove", () => {
                if (controlsContainer.classList.contains("active")) {
                    clearTimeout(timerContainerShow)
                    controlsContainer.classList.add("show")
                }
            })
            container.addEventListener("touchend", () => {
                clearTimeout(timerContainerShow)
                timerContainerShow = setTimeout(() => {
                    controlsContainer.classList.remove("show")
                }, 15 * 1000)
            })

            const volumeLine = document.body.querySelector(".volume-bar input[type='range']")
            volumeLine.addEventListener("input", () => {
                videoElement.muted = false
                volumeMute.classList.remove("muted")
                videoElement.volume = Number(volumeLine.value) / 100
            })

            const volumeMute = document.body.querySelector(".volume-mute-container")
            volumeMute.addEventListener("click", () => {
                videoElement.muted = volumeMute.classList.contains("muted")
            })

            videoElement.addEventListener("play", () => {
                playPauseButton.classList.add("paused")
            })

            videoElement.addEventListener("pause", () => {
                playPauseButton.classList.remove("paused")
            })

            const timeContainer = document.body.querySelector(".time")
            const progressLine = document.body.querySelector(".progress")
            progressLine.addEventListener("change", (event) => {
                videoElement.currentTime = Number(progressLine.value)
                progressLineIsBlock = false
            })

            let progressLineIsBlock = false
            progressLine.addEventListener("input", (event) => {
                progressLineIsBlock = true
                timeContainer.innerHTML = getHumanTime(progressLine.value) + ' / ' + getHumanTime(videoElement.duration)
            })

            videoElement.addEventListener("timeupdate", () => {
                if (!progressLineIsBlock) {
                    timeContainer.innerHTML = getHumanTime(videoElement.currentTime) + ' / ' + getHumanTime(videoElement.duration)
                    progressLine.setAttribute("max", String(videoElement.duration))
                    progressLine.value = videoElement.currentTime
                }
            })

            videoElement.addEventListener("ended", () => {
                triggerEvent(document.body, "customEndedVideo")
                videoElement.currentTime = 0
            })

            const playPauseButton = document.body.querySelector(".play-pause-button")
            playPauseButton.addEventListener("click", () => {
                if (playPauseButton.classList.contains("paused")) {
                    videoElement.play()
                } else {
                    videoElement.pause()
                }
            })

            // let timer
            // videoElement.addEventListener("click", () => {
            //     // if (event.detail === 1) {
            //     //     timer = setTimeout(() => {
            //             videoElement.paused
            //                 ? videoElement.play()
            //                 : videoElement.pause()
            //         // }, 200)
            //     // }
            // })

            // videoElement.addEventListener("dblclick", (event) => {
            //     clearTimeout(timer)
            //     const bounding = videoElement.getBoundingClientRect()
            //     const leftSideStart = bounding.left
            //     const middle = bounding.left + (bounding.width / 2)
            //     if (event.clientX > leftSideStart && event.clientX < middle) {
            //         videoElement.currentTime -= 15
            //     } else {
            //         videoElement.currentTime += 15
            //     }
            // })

            const pictureInPictureButton = document.body.querySelector(".picture-in-picture-button")
            pictureInPictureButton.addEventListener("click", () => {
                videoElement.requestPictureInPicture();
            })

            const setFullScreen = () => {
                if (iframe.requestFullscreen) {
                    iframe.requestFullscreen({
                        navigationUI: "hide"
                    })
                } else if (iframe.requestFullScreen) {
                    iframe.requestFullScreen({
                        navigationUI: "hide"
                    });
                } else if (iframe.mozRequestFullScreen) {
                    iframe.mozRequestFullScreen({
                        navigationUI: "hide"
                    });
                } else if (iframe.webkitRequestFullScreen) {
                    iframe.webkitRequestFullScreen({
                        navigationUI: "hide"
                    });
                } else if (iframe.msRequestFullscreen) {
                    iframe.msRequestFullscreen();
                }
            }

            const exitFullScreen = () => {
                if (document.cancelFullScreen) {
                    document.cancelFullScreen()
                } else if (document.exitFullscreen) {
                    document.exitFullscreen()
                } else if (document.cancelFullscreen) {
                    document.cancelFullscreen()
                } else if (document.mozCancelFullScreen) {
                    document.mozCancelFullScreen()
                } else if (document.webkitCancelFullScreen) {
                    document.webkitCancelFullScreen()
                } else if (document.msExitFullscreen) {
                    document.msExitFullscreen()
                }
            }

            const isFullScreen = () => {
                return window.innerWidth === screen.width
            }

            const fullScreenButton = document.body.querySelector(".full-screen-button")
            fullScreenButton.addEventListener("click", () => {
                fullScreenButton.fullScreen = !fullScreenButton.fullScreen ?? true
                if (fullScreenButton.fullScreen) {
                    if (iframe.requestFullScreen || iframe.requestFullscreen || iframe.mozRequestFullScreen || iframe.webkitRequestFullScreen || iframe.msRequestFullscreen) {
                        setFullScreen()
                    }
                } else {
                    try {
                        exitFullScreen()
                    } catch (e) {
                        setFullScreen()
                    }
                }
            })
        }

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
            getFilmFiles("{{$filmImdbId}}", {{$isSerial}}, "{{$filmTitle}}", "{{$filmRawTitle}}");
        }

        const VIDEO_CDN_API_TOKEN = '3i40G5TSECmLF77oAqnEgbx61ZWaOYaE';

        function getFilmFiles(imdbId, isSerial, title, rawTitle) {
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
                }).catch((error, code) => {
                fetch('https://videocdn.tv/api/short?api_token=' + VIDEO_CDN_API_TOKEN + ('&title=' + rawTitle))
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
                    }).catch((error, code) => {

                })
            })
        }

        function parseVideoFiles(data) {

            const iframeSrc = data.iframe_src

            document.body.querySelector(".preview-poster")?.remove()
            LoaderShow(document.getElementById("iframe"))

            // fetch('https:' + iframeSrc + '?api_token=' + VIDEO_CDN_API_TOKEN)
            fetch('{{route("get-iframe-content")}}' + "?iframeSrc=" + iframeSrc)
                .then((response) => {
                    response.text()
                        .then((raw) => {

                            // new method
                            generateVideoContainer(raw)
                        })
                })

        }

        document.body.addEventListener("customEndedVideo", () => {
            const seriesSelector = document.querySelector("#iframe .controls .menu-button .settings-container").querySelector(".series select")
            if (!seriesSelector) {
                return
            }
            const selectedIndex = seriesSelector.selectedIndex
            const countOptions = seriesSelector.childNodes.length - 1
            if ((selectedIndex + 1) <= countOptions) {
                seriesSelector.selectedIndex = selectedIndex + 1
                triggerEvent(seriesSelector, "change")
            }
        })

        const generateVideoContainer = (raw) => {
            putWatched()
            const clearRaw = raw.replace(/\n/g, '')
                .replaceAll(/link/g, 'link-bac')
                .replaceAll(/script/g, 'script-bac')

            let trashElement = document.createElement('div');
            trashElement.innerHTML = clearRaw
            document.body.append(trashElement);

            let translations = trashElement.querySelector(".translations")
            const translationId = trashElement.querySelector("#translation_id")?.value

            const filesRaw = JSON.parse(trashElement.querySelector("#files").value)

            if (!translations) {
                translations = document.createElement('div')
                translations.classList.add("translations")
                const translationsSelector = document.createElement('select')
                Object.keys(filesRaw).forEach((translation, index) => {
                    let translationOption = document.createElement('option')
                    translationOption.label = "Озвучка " + (index + 1)
                    translationOption.value = translation
                    translationsSelector.append(translationOption)
                })
                translations.append(translationsSelector)
            }

            const translationsSelect = translations?.querySelector("select")
            // filmObject.was.translate && (translationsSelect.value = filmObject.was.translate)
            if (filmObject.was.translate) {
                translationsSelect.querySelector(`option[selected]`)?.removeAttribute("selected")
                translationsSelect.querySelector(`option[value="${filmObject.was.translate}"]`).setAttribute("selected", "")
            }

            document.querySelector("#iframe .controls .menu-button .settings-container").append(translations)

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
                document.querySelector("#iframe .controls .menu-button .settings-container").querySelector(".seasons")?.remove()
                let seasonsContainer = document.createElement('div')
                seasonsContainer.classList.add("seasons")
                let seasonsSelector = document.createElement('select')
                seasonsContainer.append(seasonsSelector)
                Object.keys(seasons).forEach((index) => {
                    let seasonOption = document.createElement('option')
                    seasonOption.label = `${Number(index) + 1} сезон`
                    seasonOption.textContent = `${Number(index) + 1} сезон`
                    seasonOption.value = index
                    if (index === (filmObject.was.season || "0")) {
                        seasonOption.selected = true
                        seasonOption.setAttribute("selected", "")
                    }
                    seasonsSelector.append(seasonOption)
                })
                document.querySelector("#iframe .controls .menu-button .settings-container").append(seasonsContainer)

                createSeriesSelector(files[translationsSelect.value][seasonsSelector.value])

                seasonsSelector.addEventListener("change", () => {
                    updateWatchedTime({series: 0, quality: 0, time: 0})
                    createSeriesSelector(files[translationsSelect.value][seasonsSelector.value])
                })
            }

            const createSeriesSelector = (series) => {
                document.querySelector("#iframe .controls .menu-button .settings-container").querySelector(".series")?.remove()

                const seasonsSelector = document.querySelector("#iframe .controls .menu-button .settings-container").querySelector(".seasons select")

                let seriesContainer = document.createElement('div')
                seriesContainer.classList.add("series")
                let seriesSelector = document.createElement('select')
                seriesContainer.append(seriesSelector)
                Object.keys(series).forEach((index) => {
                    let seriesOption = document.createElement('option')
                    seriesOption.label = `${Number(index) + 1} серия`
                    seriesOption.textContent = `${Number(index) + 1} серия`
                    seriesOption.value = index
                    if (index === (filmObject.was.series || "0")) {
                        seriesOption.selected = true
                        seriesOption.setAttribute("selected", "")
                    }
                    seriesSelector.append(seriesOption)
                })
                document.querySelector("#iframe .controls .menu-button .settings-container").append(seriesContainer)
                createQualitySelector(files[translationsSelect.value][seasonsSelector.value][filmObject.was.series || 0])

                seriesSelector.addEventListener("change", () => {
                    updateWatchedTime({quality: 0, time: 0})
                    createQualitySelector(files[translationsSelect.value][seasonsSelector.value][seriesSelector.value])
                })
            }

            let timerForTime = null

            const createQualitySelector = (qualityArr) => {
                document.querySelector("#iframe .controls .menu-button .settings-container").querySelector(".quality")?.remove()
                let qualityContainer = document.createElement('div')
                qualityContainer.classList.add("quality")
                let qualitySelector = document.createElement('select')
                qualityContainer.append(qualitySelector)
                let lastQuality = null
                Object.keys(qualityArr).forEach((qualityType) => {
                    let qualityOption = document.createElement('option')
                    qualityOption.label = qualityType
                    qualityOption.textContent = qualityType
                    qualityOption.value = qualityArr[qualityType]
                    lastQuality = qualityType
                    qualitySelector.append(qualityOption)
                })
                try {
                    // qualitySelector.querySelector(`[label='${(filmObject.was.quality)}']`).selected = true
                    qualitySelector.querySelector(`[label='${(filmObject.was.quality)}']`).setAttribute("selected", "")
                } catch (e) {
                    qualitySelector.querySelector(`[label='${(lastQuality)}']`).selected = true
                    qualitySelector.querySelector(`[label='${(lastQuality)}']`).setAttribute("selected", "")
                }
                document.querySelector("#iframe .controls .menu-button .settings-container").append(qualityContainer)

                const seasonsSelector = document.querySelector("#iframe .controls .menu-button .settings-container").querySelector(".seasons select")
                const seriesSelector = document.querySelector("#iframe .controls .menu-button .settings-container").querySelector(".series select")

                updateWatchedTime({
                    translate: translationsSelect?.value,
                    season: seasonsSelector?.value,
                    series: seriesSelector?.value,
                    quality: qualitySelector.selectedOptions[0].getAttribute("label"),
                    time: filmObject.was.time,
                })
                setVideo(qualitySelector.value, document.body.querySelector(".videoContainer"), filmObject.was.time)

                clearInterval(timerForTime)
                timerForTime = setInterval(() => {
                    updateWatchedTime({
                        translate: translationsSelect?.value,
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
                            translate: translationsSelect?.value,
                            season: seasonsSelector?.value,
                            series: seriesSelector?.value,
                            quality: qualitySelector.selectedOptions[0].getAttribute("label"),
                            time: document.body.querySelector(".videoContainer").querySelector('video').currentTime,
                        })
                    }, 5000)
                })
            }

            updateWatchedTime({translate: (translationsSelect?.value ?? 0)})
            translationsSelect?.addEventListener("change", () => {
                updateWatchedTime({season: 0, series: 0, quality: 0, time: 0})
                if (typeof filesRaw[translationsSelect.value] === "string") {
                    createQualitySelector(files[translationsSelect.value])
                } else {
                    createSeasonsSelector(files[translationsSelect.value])
                }
            })

            document.body.querySelector(".videoContainer").style.height = "100%"
            if (!translationsSelect || typeof filesRaw[translationsSelect.value] === "string") {
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
