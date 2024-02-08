<?php
session_start();

if (isset($_SESSION["username"])) {
    echo "<h1 class='font-bold text-7xl text-center mt-[5%]'>Welcome " . $_SESSION["username"] . "</h1>";
    echo "<a href='logout.php'>Sign out</a>";
} else {
    echo "<h1>Welcome Guest</h1>";
    echo "<a href='/index.php'><- Go back</a>";
}

if (isset($_POST["submitAPIinput"])) {

    $submitNameData = $_POST["nameAPIinput"];

    // $data_array =  array("data" => "some_record_data"); 
    // $make_call = callAPI('POST', 'https://yourapi.com/post_url/', json_encode($data_array)); 
    // $response = json_decode($make_call, true);
    $brokenUrl = "https://api.genderize.io?name=" . $submitNameData;;
    $url = $brokenUrl; 

    $curl = curl_init($url);

    $certificate_location = "/usr/local/openssl-0.9.8/certs/cacert.pem";

    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, $certificate_location);

    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, $certificate_location);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($curl);
}
        //https://api.nationalize.io?name=zimon
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <div class="flex justify-center items-center h-[40%]">
        <div class="w-[80%]">
            <form method="POST" class="w-[40%] m-auto">
                <input type="text" name="nameAPIinput" id="nameAPIinput" class="border-2 border-black rounded-xl w-[80%] p-[1%]" placeholder="Write a name..." required>
                <input type="submit" value="Call API" name="submitAPIinput" class="border-2 border-black rounded-xl w-[18%] p-[1%] px-[5%] hover:bg-gray-400">
            </form>
            <div class="m-auto text-center">
                <?php
                    if (isset($_POST["submitAPIinput"])) {
                        if (!$response) {
                            die('Error: "' . curl_error($curl) . '" - Code: ' . curl_errno($curl));
                        } else {
                            curl_close($curl);
                            $responseData = json_decode($response, true);
                            if ($responseData['error']) {
                                echo $responseData['error'];
                            } else {
                                echo "<p>The person with the name " . ucfirst($responseData['name']) . " is a " . $responseData['gender'] . " with a probability of " . round( $responseData['probability'] * 100 ), "%</p>";
                            }
                        }
                    } else {
                        echo "<p>Enter a name above to continue!</p>";
                    }
                ?>
            </div>
        </div>
    </div>
</body>
</html>
