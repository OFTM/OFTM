<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" type="text/css" href="/css/app.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<div id="app">
    @include('menu.sidebar')
</div>
<script src="/js/app.js"></script>
</body>
</html>