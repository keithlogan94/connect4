



async function createGame() {
    return new Promise(function (resolve, reject) {

        $.ajax({
            url: 'http://localhost:8378/create-game',
            type: 'POST',
            success: function (response) {
                resolve(JSON.parse(response));
            }
        });

    });
}


async function placeGamePiece(gameId, color, column) {

    return new Promise(function (resolve, reject) {

        $.ajax({
            url: 'http://localhost:8378/'+gameId+'/place_game_piece/'+color+'/' + column,
            type: 'POST',
            success: function (response) {
                resolve(JSON.parse(response));
            }
        });

    });


}



async function getNearestPositionToBottom(gameId, column) {

    return new Promise(function (resolve, reject) {

        $.ajax({
            url: 'http://localhost:8378/'+gameId+'/nearest_to_bottom_game_position/'+ column,
            type: 'POST',
            success: function (response) {
                resolve(JSON.parse(response));
            }
        });

    });



}































