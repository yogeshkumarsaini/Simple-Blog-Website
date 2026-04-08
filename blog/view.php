<?php include 'config/db.php'; include 'includes/header.php';

$id = $_GET['id'];

$stmt = $conn->prepare("SELECT posts.*, categories.name AS category_name 
FROM posts 
LEFT JOIN categories ON posts.category_id = categories.id
WHERE posts.id=?");

$stmt->bind_param("i",$id);
$stmt->execute();
$post = $stmt->get_result()->fetch_assoc();
?>

<h2><?= htmlspecialchars($post['title']) ?></h2>

<p class="text-muted">
Category: <?= $post['category_name'] ?>
</p>

<p><?= htmlspecialchars($post['content']) ?></p>

<a href="index.php" class="btn btn-secondary">Back</a>

<?php include 'includes/footer.php'; ?>