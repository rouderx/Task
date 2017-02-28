<!DOCTYPE html>
<html>
<head>
    <title>Administrácia používateľov</title>
    <meta charset="UTF-8">
    <style type="text/css">
        table {
            border-spacing: 0px;
            border-collapse: collapse;
            text-align: center;
        }

        td,th{
            border: 1px solid lightgrey;
            padding: 5px 5px;
            min-width: 95px;
        }

        #container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .err {
            color: red;
            font-size: 18px;
        }

        #none {
            border-width: 0;
            padding-top: 20px;
            font-weight: 600;
        }

    </style>
</head>
<body>
<div id="container">
    <div id="uTable">
        <?php if (!empty($_SESSION['succ'])):?>
            <div class="err"><?=$_SESSION['succ']?></div>
        <?php endif;?>
        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Meno</th>
                    <th>Priezvisko</th>
                    <th>Vek</th>
                    <th>Mesto</th>
                    <th>Dátum vytvorenia</th>
                </tr>
            </thead>
            <?php
                if(empty($result))
                { ?>
                    <tr><td id="none" colspan="6">Žiadny používateľ neexistuje.</td></tr>
                <?php }
                else
                {
                    foreach($result as $row): ?>
                        <tr>
                            <td><?=$row->id;?></td>
                            <td><?=$row->name;?></td>
                            <td><?=$row->surname;?></td>
                            <td><?=$row->age;?></td>
                            <td><?=$row->city;?></td>
                            <td><?=$row->c_date;?></td>
                            <td><a href="manage/edit.php?id=<?=$row->id;?>">edit</a></td>
                            <td><a href="manage/delete.php?id=<?=$row->id;?>">delete</a></td>
                        </tr>
                    <?php endforeach;
                }
            ?>
        </table>
    </div>
    <a href="manage/add.php"><h3>Pridať používateľa</h3></a>
</div>
</body>
</html>
