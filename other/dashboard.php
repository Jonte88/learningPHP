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

    $submitNameData = $_POST["nameAPIinput"];

    // $data_array =  array("data" => "some_record_data"); 
    // $make_call = callAPI('POST', 'https://yourapi.com/post_url/', json_encode($data_array)); 
    // $response = json_decode($make_call, true);
    $brokenUrl = "https://api.nationalize.io?name=" . $submitNameData;;
    $url = $brokenUrl; 

    $curl = curl_init($url);

    $certificate_location = "/usr/local/openssl-0.9.8/certs/cacert.pem";

    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, $certificate_location);

    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, $certificate_location);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($curl);

    if (!$response) {
        die('Error: "' . curl_error($curl) . '" - Code: ' . curl_errno($curl));
    }

    curl_close($curl);

    echo $response;
    echo "Done!";
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
