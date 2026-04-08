<?php include 'config/db.php'; include 'includes/header.php'; ?>

<h2>All Posts</h2>
<a href="posts/create.php" class="btn btn-success mb-3">Create Post</a>

<form method="GET" class="mb-3">
    <input type="text" name="search" class="form-control" placeholder="Search...">
</form>

<?php
$limit = 6;
$page = $_GET['page'] ?? 1;
$start = ($page - 1) * $limit;

$search = $_GET['search'] ?? '';

if ($search) {
    $stmt = $conn->prepare("SELECT posts.*, categories.name AS category_name 
    FROM posts 
    LEFT JOIN categories ON posts.category_id = categories.id
    WHERE title LIKE ? OR content LIKE ?
    LIMIT ?, ?");
    
    $searchTerm = "%$search%";
    $stmt->bind_param("ssii", $searchTerm, $searchTerm, $start, $limit);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $result = $conn->query("SELECT posts.*, categories.name AS category_name 
    FROM posts 
    LEFT JOIN categories ON posts.category_id = categories.id
    ORDER BY id DESC
    LIMIT $start, $limit");
}

$total = $conn->query("SELECT COUNT(*) as count FROM posts")->fetch_assoc()['count'];
$pages = ceil($total / $limit);
?>

<div class="row">
<?php while($row = $result->fetch_assoc()): ?>
    <div class="col-md-4">
        <div class="card mb-4 shadow">
            <div class="card-body">
                <h5><?= htmlspecialchars($row['title']) ?></h5>
                <p><?= substr(htmlspecialchars($row['content']),0,100) ?>...</p>

                <p class="text-muted">
                    Category: <?= $row['category_name'] ?? 'None' ?>
                </p>

                <a href="view.php?id=<?= $row['id'] ?>" class="btn btn-primary btn-sm">Read</a>
                <a href="posts/edit.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                <a href="posts/delete.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm">Delete</a>
            </div>
        </div>
    </div>
<?php endwhile; ?>
</div>

<nav>
<ul class="pagination">
<?php for($i=1; $i<=$pages; $i++): ?>
<li class="page-item">
<a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
</li>
<?php endfor; ?>
</ul>
</nav>

<?php include 'includes/footer.php'; ?>