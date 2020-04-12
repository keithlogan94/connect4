
$(document).on('click', 'button.place-checker', async function () {
    $column = $("#column");

    let playerTurn = await getGameInfo(gameId,'turn_color');
    console.log(playerTurn);

    await placeGamePiece(gameId, playerTurn, $column.val());
    $column.val("");

    playerTurn = await getGameInfo(gameId,'turn_color');
    console.log(playerTurn);



    $("#color-player").text(capitalizeFirstLetter(playerTurn));

    await loadGame(gameId, document.getElementById('game-container'));
});


$(async function () {




    const currentGameId = gameId;

    if (currentGameId == null) {
        throw "test";
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
    const playerTurn = await getGameInfo(currentGameId,'turn_color');

    if (playerTurn == null) window.location = "http://localhost:8378";
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
    await loadGame(gameId, document.getElementById('game-container'));
    $(".popup").show();

}




async function loadGame(gameId, containerElem) {

    if (isNaN(Number.parseInt(gameId))) throw "gameId is not an int";

    return new Promise(async function (resolve, reject) {


        const boardPositions = await getGamePositions(gameId);

        for (var i = 0; i < boardPositions.length; i++) {
            if (boardPositions[i].is_filled)
            {
                $("#" + boardPositions[i].position_code).html(
                `<div class="board-position ${boardPositions[i].position_code[0]}" id="${boardPositions[i].position_code}">
                    <div class="${boardPositions[i].filled_color}"></div>
                 </div>`
                )
            }
        }

        resolve(true);


    })

}











