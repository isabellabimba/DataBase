<!DOCTYPE html>
<html>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<body>

<?php

/* Verify parameter course_code */
if (!isset($_REQUEST["codice_tappa"]) || trim($_REQUEST["codice_tappa"]) == ""){
    echo '<p> ERRORE: Stage code missing or empty. </p>';
    exit;
}

$codice_ciclista = $_REQUEST["codice_ciclista"];
$codice_tappa = $_REQUEST["codice_tappa"];


/* Establish DB connection */
$conn = @mysqli_connect ( 'localhost', 'root', '', 'Cycling_Championship' );

if (mysqli_connect_errno()) {
	echo "Failed to connect to MySQL: " . mysqli_connect_error ();
}

/* String sanification for DB query */
$codice_ciclista = mysqli_real_escape_string($conn, $codice_ciclista);
$codice_tappa = mysqli_real_escape_string($conn, $codice_tappa);

/* Query construction */
$query = "SELECT Ranking
            FROM Individual_Classification
            WHERE CodC='$codice_ciclista' AND CodS='$codice_tappa'";

/* Query execution */
$result = mysqli_query ( $conn, $query );
if (!$result){
    die ( 'Query error: ' . mysqli_error ( $conn ) );
}

/* Check if codice_ciclista found */
if (mysqli_num_rows ( $result ) > 0) {
    echo "<h1>For $codice_ciclista the ranking is:</h1>";
    echo "<table class='w3-table-all w3-hoverable'>";

    /* Table header */
    echo "<thead><tr>";
    $i = 0;
    $field_names = [];
    while($i<mysqli_num_fields($result)) {
        $meta=mysqli_fetch_field($result);
        echo "<th>".$meta->name."</th>";
        array_push($field_names, $meta->name);
        $i++;
    }
    echo "</thead></tr>";

    /* Table content */
    while($row = mysqli_fetch_array($result)) {
        echo "<tr>";
        foreach ($field_names as $field){
            /* String sanification for HTML */
            $safe_html = htmlspecialchars($row[$field], ENT_QUOTES | ENT_SUBSTITUTE, 'utf-8');
            echo "<td>" . $safe_html . "</td>";
        }
        echo "</tr>";
    }
    echo "</table>";

} else {
    echo "<h1> Ranking not found.</h1>";
}

?>


</body>
</html>
