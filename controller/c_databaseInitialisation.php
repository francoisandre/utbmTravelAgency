<?php


try {
    
    include_once __DIR__.'/../db/dbConnection.php';
    include_once __DIR__.'/../util/userUtils.php';
    include_once __DIR__.'/../util/loyaltyProgramUtils.php';

    $pdo = getDatabase();

    $sqlFile = '../sql/travel_agency.sql';
    $sql = file_get_contents($sqlFile);
    $statements = explode(";", $sql); 

    foreach ($statements as $statement) {
        $statement = trim($statement);
        if (!empty($statement)) {
            $pdo->exec($statement); 
        }
    }

    echo "Script SQL exécuté avec succès.";

    createLoyaltyProgram("Bronze", 5, 0,"#CD7F32;");
    createLoyaltyProgram("Silver", 10, 5, "silver");
    createLoyaltyProgram("Gold", 15, 15, "gold");
    createLoyaltyProgram("Platinium", 20, 50, "#E5E4E2;");
    echo "<br/>";
    echo "Programmes de fidélité avec succès.";

    createUser("francois.andre.perso@gmail.com", "toto", "Francois", "ANDRE", "0622422400", true);
    createUser("alexandre@gmail.com", "utbm", "Alexandre", "ANDRE", "0622422400", true);
    createUser("ayoub@gmail.com", "utbm", "Ayoub", "CHERAMAT", "07793559", true);

    echo "<br/>";
    echo "Administrateurs ajoutés avec succès.";
   

} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}

?>
