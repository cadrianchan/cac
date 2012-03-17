<?php

include_once "model/model.class.php";
$model = new model($registry);
$model->queryMysql("CREATE TABLE members(user VARCHAR(32), pass VARCHAR(16), INDEX(user(6)))");
$model->queryMysql("CREATE TABLE messages(id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY, auth VARCHAR(32), recip VARCHAR(32), pm CHAR(1), time INT UNSIGNED, message VARCHAR(4096), INDEX(auth(6)), INDEX(recip(6)))");
$model->queryMysql("CREATE TABLE friends(user VARCHAR(32), follower VARCHAR(16), INDEX(user(6)), INDEX(follower(6)))");
$model->queryMysql("CREATE TABLE profiles(user VARCHAR(32), text VARCHAR(4096), INDEX(user(6)))");
$model->queryMysql("CREATE TABLE stats(user VARCHAR(32), goals INT, assists INT, team VARCHAR(32), INDEX(user(6)))");
$model->queryMysql("CREATE TABLE teams(teamnames VARCHAR(32))");

$model->queryMysql("INSERT INTO teams VALUES('Chinatown Athletic Council')");
$model->queryMysql("INSERT INTO teams VALUES('N.Y.C.A.C.')");
$model->queryMysql("INSERT INTO teams VALUES('Kinyu Realty')");
$model->queryMysql("INSERT INTO teams VALUES('Viper')");
$model->queryMysql("INSERT INTO teams VALUES('League of Nation')");
$model->queryMysql("INSERT INTO teams VALUES('Mr. Tea Club')");
$model->queryMysql("INSERT INTO teams VALUES('Manhattan Union')");

?>
