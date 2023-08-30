<?php

include_once '../includes/autoloader.php';

Auth::requireLogin();

$conn = new Database();

$db = $conn->getConn();

$articles = Article::getAll($db);
?>

<?php require '../includes/header.php' ?>

    <h2>Administration : </h2>
    <p><a href="new-article.php">Add a new article</a></p>

<?php if (empty($articles)) : ?>
    <p>No articles in the database</p>
<?php else : ?>
    <table>
        <thead>
            <th>Title</th>
        </thead>
        <tbody>
        <?php foreach ($articles as $article) : ?>
            <tr>
                <td>
                    <a href="article.php?id=<?= $article['id'] ?>"> <?= htmlspecialchars($article['title']) ?></a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif ?>
<?php require '../includes/footer.php' ?>