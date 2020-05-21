/*$(document).ready(function (){

    var defaultSize = 0;
    var changedSize = 0;
    var px = "px";
    $(".text-to-change").text(defaultSize+changedSize+px);

    $(".button-increment").on("click", function () {
        // po kliku na plus
        changedSize++;
        $(".text-to-change").css("font-size", defaultSize+changedSize+px);
        $(".text-to-change").text(defaultSize+changedSize+px);

    });

    $(".button-decrement").on("click", function () {
        // po kliku na minus

        changedSize--;
        $(".text-to-change").css("font-size", defaultSize+changedSize+px);
        $(".text-to-change").text(defaultSize+changedSize+px);
    });
});*/

/* Hejbajicí se zmrd

var mouseX, mouseY;
$(document).mousemove(function(e) {
    $(".cat").css({
        "left": e.pageX-25+"px",
        "top":  e.pageY-25+"px"
    });
});*/

//Věk
window.setInterval(function () {
  var time = new Date();
  var bday = new Date(2003, 11, 20);
  var rozdil = time.getTime() - bday.getTime();
  var cislo = rozdil / (1000 * 60 * 60 * 24 * 365.25);
  $(".age").html(cislo.toFixed(12));
});


