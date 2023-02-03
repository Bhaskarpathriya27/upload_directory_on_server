<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <form action="transfer-process.php" method="POST">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Enter Host OR IP</label>
                    <input type=" text" class="form-control" name="host" id="exampleFormControlInput1">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Username</label>
                    <input type=" text" class="form-control" name="username" id="exampleFormControlInput1">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Password</label>
                    <input type=" text" class="form-control" name="password" id="exampleFormControlInput1">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Source Destination</label>
                    <input type=" text" class="form-control" name="local" id="exampleFormControlInput1">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Target Destination</label>
                    <input type=" text" class="form-control" name="serverAdd" id="exampleFormControlInput1">
                </div>
            </div>
            <div class="mt-4" style="text-align: center;">
                <button type="submit" class="btn btn-primary">Transfer</button>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

</body>

</html>