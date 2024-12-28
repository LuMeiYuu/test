<html>
<head>
</head>
<body>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HTML Form to SQL</title>
    <link rel="stylesheet"  href="..\style.css"> 

</head>
<body> 
<div class="top-bar">
    <ul>
    <li><a href="\test\attendance"><button> Record Attendance </button></a> </li>
    <li><span><img src="..\images\logomain.png" alt="logo goes here"></span></li>
    <li><a href="/test/display" ><button> Records </button></a> </li>
</ul>
</div>
<div class="menufr">
    
    <h1> Your Attendance has been recorded!</h1>
    <?php
// Establish database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "testing";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve the most recently submitted row from the students table
$sql = "SELECT * FROM attendance ORDER BY attendance_id DESC LIMIT 1";
$result = $conn->query($sql);

if ($result !== false && $result->num_rows > 0) {
    // Fetch the most recently inserted row data
    $row = $result->fetch_assoc();

    // Display the inserted data
    echo "Submitted information:<br>";
    echo "time: " . $row['time'] . "<br>";
    echo "Id Number: " . $row['id_number'] . "<br>";
    
} else {
    echo "Error: No data found.";
}

// Close database connection
$conn->close();
?>

    
</div>




</body>
</html>

</body>
</html>