
$(document).on('click', '.place-checker', function () {
    $column = $("#column");
    placeGamePiece(1, window.turn, $column.val());
    $column.val("");
    $(".popup").hide();
    changeTurn();
    loadGame(1, document.getElementById('game-container'));
});


$(function () {

    $(".popup").hide();
    startGame();
    window.turn = "yellow";

    $("#color-player").text(getColorForTurn());



});

function changeTurn()
{
    if (window.turn === 'yellow')
    {
        window.turn = 'red';
    } else {
        window.turn = 'yellow';
    }
}

function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}

function getColorForTurn()
{
    return capitalizeFirstLetter(window.turn);
}


async function startGame()
{
    await createGame();
    await loadGame(1, document.getElementById('game-container'));
    $(".popup").show();

}




async function loadGame(gameId, containerElem) {

    return new Promise(async function (resolve, reject) {


        const boardPositions = await getGamePositions(gameId);


        var positionsObj = {};

        $.each(boardPositions, function (index, elem) {
            positionsObj[elem.position_code] = elem;
        });

        var boardPositionKeys = Object.keys(positionsObj);


        var html = '<div id="board">';





        for (var i = 0; i < boardPositionKeys.length; i++)
        {
            const elem = positionsObj[boardPositionKeys[i]];

            var token = ``;
            if (elem.is_filled)
                token = `<div class="${elem.filled_color}"></div>`;

            html += `<div class="board-position" id="${elem.position_code}">
                    ${token}
                </div>`;

        }

        html += '</div>';




        // $.each(boardPositions, function (index, elem) {
        //
        //
        // });


        $(containerElem).html(html);

        resolve(true);


    })

}











