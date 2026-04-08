<?php include '../config/db.php'; include '../includes/header.php';

$id = $_GET['id'];

$stmt = $conn->prepare("SELECT * FROM posts WHERE id=?");
$stmt->bind_param("i",$id);
$stmt->execute();
$post = $stmt->get_result()->fetch_assoc();
?>

<h2>Edit Post</h2>

<form method="POST">
    <input type="text" name="title" value="<?= $post['title'] ?>" class="form-control mb-2">
    
    <textarea name="content" class="form-control mb-2"><?= $post['content'] ?></textarea>

    <button name="update" class="btn btn-primary">Update</button>
</form>

<?php
if(isset($_POST['update'])){
    $title = $_POST['title'];
    $content = $_POST['content'];

    $stmt = $conn->prepare("UPDATE posts SET title=?, content=? WHERE id=?");
    $stmt->bind_param("ssi",$title,$content,$id);
    $stmt->execute();

    header("Location: ../index.php");
}
?>

<?php include '../includes/footer.php'; ?>