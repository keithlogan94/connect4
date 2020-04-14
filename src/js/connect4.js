



function createGame() {
    return new Promise(function (resolve, reject) {

        $.ajax({
            url: 'http://'+applicationHostname+':'+applicationPort+'/create-game',
            type: 'POST',
            success: function (response) {
                resolve(JSON.parse(response));
            }
        });

    });
}


function placeGamePiece(gameId, color, column) {

    return new Promise(function (resolve, reject) {

        $.ajax({
            url: 'http://'+applicationHostname+':'+applicationPort+'/'+gameId+'/place_game_piece/'+color+'/' + column,
            type: 'POST',
            success: function (response) {
                resolve(JSON.parse(response));
            }
        });

    });


}



function getNearestPositionToBottom(gameId, column) {

    return new Promise(function (resolve, reject) {

        $.ajax({
            url: 'http://:' + applicationPort + '/'+gameId+'/nearest_to_bottom_game_position/'+ column,
            type: 'GET',
            success: function (response) {
                resolve(JSON.parse(response));
            }
        });

    });

}


function getGamePositions(gameId) {


    return new Promise(function (resolve, reject) {

        $.ajax({
            url: 'http://'+applicationHostname+':' + applicationPort + '/'+gameId+'/game_positions',
            type: 'GET',
            success: function (response) {
                resolve(JSON.parse(response));
            }
        });

    });


}


function getGameInfo(gameId, gameInfo) {

    return new Promise(function (resolve, reject) {

        $.ajax({
            url: 'http://'+applicationHostname+':'+applicationPort+'/'+gameId+'/game_info/' + gameInfo,
            type: 'GET',
            success: function (response) {
                resolve(JSON.parse(response)[gameInfo]);
            }
        });

    });

}





























