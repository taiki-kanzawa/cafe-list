/*global $*/
$(function(){
    $('.thumbnails img').click(function(){
        var $thisImg = $(this).attr('src');
        var $thisAlt = $(this).attr('alt');
        $('.main-image img').attr({src:$thisImg,alt:$thisAlt});
    });
});