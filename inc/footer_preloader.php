    <div id="fls-preloader">
        <!-- Документація: https://template.fls.guru/template-docs/modul-preloader.html -->
        <!-- Стилі для прелоадера -->
        <style>
            * {
                padding: 0px;
                margin: 0px;
                border: 0px;
            }

            *,
            *:before,
            *:after {
                box-sizing: border-box;
            }

            html {
                overflow: hidden;
                touch-action: none;
                overscroll-behavior: none;
            }

            /* Головний блок */
            .fls-preloader {
                pointer-events: none;
                z-index: -1;
                position: fixed;
                width: 100%;
                height: 100%;
                top: 0;
                left: 0;
                display: flex;
                justify-content: center;
                align-items: center;
            }

            /* Блок з елементами */
            .fls-preloader__body {
                padding: 0.93rem;
                max-width: 480px;
                width: 100%;
                display: flex;
                flex-direction: column;
                align-items: center;
            }

            /* Блок з лічильником */
            .fls-preloader__counter {
                font-size: 50px;
                line-height: 61px;
                color: #FCC10A;
            }

            /* Прогресбар */
            .fls-preloader__line {
                width: 100%;
                position: relative;
                background: #C4C4C4;
            }

            .fls-preloader__line:before {
                content: "";
                position: absolute;
                width: 100%;
                height: 100%;
                top: 0;
                left: 0;
                background: #C4C4C4;
                height: 6px;
                z-index: 1;
            }

            .fls-preloader__line:after {
                content: "";
                position: absolute;
                width: 100%;
                height: 100%;
                top: 0;
                left: 0;
                background: url('<?php echo get_template_directory_uri();?>/img/preloader-bg.png') 0 0 / 14px 6px;
                height: 6px;
                z-index: 3;
            }

            /* Лінія прогресбару */
            .fls-preloader__line span {
                display: block;
                transition: width 0.2s ease;
                height: 6px;
                background-color: #FCC10A;
                position: relative;
                z-index: 2;
            }
        </style>
        <!-- Скріпт прелоадера -->
        <script>
            function preloader() {
                const preloaderImages = document.querySelector('[data-preloader]') ? document.querySelectorAll('[data-preloader] img') : document.querySelectorAll('img');
                const preloaderContainer = document.querySelector('#fls-preloader');
                if (preloaderImages.length) {
                    const preloaderTemplate = `
                    <div class="fls-preloader">
                        <div class="fls-preloader__body">
                            <div class="fls-preloader__counter">0%</div>
                            <div class="fls-preloader__line"><span></span></div>
                        </div>
                    </div>`;
                    document.querySelector('html').insertAdjacentHTML("beforeend", preloaderTemplate);

                    const
                        preloader = document.querySelector('.fls-preloader'),
                        showPecentLoad = document.querySelector('.fls-preloader__counter'),
                        showLineLoad = document.querySelector('.fls-preloader__line span'),
                        htmlDocument = document.documentElement;

                    let imagesLoadedCount = counter = progress = 0;

                    htmlDocument.classList.add('loading');
                    htmlDocument.classList.add('lock');

                    preloaderImages.forEach(preloaderImage => {
                        const imgClone = document.createElement('img');
                        if (imgClone) {
                            imgClone.onload = imageLoaded;
                            imgClone.onerror = imageLoaded;
                            preloaderImage.dataset.src ? imgClone.src = preloaderImage.dataset.src : imgClone.src = preloaderImage.src;
                        }
                    });

                    function setValueProgress(progress) {
                        showPecentLoad ? showPecentLoad.innerText = `${progress}%` : null;
                        showLineLoad ? showLineLoad.style.width = `${progress}%` : null;
                    }
                    showPecentLoad ? setValueProgress(progress) : null;

                    function imageLoaded() {
                        imagesLoadedCount++;
                        progress = Math.round((100 / preloaderImages.length) * imagesLoadedCount);
                        const intervalId = setInterval(() => {
                            counter >= progress ? clearInterval(intervalId) : setValueProgress(++counter);
                            counter >= 100 ? addLoadedClass() : null;
                        }, 10);
                    }

                    function addLoadedClass() {
                        htmlDocument.classList.add('loaded');
                        htmlDocument.classList.remove('lock');
                        htmlDocument.classList.remove('loading');
                        setInterval(() => {
                            preloader.remove();
                            preloaderContainer.remove();
                        }, 0);
                    }
                } else {
                    preloaderContainer.remove();
                }
            }
            preloader();
        </script>
    </div>