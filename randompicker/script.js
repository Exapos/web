$(document).ready(function () {

    var maps = [
        {'name':'Inferno','img':'inferno.png'},
        {'name':'Train','img':'train.png'},
        {'name':'Mirage','img':'mirage.png'},
        {'name':'Nuke','img':'nuke.png'},
        {'name':'Overpass','img':'overpass.png'},
        {'name':'Dust_II','img':'dust2.png'},
        {'name':'Vertigo','img':'vertigo.png'},
        {'name':'Office','img':'office.png'}
    ];

    var pickedMaps = [

    ];


    var mapsContent = '';

    var index = 1;
    maps.forEach(element => {
        if(index == 1){
            mapsContent+= '<div class="d-flex">';
        }

        var elementImg = '<img src="img/'+element.img+'" class="map-img">';
        mapsContent += '<div class="flex-fill"><label for="'+index+'"><input type="checkbox" class="checkbox-map" id="'+index+'">'+elementImg +'<br></label>'+
                       '</div>';

        if(index % 4 == 0){ //pokud je zbytek po dělení == 0, "modulo"
            // nový řádek
            mapsContent+= '</div>';
            mapsContent+= ' <div class="d-flex">';
        }
        
        
        if(index == maps.length){
            console.log(index);
            console.log(maps.length);
            mapsContent+= '</div>';
        }
        index++;

       
    });
    mapsContent += '</div>';
    $('#maps').append(mapsContent);

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