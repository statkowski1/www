<?php
	$host = 'localhost';
	$user = 'root';
	$pass = '';
	$db= 'moja_strona';
	$login = '';
	$pass = '';
	
	$link = mysqli_connect($host, $user, $pass, $db);
	if	(!$link) 
	{
		echo '<b>Połączenie zostało przerwane!<b/><br></br>';

	}
	if (mysqli_connect_errno()) {
	echo "Błąd połączenia z bazą danych: " . mysqli_connect_error();
	exit();
	}
	
	$login = 'Sebastian';
	$password = 'haslo123';
?>