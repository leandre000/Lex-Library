<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include 'db.php';

$search = '';
if (isset($_POST['search'])) {
    $search = $_POST['search'];
}

$sql = "SELECT books.*, authors.name AS author_name FROM books 
        LEFT JOIN authors ON books.author_id = authors.author_id 
        WHERE books.title LIKE '%$search%' OR authors.name LIKE '%$search%'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Online Library Management - Books</title>
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
        .book-image {
            width: 50px;
            height: 50px;
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
                    <a class="nav-link active" href="list_books.php">Books</a>
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

    <div class="container mt-4">
        <form class="form-inline mb-3" method="post" action="list_books.php">
            <input class="form-control mr-sm-2" type="text" name="search" placeholder="Search" value="<?php echo $search; ?>">
            <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>ISBN</th>
                    <th>Genre</th>
                    <th>Publication Year</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><img src="<?php echo $row['image']; ?>" class="book-image" alt="Book Image"></td>
                        <td><?php echo $row['title']; ?></td>
                        <td><?php echo $row['author_name']; ?></td>
                        <td><?php echo $row['ISBN']; ?></td>
                        <td><?php echo $row['genre']; ?></td>
                        <td><?php echo $row['publication_year']; ?></td>
                        <td>
                            <a href="edit_book.php?id=<?php echo $row['book_id']; ?>" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                            <a href="archive_book.php?id=<?php echo $row['book_id']; ?>" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
