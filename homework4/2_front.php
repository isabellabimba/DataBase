<!DOCTYPE html>
<html>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<body>

<h1>Enter Cyclist</h1>

<form action="2_back.php">

    <label for="codice_ciclista">Cyclist Code:</label><br>
    <input type="text" id="codice_ciclista" name="codice_ciclista" placeholder="e.g. s123456"><br><br>

    <label for="nome_ciclista">Cyclist name:</label><br>
    <input type="text" id="nome_ciclista" name="nome_ciclista" placeholder="e.g. Mario"><br><br>

    <label for="cognome_ciclista">Surname Cyclist:</label><br>
    <input type="text" id="cognome_ciclista" name="cognome_ciclista" placeholder="e.g. Rossi"><br><br>

    <label for="nazionalità_ciclista">Nationality Cyclist:</label><br>
    <input type="text" id="nazionalità_ciclista" name="nazionalità_ciclista" placeholder="e.g. Italian"><br><br>

    <label for="codice_squadra">Team Code:</label><br>
    <select id="codice_squadra" name="codice_squadra" class="w3-select">
    <option value=''disabled selected>Select a team</option>
    <?php

        /* Establish DB connection */
        $conn = @mysqli_connect ( 'localhost', 'root', '', 'Cycling_Championship' );

        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error ();
        }

        /* Query construction */
        $query = "SELECT CodT FROM Team";

        /* Query execution */
        $result = mysqli_query ( $conn, $query );
        if (!$result){
            die ( 'Query error: ' . mysqli_error ( $conn ) );
        }

        /* Check if codt found */
        if (mysqli_num_rows ( $result ) > 0) {
            while($row = mysqli_fetch_array($result)) {
                $codt = $row["CodT"];
                echo "<option value='$codt'>$codt</option>";
            }
        }
        ?>
        </select>
        <br>
        <br>

    <label for="anno_nascita">Year of Birth Cyclist:</label><br>
    <input type="text" id="anno_nascita" name="anno_nascita" placeholder="e.g. 1980"><br><br>

    <input type="submit" value="Insert">
</form>


</body>
</html>
