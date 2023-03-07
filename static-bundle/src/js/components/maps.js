import {isClickedBeyond, getClickedNotBeyondElement} from "../utils/helpers.js";

function getMapPinImage() {
    return `//${window.location.host}/wp-content/themes/stairways/static-bundle/dist/img/common/logo-map.svg`
}

if (document.querySelector('#map')) {

    ymaps.ready(() => {

        let myMap = new ymaps.Map('map',
            {
                center: [55.751574, 37.573856],
                zoom: 1,
            },
            {
                searchControlProvider: 'yandex#search'
            });
        // Создаём макет содержимого.
        let MyIconContentLayout = ymaps.templateLayoutFactory.createClass(
            '<div style="color: #FFFFFF; font-weight: bold;">$[properties.iconContent]</div>'
        )

        function showInitailMapPins() {
            document.querySelectorAll('.location-addresses__item').forEach(location => {
                addMapPin(getLocationAddress(location));
            })
        }
        function getLocationAddress(location) {
            return location.dataset.address;
        }
        
        showInitailMapPins()



        function getClickedAddressCard(e) {
            return getClickedNotBeyondElement(e, 'page-contacts-city');
        }
        function isAddressCardClosing(card) {
            return !card.classList.contains('bayan--opened');
        }

        window.addEventListener('click', function(e) {
            const addressCard = getClickedAddressCard(e);
            if (!addressCard) return;
            if (isAddressCardClosing(addressCard)) return

            addressCard.querySelectorAll('.page-contacts-city__location').forEach(location => {
                addMapPin(getLocationAddress(location));
            })
        });

        let location = ymaps.geolocation.get();

        document.querySelectorAll('.accordion__mess--marshrut').forEach(el => {
            el.addEventListener('click', (e) => {
                e.preventDefault();
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
            myMap = new ymaps.Map("map", {
                center: [55.76, 42.64],
                zoom: 5
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
                // myMap.setCenter(coords, 7, {
                    // Проверяем наличие тайлов на данном масштабе.
                    // checkZoomRange: true
                // });

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
        //end addMapPin

    });
}
/*
//import { data } from '/data_map.json';
if (document.querySelector('#map') && ymaps != undefined) {
    ymaps.ready(init);

    function init() {
        // var customBalloonContentLayout = ymaps.templateLayoutFactory.createClass([
        //     '<ul class=list>',
        //     // Выводим в цикле список всех геообъектов.
        //     '{% for geoObject in properties.geoObjects %}',
        //     '<li><a href=# data-placemarkid="{{ geoObject.properties.placemarkId }}" class="list_item">{{ geoObject.properties.length }}</a></li>',
        //     '{% endfor %}',
        //     '</ul>'
        // ].join(''));
        let myMap = new ymaps.Map('map', {
                center: [55.76, 37.64],
                zoom: 10
            }, {
                searchControlProvider: 'yandex#search'
            }),
            objectManager = new ymaps.ObjectManager({
                // Чтобы метки начали кластеризоваться, выставляем опцию.
                clusterize: true,
                // ObjectManager принимает те же опции, что и кластеризатор.
                gridSize: 32,
                hasBalloon: true,
                hasHint: true,
                clusterDisableClickZoom: true,
                clusterOpenBalloonOnClick: true,
                // Устанавливаем режим открытия балуна. 
                // В данном примере балун никогда не будет открываться в режиме панели.
                clusterBalloonPanelMaxMapArea: 0,
                // По умолчанию опции балуна balloonMaxWidth и balloonMaxHeight не установлены для кластеризатора,
                // так как все стандартные макеты имеют определенные размеры.
                clusterBalloonMaxHeight: 200,
                iconContentLayout: 'cluster#blueGovernmentCircleIcon',
                // clusterIconLayout: customBalloonContentLayout,
            });


        // Чтобы задать опции одиночным объектам и кластерам,
        // обратимся к дочерним коллекциям ObjectManager.

        // var clusterer = new ymaps.Clusterer({
        //     // Зададим макет метки кластера.
        //     clusterIconLayout: ymaps.templateLayoutFactory.createClass('<div class="clusterIcon">{{ properties.geoObjects.length }}</div>'),
        //     // Чтобы метка была кликабельной, переопределим ее активную область.
        //     clusterIconShape: {
        //         type: 'Rectangle',
        //         coordinates: [[0, 0], [20, 20]]
        //     }
        // });
        // var customItemContentLayout = ymaps.templateLayoutFactory.createClass(
        //     // Флаг "raw" означает, что данные вставляют "как есть" без экранирования html.
        //     '<h2 class=ballon_header>{{ properties.balloonContentHeader|raw }}</h2>' +
        //     '<div class=ballon_body>{{ properties.balloonContentBody|raw }}</div>' +
        //     '<div class=ballon_footer>{{ properties.balloonContentFooter|raw }}</div>'
        // );
        // var customPlacemarkLayout = ymaps.templateLayoutFactory.createClass(
        //     '<div class=placemark_layout_container>{{ properties.cost }}</div>'
        // );
        // // Создаем собственный макет с информацией о выбранном геообъекте.
        // var customBalloonContentLayout = ymaps.templateLayoutFactory.createClass([
        //     '<h2 class=ballon_header>{{ properties.rooms }}</h2>'
        // ].join(''));



        objectManager.events.add('click', function(e) {
            var clustererPlacemark = e.get('target');
            // var overlay = clustererPlacemark.getOverlaySync();
            // var layout = overlay.getLayoutSync();
            // var element = layout.getParentElement();
            //  doWhateverYouWant(element);
            console.log(clustererPlacemark)
        });

        objectManager.objects.options.set('preset', 'islands#blueDotIconWithCaption');

        objectManager.clusters.options.set({
            preset: 'islands#blueDotIconWithCaption',
            iconCaption: 'Подпись метки',
            //  clusterIcons: clusterIcons,
            // iconLayout: customPlacemarkLayout,
            // balloonContentLayout: customBalloonContentLayout,
            // clusterIconContentLayout: customItemContentLayout,
            // hintContentLayout: ymaps.templateLayoutFactory.createClass('Группа объектов')
        });
        myMap.geoObjects.add(objectManager);

        // fetch('/data_map.json')
            // .then(response => response.json())
            // .then(result => {
            //     objectManager.add(result)
            // });

    }

}
*/