<?php
include 'db.php';

if (isset($_POST['submit'])) {
    $chapter_number = $_POST['chapter_number'];
    $title = $_POST['title'];
    $stmt = $pdo->prepare("INSERT INTO chapters (chapter_number, title) VALUES (?, ?)");
    $stmt->execute([$chapter_number, $title]);
    header("Location: homepage.php");
    exit;
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $chapter_number = $_POST['chapter_number'];
    $title = $_POST['title'];
    $stmt = $pdo->prepare("UPDATE chapters SET chapter_number = ?, title = ? WHERE id = ?");
    $stmt->execute([$chapter_number, $title, $id]);
    header("Location: homepage.php"); 
    exit;
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $pdo->prepare("DELETE FROM chapters WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: homepage.php");  
    exit;
}

// Fetch Chapters from the database
$chapters = $pdo->query("SELECT * FROM chapters")->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manga Chapters</title>
    <link rel="stylesheet" href="css/homepage.css">
</head>
<body>
    <h2>Manga Chapters</h2>
    <form method="post" action="">
        <input type="hidden" name="id" value="<?php echo isset($_GET['edit']) ? $_GET['edit'] : ''; ?>">
        <label>Chapter Number:</label>
        <input type="text" name="chapter_number" required>
        <label>Title:</label>
        <input type="text" name="title" required>
        <button type="submit" name="<?php echo isset($_GET['edit']) ? 'update' : 'submit'; ?>">
            <?php echo isset($_GET['edit']) ? 'Update' : 'Add'; ?>
        </button>
    </form>

    <table>
        <tr>
            <th>Chapter</th>
            <th>Title</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($chapters as $row): ?>
            <tr>
                <td><?php echo $row['chapter_number']; ?></td>
                <td><?php echo $row['title']; ?></td>
                <td>
                    <a href="homepage.php?edit=<?php echo $row['id']; ?>">Edit</a> |
                    <a href="homepage.php?delete=<?php echo $row['id']; ?>">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
