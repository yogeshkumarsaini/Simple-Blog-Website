<?php include '../config/db.php'; include '../includes/header.php'; ?>

<h2>Create Post</h2>

<form method="POST">
    <input type="text" name="title" class="form-control mb-2" placeholder="Title" required>
    
    <textarea name="content" class="form-control mb-2" placeholder="Content" required></textarea>

    <select name="category" class="form-control mb-2">
        <?php
        $cats = $conn->query("SELECT * FROM categories");
        while($cat = $cats->fetch_assoc()) {
            echo "<option value='{$cat['id']}'>{$cat['name']}</option>";
        }
        ?>
    </select>

    <button name="submit" class="btn btn-success">Post</button>
</form>

<?php
if(isset($_POST['submit'])){
    $title = $_POST['title'];
    $content = $_POST['content'];
    $category = $_POST['category'];

    $stmt = $conn->prepare("INSERT INTO posts (title, content, category_id) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $title, $content, $category);
    $stmt->execute();

    header("Location: ../index.php");
}
?>

<?php include '../includes/footer.php'; ?>