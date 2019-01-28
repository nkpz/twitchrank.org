<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>SmashStreams</title>
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    </head>
    <body>
        <div id="app">
          <smashgraphs streamdata={!! json_encode($data) !!}></smashgraphs>
        </div>
        <script src="{{ mix('js/app.js') }}"></script>
    </body>
</html>