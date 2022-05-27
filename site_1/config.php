<?
	$conn = new PDO("mysql:host=localhost;dbname=p240", "P240", "Hello45World1");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if(!$conn) die("Не удалось подключиться к бд.");
?>