var libraryOfSounds = {
    'Anička kundička': 'anickakundicka.mp3',
    'Máš místo mozku kundu': 'masmistomozkukundu.mp3',
    'Nooooo jdeee vole': 'nojdevoel.mp3',
    'Anna zastavá bukvy': 'zastavatkundy.mp3',
    'Mám všechno zlatý kromě zubu a dmg!!': 'mamzlatyzuby.mp3',
    'Hmmm vyliž si papriku': 'Hmmvilizsipapriku.mp3',
};

$(document).ready(function () {// věci uvnitř se spustí po načtení stránky
    for (var key in libraryOfSounds) {
        var fileName = libraryOfSounds[key];
        var tileElement = $("<div class='tile'></div>").text(key); // vytvořím div (kostičku) na kterou uživatel klikne
        tileElement.attr('file', fileName); // tady kostičce nastavím jméno souboru (aby věděla co přehrát)

        tileElement.on('click', function () { // tady nastavím naslouchač na kliknutí...
            var mp3player = $('#mp3-player'); //po kliku vytvořím mp3 přehrávač
            mp3player.attr('src', '../files/sounds/' + $(this).attr('file')); // do atributu "src" mu nastavím cestu k mp3
            mp3player[0].play(); //..a zvuk přehraju
        });

        $('#player').append(tileElement); // vložím kostičku do přehrávače
    }
});

