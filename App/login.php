<?php

session_start();
//require 'auth.php';
require_once'Models/connect.php';

$Post = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$PostFilters = array_map("strip_tags", $Post);

if ($PostFilters['identCall'] == 'login'){

	$username = $PostFilters['username'];
	$password = $PostFilters['password'];
	$remember = $PostFilters['remember'];

	$message = $connect->login2($username, $password, $remember);

	echo $message;		

};