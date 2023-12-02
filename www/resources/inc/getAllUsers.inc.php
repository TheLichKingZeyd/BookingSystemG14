<?php

include 'login.inc.php';

// Hvis en bruker er innlogget
if(!empty($_SESSION['userID'])) {
    
    // Hent bruker informasjon
    $sql = "SELECT * FROM users";
    $q = $pdo->prepare($sql);
    
    // Kjør
    try {
      $q->execute();
    } catch (PDOException) {
      echo "Noe gikk galt";
    }
    
    // Hent
    $brukere = $q->fetchAll(PDO::FETCH_OBJ);
    
    // Sjekk at dataen har kommet
    if (!$brukere) {
      echo "Brukere ble ikke funnet";
      exit;
    } else {
        
    }
}

// Hvis ingen bruker innlogget
else {
  echo "Ingen tilgang, logg inn";
  exit;
}
?>