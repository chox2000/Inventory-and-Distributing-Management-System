<?php
include('connection.php'); // Include the connection file

if(isset($_POST['save_button'])) {
    // Retrieve form data
    $rawMaterialName = $_POST['RawMaterialstName'];
    $costPrice = $_POST['CostPrice'];
    $supplierId = $_POST['supplier'];
    $unit = $_POST['Unit'];

    // Prepare SQL statement
    $sql = "INSERT INTO rawmaterials (RawMaterialstName,CostPrice,SupplierId,Unit) VALUES (?, ?, ?, ?)";

    // Prepare and bind parameters
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssis", $rawMaterialName, $costPrice, $supplierId, $unit);

    // Execute the statement
    if ($stmt->execute()) {
        // Data inserted successfully
        echo "Raw material added successfully.";
        header("Location: viewRaw.php");
    } else {
        // Error occurred while inserting data
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>
