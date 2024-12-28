<?php
// Establish database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "testing";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve data from students table
$sql_students = "SELECT * FROM students";
$result_students = $conn->query($sql_students);

$sql_attend_comb = "SELECT * FROM combined_info";
$result_attendance = $conn->query($sql_attend_comb);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Students</title>
    <link rel="stylesheet"  href="/test/style.css">
    <style>
        #dlbutton {
            padding: 10px; /* Set padding to 3px */
            background-color: transparent; /* No background color */
            color: rgb(7, 7, 7); /* White text color */
            border: 1px solid rgb(0, 0, 0); /* Border with white color */
            border-radius: 5px; /* Rounded corners */
            cursor: pointer; /* Show pointer cursor on hover */
            font-size: 10px;
            margin: 10px;
        }
        #dlbutton:hover {
            background-color: white; /* No background color */
            color: #0A1128;
        }
    </style>
</head>
<body>

<div class="top-bar">
    <ul>
        <li><a href="\test"><button> Register </button></a> </li>
        <li><span><img src="\test\images\logomain.png" alt="logo goes here"></span></li>
        <li><a href="\test\display" ><button> Records </button></a> </li>
    </ul>
</div>

<div class="maindiv">
    <div class="info-card">
        <h2 style="margin:5px;" >Students Table</h2>
        <a style="margin:5px;" href="download_students.php" download><button id="dlbutton">Download CSV</button></a>

        <table border="1">
            <tr>
                <th>Name</th>
                <th>Strand</th>
                <th>ID Number</th>
            </tr>
            <?php
            if ($result_students->num_rows > 0) {
                while($row_students = $result_students->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row_students["name"] . "</td>";
                    echo "<td>" . $row_students["strand"] . "</td>";
                    echo "<td>" . $row_students["id_number"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No students found</td></tr>";
            }
            ?>
        </table>
    </div>

    <div class="info-card">
        <h2 style="margin:5px;">Attendance Table</h2>
        <a href="download_attendance.php" download><button id="dlbutton">Download CSV</button></a>

        <?php
        // Query to get combined data
        $query = "SELECT s.id, s.id_number, s.name, s.strand, a.time 
                  FROM students s
                  LEFT JOIN attendance a ON s.id_number = a.id_number
                  ORDER BY a.time DESC";
                  
        $result = mysqli_query($conn, $query);

        // Display table
        ?>

        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>ID Number</th>
                    <th>Name</th>
                    <th>Strand</th>
                    <th>Time</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['id_number'] . "</td>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . $row['strand'] . "</td>";
                    echo "<td>" . $row['time'] . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>

        <?php
        // Close connection
        mysqli_close($conn);
        ?>
    </div>

</div>
</body>
</html>
