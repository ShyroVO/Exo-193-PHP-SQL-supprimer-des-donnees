<?php

/**
 * 1. Importez la table user dans une base de données que vous aurez créée au
 * préalable via PhpMyAdmin
 * 2. En utilisant l'objet de connexion qui a déjà été défini =>
 *    --> Remplacez les informations de connexion ( nom de la base et vérifiez les
 * paramètres d'accès ).
 *    --> Supprimez le dernier utilisateur de la liste, faites une capture d'écran dans
 * PhpMyAdmin pour me montrer que vous avez supprimé l'entrée et pushez la avec
 * votre code.
 *    --> Faites un truncate de la base de données, les auto incréments présents
 * seront remis à 0
 *    --> Insérez un nouvel utilisateur dans la table ( faites un screenshot
 * et ajoutez le au repo )
 *    --> Finalement, vous décidez de supprimer complètement la table
 *    --> Et pour finir, comme vous n'avez plus de table dans la base de données,
 * vous décidez de supprimer aussi la base de données.
 */

try {
    $pdo = new PDO("mysql:host=localhost;dbname=table_test_php;charset=utf8", 'root' , '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // SUP Last user
    $sql = "DELETE FROM table_test_php.user WHERE id = last_insert_id()";
    if ($pdo->exec($sql)!== false){
        echo "Sup user<br><br>";
    }
    else{
        echo "non sup user, no insert<br><br>";
    }

    // SUP DONNES TABLE USER
    $sqll = "TRUNCATE TABLE table_test_php.user";
    if ($pdo->exec($sqll)!==false){
        echo "all contenu of user sup<br><br>";
    }
    else{
        echo "contenue usser non sup<br><br>";
    }

    // ISERT USER
    $kpok = $pdo->prepare("INSERT INTO table_test_php.user (nom, prenom, rue, numero, code_postal, ville, pays, mail) VALUES (?,?,?,?,?,?,?,?)");
    $nom = 'nom';
    $prenom = 'prenom';
    $rue = 'rue';
    $num = '0';
    $cp ='01';
    $ville = 'truc';
    $pays = 'trucp';
    $mail = 'test192@example.com';
    $kpok->bindParam(1, $nom);
    $kpok->bindParam(2, $prenom);
    $kpok->bindParam(3, $rue);
    $kpok->bindParam(4, $num);
    $kpok->bindParam(5, $cp);
    $kpok->bindParam(6, $ville);
    $kpok->bindParam(7, $pays);
    $kpok->bindParam(8,$mail);
    $kpok->execute();

    //SUP TABLE USER
    $sqlll = "DROP TABLE table_test_php.user";
    if ($pdo->exec($sqlll)!== false){
        echo "table user sup<br><br>";
    }
    else{
        echo "table user non sup<br><br>";
    }

    //Sup Bdd
    $sqllll = "DROP DATABASE table_test_php";
    if ($pdo->exec($sqllll)!==false){
        echo 'BDD sup';
    }
    else{
        echo "BDD non sup";
    }

}
catch (PDOException $exception) {
    echo $exception->getMessage();
}