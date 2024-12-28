<html>
<head>
</head>
<body>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Establish database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "testing";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $name = $_POST['name'];
    $id_number = $_POST['id_number'];
    $strand = $_POST['strand'];

    // Prepare SQL statement to insert data into database
    $sql = "INSERT INTO students (name, id_number, strand) VALUES ('$name', '$id_number','$strand' )";

    // Execute SQL statement
    if ($conn->query($sql) === TRUE) {
        // Redirect to display information page
        header("Location: display_info.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close database connection
    $conn->close();
}
?>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    Name: <input type="text" name="name"><br>
    ID Number: <input type="text" name="id_number"><br>
    Strand: <input type="text" name="strand"><br>
    <input type="submit" value="Submit">
</form>
</body>
</html>
