var kupavnaContacts = function () {

    var mapInit = function () {

        $('.contacts-map').each(function () {
            var $this = $(this);
            var center = [];
            var data = JSON.parse($this.data('points'));
            var pointCount = 0;
            var cityPoint = new ymaps.GeoObjectCollection();
            var map = new ymaps.Map($this.get(0), {
                center: [],
                zoom: 14,
                controls: [],
                maxZoom: 16,
                minZoom: 4,
                flying: true
            });

            map.behaviors.disable('scrollZoom');

            map.controls.add("zoomControl", {
                // Расположим кнопку пробок слева
                float: 'none',
                position: {
                    bottom: 50,
                    right: 30
                }
            });

            cityPoint.removeAll();

            var latLon = data.coords.trim(' ').split(',');

            var openBalloon = function () {
                map.balloon.open(latLon, data.baloon, {
                    closeButton: true,
                    maxWidth: 255,
                    mapAutoPan: true,
                });
            };

            var point = new ymaps.Placemark(latLon,
                {}, {
                    iconLayout: 'default#image',
                    iconImageHref: '/dist/img/icons/map-marker.png',
                    iconImageSize: [40, 57],
                    iconImageOffset: [-20, -57]
                }
            );

            point.events.add('click', function () {
                if (map.balloon.isOpen()) {
                    map.balloon.close();
                } else {
                    openBalloon();
                }
            });

            center = latLon;
            cityPoint.add(point);

            map.geoObjects.add(cityPoint);

            openBalloon();

            map.setCenter(center);
            map.setZoom(16);
        });

    };

    return {
        init: function () {
            $('.contacts-address .red p').dotdotdot();
            kupavnaApp.showToggle('.contacts-managers', 100);
            $('.contacts-managers').animate({opacity: 1});

            $('#contacts').on('change.zf.tabs', function () {
                // update
                kupavnaApp.showToggle('.contacts-managers', 100, true);
            });
        },

        map: function () {
            mapInit();
        }
    }
}();

$(document).ready(function () {
    kupavnaContacts.init();
});