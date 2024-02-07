<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h1>Welcome Guest</h1>
    <a href="/index.php"><- Go back</a>
    
    <input type="text" id="nameAPIinput">
    <button onclick="callAPI()">Call API</button>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        function callAPI() {
            var nameAPIinput = document.getElementById('nameAPIinput').value;
            var url = 'https://api.nationalize.io?name=' + encodeURIComponent(nameAPIinput);

            axios.get(url)
                .then(function (response) {
                    // Handle success
                    console.log(response.data);
                    // You can process the response data here
                })
                .catch(function (error) {
                    // Handle error
                    console.error('Error fetching data from the API:', error);
                });
        }
    </script>
</body>
</html>
