<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.9.0/css/all.css" integrity="sha384-i1LQnF23gykqWXg6jxC2ZbCbUMxyw5gLZY6UiUS98LYV5unm8GWmfkIS6jqJfb4E" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
<div class="container pt-4">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="text-justify">
                <h1>
                    Hi,
                </h1>
                <p class="lead">
                    We’re writing to let you know about recent updates to our Terms of Service and Privacy Policy.
                </p>
                <div class="text-center">
                    <a href="{{ route('terms.current') }}" class="btn btn-primary ml-auto">View our updated Terms of Services and Privacy Policy</a>
                </div>
                <p class="pt-4">
                    Please take a look at updates to our Terms of Service and Privacy Policy
                </p>
                <p>Publication date: {{$term->published_at}}</p>
            </div>

        </div>
    </div>
</div>

</body>
</html>
