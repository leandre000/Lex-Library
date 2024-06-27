<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include 'db.php';

// Fetch book count
$book_count_sql = "SELECT COUNT(*) AS count FROM books";
$book_count_result = $conn->query($book_count_sql);
$book_count_row = $book_count_result->fetch_assoc();
$book_count = $book_count_row['count'];

// Fetch author count
$author_count_sql = "SELECT COUNT(*) AS count FROM authors";
$author_count_result = $conn->query($author_count_sql);
$author_count_row = $author_count_result->fetch_assoc();
$author_count = $author_count_row['count'];

// Fetch broken books count (placeholder)
$broken_books_count = 5; // Replace with actual query if needed
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Online Library Management - Dashboard</title>
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
        .card {
            border: 1px solid #007bff;
        }
        .card h3 {
            color: #007bff;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <a class="navbar-brand" href="#"><i class="fas fa-book"></i> Online Library Management</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" href="dashboard.php">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="list_books.php">Books</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="add_book.php">Add Book</a>
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

    <div class="container">
        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body text-center">
                        <h3><i class="fas fa-book"></i> <?php echo $book_count; ?></h3>
                        <p>Books Listed</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body text-center">
                        <h3><i class="fas fa-book-dead"></i> <?php echo $broken_books_count; ?></h3>
                        <p>Books Broken</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body text-center">
                        <h3><i class="fas fa-users"></i> <?php echo $author_count; ?></h3>
                        <p>Authors Listed</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
