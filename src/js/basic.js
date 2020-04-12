
$(document).on('click', 'button.place-checker', async function () {
    $column = $("#column");

    let playerTurn = await getGameInfo(gameId,'turn_color');
    console.log(playerTurn);

    await placeGamePiece(gameId, playerTurn, $column.val());
    $column.val("");

    const winningColor = await getGameInfo(gameId,'winning_color');

    if (winningColor) {
        $(".popup").html("<h1>"+winningColor + " won!"+"</h1>");

        await loadGame(gameId, document.getElementById('game-container'));
    } else {

        playerTurn = await getGameInfo(gameId,'turn_color');
        console.log(playerTurn);



        $("#color-player").text(capitalizeFirstLetter(playerTurn));

        await loadGame(gameId, document.getElementById('game-container'));
    }

});


$(async function () {


    const currentGameId = gameId;

    const winningColor = await getGameInfo(gameId,'winning_color');

    if (winningColor) {
        $(".popup").html("<h1>"+winningColor + " won!"+"</h1>");

        await loadGame(gameId, document.getElementById('game-container'));
    } else {
        if (currentGameId == null) {
            if (playerTurn == null) window.location = "http://localhost:8378";
        } else {
            if (isNaN(Number.parseInt(currentGameId))) throw "currentGameId is not a number";
            loadGame(currentGameId, document.getElementById('game-container'));

        }

        const playerTurn = await getGameInfo(currentGameId,'turn_color');

        if (playerTurn == null) window.location = "http://localhost:8378";


        $("#color-player").text(capitalizeFirstLetter(playerTurn));
    }




});

function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}

function loadGame(gameId, containerElem) {

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











