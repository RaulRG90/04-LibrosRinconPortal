













//"use strict";

$(function() {/*
  var handleIn = function(){
    $(this).parent().siblings('i.fa.fa-play-circle-o.video-play').hide();
  };

  var handleOut = function(){
    $(this).parent().siblings('i.fa.fa-play-circle-o.video-play').show();
  };*/

  $('.home_menu').click(function() {
    var section = this.getAttribute("data-section");
    switch(section){
        case '.blog.section':
            window.history.pushState(null,null,window.location.pathname+'#blog');
            break;
        case '.press':
            window.history.pushState(null,null,window.location.pathname+'#prensa');
            break;
        case '.multimedia':
            window.history.pushState(null,null,window.location.pathname+'#multimedia');
            break;
        case '.reforms':
            window.history.pushState(null,null,window.location.pathname+'#reformas');
            break;
        case '.structure':
            window.history.pushState(null,null,window.location.pathname+'#estructura');
            break;
        case '.programs':
            window.history.pushState(null,null,window.location.pathname+'#acciones');
            break;
        case '.documents':
            window.history.pushState(null,null,window.location.pathname+'#documentos');
            break;
        case '.schedule':
            window.history.pushState(null,null,window.location.pathname+'#agenda');
            break;
    }
    $('html,body').animate({scrollTop: $(section).offset().top - 100}, 500);
    return false;
  });

/*
    // OPENDATA SHOW MORE
    $(".click_opendata").click(function(event){
        event.preventDefault();
        var counter=0;
        var lnk_visible=0;
        var lnk_len = $(".opendata_panel").length;
        $(".opendata_panel").each(function(index, element) {
          if (counter<3 && $(element).is(':hidden') ){
            counter++; $(element).show();
          }else{
            lnk_visible++;
          }
        });
        if (lnk_visible >= lnk_len){
          var current_org = window.location.pathname;
          window.location.href = "http://busca.datos.gob.mx/#/instituciones"+current_org;
        }
      });

  $('.gallery-overlay').hover(handleIn, handleOut);
  $('.most-recent-article').resizeAndCrop({
    center: true,
    width: 281,
    height: 178,
    forceResize: true
  });

  $('.featured-article').resizeAndCrop({
    center: true,
    width: 461,
    height: 266,
    forceResize: true
  });*/
});











  
    /*$("#btnAtencionCiudadana").click(function(event) {
      var description = $("#descripcion").val();
      var url = "http://www.gob.mx/atencion?description="+description+"&site=sedena";
      window.open(url, "_blank");
    });*/
  

  map = null;
  var mapProp = {
    center:new google.maps.LatLng("19.431867","-99.156931"),
    zoom:14,
    mapTypeId:google.maps.MapTypeId.ROADMAP
  };
  if (document.getElementById("googleMap") != null && map == null) {
    map = new google.maps.Map(document.getElementById("googleMap"), mapProp);
  }

  var marker = new google.maps.Marker({
    position: new google.maps.LatLng("19.431867","-99.156931"),
    title: "SEB",
    animation: google.maps.Animation.DROP
  });

  if (document.getElementById("googleMap") != null && map == null) {
    map = new google.maps.Map(document.getElementById("googleMap"), mapProp);
  }

  var markers = []
  markers.push(marker);
  var markerCluster = new MarkerClusterer(map, markers);