<?php
// delete_book.php
include 'db.php';

$book_id = $_GET['id'];

$sql = "UPDATE books SET is_archived=1 WHERE book_id=$book_id";

if ($conn->query($sql) === TRUE) {
    echo "Record archived successfully";
} else {
    echo "Error archiving record: " . $conn->error;
}

$conn->close();
?>
