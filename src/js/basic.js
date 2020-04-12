
$(document).on('click', 'button.play-again', function () {
    window.location = "http://localhost:8378";
});

$(document).on('click', 'button.no-play-again', function () {
    $(".popup").html(`<h1>Thank you for playing!</h1>`);
});


$(document).on('click', 'button.place-checker', async function () {
    let $column = $("#column");

    let playerTurn = await getGameInfo(gameId,'turn_color');
    console.log(playerTurn);

    const enteredColumn = Number.parseInt($column.val());

    let $popupDiv = $(".popup-div");

    if (isNaN(enteredColumn)) {
        $popupDiv.hide();
        let $popupMsgElem = $("#popup-message");
        const oldHtml = $popupMsgElem.html();
        $popupMsgElem.html("You must enter a valid number.");
        setTimeout(function () {
            $popupMsgElem.html(oldHtml);
            $popupDiv.show();
        }, 2000);
        return;
    }


    if (enteredColumn < 1 || enteredColumn > 6) {
        $popupDiv.hide();
        let $popupMsgElem = $("#popup-message");
        const oldHtml = $popupMsgElem.html();
        $popupMsgElem.html("You must enter a column 1-6.");
        setTimeout(function () {
            $popupDiv.show();
            $popupMsgElem.html(oldHtml);
        }, 2000);
        return;
    }

    await placeGamePiece(gameId, playerTurn, $column.val());
    $column.val("");

    const winningColor = await getGameInfo(gameId,'winning_color');

    if (winningColor) {
        $(".popup").html(`
            <h1>${capitalizeFirstLetter(winningColor) + " wins!"}</h1>
            <div>
                <p class="inline">Do you want to play again?</p>
                <div class="inline">
                    <button class="play-again sm-button">Yes</button>
                    <button class="no-play-again sm-button">No</button>
                </div>            
            </div>
            `);

        await loadGame(gameId, document.getElementById('game-container'));
    } else {

        const isTie = await getGameInfo(gameId, 'is_tie');

        if (isTie === 'yes') {
            $(".popup").html(`
            <h1>It's a tie!</h1>
            <div>
                <p class="inline">Do you want to play again?</p>
                <div class="inline">
                    <button class="play-again sm-button">Yes</button>
                    <button class="no-play-again sm-button">No</button>
                </div>            
            </div>
            `);
        } else {
            playerTurn = await getGameInfo(gameId,'turn_color');
            console.log(playerTurn);



            $("#color-player").text(capitalizeFirstLetter(playerTurn));

            await loadGame(gameId, document.getElementById('game-container'));
        }


    }

});


$(async function () {


    const currentGameId = gameId;

    const winningColor = await getGameInfo(gameId,'winning_color');

    if (winningColor) {
        $(".popup").html("<h1>In this previous game "+winningColor + " won!"+"</h1>");

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











