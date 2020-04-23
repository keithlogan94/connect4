


CREATE DATABASE IF NOT EXISTS connect4;


USE connect4;










CREATE TABLE games
(
    game_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    privacy ENUM ('public','private') DEFAULT 'private',
    game_setup_id INT NOT NULL,
    add_time DATETIME NOT NULL
);

CREATE INDEX game_index ON games (`game_id`);


DROP PROCEDURE IF EXISTS create_game;

DELIMITER $$


CREATE PROCEDURE create_game(p_game_setup_id INT)
BEGIN


    INSERT INTO games (game_setup_id, add_time) VALUES (p_game_setup_id, NOW());

    SELECT LAST_INSERT_ID() AS 'game_id';


END


$$


DELIMITER ;










CREATE TABLE IF NOT EXISTS game_users
(
  game_user_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  user_id INT NOT NULL,
  color ENUM('red','yellow'),
  game_id INT NOT NULL,
  add_time DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);


CREATE UNIQUE INDEX game_user_index ON game_users (`user_id`, `color`, `game_id`);




DELIMITER $$

CREATE PROCEDURE add_game_user (p_user_id INT, p_color ENUM('red','yellow'), p_game_id INT)
BEGIN

    INSERT INTO game_users (user_id, color, game_id) VALUES (p_user_id, p_color, p_game_id)
    ON DUPLICATE KEY UPDATE
        user_id = VALUES(user_id),
        color = VALUES(color),
        game_id = VALUES(game_id)
    ;



END

$$


DELIMITER ;



DELIMITER $$


CREATE PROCEDURE get_game_user (p_color ENUM('red','yellow'), p_game_id INT)
BEGIN


    SELECT * FROM game_users WHERE game_id = p_game_id AND color = p_color LIMIT 1;



END



$$


DELIMITER ;







