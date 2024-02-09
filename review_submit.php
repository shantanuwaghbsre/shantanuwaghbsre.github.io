<?php
// Assuming you have established a database connection

if(isset($_POST['save_btn'])) {
    $name = $_POST['name'];
    $rating = $_POST['rating'];
    $comment = $_POST['comment'];

    // Insert data into reviews table
    $sql = "INSERT INTO reviews (name, rating, comment) VALUES ('$name', '$rating', '$comment')";
    // Execute the SQL query
    if ($conn->query($sql) === TRUE) {
        echo "Review submitted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>
