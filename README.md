# 📚Library Management System

## 🌟 Overview
A lightweight **Library Management System** built with **PHP** and **MySQL** to manage books, members, and borrowing activities for small libraries. Designed for librarians and administrators, it offers a simple, user-friendly interface to streamline library operations. 🚀

## ✨ Key Features
- 📖 **Book Management**: Add, update, and delete book records (title, author, ISBN).
- 👤 **Member Management**: Register and manage library members.
- 📅 **Borrowing & Returns**: Track book loans and return status.
- 🔍 **Search Functionality**: Search books by title or author.
- 📊 **Basic Reports**: Generate reports for borrowed books and overdue returns.
- 🔒 **Admin Login**: Secure access for administrators.

## 🛠️ Prerequisites
- ☕ **PHP 7.4** or later
- 🗄️ **MySQL 5.7** or later
- 📦 **Apache** or **Nginx** web server
- 🌍 **Modern browser** (Chrome, Firefox, Edge)

## 🚀 Installation
1. **Clone the Repository** 📂
   ```bash
   git clone https://github.com/yourusername/library-management.git
   cd library-management
   ```

2. **Configure Database** 🗄️
   - Create a MySQL database named `library_db`.
   - Import `database/library_db.sql` into the database.
   - Update `config/db.php` with your database credentials:
     ```php
     <?php
     define('DB_HOST', 'localhost');
     define('DB_USER', 'your_username');
     define('DB_PASS', 'your_password');
     define('DB_NAME', 'library_db');
     ?>
     ```

3. **Set Up Web Server** 🌐
   - Place the project folder in your web server’s root (e.g., `htdocs` for XAMPP).
   - Ensure write permissions for the `uploads` folder (if used for book covers).

4. **Run the Application** 🏃
   - Start Apache and MySQL (e.g., via XAMPP/WAMP).
   - Access the app at `http://localhost/library-management`.

## 🎮 Usage
1. **Admin Login** 🔐
   - Visit `http://localhost/library-management`.
   - Default credentials (update in production):
     - **Username**: admin
     - **Password**: admin123

2. **Manage Library** 📚
   - Add books and members via the admin dashboard.
   - Record borrowing/return transactions.
   - Use the search bar to find books by title or author.
   - View reports for borrowing status and overdue books.

3. **Key Endpoints** 📡
   - **Book List**: `GET /api/books`
   - **Add Book**: `POST /api/books/add`
     ```json
     {
       "title": "Sample Book",
       "author": "John Doe",
       "isbn": "1234567890"
     }
     ```

## 📂 Project Structure
```
library-management/
├── config/
│   ├── db.php              # Database configuration ⚙️
├── css/                    # Stylesheets (Bootstrap, custom CSS) 🎨
├── js/                     # JavaScript (jQuery) 🛠️
├── src/
│   ├── controllers/        # Request handling logic ⚙️
│   ├── models/             # Database models (Book, Member) 📋
│   ├── views/              # UI templates (PHP/HTML) 📄
├── database/
│   ├── library_db.sql      # Database schema 🗄️
├── index.php               # Entry point 🌐
├── README.md               # This file 📄
```

## 🤝 Contributing
Contributions are welcome! To contribute:
1. 🍴 Fork the repository.
2. 🌿 Create a branch: `git checkout -b feature/your-feature`.
3. ✍️ Commit changes: `git commit -m "Add your feature"`.
4. 🚀 Push branch: `git push origin feature/your-feature`.
5. 📬 Open a pull request.

---

🌍 Simplify library management!
