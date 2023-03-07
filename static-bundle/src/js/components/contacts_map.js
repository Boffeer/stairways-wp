import {isClickedBeyond, getClickedNotBeyondElement} from "../utils/helpers.js";

function getMapPinImage() {
    return `//${window.location.host}/wp-content/themes/stairways/static-bundle/dist/img/common/logo-map.svg`
}

if (document.querySelector('.page-contacts__map')) {

    ymaps.ready(() => {

        let myMap = new ymaps.Map('map-contact',
            {
                center: [55.751574, 37.573856],
                zoom: 20
            },
            {
                searchControlProvider: 'yandex#search'
            });

        // Создаём макет содержимого.
        let MyIconContentLayout = ymaps.templateLayoutFactory.createClass(
            '<div style="color: #FFFFFF; font-weight: bold;">$[properties.iconContent]</div>'
        )

        let myPlacemark = new ymaps.Placemark(myMap.getCenter(),
            {
                hintContent: 'Собственный значок метки',
                balloonContent: 'Это красивая метка'
            },
            {
                // Опции.
                // Необходимо указать данный тип макета.
                iconLayout: 'default#image',
                // Своё изображение иконки метки.
                iconImageHref: getMapPinImage(),
                // Размеры метки.
                iconImageSize: [48, 48],
                // Смещение левого верхнего угла иконки относительно
                // её "ножки" (точки привязки).
                iconImageOffset: [-5, -38]
            }
        );

        /*
        let myPlacemarkWithContent = new ymaps.Placemark([55.661574, 37.573856],
            {
                hintContent: 'Собственный значок метки с контентом',
                balloonContent: 'А эта — новогодняя',
                iconContent: '12'
            }, {
                // Опции.
                // Необходимо указать данный тип макета.
                iconLayout: 'default#imageWithContent',
                // Своё изображение иконки метки.
                iconImageHref: 'images/ball.png',
                // Размеры метки.
                iconImageSize: [48, 48],
                // Смещение левого верхнего угла иконки относительно
                // её "ножки" (точки привязки).
                iconImageOffset: [-24, -24],
                // Смещение слоя с содержимым относительно слоя с картинкой.
                iconContentOffset: [15, 15],
                // Макет содержимого.
                iconContentLayout: MyIconContentLayout
            }
        );
        */

        // myMap.geoObjects.add(myPlacemark);
        function showInitailMapPins() {
            document.querySelector('.page-contacts-city').querySelectorAll('.page-contacts-city__location').forEach(location => {
                addMapPin(getLocationAddress(location));
            })
        }
        showInitailMapPins()



        function getClickedAddressCard(e) {
            return getClickedNotBeyondElement(e, 'page-contacts-city');
        }
        function isAddressCardClosing(card) {
            return !card.classList.contains('bayan--opened');
        }
        function getLocationAddress(location) {
            return location.dataset.address;
        }

        window.addEventListener('click', function(e) {
            const addressCard = getClickedAddressCard(e);

            if (!addressCard) return;

            if (!isAddressCardClosing(addressCard)) {
                addressCard.parentElement.querySelectorAll('.page-contacts-city').forEach(card =>{
                    if (card != addressCard) {
                        if (card.classList.contains('bayan--opened')) {
                            window.scroll({
                                top: card.getBoundingClientRect().top + pageYOffset - 80,
                                left: 0,
                                behavior: 'smooth'
                            })
                        }

                        if (card.bayan) {
                            card.bayan.close();
                        }
                    }
                })
            }

            if (isAddressCardClosing(addressCard)) return

            addressCard.querySelectorAll('.page-contacts-city__location').forEach(location => {
                addMapPin(getLocationAddress(location));
            })
        });

        let location = ymaps.geolocation.get();

        document.querySelectorAll('.accordion__mess--marshrut').forEach(el => {
            el.addEventListener('click', (e) => {
                e.preventDefault();

                window.scroll({
                    top: document.querySelector('.page-contacts__map').getBoundingClientRect().top + pageYOffset - 80,
                    left: 0,
                    behavior: 'smooth'
                })
                let addresOffice = el.closest('.accordion__body--container').querySelector('.link--geo span:first-child').innerText
                location.then(
                    (result) => {
                        ymaps.route([result.geoObjects.position, addresOffice], {
                            multiRoute: true
                        }).done(function(route) {
                            route.options.set("mapStateAutoApply", true);
                            myMap.geoObjects.add(route);
                        }, function(err) {
                            throw err;
                        }, this);
                        // myMap.geoObjects.add(result.geoObjects)
                    },
                    (err) => {
                        console.log('Ошибка: ' + err)
                    }
                );
            });
        });

        function addMapPin(address) {
            // myMap.container.fitToViewport();
            myMap.destroy();
            myMap = new ymaps.Map("map-contact", {
                center: [55.76, 37.64],
                zoom: 20
            });

            ymaps.geocode(address,
            {
                    /**
                     * Опции запроса
                     * @see https://api.yandex.ru/maps/doc/jsapi/2.1/ref/reference/geocode.xml
                     */
                    // Сортировка результатов от центра окна карты.
                    // boundedBy: myMap.getBounds(),
                    // strictBounds: true,
                    // Вместе с опцией boundedBy будет искать строго внутри области, указанной в boundedBy.
                    // Если нужен только один результат, экономим трафик пользователей.
                    results: 1
            }).then(function(res) {
                let firstGeoObject = res.geoObjects.get(0),
                    // Координаты геообъекта.
                    coords = firstGeoObject.geometry.getCoordinates(),
                    // Область видимости геообъекта.
                    bounds = firstGeoObject.properties.get('boundedBy');

                // firstGeoObject.options.set('preset', 'islands#darkBlueDotIconWithCaption');
                // // Получаем строку с адресом и выводим в иконке геообъекта.
                // firstGeoObject.properties.set('iconCaption', firstGeoObject.getAddressLine());

                // Добавляем первый найденный геообъект на карту.
                // myMap.geoObjects.add(firstGeoObject);
                // Масштабируем карту на область видимости геообъекта.
                myMap.setCenter(coords, 7, {
                    // Проверяем наличие тайлов на данном масштабе.
                    checkZoomRange: true
                });

                let myPlacemark = new ymaps.Placemark(coords,
                    {
                        //  iconContent: 'моя метка',
                        balloonContent: firstGeoObject.getAddressLine()
                    }, {
                        // Тип макета.
                        iconLayout: 'default#image',
                        // Своё изображение иконки метки.
                        iconImageHref: getMapPinImage(),
                        // Размеры метки.
                        iconImageSize: [48, 48],
                        // Смещение левого верхнего угла иконки относительно
                        // её "ножки" (точки привязки).
                        iconImageOffset: [-5, -38]
                    }
                );

                myMap.geoObjects.add(myPlacemark);
            });
        }
    });
}