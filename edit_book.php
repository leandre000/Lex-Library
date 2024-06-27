<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include 'db.php';

$book_id = $_GET['id'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $author_id = $_POST['author_id'];
    $isbn = $_POST['isbn'];
    $genre = $_POST['genre'];
    $publication_year = $_POST['publication_year'];
    $image = $_FILES['image']['name'];
    $target = "images/" . basename($image);

    if ($image) {
        $sql = "UPDATE books SET title='$title', author_id='$author_id', ISBN='$isbn', genre='$genre', publication_year='$publication_year', image='$target' WHERE book_id='$book_id'";
    } else {
        $sql = "UPDATE books SET title='$title', author_id='$author_id', ISBN='$isbn', genre='$genre', publication_year='$publication_year' WHERE book_id='$book_id'";
    }

    if ($conn->query($sql) === TRUE) {
        if ($image && !move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            echo "Failed to upload image.";
        } else {
            header("Location: list_books.php");
            exit();
        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}

$sql = "SELECT * FROM books WHERE book_id='$book_id'";
$result = $conn->query($sql);
$book = $result->fetch_assoc();

$authors_sql = "SELECT * FROM authors";
$authors_result = $conn->query($authors_sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Online Library Management - Edit Book</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .navbar {
            border-bottom: 2px solid #007bff;
            background-color: #f8f9fa;
            padding: 15px;
        }
        .navbar-brand {
            display: flex;
            align-items: center;
        }
        .navbar-brand i {
            margin-right: 10px;
        }
        .navbar-nav .nav-link {
            color: #007bff;
            padding: 10px 15px;
        }
        .navbar-nav .nav-link:hover, .navbar-nav .nav-link.active {
            color: #0056b3;
            background-color: #e9ecef;
            border-radius: 5px;
        }
        .logout-btn {
            position: absolute;
            right: 15px;
            top: 15px;
            color: #dc3545;
            border: 1px solid #dc3545;
            padding: 5px 10px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <a class="navbar-brand" href="dashboard.php"><i class="fas fa-book"></i> Online Library Management</a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="dashboard.php">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="list_books.php">Books</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="add_book.php">Add Book</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="edit_book.php?id=<?php echo $book_id; ?>">Edit Book</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Authors</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Issue Books</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Register Students</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Change Password</a>
                </li>
            </ul>
            <a href="logout.php" class="logout-btn">Log Me Out</a>
        </div>
    </nav>

    <div class="container mt-4">
        <h2>Edit Book</h2>
        <form action="edit_book.php?id=<?php echo $book_id; ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" class="form-control" id="title" name="title" value="<?php echo $book['title']; ?>" required>
            </div>
            <div class="form-group">
                <label for="author_id">Author:</label>
                <select class="form-control" id="author_id" name="author_id" required>
                    <?php while($row = $authors_result->fetch_assoc()): ?>
                        <option value="<?php echo $row['author_id']; ?>" <?php if ($row['author_id'] == $book['author_id']) echo 'selected'; ?>><?php echo $row['name']; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="isbn">ISBN:</label>
                <input type="text" class="form-control" id="isbn" name="isbn" value="<?php echo $book['ISBN']; ?>" required>
            </div>
            <div class="form-group">
                <label for="genre">Genre:</label>
                <input type="text" class="form-control" id="genre" name="genre" value="<?php echo $book['genre']; ?>" required>
            </div>
            <div class="form-group">
                <label for="publication_year">Publication Year:</label>
                <input type="number" class="form-control" id="publication_year" name="publication_year" value="<?php echo $book['publication_year']; ?>" required>
            </div>
            <div class="form-group">
                <label for="image">Image:</label>
                <input type="file" class="form-control" id="image" name="image">
                <img src="<?php echo $book['image']; ?>" class="book-image mt-2" alt="Book Image">
            </div>
            <button type="submit" class="btn btn-primary">Update Book</button>
        </form>
    </div>
</body>
</html>
