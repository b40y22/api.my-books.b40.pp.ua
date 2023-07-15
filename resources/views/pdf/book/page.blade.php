<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Page</title>

    <style>
        @font-face {
            font-family: "DejaVu Sans";
            font-style: normal;
            font-weight: 400;
            src: url("{{asset('fonts/DejaVuSans.ttf')}}");
        }
        body {
            display: flex;
            justify-content: center;
            font-family: "DejaVu Sans", serif;
            font-size: 12px;
        }
        .left {
            text-align: left;
        }
        .container {
            display: flex;
            flex-direction: column;
            width: 700px;
        }
    </style>

</head>
<body>
    <div class="container left">
        @foreach($context as $page)
            @foreach($page as $line)
                {{$line}}
            @endforeach
        @endforeach
    </div>
</body>
</html>
