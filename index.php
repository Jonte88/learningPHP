<?php

    session_start();

    if (isset($_POST["submit"])) {
        $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);

        $password = $_POST["password"];

        if ($username == "Jonathan" && $password == "123") {
            $_SESSION["username"] = $username;
            header("Location: /other/dashboard.php");
        } else {
            echo "Incorrect Username or Password!";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Thing</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>

    <div class="flex justify-center items-center h-screen">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="bg-white py-[2%] px-[2%] rounded-2xl w-1/4">
            <h1 class="text-7xl	text-center font-bold">Log in</h1>
            <div class="mt-[10%]">
                <label for="username" class="text-center font-bold ml-2">Username: </label><br>
                <input type="text" name="username" class="border-2 border-black rounded-xl w-full p-[1%]">
            </div>
            <div class="mt-[3%]">
                <label for="password" class="text-center font-bold ml-2">Password: </label><br>
                <input type="password" name="password" class="border-2 border-black rounded-xl w-full p-[1%]">
            </div>
            <input type="submit" value="Submit" name="submit" class="bg-black text-white rounded-xl px-[3%] py-[1.5%] mt-[5%]">
        </form>
    </div>
    <footer class="text-white absolute inset-x-0 bottom-0 h-16 font-bold m-auto">
        <p class="text-center text-xl">&copy; Jonathan Th-J 2024</p>
    </footer>

</body>
</html>
