<?php

class model {

    private $dbuser, $dbpass, $dbhost, $dbname, $registry;

    function __construct($registry) {
        $this->dbuser = "username";
        $this->dbpass = "password";
        $this->dbhost = "localhost";
        $this->dbname = "citynysoccer";
        $this->registry = $registry;

        $this->connectDB();
    }

    function __destruct() {
        $this->closeDB();
    }

    function connectDB() {
        mysql_connect($this->dbhost, $this->dbuser, $this->dbpass) or die(mysql_error());
        mysql_select_db($this->dbname) or die(mysql_error());
    }

    function closeDB() {
        mysql_close() or die(mysql_error());
    }

    function queryMysql($query) {
        $result = mysql_query($query) or die(mysql_error());
        return $result;
    }

    function getTeamnames() {
        $teamnames = array();
        $results = $this->queryMysql('select teamnames from teams');
        while ($row = mysql_fetch_array($results)) {
            $teamnames[] = $row[0];
        }
        return $teamnames;
    }

    function userSignup($user, $pass, $team) {
        $user = sanitizeString($user);
        if(!preg_match('/^[a-zA-Z0-9_-]{3,16}$/', $user)) {
            return "Only alphabets, digits, underscores and hyphens are accepted";
        }
        $pass = sanitizeString($pass);
        if(!preg_match('/^[a-zA-Z0-9_-]{3,16}$/', $pass)) {
            return "Only alphabets, digits, underscores and hyphens are accepted";
        }
        
        $query = "select * from members where user='$user'";
        if (mysql_num_rows($this->queryMysql($query))) {
            return "Username already exists!<br/><br/>";
        } else {
            $query = "insert into members values('$user', '$pass')";
            $this->queryMysql($query);
            $query = "insert into stats values('$user', '0', '0', '$team')";
            $this->queryMysql($query);
            copy('uploads/profiles/blank.jpg', "uploads/profiles/$user.jpg");
            return "<h4>Account created. </h4>Please Log in.<br/>";
        }
    }

    function userLogin($user, $pass) {
        $query = "select * from members where user='$user' and pass='$pass'";
        if (mysql_num_rows($this->queryMysql($query))) {
            return true;
        } else {
            return false;
        }
    }

    function getTopScorers() {
        $topscorers = array();
        $results = $this->queryMysql('select user, goals, team from stats order by goals desc limit 5');
        while ($row = mysql_fetch_array($results)) {
            $topscorers[] = array('user' => $row[0], 'goals' => $row[1], 'team' => $row[2]);
        }
        return $topscorers;
    }

    function getTopAssists() {
        $topassists = array();
        $results = $this->queryMysql('select user, assists, team from stats order by assists desc limit 5');
        while ($row = mysql_fetch_array($results)) {
            $topassists[] = array('user' => $row[0], 'assists' => $row[1], 'team' => $row[2]);
        }
        return $topassists;
    }

    function updateUserInfo($user, $userInfo) {
        $text = sanitizeString($userInfo);
        $text = preg_replace('/\s\s+/', ' ', $text);

        $query = "select * from profiles where user='$user'";
        if (mysql_num_rows($this->queryMysql($query))) {
            $this->queryMysql("update profiles set text='$text' where user='$user'");
        } else {
            $query = "insert into profiles values('$user', '$text')";
            $this->queryMysql($query);
        }

        return $text;
    }

    function displayUserInfo($user) {
        $query = "select * from profiles where user='$user'";
        $result = $this->queryMysql($query);

        if (mysql_num_rows($result)) {
            $row = mysql_fetch_row($result);
            $text = stripslashes($row[1]);
            $text = stripslashes(preg_replace('/\s\s+/', ' ', $text));
        } else {
            $text = "";
        }

        return $text;
    }

    function showProfile($user) {
        $msg = "$user's Profile:<br/>";
        if (file_exists("uploads/profiles/$user.jpg")) {
            $msg = $msg . "<img src='uploads/profiles/$user.jpg' border='1' align='left' />";
        }

        $result = $this->queryMysql("select * from profiles where user='$user'");

        if (mysql_num_rows($result)) {
            $row = mysql_fetch_row($result);
            $msg = $msg . stripslashes($row[1]);
        }
        return $msg . "<br clear=left /><br/>";
    }

    function follow($user, $add) {
        $query = "select * from friends where user='$add' and follower='$user'";

        if (!mysql_num_rows($this->queryMysql($query))) {
            $query = "insert into friends values('$add', '$user')";
            $this->queryMysql($query);
        }
    }

    function unfollow($user, $remove) {
        $query = "delete from friends where user='$remove' and follower='$user'";
        $this->queryMysql($query);
    }

    function friendsFollowingUser($user) {
        $friends = array();
        $query = "select follower from friends where user='$user'";
        $results = $this->queryMysql($query);
        while ($row = mysql_fetch_array($results)) {
            $friends[] = $row[0];
        }
        return $friends;
    }

    function followedByUser($user) {
	$friends = array();
        $query = "select user from friends where follower='$user'";
        $results = $this->queryMysql($query);
        while ($row = mysql_fetch_array($results)) {
            $friends[] = $row[0];
        }
        return $friends;
    }

    function showMembers($user) {
        $query = "select user from members where user<>'$user'";
        $results = $this->queryMysql($query);
        while ($row = mysql_fetch_array($results)) {
            $members[] = $row[0];
        }
        return $members;
    }

    function showFriendsAndMembers($user) {
        $friendsFollowingUser = $this->friendsFollowingUser($user);
        $followedByUser = $this->followedByUser($user);
        $allmembers = $this->showMembers($user);

        $mutualFriends = array_intersect($followedByUser, $friendsFollowingUser);
        $relatedFriends = array_unique(array_merge($followedByUser, $friendsFollowingUser));
        $results = array('mutual' => $mutualFriends,
            'friendsFollowingOnly' => array_diff($friendsFollowingUser, $mutualFriends),
            'followedByOnly' => array_diff($followedByUser, $mutualFriends),
            'nonFriends' => array_diff($allmembers, $relatedFriends));

        return $results;
    }

    function postMsg($user, $view, $pm, $text) {
        $text = sanitizeString($text);

        if ($text != "") {
            $pm = substr(sanitizeString($_POST['pm']), 0, 1);
            $time = time();
            $this->queryMysql("insert into messages values(NULL, '$user', '$view', '$pm', $time, '$text')");
        }
    }

    function deleteMsg($id, $user) {
        $id = sanitizeString($id);
        $this->queryMysql("delete from messages where id=$id and recip='$user'");
    }
    
    function showMsg($view) {
        $messages = array();
        $results = $this->queryMysql("select * from messages where recip='$view' order by time desc");
        while ($row = mysql_fetch_array($results)) {
            $messages[] = array('id' => $row[0], 'auth' => $row[1], 'recip' => $row[2],
                                'pm' => $row[3], 'time' => $row[4], 'message' => $row[5]);
        }
        
        return $messages;
    }

}

?>
