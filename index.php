<?php
    include_once "core/init.php";
    $db = Db::getInstance();

    if(Input::exists("post")){
        var_dump($_POST);
        $validate = new Validation();
        if($validate->insert($_POST)){
            
        }
    }

    $data = $db->query("SELECT * FROM capteur 
                        JOIN rcsf ON capteur.ref = rcsf.type 
                        ORDER BY 'type'")->getResults();
    
    $data = splitArrayType($data, ["vanet", "uwsn"]);
?>

<html>
    <head>
        <title>Assessment</title>
    </head>
    <body>
        <section>
            <h3>Ajout un capteur</h3>
            <form method="POST" action="">
                <div>
                    <label for="type">Type de RCSF</label>
                    <select name="type" id="type">
                        <option value="vanet">Vanet</option>
                        <option value="uwsn">Uwsn</option>
                    </select>
                </div>
                <p>Codonnée:</p>
                <div>
                    <label for="x">X</label>
                    <input type="text" name="x_coordonne" id="x">
                </div>
                <div>
                    <label for="y">Y</label>
                    <input type="text" name="y_coordonne" id="y">
                </div>
                <button type="submit">Ajouter</button>
            </form>
        </section>
        <hr>
        <section>
            <h3>Capteurs</h3>
            <div>
                <h4>Vanet(<?=count($data["vanet"]) ?>)</h4>
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Latitude X</th>
                        <th>Longitude Y</th>
                    </tr>
                    <?php foreach($data["vanet"] as $vanet){ ?>
                    <tr>
                        <td><?= $vanet->id ?></td>
                        <td><?= $vanet->x_coordonne ?></td>
                        <td><?= $vanet->y_coordonne ?></td>
                    </tr>
                    <?php } ?>
                </table>
            </div>
            <div>
                <h4>Uwsn(<?=count($data["uwsn"]) ?>)</h4>
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Latitude X</th>
                        <th>Longitude Y</th>
                    </tr>
                    <?php foreach($data["uwsn"] as $uwsn){ ?>
                    <tr>
                        <td><?= $uwsn->id ?></td>
                        <td><?= $uwsn->x_coordonne ?></td>
                        <td><?= $uwsn->y_coordonne ?></td>
                    </tr>
                    <?php } ?>
                </table>
            </div>
        </section>
    </body>
</html>