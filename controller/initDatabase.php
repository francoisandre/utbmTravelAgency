<?php


try {
    
    include_once __DIR__.'/../db/dbConnection.php';

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

} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}

?>
