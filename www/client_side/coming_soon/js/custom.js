/**
 * Created by Laco.
 * @author: Konstantin Mokhov (HtmlMak)
 * Date: 25.05.2016
 * Time: 17:38
 */
$(document).ready(function () {
    $(document.body).on('click', 'a[href="#"]', function (e) {
        e.preventDefault();
    });
});

!function(a){a.fn.serializeObject=function(){var b={},c=function(c,d){var e=b[d.name];"undefined"!==typeof e&&null!==e?a.isArray(e)?e.push(d.value):b[d.name]=[e,d.value]:b[d.name]=d.value};return a.each(this.serializeArray(),c),b}}(jQuery);
