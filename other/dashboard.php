<?php
session_start();

if (isset($_SESSION["username"])) {
    echo "<h1>Welcome " . $_SESSION["username"] . "</h1>";
    echo "<a href='logout.php'>Logout</a>";
} else {
    echo "<h1>Welcome Guest</h1>";
    echo "<a href='/index.php'><- Go back</a>";
}

if (isset($_POST["submitAPIinput"])) {

	$url = "https://api.nationalize.io?name=zimon";
	
	$client = curl_init($url);
	curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
	$response = curl_exec($client);
	
	$result = json_decode($response);
	
	print_r($result);
    echo $result;
    }
        //https://api.nationalize.io?name=zimon
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <form method="POST">
        <input type="text" name="nameAPIinput" id="nameAPIinput">
        <input type="submit" value="Call API" name="submitAPIinput">
    </form>
</body>
</html>
