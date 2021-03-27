<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<?php echo 'SEARCH' ?>

<h1>Search by name </h1>

<form method="post">
    <label for="name">Name: </label>
    <input type="text" name="name" id="name">
</form>

<form method="get" action="/found">
    <button type="submit">Search</button>
</form>

<form method="get" action="/" >
    <input type="submit" name="submit" value="back">
</form>



</body>
</html>
