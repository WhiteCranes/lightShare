<?php

	$message = $_POST['message'];
	$timestamp = $_POST['timestamp'];

	$content = $timestamp . '------#--1-@---------' . $message . '------#--2-@---------';

	$file = 'chat.txt';
	file_put_contents($file, $content, FILE_APPEND);
    shell_exec('sudo echo 999 >> /root/html/chat.txt');
?>
