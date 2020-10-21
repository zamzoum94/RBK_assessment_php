<?php
    include_once "core/init.php";
    $db = Db::getInstance();

    if(Input::exists("post")){
        if(Token::Check(Input::get("token"))){
            $validate = new Validation();
            if($validate->insert($_POST)){

            }
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
                <input type="hidden" name="token" value=<?=TOKEN::generate() ?>>
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
                        <td><?= escape($vanet->id) ?></td>
                        <td><?= escape($vanet->x_coordonne) ?></td>
                        <td><?= escape($vanet->y_coordonne) ?></td>
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
                        <td><?= escape($uwsn->id) ?></td>
                        <td><?= escape($uwsn->x_coordonne) ?></td>
                        <td><?= escape($uwsn->y_coordonne) ?></td>
                    </tr>
                    <?php } ?>
                </table>
            </div>
        </section>
    </body>
</html>