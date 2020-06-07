<!DOCTYPE html>
<html>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<body>

<?php

/* Verify parameter posizione_classifica */
if (!isset($_REQUEST["posizione_classifica"]) || trim($_REQUEST["posizione_classifica"]) == ""){
    echo "<div class='w3-panel w3-red'>
        <h3>Errore!</h3>
        <p>Cyclist position missing or empty.</p>
    </div>";
    exit;
}


$codice_ciclista  = $_REQUEST["codice_ciclista"];
$codice_tappa  = $_REQUEST["codice_tappa"];
$edizione  = $_REQUEST["edizione"];
$posizione_classifica = $_REQUEST["posizione_classifica"];


/* Establish DB connection */
$conn = @mysqli_connect ( 'localhost', 'root', '', 'Cycling_Championship' );

if (mysqli_connect_errno()) {
	echo "Failed to connect to MySQL: " . mysqli_connect_error ();
}

/* String sanification for DB query */
$codice_ciclista =  utf8_decode( mysqli_real_escape_string($conn, $codice_ciclista)  );
$codice_tappa =  utf8_decode( mysqli_real_escape_string($conn, $codice_tappa)  );
$edizione =  utf8_decode( mysqli_real_escape_string($conn, $edizione)  );
$posizione_classifica = utf8_decode( mysqli_real_escape_string($conn, $posizione_classifica) );

/* Check Type */
if (!is_numeric($posizione_classifica)){
    echo "<div class='w3-panel w3-red'>
        <h3>Error!</h3>
        <p>The position in the ranking must be a numerical value.</p>
    </div>";
    exit;
}

/* Check Type */
if (!is_numeric($posizione_classifica) || $posizione_classifica < 1 || $posizione_classifica != round($posizione_classifica)){
    echo "<div class='w3-panel w3-red'>
        <h3>Error!</h3>
        <p>Ranking must be positive.</p>
    </div>";
    exit;
}

/* Query construction */
$query = "SELECT * FROM Individual_Classification WHERE (CodC='$codice_ciclista' AND CodS='$codice_tappa' AND Ranking='$posizione_classifica')";
$result = mysqli_query ( $conn, $query );

/* Query execution */
if (!$result){
    echo "<div class='w3-panel w3-red'>
        <h3>Error!</h3>
        <p>Ranking insertion failed! ". mysqli_error ( $conn ) ." </p>
    </div>";
    exit;
} elseif (mysqli_num_rows ( $result ) > 0) {
    echo "<div class='w3-panel w3-red'>
        <h3>Error!</h3>
        <p>Ranking insertion failed because it already exists in the DB.</p>
    </div>";
    exit;
}


/* Query construction */
$query = "INSERT INTO Individual_Classification (CodC, CodS, Edition, Ranking) VALUES ('$codice_ciclista', '$codice_tappa', '$edizione', '$posizione_classifica')";

/* Query execution */
$result = mysqli_query ( $conn, $query );
if (!$result){
    echo "<div class='w3-panel w3-red'>
        <h3>Error!</h3>
        <p>Ranking insertion failed! ". mysqli_error ( $conn ) ." </p>
    </div>";
    exit;
} else {
    echo "<div class='w3-panel w3-green'>
        <h3>Congratulazion!</h3>
        <p>Ranking insertion successful.</p>
    </div>  ";
    exit;
}
?>

</body>
</html>
