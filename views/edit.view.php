<!DOCTYPE html>
<html>
    <head>
        <title>Úprava používateľa</title>
        <meta charset="UTF-8">
        <style type="text/css">
            body {
                display: flex;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
            }

            span{
                color: red;
            }

            table {
                border-spacing: 0px;
                border-collapse: collapse;
                text-align: center;
            }

            td,th{
                border: 1px solid lightgrey;
                padding: 5px 5px;
                min-width: 100px;
            }

            tr > td:first-child {
                font-weight: 600;
                background-color: rgba(232, 129, 0, 0.12);
            }

        </style>
    </head>
    <body>
        <h1>Úprava používateľa:</h1>

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
            <table>
                <?php
                foreach ($result as $row):?>
                    <tr>
                        <td>ID</td><td><?=$row->id;?></td><input type="hidden" name="id" value="<?=$row->id;?>">
                    </tr>
                    <tr>
                        <td>Meno</td><td><input type="text" name="name" value="<?=$row->name;?>" placeholder="<?=$row->name;?>"></td>
                    </tr>
                    <tr>
                        <td>Priezvisko</td><td><input type="text" name="surname" value="<?=$row->surname;?>" placeholder="<?=$row->surname;?>"></td>
                    </tr>
                    <tr>
                        <td>Heslo</td><td><input type="password" name="pass"></td>
                    </tr>
                    <tr>
                        <td>Vek</td><td><input type="text" name="age" value="<?=$row->age;?>" placeholder="<?=$row->age;?>"></td>
                    </tr>
                    <tr>
                        <td>Mesto</td><td><input type="text" name="city" value="<?=$row->city;?>" placeholder="<?=$row->city;?>"></td>
                    </tr>
                <?php endforeach;?>
                <br>
                <tr>
                    <td>Bezp. heslo</td><td><input type="password" name="security"></td>
                </tr>
            </table>
            <input type="submit" name="submit" value="Submit">
        </form>
        <a href="../administration.php"><h3>Späť</h3></a>
    </body>
</html>