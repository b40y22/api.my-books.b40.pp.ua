<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$title}}</title>

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
        .center {
            text-align: center;
        }
        .container {
            display: flex;
            flex-direction: column;
            width: 700px;
        }
        .title {
            font-size: 24px;
        }
        .authors {
            font-size: 16px;
            margin: 40px auto;
        }
        .cover {
            margin-top: 20px;
        }
        .cover-image {
            height: 200px;
        }
        .year {
            font-size: 16px;
            margin-top: 660px;
        }
    </style>

</head>
<body>
    <div class="container">
        <div class="title center">
            {{$title}}
        </div>

        <div class="authors center">
            @foreach($authors as $author)
                {{$author}}
            @endforeach
        </div>

        <div class="cover center">
            <img class="cover-image" src="{{$cover}}" alt="">
        </div>

        <div class="year center">
            {{$year}} г.
        </div>
    </div>
</body>
</html>
