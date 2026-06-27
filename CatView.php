<?php
$conn = new mysqli("localhost", "root", "", "catdb");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query("SELECT * FROM cats");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cat Records</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<h2>Cat Records</h2>

<table>
<tr>
<th>ID</th>
<th>Name</th>
<th>Breed</th>
<th>Age</th>
<th>Address</th>
<th>Color</th>
<th>Height (cm)</th>
<th>Weight (kg)</th>
</tr>

<?php
while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>".$row["id"]."</td>";
    echo "<td>".$row["name"]."</td>";
    echo "<td>".$row["breed"]."</td>";
    echo "<td>".$row["age"]."</td>";
    echo "<td>".$row["address"]."</td>";
    echo "<td>".$row["color"]."</td>";
    echo "<td>".$row["height"]."</td>";
    echo "<td>".$row["weight"]."</td>";
    echo "</tr>";
}
?>

</table>

<a href="CatRegister.php">Go Back</a>

</body>
</html>