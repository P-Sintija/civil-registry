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

<?php echo 'FOUND';

foreach ($found->getPersonData() as $person) {
    echo 'name: ' . $person->getName() .
        '; surname: ' . $person->getSurname() .
        '; personalCode: ' . $person->getPersonalCode() . '<br>';

    ?>

    <form method="get" action="/edit">
        <input type="submit" name="edit" value="Edit">
    </form>


    <form method="post">
        <button type="submit">Delete</button>
    </form>

<?php }

echo $message; ?>


<form method="get" action="/">
    <input type="submit" name="edit" value="Home">
</form>


</body>
</html>
