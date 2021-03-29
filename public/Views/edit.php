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
    <input type="text" name="name" id="name" value= <?php echo $person[0]->getName(); ?>>

    <br>

    <label for="surname">Surname: </label>
    <input type="text" name="surname" id="surname" value= <?php echo $person[0]->getSurname(); ?>>

    <br>

    <label for="code">Personal Id: </label>
    <input type="text" name="personalId" id="code" value= <?php echo $person[0]->getPersonalId(); ?>>

    <br>

    <label for="personality">Personality: </label>
    <input type="text" name="personality" id="personality" value= <?php echo $person[0]->getPersonality(); ?>>

    <br>

    <button type="submit">save</button>
</form>

<br>

<form method="get" action="/">
    <input type="submit" name="submit" value="home">
</form>

</body>
</html>
