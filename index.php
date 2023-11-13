<?php
$host = "localhost";
$username = "root";
$password = "";
$baza = "gamess";

$conn = new mysqli($host, $username, $password, $baza);

if ($conn->connect_error) {
    die("błąd połączenia z bazą " . $conn->connection_error);
}

if (isset($_POST['insert'])) {
    $nazwa = $_POST["nazwa"];
    $typ = $_POST["typ"];
    $producent = $_POST["producent"];
    $data_produkcji = $_POST["data_produkcji"];

    $sql = "INSERT INTO `gry`(`nazwa`, `typ`, `producent`, `data_produkcji`) 
    VALUES ('$nazwa','$typ','$producent','$data_produkcji')";

    if ($conn->query($sql) == TRUE) {
        echo "dane zostały dodane do bazy!!";
    } else {
        echo "błąd " . $sql . "<br>" . $conn->error;
    }
}
$sql_select = "SELECT * FROM gry";
$result = $conn->query($sql_select);
?>
<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>strona</title>
        <style>
            table {
                border-collapse: collapse;
                width: 50%;
                margin-top: 20px;
            }
            table, th, td {
                border 1px solid black;
            }
            th, td {
                padding: 10px;
                text-align: left;
            }
            </style>
    </head>
    <body>
        <form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
            Nazwa: <input type="text" name="nazwa" required><br>
            Typ: <input type="text" name="typ" required><br>
            Producent: <input type="text" name="producent" required><br>
            Data produkcji: <input type="text" name="data_produkcji" required><br>
            <input type="submit" name="insert" value="Dodaj">
        </form>
        <?php
        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>ID Gry</th><th>Nazwa</th><th>Typ</th><th>Producent</th><th>Data Produkcji</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>".$row["id_gry"]."</td><td>".$row["nazwa"]."</td><td>".$row["typ"]."</td><td>".$row["producent"]."</td><td>".$row["data_produkcji"]."</td></tr>";
            }
            echo "</table>";
        } else {
            echo "brak danych";
        }
        ?>
    </body>
</html>
<?php
    $conn->close();
    ?>