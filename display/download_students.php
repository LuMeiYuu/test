<?php
// Establish database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "testing";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from the database
$sql = "SELECT * FROM students";
$result = $conn->query($sql);

// Set headers for CSV file
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="data.csv"');

// Open file pointer
$output = fopen('php://output', 'w');

// Write headers to CSV file
fputcsv($output, array('id_number', 'name' )); // Modify the array to match your table structure

// Write data rows to CSV file
while($row = $result->fetch_assoc()) {
    fputcsv($output, $row);
}

// Close file pointer
fclose($output);

// Close database connection
$conn->close();
?>
