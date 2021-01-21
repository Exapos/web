var libraryOfSounds = {
    'Nejdu to hrát': 'nejdu_to_hrat.mp3',
    'Tahle mi urve hlavu': 'Tahle mi urve halvu.m4a',
    'Proč nechcípneš? PROČ!!': 'Proc nechcipnes.m4a',
    'On je nahoře!!!!!!!!!!': 'ON JE NAHORE.m4a',
    'My to vyhrajem!': 'My to vyhrajem.m4a',
    'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA': 'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA.m4a',
    'Neee Neeeeeeeeeeeeee!': 'Ne neeeeeeeeeeeeeeeeeeeeeeeeeeee.m4a',
    'Nerushuju!': 'Nerushuju.m4a',
    
};

$(document).ready(function () {// věci uvnitř se spustí po načtení stránky
    for (var key in libraryOfSounds) {
        var fileName = libraryOfSounds[key];
        var tileElement = $("<li class='flex-item'></li>").text(key); // vytvořím div (kostičku) na kterou uživatel klikne
        tileElement.attr('file', fileName); // tady kostičce nastavím jméno souboru (aby věděla co přehrát)

        tileElement.on('click', function () { // tady nastavím naslouchač na kliknutí...
            var mp3player = $('#mp3-player'); //po kliku vytvořím mp3 přehrávač
            mp3player.attr('src', '../sounds/' + $(this).attr('file')); // do atributu "src" mu nastavím cestu k mp3
            mp3player[0].play(); //..a zvuk přehraju
        });
        
        $('#player').append(tileElement); // vložím kostičku do přehrávače
    }
});

