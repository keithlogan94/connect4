
$(document).on('click', 'button.play-again', function () {
    window.location = "http://"+applicationHostname + '/setup';
});

$(document).on('click', 'button.no-play-again', function () {
    $("#user-input-section").html(`<h1>Thank you for playing!</h1>`);
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
        clearInterval(window.loadInterval);
        $("#user-input-section").html(`
            <h1>${capitalizeFirstLetter(winningColor) + " wins!"}</h1>
            <div>
                <p class="inline">Do you want to play again?</p>
                <div class="inline">
                    <button class="play-again sm-button">Yes</button>
                    <button class="no-play-again sm-button">No</button>
                </div>            
            </div>
            `);

        $("#header > div > nav > ul > li:nth-child(1) > a").text("Play Again?");

        await loadGame(gameId, document.getElementById('game-container'));
    } else {

        const isTie = await getGameInfo(gameId, 'is_tie');

        if (isTie === 'yes') {
            clearInterval(window.loadInterval);
            $("#user-input-section").html(`
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

async function load() {


    const currentGameId = gameId;

    const winningColor = await getGameInfo(gameId,'winning_color');

    if (winningColor) {
        $("#user-input-section").html("<h1>"+capitalizeFirstLetter(winningColor) + " won!"+"</h1>");
        $("#header > div > nav > ul > li:nth-child(1) > a").text("Play Again?");

        await loadGame(gameId, document.getElementById('game-container'));
    } else {
        if (currentGameId == null) {
            if (playerTurn == null) window.location = "http://"+applicationHostname+":" + applicationPort;
        } else {
            if (isNaN(Number.parseInt(currentGameId))) throw "currentGameId is not a number";
            await loadGame(currentGameId, document.getElementById('game-container'));

        }

        const playerTurn = await getGameInfo(currentGameId,'turn_color');
        // const ip = await getIp();

        const userAssignedYellow = await getGameInfo(currentGameId, 'user_assigned_yellow');
        const userAssignedRed = await getGameInfo(currentGameId, 'user_assigned_red');

        if (!userAssignedYellow || !userAssignedRed) {
            $("#popup-message").text(`Please wait for the other player to join.`);
            $(".popup-div").hide();
        } else {
            switch (playerTurn) {
                case "yellow":
                    if (userId != userAssignedYellow) {
                        $("#popup-message").text("Please wait for the other player to play.");
                        $(".popup-div").hide();
                        console.log('its NOT my turn');
                    } else {
                        console.log('its my turn');
                        $("#popup-message").text("Yellow, please enter the column to drop your checker:");
                        $(".popup-div").show();
                    }
                    break;
                case "red":

                    if (userId != userAssignedRed) {
                        $("#popup-message").text("Please wait for the other player to play.");
                        $(".popup-div").hide();
                        console.log('its NOT my turn');
                    } else {
                        $("#popup-message").text("Red, please enter the column to drop your checker:");
                        $(".popup-div").show();
                        console.log('its my turn');
                    }
                    break;
            }
        }



        if (playerTurn == null) {
            window.location = "http://"+applicationHostname+":" + applicationPort;
        }


        $("#color-player").text(capitalizeFirstLetter(playerTurn));
    }




}
window.loadInterval = setInterval(load, 2000);
$(load);

function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}

function loadGame(gameId, containerElem) {

    if (isNaN(Number.parseInt(gameId))) throw "gameId is not an int";

    return new Promise(async function (resolve, reject) {


        const boardPositions = await getGamePositions(gameId);

        for (let i = 0; i < boardPositions.length; i++) {
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










