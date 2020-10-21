<?php
    include_once "core/init.php";
    
    if(Input::exists("post")){
        var_dump($_POST);
        $validate = new Validation();
        if($validate->insert($_POST)){
            
        }
    }
?>

<html>
    <head>
        <title>Assessment</title>
    </head>
    <body>
        <div>
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
        </div>
    </body>
</html>