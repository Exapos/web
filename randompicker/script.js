$(document).ready(function () {

    var maps = [
        {'name':'Inferno'},
        {'name':'Train'},
        {'name':'Mirage'},
        {'name':'Nuke'},
        {'name':'Overpass'},
        {'name':'Dust_II'},
        {'name':'Vertigo'}
    ];

    var pickedMaps = [

    ];

    var mapsContent = "";
    var index = 0;
    maps.forEach(element => {
        mapsContent += '<label for="'+index+'"><input type="checkbox" class="checkbox-map" id="'+index+'">'+element.name+'<br></label>'+
                       '<br>';
        index++;
    });

    $('#maps').html(mapsContent);

    $("body").on( "click", ".checkbox-map", function() {
      
       // vymažeme pickedMaps
       // proiterujeme všechny zaškrtnuté checkboxy 
       // podle ID je přidáme do pickedMaps
       pickedMaps = [];
       $(".checkbox-map:checked").each(function(i,element){
        var id = $(this).attr("id");  
        pickedMaps.push(maps[id]);
       });
    });

    //var randomPick = maps[Math.floor(Math.random()*maps.length)];
    //document.body.innerHTML = randomPick;

    $('#randomPick').click(function () { 
        var randomMap = pickedMaps[Math.floor(Math.random() * pickedMaps.length)];
        $('#randomMap').html(randomMap.name)
    });
});