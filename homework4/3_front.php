<!DOCTYPE html>
<html>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<body>

<h1>Enter ranking position</h1>

<form action="3_back.php">

    <label for="codice_ciclista">Cyclist Code:</label><br>
    <select id="codice_ciclista" name="codice_ciclista" class="w3-select">
    <option value="" disabled selected>Select a cyclist</option>
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

        /* Check if codc found */
        if (mysqli_num_rows ( $result ) > 0) {
            while($row = mysqli_fetch_array($result)) {
                $codc = $row["CodC"];
                echo "<option value='$codc'>$codc</option>";
            }
        }
        ?>
        </select>
        <br>
        <br>

    <label for="codice_tappa">Stage Code:</label><br>
    <select id="codice_tappa" name="codice_tappa" class="w3-select">
    <option value=''disabled selected>Select a stage</option>
        <?php

            /* Establish DB connection */
            $conn = @mysqli_connect ( 'localhost', 'root', '', 'Cycling_Championship' );

            if (mysqli_connect_errno()) {
                echo "Failed to connect to MySQL: " . mysqli_connect_error ();
            }

            /* Query construction */
            $query = "SELECT CodS FROM Individual_Classification";

            /* Query execution */
            $result = mysqli_query ( $conn, $query );
            if (!$result){
                die ( 'Query error: ' . mysqli_error ( $conn ) );
            }

            /* Check if cods found */
            if (mysqli_num_rows ( $result ) > 0) {
                while($row = mysqli_fetch_array($result)) {
                    $cods = $row["CodS"];
                    echo "<option value='$cods'>$cods</option>";
                }
            }
            ?>
            </select>
            <br>
            <br>

     <label for="edizione">Edition:</label><br>
     <select id="edizione" name="edizione" class="w3-select">
     <option value=''disabled selected>Select an edition</option>
                <?php

                    /* Establish DB connection */
                    $conn = @mysqli_connect ( 'localhost', 'root', '', 'Cycling_Championship' );

                    if (mysqli_connect_errno()) {
                        echo "Failed to connect to MySQL: " . mysqli_connect_error ();
                    }

                    /* Query construction */
                    $query = "SELECT Edition FROM Individual_Classification";

                    /* Query execution */
                    $result = mysqli_query ( $conn, $query );
                    if (!$result){
                        die ( 'Query error: ' . mysqli_error ( $conn ) );
                    }

                    /* Check if edition found */
                    if (mysqli_num_rows ( $result ) > 0) {
                        while($row = mysqli_fetch_array($result)) {
                            $edition = $row["Edition"];
                            echo "<option value='$edition'>$edition</option>";
                        }
                    }
                    ?>
                    </select>
                    <br>
                    <br>


    <label for="posizione_classifica">Cyclist position:</label><br>
    <input type="text" id="posizione_classifica" name="posizione_classifica" placeholder="e.g. 2"><br><br>

    <input type="submit" value="Insert">
</form>


</body>
</html>
