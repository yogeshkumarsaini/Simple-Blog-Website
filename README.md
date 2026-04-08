# 📝 PHP Blog Website

A simple and secure **Blog Website** built using **PHP & MySQL** with full CRUD functionality, search, pagination, and category management. This project demonstrates core backend development concepts and clean UI using Bootstrap.

---

## 🚀 Features

* ✍️ Create Blog Posts
* 📃 View All Posts
* ✏️ Edit & Update Posts
* ❌ Delete Posts
* 🔍 Search Functionality
* 📄 Pagination
* 🏷️ Categories System
* 🔐 Secure Queries (Prepared Statements)
* 🎨 Responsive UI using Bootstrap
* 🦶 Professional Footer Section

---

## 🧠 Concepts Used

* PHP (Core)
* MySQL Database
* CRUD Operations
* Prepared Statements (SQL Injection Prevention)
* Form Handling (GET & POST)
* Basic Routing
* Bootstrap (UI Design)

---

## 📁 Project Structure

```
blog/
│── config/
│   └── db.php
│
│── includes/
│   ├── header.php
│   └── footer.php
│
│── posts/
│   ├── create.php
│   ├── edit.php
│   └── delete.php
│
│── index.php
│── view.php
```

---

## 🗄️ Database Setup

```sql
CREATE DATABASE blog_db;
USE blog_db;

CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100)
);

INSERT INTO categories (name) VALUES ('Tech'), ('Life'), ('Education');

CREATE TABLE posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255),
    content TEXT,
    category_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

---

## ⚙️ Installation & Setup

1. Clone the repository:

```
git clone https://github.com/yogeshkumarsaini/php-blog.git
```

2. Move project to your server directory:

* For XAMPP → `htdocs`
* For WAMP → `www`

3. Start Apache & MySQL

4. Import the database in phpMyAdmin

5. Update database config:

```
config/db.php
```

6. Run in browser:

```
http://localhost/blog/
```

---

## 🔐 Security

* Used **Prepared Statements** to prevent SQL Injection
* Used `htmlspecialchars()` to prevent XSS attacks


