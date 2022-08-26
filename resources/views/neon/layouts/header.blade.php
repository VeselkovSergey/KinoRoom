<style>
    .sign_word {
        font-size: 40px;
        font-weight: bold;
        /*line-height: 40px;*/
        color: #ffffff;
        font-family: system-ui;
        text-transform: uppercase;
        text-shadow: 0 -40px 100px, 0 0 2px, 0 0 1em #338fee, 0 0 0.5em #b625c5, 0 0 0.1em #300472;
    }
    .sign_word span {
        animation: neon-4 linear infinite 2s;
    }

    .sign_word * {
        display: inline-block;
    }
    @keyframes neon-4 {
        78% {
            color: inherit;
            text-shadow: inherit;
        }
        79% {
            color: #0b3960;
        }
        80% {
            text-shadow: none;
        }
        81% {
            color: inherit;
            text-shadow: inherit;
        }
        82% {
            color: #0b3960;
            text-shadow: none;
        }
        83% {
            color: inherit;
            text-shadow: inherit;
        }
        92% {
            color: #0b3960;
            text-shadow: none;
        }
        92.5% {
            color: inherit;
            text-shadow: inherit;
        }
    }

    .neon-svg {
        fill: white;
        filter: drop-shadow( 1px 5px 4px #008cff );
    }

    .pr-25-0 {
        padding-right: 25px;
    }
    @media screen and (max-width: 540px) {
        .pr-25-0 {
            padding-right: 0;
        }
    }

    .pl-50-10 {
        padding-left: 50px;
    }
    @media screen and (max-width: 540px) {
        .pl-50-10 {
            padding-left: 10px;
        }
    }
</style>

<header class="w-100 pos-rel z-2 flex" style="max-width: 100%; height: 70px; background: linear-gradient(210deg, black, transparent);">
    <a href="{{route('home')}}" class="flex-center" style="text-decoration: unset;">
        <div class="pl-50-10 sign_word"><div><div>N</div>E</div><span><div>O</div></span><span>N</span><div><div>F</div>I</div><span>L</span><div>M</div><span>S</span></div>
    </a>

{{--    @if(auth()->check())--}}

    <div class="flex-center ml-a">

        <a class="index-buttons h-75" href="https://t.me/neonfilmz" title="наш Telegram">
            <svg width="100%" height="100%" class="neon-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" style="filter: drop-shadow( 1px 5px 4px #008cff ); max-width: 70px;">
                <path d="M490.626,153.442c-13.697-31.292-33.236-59.158-58.073-82.819c-3.207-3.055-8.28-2.933-11.335,0.275
			c-3.054,3.206-2.931,8.28,0.275,11.333c48.024,45.751,74.473,107.464,74.473,173.769c0,132.318-107.648,239.967-239.967,239.967
			S16.033,388.318,16.033,256S123.682,16.033,256,16.033c48.336,0,94.93,14.306,134.742,41.369
			c3.661,2.489,8.647,1.538,11.137-2.122c2.489-3.662,1.538-8.648-2.123-11.137C357.274,15.265,307.565,0,256,0
			C187.62,0,123.333,26.628,74.981,74.981C26.629,123.333,0,187.62,0,256s26.629,132.667,74.981,181.019
			C123.333,485.372,187.62,512,256,512s132.667-26.628,181.019-74.981C485.371,388.667,512,324.38,512,256
			C512,220.348,504.808,185.842,490.626,153.442z"></path>
                <path d="M372.333,108.552l-154.176,71.771c-4.014,1.868-5.753,6.638-3.884,10.652s6.638,5.755,10.65,3.885l95.106-44.274
			l-46.237,37.431l-106.107,85.896l-58.036-25.392l81.326-37.858c4.014-1.87,5.753-6.638,3.884-10.652
			c-1.868-4.014-6.639-5.755-10.65-3.885l-87.54,40.752c-4.654,2.166-7.592,6.905-7.474,12.035c0.115,5.02,3.149,9.538,7.748,11.55
			l64.802,28.35l18.979,113.873c1.168,7.041,10.702,9.046,14.613,3.075l53.836-82.171l101.811,47.512
			c8.157,3.81,17.864-2.012,18.39-10.966l14.344-243.849c0.015-0.226,0.014-0.458,0.009-0.685
			C383.567,109.927,377.471,106.176,372.333,108.552z M190.018,360.931l-12.404-74.428l126.369-102.299l-96.718,108.441
			c-0.87,0.976-1.516,2.204-1.816,3.479L190.018,360.931z M207.049,358.631l11.72-49.228l15.724,7.338L207.049,358.631z
			 M243.371,303.191l-16.967-7.917l83.469-93.586L297.8,220.116L243.371,303.191z M353.637,354.649l-95.586-44.607l107.897-164.684
			L353.637,354.649z"></path>
</svg>
        </a>


{{--        <a class="index-buttons h-75 p-5 pr-25" href="{{route('profile')}}" title="избранное">--}}
{{--            <svg height="100%" class="neon-svg" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 490.706 490.706" style="filter: drop-shadow( 0px 1px 1px #008cff );" xml:space="preserve">--}}
{{--                <g>--}}
{{--                    <g>--}}
{{--                        <path d="M490.133,178.037c-1.493-4.373-5.547-7.253-10.133-7.36H309.653l-54.187-163.2c-1.813-5.547-7.893-8.64-13.44-6.827--}}
{{--			c-3.2,1.067-5.76,3.627-6.827,6.827l-54.187,164.267H10.667C4.8,170.784,0,175.477,0,181.45c0,3.307,1.493,6.4,4.16,8.427--}}
{{--			l136.96,107.2L81.493,476.49c-1.92,5.547,1.067,11.627,6.72,13.547c3.307,1.067,6.933,0.533,9.707-1.493l147.52-107.52--}}
{{--			L392.96,486.09c4.8,3.413,11.413,2.347,14.827-2.453c1.92-2.773,2.453-6.293,1.493-9.493L350.187,292.81L486.4,189.984--}}
{{--			C490.133,187.21,491.627,182.41,490.133,178.037z M331.307,280.224c-3.627,2.773-5.12,7.467-3.733,11.84l51.413,157.76--}}
{{--			l-127.36-90.773c-3.733-2.667-8.747-2.667-12.48,0.107l-126.827,92.48l51.413-154.88c1.387-4.267,0-8.96-3.52-11.733L41.6,192.01--}}
{{--			h147.093c4.587,0,8.64-2.987,10.133-7.36l46.507-140.16l46.507,140.16c1.493,4.373,5.547,7.253,10.133,7.36h146.133--}}
{{--			L331.307,280.224z"></path>--}}
{{--                    </g>--}}
{{--                </g>--}}
{{--                <g>--}}
{{--                </g>--}}
{{--                <g>--}}
{{--                </g>--}}
{{--                <g>--}}
{{--                </g>--}}
{{--                <g>--}}
{{--                </g>--}}
{{--                <g>--}}
{{--                </g>--}}
{{--                <g>--}}
{{--                </g>--}}
{{--                <g>--}}
{{--                </g>--}}
{{--                <g>--}}
{{--                </g>--}}
{{--                <g>--}}
{{--                </g>--}}
{{--                <g>--}}
{{--                </g>--}}
{{--                <g>--}}
{{--                </g>--}}
{{--                <g>--}}
{{--                </g>--}}
{{--                <g>--}}
{{--                </g>--}}
{{--                <g>--}}
{{--                </g>--}}
{{--                <g>--}}
{{--                </g>--}}
{{--</svg>--}}
{{--        </a>--}}

{{--        <a class="index-buttons h-75 p-5 pr-25" href="{{route('logout')}}" title="выход">--}}
{{--            <svg height="100%" class="neon-svg" fill="white" style="filter: drop-shadow( 1px 5px 4px #008cff ) " viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">--}}
{{--                <path d="M24,45.73A23.34,23.34,0,0,1,7.81,39.35,21.47,21.47,0,0,1,1,23.77,22.21,22.21,0,0,1,16,3a0.5,0.5,0,0,1,.34.94A21.21,21.21,0,0,0,2,23.77,20.49,20.49,0,0,0,8.5,38.63,22.35,22.35,0,0,0,24,44.73h0.11c12.13-.05,22-9.55,21.91-21.16A21.18,21.18,0,0,0,31.25,3.77a0.5,0.5,0,1,1,.32-0.95A22.18,22.18,0,0,1,47,23.56c0.05,12.17-10.22,22.11-22.9,22.17H24Z"></path>--}}
{{--                <path d="M24,16.27a0.5,0.5,0,0,1-.5-0.5v-13a0.5,0.5,0,0,1,1,0v13A0.5,0.5,0,0,1,24,16.27Z"></path>--}}
{{--            </svg>--}}
{{--        </a>--}}

    </div>

{{--    @endif--}}

</header>

<style>
    /*.index-buttons {*/
    /*    padding: 25px;*/
    /*    border-radius: 10px;*/
    /*    text-align: center;*/
    /*    box-shadow: 0 0 10px rgba(0, 0, 0, 0.25);*/
    /*    cursor: pointer;*/
    /*    background-color: white;*/
    /*}*/

    /*.index-buttons:not(:last-child) {*/
    /*    margin-bottom: 10px;*/
    /*}*/

    .index-buttons:hover {
        transform: scale(1.05);
        transition: transform 250ms;
    }

    .title-helper {
        text-align: center;
        position: absolute;
        background-color: rgba(255, 255, 255, 0.95);
        color: #000000;
        padding: 5px;
        border-radius: 10px;
        width: 150px;
        bottom: -25px;
    }
    /*.title-helper:after {*/
    /*    content: " ";*/
    /*    border: 8px solid transparent;*/
    /*    border-bottom: 10px solid rgba(255, 255, 255, 0.95);*/
    /*    position: absolute;*/
    /*    top: -18px;*/
    /*    left: 50%;*/
    /*}*/
</style>

<script>

    function CreateElement(tag, params, parent) {
        const element = document.createElement(tag);
        if (params.attr) {
            Object.keys(params.attr).forEach((a) => {
                element.setAttribute(a, params.attr[a]);
            });
        }
        if (params.class) {
            element.className = params.class;
        }
        if (params.events) {
            Object.keys(params.events).forEach((e) => {
                element.addEventListener(e, params.events[e]);
            });
        }
        if (params.content) {
            element.innerHTML = params.content;
        }
        if (parent) {
            parent.appendChild(element);
        }
        if (params.childs) {
            params.childs.forEach((child) => {
                element.appendChild(child);
            })
        }
        return element;
    }

    document.body.querySelectorAll('.index-buttons').forEach((element) => {
        element.addEventListener('mouseenter', () => {
            if (element.getAttribute('title') && !element.dataset.titleShow || element.dataset.titleShow === 'false') {
                element.dataset.titleShow = 'true';
                element.dataset.titleId = uid();
                const titleContainer = CreateElement('div', {content: element.getAttribute('title'), class: 'title-helper'});
                titleContainer.dataset.id = element.dataset.titleId;
                element.after(titleContainer);
                let left = element.getBoundingClientRect().left + ((element.getBoundingClientRect().width) / 2) - 150 / 2 - 10;

                if (left + titleContainer.getBoundingClientRect().width > document.body.clientWidth) {
                    console.log(left)
                    left = left - (left + titleContainer.getBoundingClientRect().width - document.body.clientWidth);
                    console.log(left)
                }

                titleContainer.style.left = left + 'px';
                element.setAttribute('hide-title', element.getAttribute('title'));
                element.removeAttribute('title');
            }
        });

        element.addEventListener('mouseleave', () => {
            if (element.dataset.titleShow === 'true') {
                element.dataset.titleShow = 'false';
                element.setAttribute('title', element.getAttribute('hide-title'));
                element.removeAttribute('hide-title')
                const titleHelper = element.parentElement.querySelector('[data-id="' + element.dataset.titleId + '"]');
                if (titleHelper) {
                    titleHelper.remove();
                }
            }
        });
    });

    const uid = function () {
        return Date.now().toString(36) + Math.random().toString(36).substr(2);
    }
</script>
