<?php
$conn = new mysqli("localhost", "root", "", "catdb");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST["name"];
    $breed = $_POST["breed"];
    $age = $_POST["age"];
    $address = $_POST["address"];
    $color = $_POST["color"];
    $height = $_POST["height"];
    $weight = $_POST["weight"];

    // Check duplicate
    $check = $conn->prepare("SELECT * FROM cats WHERE name=? AND breed=? AND age=?");
    $check->bind_param("ssi", $name, $breed, $age);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        echo "Cat already exists.<br>";
    } else {
        $stmt = $conn->prepare("INSERT INTO cats (name, breed, age, address, color, height, weight) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssissdd", $name, $breed, $age, $address, $color, $height, $weight);
        $stmt->execute();

        echo "Saved successfully.<br>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Cat Registration</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container">
    <h2>Cat Registration</h2>

    <form method="POST">
        Name: <input type="text" name="name" required>
        Breed: <input type="text" name="breed" required>
        Age: <input type="number" name="age" required>
        Address: <input type="text" name="address" required>
        Color: <input type="text" name="color" required>

        Height (cm): <input type="number" step="0.1" name="height" required>
        Weight (kg): <input type="number" step="0.1" name="weight" required>

        <button type="submit">Save</button>
    </form>

    <a href="CatView.php">View Cats</a>
</div>

</body>
</html>