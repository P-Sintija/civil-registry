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

<h3>Search by personal id</h3>

<form method="post">
    <label for="code">Personal id: </label>
    <input type="text" name="personalId" id="code">
    <button type="submit">Search</button>
</form>

<br>

<?php if (isset($_POST['name']) || isset($_POST['surname']) || isset($_POST['personalId'])) { ?>

<table border="1" cellspacing="0" cellpadding="5">
    <tr>
        <th>Name</th>
        <th>Surname</th>
        <th>Personal id</th>
        <th>Personality</th>
        <th>Delete/Edit</th>
    </tr>


    <?php foreach ($search->getPersonData() as $person) { ?>

        <tr>
            <td><?php echo $person->getName(); ?></td>
            <td><?php echo $person->getSurname(); ?></td>
            <td><?php echo $person->getPersonalId(); ?></td>
            <td><?php echo $person->getPersonality(); ?></td>
            <td>
                <form method="post" action="/delete">
                    <button type="submit" name= <?php echo 'personalId'; ?>
                    class="button" value= <?php echo $person->getPersonalId(); ?>>delete
                    </button>
                </form>

                <form method="get" action="/edit">
                    <button type="submit" name= <?php echo 'personalId' ?>
                    class="button" value= <?php echo $person->getPersonalId(); ?>>edit
                    </button>
                </form>
            </td>
        </tr>
    <?php }
    } ?>
</table>

<br>

<form method="get" action="/">
    <input type="submit" name="submit" value="home">
</form>


</body>
</html>
