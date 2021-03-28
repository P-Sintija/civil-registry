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

<h3>Search by name</h3>

<form method="post">
    <label for="name">Name: </label>
    <input type="text" name="name" id="name">
    <button type="submit">Search</button>
</form>

<h3>Search by surname</h3>

<form method="post">
    <label for="surname">Surname: </label>
    <input type="text" name="surname" id="surname">
    <button type="submit">Search</button>
</form>

<h3>Search by personal code</h3>

<form method="post">
    <label for="code">Personal code: </label>
    <input type="text" name="personalCode" id="code">
    <button type="submit">Search</button>
</form>


<?php

if (isset($_POST['name']) || isset($_POST['surname']) || isset($_POST['personalCode'])) {
    foreach ($search->getPersonData() as $person) {
        echo 'name: ' . $person->getName() .
            '; surname: ' . $person->getSurname() .
            '; personalCode: ' . $person->getPersonalCode() . '<br>';

        ?>
        <form method="post" action="/delete">
            <button type="submit" name= <?php echo 'personalCode'; ?>
            class="button" value= <?php echo $person->getPersonalCode(); ?>>DELETE</button>
        </form>

        <form method="get" action="/edit">

            <?php $keys = ['name','personalCode']?>
            <button type="submit" name= <?php foreach($keys as $key){
                echo $key ;
            }; ?>
            class="button" value= <?php foreach( [$person->getName(), $person->getPersonalCode()] as $value) {
                echo $value;
            }; ?>>EDIT</button>
        </form>


        <?php
    }
}

?>


<form method="get" action="/">
    <input type="submit" name="submit" value="back">
</form>


</body>
</html>
