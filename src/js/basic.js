
$(document).on('click', '.place-checker', function () {
    alert('placing checker');
});


$(function () {

    $(".popup").hide();
    startGame();



});


async function startGame()
{
    await createGame();
    await loadGame(1, document.getElementById('game-container'));
    $(".popup").show();

}




async function loadGame(gameId, containerElem) {

    return new Promise(async function (resolve, reject) {


        const boardPositions = await getGamePositions(gameId);

        var html = '<div id="board">';

        $.each(boardPositions, function (index, elem) {

            var token = ``;
            if (elem.is_filled)
                token = `<div class="${elem.filled_color}"></div>`;

            html += `<div class="board-position" id="${elem.position_code}">
                    ${token}
                </div>`;
        });

        html += '</div>';

        $(containerElem).html(html);

        resolve(true);


    })

}











