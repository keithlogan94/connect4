
function runOnLoad (func) {
    window.onload = func;
}



function generateBoardFromBoardPositions(boardPositions) {




}


async function loadGame(gameId, containerElem) {


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

}











