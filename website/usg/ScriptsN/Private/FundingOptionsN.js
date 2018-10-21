$(function () {
    var $TableCornerTL = $('.table:first-child tbody:first-child tr:first-child th:first-child');
    var $TableCornerTR = $('.table:first-child tbody:first-child tr:first-child th:last-child');
    var $TableCornerBL = $('.table:last-child > tbody:last-child > tr:last-child td:first-child');
    var $TableCornerBR = $('.table:last-child > tbody:last-child > tr:last-child td:last-child');
    var $tmp;
    if (culture == "ar-AE") {
        $tmp = $TableCornerTL;
        $TableCornerTL = $TableCornerTR;
        $TableCornerTR = $tmp;
        $tmp = $TableCornerBL;
        $TableCornerBL = $TableCornerBR;
        $TableCornerBR = $tmp;
    }
    $TableCornerTL.addClass('RadiusTL');
    $TableCornerTR.addClass('RadiusTR');
    $TableCornerBL.addClass('RadiusBL');
    if (showInfo != "W")
    {
       $TableCornerBR.addClass('RadiusBR');
    }
})