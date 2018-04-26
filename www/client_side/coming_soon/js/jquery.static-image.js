/**
 * Created by Laco.
 * @author: Konstantin Mokhov (HtmlMak)
 * Date: 26.05.2016
 * Time: 11:24
 */
$(document).ready(function () {
    var $image = $('.static-image');
    $image.css('background-image', 'url(' + $image.data('src') + ')');
});