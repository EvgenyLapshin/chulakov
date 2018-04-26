$(window).load(function () {
    "use strict";
    var scale = 0.5;

    function fullScreenContainer() {

        var screenWidth = $('#right-side').width() + "px";
        var screenHeight = $(window).height() * scale + "px";

        $("#map").css({
            width : screenWidth,
            height: screenHeight
        });

        $(window).resize(function () {

            var screenWidth = $('#right-side').width() + "px";
            var screenHeight = $(window).height() * scale + "px";

            $("#map").css({
                width : screenWidth,
                height: screenHeight
            });

        });

    }

    fullScreenContainer();

});

function mapInit() {
    var center = [];
    var data = mapData;
    var pointCount = 0;
    var cityPoint = new ymaps.GeoObjectCollection();
    var map = new ymaps.Map('map', {
        center  : [],
        zoom    : 14,
        controls: [],
        maxZoom : 16,
        minZoom : 4,
        flying  : true
    });

    map.behaviors.disable('scrollZoom');

    map.controls.add("zoomControl", {
        // Расположим кнопку пробок слева
        float   : 'none',
        position: {
            bottom: 50,
            right : 30
        }
    });

    cityPoint.removeAll();

    $.each(data.points, function (key, value) {
        var latLon = value[0].trim(' ').split(',');
        var point = new ymaps.Placemark(latLon,
            {
                balloonContent: value[1]
            }, {
                iconLayout           : 'default#image',
                balloonMaxWidth      : 255,
                balloonMapAutoPan    : true,
                // Отключаем кнопку закрытия балуна.
                balloonCloseButton   : true,
                // Балун будем открывать и закрывать кликом по иконке метки.
                hideIconOnBalloonOpen: false
            }
        );

        center = latLon;
        cityPoint.add(point);
        pointCount++;
    });

    map.geoObjects.add(cityPoint);

    if (pointCount > 1) {
        ymaps.geoQuery(map.geoObjects).applyBoundsToMap(map);
    }
    else {
        map.setCenter(center);
        map.setZoom(16);
    }
}