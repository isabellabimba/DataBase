<!DOCTYPE html>
<html>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<body>

<h1>Cyclist position in the stage</h1>

<form action="1_back.php">
    <label for="tutto">Cyclist Code:</label><br>
    <select id="codice_ciclista" name="codice_ciclista" class="w3-select">
    <option value=''disabled selected>e.g. s123456</option>
    <?php

        /* Establish DB connection */
        $conn = @mysqli_connect ( 'localhost', 'root', '', 'Cycling_Championship' );

        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error ();
        }

        /* Query construction */
        $query = "SELECT CodC FROM Individual_Classification";

        /* Query execution */
        $result = mysqli_query ( $conn, $query );
        if (!$result){
            die ( 'Query error: ' . mysqli_error ( $conn ) );
        }

        /* Check if codC found */
        if (mysqli_num_rows ( $result ) > 0) {
            while($row = mysqli_fetch_array($result)) {
                $codC = $row["CodC"];
                echo "<option value='$codC'>$codC</option>";
            }
        }

    ?>
    </select>
    <br>
    <br>

    <form action="1_back.php">
      <label for="codice_tappa">Stage Code:</label><br>
      <input type="text" id="codice_tappa" name="codice_tappa" placeholder="e.g. 1">
      <br><br>

    <input type="submit" value="Find">
</form>


</body>
</html>
