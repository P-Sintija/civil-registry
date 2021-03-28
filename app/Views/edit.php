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

<h1>Edit</h1>

<form method="post">
    <label for="name">Name: </label>
    <input type="text" name="name" id="name"  >

    <label for="surname">Surname: </label>
    <input type="text" name="username" id="surname">

    <label for="code">Personal code: </label>
    <input type="text" name="personalCode" id="code" placeholder= <?php //echo key($_GET[1]) . $_GET[key($_GET[1])]; ?>>

    <button type="submit">Save</button>
</form>


<form method="get" action="/" >
    <input type="submit" name="submit" value="home">
</form>

</body>
</html>