CREATE TABLE users
(
    user_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    email_address VARCHAR(250) NOT NULL,
    password VARCHAR(250) NOT NULL,
    favorite_color ENUM ('yellow','red'),
    add_time DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE UNIQUE INDEX unique_email_index ON users (`email_address`);



DELIMITER $$


CREATE PROCEDURE find_user_by_user_id(p_user_id INT)
BEGIN

    SELECT * FROM users WHERE user_id = p_user_id LIMIT 1;


END

$$

DELIMITER ;




DELIMITER $$



CREATE PROCEDURE find_user_by_email_password(p_email VARCHAR(250), p_password VARCHAR(250))
BEGIN


    SELECT * FROM users WHERE email_address = p_email AND password = p_password LIMIT 1;


END

$$

DELIMITER ;



DELIMITER $$


CREATE PROCEDURE add_user(p_first_name VARCHAR(100), p_last_name VARCHAR(100), p_email_address VARCHAR(250), p_password VARCHAR(250), p_favorite_color ENUM('yellow','red'))
BEGIN


    INSERT INTO users (first_name, last_name, email_address, password, favorite_color) VALUES
    (p_first_name, p_last_name, p_email_address, p_password, p_favorite_color);


    SELECT LAST_INSERT_ID() AS 'user_id';



END


$$




DELIMITER ;




CREATE TABLE user_wins
(
  user_win_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  user_id INT NOT NULL,
  game_id INT NOT NULL,
  add_time DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE UNIQUE INDEX user_win_index ON user_wins (`user_id`,`game_id`);



DELIMITER $$

CREATE PROCEDURE add_win(p_user_id INT, p_game_id INT)
BEGIN

    INSERT INTO user_wins (user_id, game_id) VALUES (p_user_id, p_game_id)
    ON DUPLICATE KEY UPDATE
                            user_id = VALUES(user_id),
                            game_id = VALUES(game_id);


END


$$

DELIMITER ;

CREATE TABLE user_losses
(
    user_loss_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    game_id INT NOT NULL,
    add_time DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE UNIQUE INDEX user_loss_index ON user_losses (`user_id`, `game_id`);


DELIMITER $$

CREATE PROCEDURE add_loss(p_user_id INT, p_game_id INT)
BEGIN

    INSERT INTO user_losses (user_id, game_id) VALUES (p_user_id, p_game_id)
    ON DUPLICATE KEY UPDATE
                            user_id = VALUES(user_id),
                            game_id = VALUES(game_id);



END

$$

DELIMITER ;












CREATE TABLE game_data
(
    game_data_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `game_id` INT,
    `key` VARCHAR(100),
    `value` VARCHAR(200),
    add_time DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE UNIQUE INDEX game_data_key_index ON game_data (`game_id`, `key`);


DROP PROCEDURE IF EXISTS set_game_data;

DELIMITER $$


CREATE PROCEDURE set_game_data(p_game_id INT, p_key VARCHAR(100), p_value VARCHAR(200))
BEGIN


    INSERT INTO game_data (`game_id`, `key`, `value`)
    VALUES
        (p_game_id, p_key, p_value)
        ON DUPLICATE KEY UPDATE
        `game_id` = VALUES(`game_id`),
        `key` = VALUES(`key`),
        `value` = VALUES(`value`)
        ;

    SELECT LAST_INSERT_ID() AS 'game_data_id';


END


$$


DELIMITER ;







DROP PROCEDURE IF EXISTS get_game_data;

DELIMITER $$


CREATE PROCEDURE get_game_data(p_game_id INT, p_key VARCHAR(100))
BEGIN

    SELECT * FROM game_data WHERE game_id = p_game_id AND `key` = p_key
    LIMIT 1
    ;


END


$$


DELIMITER ;


















CREATE TABLE board_positions
(
    board_position_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    game_id INT,
    position_code VARCHAR(10),
    x_position INT,
    y_position INT,
    is_filled BOOL DEFAULT FALSE,
    filled_color ENUM('red','yellow'),
    turn_number INT,
    add_time DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE INDEX filled_color_index ON board_positions (`filled_color`);
CREATE INDEX is_filled_index ON board_positions (`is_filled`);
CREATE UNIQUE INDEX board_positions_key_index ON board_positions (`game_id`, `position_code`);



DROP PROCEDURE IF EXISTS add_board_position;

DELIMITER $$


CREATE PROCEDURE add_board_position(p_game_id INT, p_position_code VARCHAR(10), p_x_position INT, p_y_position INT,
        p_is_filled BOOL, p_filled_color ENUM('red','yellow'), p_turn_number INT)
BEGIN


    INSERT INTO board_positions (game_id,position_code,x_position,y_position,is_filled,filled_color,turn_number)
    VALUES
       (
           p_game_id, p_position_code, p_x_position, p_y_position,
           p_is_filled, p_filled_color, p_turn_number
       )
       ON DUPLICATE KEY UPDATE
        game_id = VALUES(game_id),
        position_code = VALUES(position_code),
        x_position = VALUES(x_position),
        y_position = VALUES(y_position),
        is_filled = VALUES(is_filled),
        filled_color = VALUES(filled_color)
       ;

    SELECT LAST_INSERT_ID() AS 'game_id';


END


$$


DELIMITER ;












DROP PROCEDURE IF EXISTS get_game_board_positions;

DELIMITER $$


CREATE PROCEDURE get_game_board_positions(p_game_id INT)
BEGIN



    DECLARE turnNumber INT DEFAULT 0;


    SELECT `value` INTO turnNumber FROM game_data WHERE game_id = p_game_id AND `key` = 'turn_number';



    SELECT * FROM board_positions WHERE game_id = p_game_id AND turn_number = turnNumber;



END



$$


DELIMITER ;









DROP PROCEDURE IF EXISTS get_last_game_played;

DELIMITER $$


CREATE PROCEDURE get_last_game_played()
BEGIN


    SELECT game_id AS 'last_game_played_id' FROM games ORDER BY game_id DESC LIMIT 1;


END



$$


DELIMITER ;








CREATE TABLE game_setup
(
    game_setup_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    game_mode ENUM('classic_connect4') NOT NULL,
    game_title VARCHAR(250),
    setup_user_id INT NOT NULL,
    invited_user_id INT NOT NULL,
    invite_code VARCHAR(250),
    game_active BOOLEAN DEFAULT FALSE,
    game_id INT NULL,
    add_time DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);

# CREATE UNIQUE INDEX unique_game_setup ON game_setup (`setup_user_id`, `invited_user_id`);
CREATE INDEX game_setup_mode_index ON game_setup (`game_mode`);
CREATE INDEX game_setup_invite_link_index ON game_setup (`invite_code`);
CREATE INDEX game_id_index ON game_setup (`game_id`);

DELIMITER $$

CREATE PROCEDURE update_game_setup_game_id(p_game_id INT, p_game_setup_id INT)
BEGIN

    UPDATE game_setup SET game_id = p_game_id WHERE game_setup_id = p_game_setup_id LIMIT 1;


END

$$

DELIMITER ;


DELIMITER $$


CREATE PROCEDURE add_game_setup(p_game_mode ENUM('classic_connect4'), p_game_title VARCHAR(250), p_setup_user_id INT, p_invited_user_id INT, p_invite_code VARCHAR(250))
BEGIN

    DELETE FROM game_setup WHERE setup_user_id = p_setup_user_id AND invited_user_id = p_invited_user_id AND game_active = FALSE AND game_id IS NULL;


    INSERT INTO game_setup (game_mode, game_title, setup_user_id, invited_user_id, invite_code) VALUES
    (p_game_mode, p_game_title, p_setup_user_id, p_invited_user_id, p_invite_code)
    ON DUPLICATE KEY UPDATE
                            game_mode = VALUES(game_mode),
                            game_title = VALUES(game_title),
                            setup_user_id = VALUES(setup_user_id),
                            invited_user_id = VALUES(invited_user_id),
                            invite_code = VALUES(invite_code);




END


$$


DELIMITER ;




DELIMITER $$


CREATE PROCEDURE update_setup_game_invite_user_id(p_user_id INT, p_game_setup_id INT)
BEGIN

    UPDATE game_setup SET invited_user_id = p_user_id, game_active = TRUE WHERE game_setup_id = p_game_setup_id;


END


$$


DELIMITER ;



DELIMITER $$


CREATE PROCEDURE find_game_setup_by_invite_code(p_invite_code VARCHAR(250))
BEGIN



    SELECT * FROM game_setup WHERE invite_code = p_invite_code ORDER BY add_time DESC LIMIT 1;




END


$$



DELIMITER ;































