<!DOCTYPE html>
<html>
    <head>
        <title>Odstránenie používateľa</title>
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

        <h1>Odstrániť používateľa:</h1><br>
        <?= $_SESSION['errors']['security']??""?>
        <table>
            <?php
                foreach ($result as $row):?>
                    <tr>
                        <td>ID</td><td><?= $row->id;?></td>
                    </tr>
                    <tr>
                        <td>Meno</td><td><?= $row->name;?></td>
                    </tr>
                    <tr>
                        <td>Priezvisko</td><td><?= $row->surname;?></td>
                    </tr>
                    <tr>
                        <td>Vek</td><td><?= $row->age;?></td>
                    </tr>
                    <tr>
                        <td>Mesto</td><td><?= $row->city;?></td>
                    </tr>
                <?php endforeach;?>
            <form method="POST" action="">
                <tr>
                    <td>Bezp. heslo:</td>
                    <td><input type="password" name="security"></td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" name="submit" value="Odoslať"></td>
                </tr>
            </form>
        </table>
        <a href="../administration.php"><h3>Späť</h3></a>
    </body>
</html>