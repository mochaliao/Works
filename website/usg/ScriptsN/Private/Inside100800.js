function initialize() {
    var myLatlng = new google.maps.LatLng(-33.864346, 151.213216);
    var mapOptions = {
        zoom: 15,
        center: myLatlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        disableDefaultUI: true
        //zoomControl: false,
        //panControl: false,
        //scaleControl:false
    };
    var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
    //var html = "Usgfx";
    //map.openInfoWindowHtml (map.getCenter(), html);
    var marker = new google.maps.Marker({
        position: myLatlng,
        map: map,
        title: 'Usgfx'
    });
}
var m = $("meta[http-equiv='Content-Language']").attr("content");
$.getScript("https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyBqtmWbG9jtD1elGYh3aOjxiQgsf6-lE1M&language=" + m).done(function () {
    google.maps.event.addDomListener(window, 'load', initialize);
});