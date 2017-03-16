<script
  src="https://code.jquery.com/jquery-2.2.4.min.js"
  integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
  crossorigin="anonymous"></script>


  <script>



$(document).ready(function(){

$(window).resize(function(){
  resizeZone();
});

  function resizeZone(){
    frame = ($("#zoneContainer").width());
    zone = ($("#zone").width());
    ratio = frame/zone;
    zone = $("#zone").css("-ms-transform","scale("+ratio+")");
    zone = $("#zone").css("-webkit-transform","scale("+ratio+")");
    zone = $("#zone").css("transform","scale("+ratio+")");
  }
resizeZone();



function initMap(){
      $.getJSON( "engine.php?a=initMap", function( data ) {
            $("#zone").html("");
              $.each( data.roads, function( keyroad, valroad ) {
                  $("#zone").append('<div class="road roadid'+valroad.id+'" data-id="'+valroad.id+'"></div>');
                  $("#zone > div:last-child").html('<div class="info">'+valroad.id+"</div>");
                  $("#zone > div:last-child").css("width",valroad.length);
                  $("#zone > div:last-child").css("left",valroad.posx);
                  $("#zone > div:last-child").css("top",valroad.posy);
                  $("#zone > div:last-child").css("-ms-transform","rotate("+valroad.posr+"deg)");
                  $("#zone > div:last-child").css("-webkit-transform","rotate("+valroad.posr+"deg)");
                  $("#zone > div:last-child").css("transform","rotate("+valroad.posr+"deg)");
                  $.each( valroad.cars, function( keycar, valcar ) {
                      $("#zone > div:last-child").append('<div class="car carid'+valcar.id+'"></div>');
                      $("#zone > div:last-child > div:last-child").css('left',valcar.curpos);
                  });
              });

              $.each( data.junctions, function( valjunc, valjunc ) {
                $("#zone").append('<div class="junction junctionid'+valjunc.id+'" junction-id="'+valjunc.id+'"></div>');
                $('.junctionid'+valjunc.id).css("left",valjunc.posx);
                $('.junctionid'+valjunc.id).css("top",valjunc.posy);

              });
      });
      //setTimeout(getMap, 50);
      updateCarPositions();
}



function updateCarPositions(){
      $.getJSON( "engine.php?a=cars", function( data ) {
              $.each( data, function( keycar, valcar ) {
                      curRoad = ($(".carid"+valcar.id+"").parent(".road").attr("data-id"));

                      if(curRoad != valcar.activeroad){
                        $(".carid"+valcar.id+"").remove();
                        $(".roadid"+valcar.activeroad).append('<div class="car carid'+valcar.id+'"></div>');

                        //  $(".road roadid"+valcar.activeroad).append();
                          //$(".road roadid"+valcar.id).append(tmp);
                      }

                      $(".carid"+valcar.id+"").css('left',valcar.curpos);
              });
      });
      setTimeout(updateCarPositions, 500);
}





initMap();

});



</script>

<div id="zoneContainer">
<div id="zone"></div>
</div>

<style>
body{
  background-color:#efefef;
}
#zoneContainer{
    width:90%;
    height:600px;
    background-color:#fff;
    overflow:hidden;
    margin:auto;
}
#zone{
    width:2000px;
    height:2000px;
    position: relative;
    transform-origin: 0 0;


}
.car{
    position: absolute;
    width:75px;
    height:30px;
    margin-top:10px;
    /*border:1px solid #f00;*/
    /*background-color:#efefef;*/
    color:#fff;

    background-image:url(car.png);
    background-size:auto 100%;
    background-repeat: no-repeat;
    background-position: center center;


    -webkit-transition: all 50ms linear;
 -moz-transition: all 50ms linear;
 -o-transition: all 50ms linear;
 transition: all 50ms linear;



}

.road{
    background-image:url(roadbg.jpg);
    background-size:auto 100%;
    position: fixed;
    height:50px;
    border:1px solid #000;
    /*overflow:hidden;*/

    -ms-transform: rotate(0deg); /* IE 9 */
-webkit-transform: rotate(0deg); /* Safari */
transform: rotate(0deg);

transform-origin: 0 0;

}
.road > .info{
  font-size: 34pt;
      color: #fff;
      -ms-transform: rotate(90deg);
      -webkit-transform: rotate(90deg);
      transform: rotate(90deg);
      position: absolute;
      left: 50px;

}
.junction{
    background-image:url(junction.png);
    background-size:100% 100%;
    position: fixed;
    height:100px;
    width:100px;


}

</style>
