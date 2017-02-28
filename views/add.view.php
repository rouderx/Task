<!DOCTYPE html>
<html>
<head>
    <title>Administrácia používateľov</title>
    <meta charset="UTF-8">
    <style type="text/css">
        body {
            display: flex;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        #uForm {
            padding-left: 20px;*/
        }

        .heading {
            margin: 5px 0;
        }

        #uForm span {
            color: red;
        }
    </style>
</head>
<body>

    <div id="uForm">
        <?php
        if(!empty($_SESSION['errors']))
        {
            foreach ($_SESSION['errors'] as $error):?>
                <span><?=$error;?></span><br>
            <?php endforeach;
        }
        unset($_SESSION['errors']);
        ?>
        <form method="POST" action="">
            <div class="heading">Meno:</div>
            <input type="text" name="name">
            <div class="heading">Priezvisko:</div>
            <input type="text" name="surname">
            <div class="heading">Heslo:</div>
            <input type="password" name="pass">
            <div class="heading">Vek:</div>
            <input type="text" name="age">
            <div class="heading">Mesto:</div>
            <input type="text" name="city">
            <div class="heading">Bezpečnostné heslo:</div>
            <input type="password" name="security"><br>
            <input type="submit" name="submit" value="Odoslať">
        </form>
    </div>
    <a href="../administration.php"><h3>Späť</h3></a>
</body>
</html>