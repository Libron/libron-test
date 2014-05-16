<?php

$mysqli = false;

function connectDB() {
				global $mysqli;
				$mysqli = new mysqli("localhost", "root", "", "mysite-local") ;
				$mysqli -> query("SET NAMES 'utf8' ");
				}
			
function closeDB()	{
			global $mysqli;
			$mysqli -> close();
			}
	
function getAllArticles() {
		global $mysqli;
		connectDB();
		$result_set = $mysqli -> query("SELECT * FROM `articles` ");
		closeDB();
		return result_setToArray($result_set);
		}
		
function getArticle($id) {
		global $mysqli;
		connectDB();
		$result_set = $mysqli -> query("SELECT * FROM `articles` WHERE `id`='$id' ");
		closeDB();
		return $result_set->fetch_assoc();
}

function getAllQuestBookComments() {
		global $mysqli;
		connectDB();
		$result_set = $mysqli -> query("SELECT * FROM `questbook` ");
		closeDB();
		return result_setToArray($result_set);
}

function addQuestBookComment($name, $comment) {
		global $mysqli;
		connectDB();
		$success =  $mysqli->query("INSERT INTO `questbook` (`name`, `comment`) VALUES ('$name', '$comment')");
		closeDB();
		return $success;
		
}
		
function result_setToArray($result_set) {
		$array = array();
		while (($row = $result_set->fetch_assoc()) != false)	
			$array[] = $row;
			return $array;
		
}

function addUser($email, $password) {
		global $mysqli;
		connectDB();
		$success =  $mysqli->query("INSERT INTO `users` (`email`, `password`) VALUES ('$email', '$password')");
		closeDB();
		return $success;
}

function checkUser($email, $password) {
	global $mysqli;
	connectDB();
	$result_set = $mysqli -> query("SELECT * FROM `users` WHERE `email` = '$email' AND `password` = '$password' ");
	closeDB();
	if ($result_set->fetch_assoc()) return true;
	else return false;
}

?>