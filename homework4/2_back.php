<!DOCTYPE html>
<html>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<body>

<?php

/* Verify parameter codice_ciclista */
if (!isset($_REQUEST["codice_ciclista"]) || trim($_REQUEST["codice_ciclista"]) == ""){
    echo "<div class='w3-panel w3-red'>
        <h3>Errore!</h3>
        <p>Cyclist code missing or empty.</p>
    </div>";
    exit;
}

/* Verify parameter nome_ciclista */
if (!isset($_REQUEST["nome_ciclista"]) || trim($_REQUEST["nome_ciclista"]) == ""){
    echo "<div class='w3-panel w3-red'>
        <h3>Errore!</h3>
        <p>Cyclist name missing or empty.</p>
    </div>";
    exit;
}

/* Verify parameter cognome_ciclista */
if (!isset($_REQUEST["cognome_ciclista"]) || trim($_REQUEST["cognome_ciclista"]) == ""){
    echo "<div class='w3-panel w3-red'>
        <h3>Errore!</h3>
        <p>Cyclist surname missing or empty.</p>
    </div>";
    exit;
}

/* Verify parameter nazionalità_ciclista */
if (!isset($_REQUEST["nazionalità_ciclista"]) || trim($_REQUEST["nazionalità_ciclista"]) == ""){
    echo "<div class='w3-panel w3-red'>
        <h3>Errore!</h3>
        <p>Cyclist nationality missing or empty.</p>
    </div>";
    exit;
}

/* Verify parameter anno_nascita */
if (!isset($_REQUEST["anno_nascita"]) || trim($_REQUEST["anno_nascita"]) == ""){
    echo "<div class='w3-panel w3-red'>
        <h3>Errore!</h3>
        <p>Cyclist birth year missing or empty.</p>
    </div>";
    exit;
}

$codice_ciclista  = $_REQUEST["codice_ciclista"];
$nome_ciclista  = $_REQUEST["nome_ciclista"];
$cognome_ciclista  = $_REQUEST["cognome_ciclista"];
$nazionalità_ciclista = $_REQUEST["nazionalità_ciclista"];
$codice_squadra  = $_REQUEST["codice_squadra"];
$nazionalità_ciclista = $_REQUEST["nazionalità_ciclista"];
$anno_nascita = $_REQUEST["anno_nascita"];

/* Establish DB connection */
$conn = @mysqli_connect ( 'localhost', 'root', '', 'Cycling_Championship' );

if (mysqli_connect_errno()) {
	echo "Failed to connect to MySQL: " . mysqli_connect_error ();
}

/* String sanification for DB query */
$codice_ciclista =  utf8_decode( mysqli_real_escape_string($conn, $codice_ciclista)  );
$nome_ciclista =  utf8_decode( mysqli_real_escape_string($conn, $nome_ciclista)  );
$cognome_ciclista =  utf8_decode( mysqli_real_escape_string($conn, $cognome_ciclista)  );
$nazionalità_ciclista = utf8_decode( mysqli_real_escape_string($conn, $nazionalità_ciclista) );
$codice_squadra =  utf8_decode( mysqli_real_escape_string($conn, $codice_squadra)  );
$anno_nascita = utf8_decode( mysqli_real_escape_string($conn, $anno_nascita) );

/* Check Type */
if (!is_numeric($anno_nascita)){
    echo "<div class='w3-panel w3-red'>
        <h3>Error!</h3>
        <p>The year of birth must be a numerical value.</p>
    </div>";
    exit;
}


/* Query construction */
$query = "SELECT * FROM Cyclist WHERE CodC='$codice_ciclista'";
$result = mysqli_query ( $conn, $query );

/* Query execution */
if (!$result){
    echo "<div class='w3-panel w3-red'>
        <h3>Error!</h3>
        <p>Inserting $codice_ciclista failed! ". mysqli_error ( $conn ) ." </p>
    </div>";
    exit;
} elseif (mysqli_num_rows ( $result ) > 0) {
    echo "<div class='w3-panel w3-red'>
        <h3>Error!</h3>
        <p>Inserting $codice_ciclista failed because it already exists in the DB.</p>
    </div>";
    exit;
}




/* Query construction */
$query = "INSERT INTO Cyclist (CodC, Name, Surname, Nationality, CodT, BirthYear) VALUES ('$codice_ciclista', '$nome_ciclista', '$cognome_ciclista', '$nazionalità_ciclista', '$codice_squadra', '$anno_nascita')";

/* Query execution */
$result = mysqli_query ( $conn, $query );
if (!$result){
    echo "<div class='w3-panel w3-red'>
        <h3>Error!</h3>
        <p>Inserting $codice_ciclista failed! ". mysqli_error ( $conn ) ." </p>
    </div>";
    exit;
} else {
    echo "<div class='w3-panel w3-green'>
        <h3>Congratulation!</h3>
        <p>Inserting $codice_ciclista successful.</p>
    </div>  ";
    exit;
}
?>

</body>
</html>
