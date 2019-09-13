<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>DevSquad</title>
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
        <link href="{{ mix('css/app.css') }}" type="text/css" rel="stylesheet" />
        <meta name="csrf-token" value="{{ csrf_token() }}" />
    </head>
    <body>
    <style>
    .divImage:hover {
      opacity: 0.6;
      transition: 0.2s;
    }
    .divImage:hover .comentario {
      display: block;
    }
    .comentario {
      display: none;
      position: absolute;
      top: 5vh;
      margin-left: 1.5em;
      color:#FFF;
    }
  </style>
      <div id="app">
          
      </div>
      <script src="{{ mix('js/app.js') }}" type="text/javascript"></script>
      <script>
        $('#imagemProduto').click(function(){
  $('#foto').click();
});
        </script>
    </body>
</html>