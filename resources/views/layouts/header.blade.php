<header class="w-100 pos-rel z-2 flex" style="height: 60px; background-color: darkred;">
    <a href="{{route('home')}}">
        <div style="height: 125px; margin-left: 40px;" class="pt-10">
            <img src="{{asset('assets/img/logo.png')}}" alt="">
        </div>
    </a>

    @if(auth()->check())

    <div class="ml-a flex-center">

        <a class="index-buttons h-75 p-5" href="{{route('search')}}" title="избранное">
            <svg height="100%" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 1000 1000" enable-background="new 0 0 1000 1000" xml:space="preserve">
                <g><path d="M988.3,392.3c-4.2-13.8-15.5-24.1-29.6-27l-302.6-60.6L535.5,33c-6.2-14-20.2-23-35.5-23s-29.2,9.1-35.5,23.1L343.8,304.7L41.1,365.3c-14,2.9-25.2,13.2-29.4,26.9c-4.2,13.6-0.4,28.4,9.7,38.7l210.8,210.7l-58.9,301.7c-2.9,14.7,0.9,29,12.2,38.2c6.8,5.4,15.5,8.3,24.6,8.3c5.5,0,10.8-1.1,15.6-3.3L500,864.8l274.6,121.8c4.7,2.2,9.8,3.4,15.4,3.4c8.7,0,17.3-3,24.1-8.4c11.5-9.1,15.3-23.8,12.5-38.3l-59.1-301.8l211-210.7C988.7,420.7,992.5,405.9,988.3,392.3z M702.7,576.6c-21.7,21.6-31.1,52.6-25.2,82.6l39.3,201.2l-179.5-79.6c-11.9-5.3-24.6-7.9-37.3-7.9c-12.7,0-25.4,2.6-37.2,7.9l-179.6,79.7l39.4-201.3c5.8-30-3.6-61-25.2-82.6L156.4,435.9l205.4-41.1c29.2-5.8,53.8-25.5,65.9-52.8L500,179.4L572.2,342c12.1,27.3,36.7,46.9,65.9,52.8L843.5,436L702.7,576.6z"/></g>
            </svg>
        </a>


        <a class="index-buttons h-75 p-5" href="{{route('profile')}}" title="профиль">
            <svg height="100%" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 1000 1000" enable-background="new 0 0 1000 1000" xml:space="preserve">
                <g><path d="M500,10C229.4,10,10,229.4,10,500c0,270.6,219.4,490,490,490c270.6,0,490-219.4,490-490C990,229.4,770.6,10,500,10z M500,156.5c89.5,0,162.1,72.6,162.1,162.1c0,89.5-72.6,162.1-162.1,162.1c-89.5,0-162-72.6-162-162.1C338,229.1,410.5,156.5,500,156.5z M499.9,861.9c-89.3,0-171.1-32.5-234.2-86.4c-15.4-13.1-24.2-32.3-24.2-52.5c0-90.8,73.5-163.4,164.2-163.4h188.6c90.8,0,164,72.6,164,163.4c0,20.2-8.8,39.4-24.2,52.5C671,829.3,589.2,861.9,499.9,861.9z"/></g>
            </svg>
        </a>

        <a class="index-buttons h-75 p-5 pr-25" href="{{route('logout')}}" title="выход">
            <svg height="100%" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 1000 1000" enable-background="new 0 0 1000 1000" xml:space="preserve">
                <g><path d="M886.4,198.5c-21.8-27.8-46.6-53.3-73.5-75.7c-14.9-12.3-37-10.2-49.3,4.6c-12.4,14.9-10.2,37,4.5,49.3c23.1,19.2,44.4,41,63.1,65C889.3,316,920,405.3,920,500c0,231.6-188.4,420-420,420C268.4,920,80,731.6,80,500c0-94.8,30.7-184.1,88.9-258.4c18.5-23.7,39.7-45.5,62.8-64.7c14.9-12.4,16.9-34.4,4.6-49.3c-12.4-14.9-34.5-16.8-49.3-4.6c-27,22.4-51.6,47.9-73.2,75.5C45.9,285.2,10,389.5,10,500c0,270.1,219.9,490,490,490s490-219.9,490-490C990,389.6,954.2,285.4,886.4,198.5z"/><path d="M500,500c19.3,0,34.9-15.6,35-34.9l1.5-420c0-19.3-15.5-35.1-34.9-35.1c-0.1,0-0.1,0-0.1,0c-19.2,0-34.9,15.6-35,34.9l-1.5,420C464.9,484.2,481.2,499.7,500,500z"/></g>
            </svg>
        </a>

    </div>

    @endif

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
