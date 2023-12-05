<?php

include 'login.inc.php';

// If user is logged in 
if(!empty($_SESSION['userID'])) {
    
    // Gather user information
    $sql = "SELECT * FROM users";
    $q = $pdo->prepare($sql);
    
    // run
    try {
      $q->execute();
    } catch (PDOException) {
      echo "Noe gikk galt";
    }
    
    // fetch
    $brukere = $q->fetchAll(PDO::FETCH_OBJ);
    
    // Check if data has arrived
    if (!$brukere) {
      echo "Brukere ble ikke funnet";
      exit;
    } else {
        
    }
}

// If no user is logged in
else {
  echo "Ingen tilgang, logg inn";
  exit;
}
?>