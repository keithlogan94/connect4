
$(document).on('click', 'button.place-checker', async function () {
    $column = $("#column");
    await placeGamePiece(1, getCookie('turn_color'), $column.val());
    $column.val("");

    const playerTurn = await getGameInfo(1,'turn_color');
    console.log(playerTurn);

    $("#color-player").text(capitalizeFirstLetter(playerTurn));

    await loadGame(1, document.getElementById('game-container'));
});


$(async function () {




    // const currentGameId = getCookie('current_game_id');

    if (currentGameId == null) {
        let newGameId = await createGame();
        newGameId = Number.parseInt(newGameId.game_id);
        if (isNaN(Number.parseInt(newGameId))) throw "newGameId is not a number";
        // setCookie('current_game_id', newGameId, '1');
        loadGame(newGameId, document.getElementById('game-container'));
    } else {
        if (isNaN(Number.parseInt(currentGameId))) throw "currentGameId is not a number";
        loadGame(currentGameId, document.getElementById('game-container'));

    }

    // const playerTurn = getCookie('turn_color');
    const playerTurn = await getGameInfo(1,'turn_color');
    console.log(playerTurn);

    // if (playerTurn == null) {
    //     setCookie('turn_color', 'yellow', '1');
    // }

    $("#color-player").text(capitalizeFirstLetter(playerTurn));


});

/*function changeTurn()
{
    if (getCookie('turn_color') === 'yellow')
    {
        setCookie('turn_color', 'red', '1');
    } else {
        setCookie('turn_color', 'yellow', '1');
    }

    $("#color-player").text(getColorForTurn());
}*/

function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}

function getColorForTurn()
{


    return capitalizeFirstLetter(getCookie('turn_color'));
}


async function startGame()
{
    await createGame();
    await loadGame(1, document.getElementById('game-container'));
    $(".popup").show();

}




async function loadGame(gameId, containerElem) {

    if (isNaN(Number.parseInt(gameId))) throw "gameId is not an int";

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











