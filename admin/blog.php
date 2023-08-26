<?php

include_once '../includes/autoloader.php';

$conn = new Database();

$db = $conn->getConn();

$articles = Article::getAll($db);
?>

<?php require '../includes/header.php' ?>


<?php if (Auth::isLoggedIn()) : ?>
    <p>You are logged in. <a href="../logout.php">Log Out</a></p>
    <a href="../new-article.php">Add a new article</a>
<?php else : ?>
    <p>You are not logged in. <a href="../login.php">Log in</a></p>
<?php endif ?>
<h2>Articles : </h2>
<?php if (empty($articles)) : ?>
    <p>No articles in the database</p>
<?php else : ?>
    <ul>
        <?php foreach ($articles as $article) : ?>
            <li>
                <article>

                    <h3> <a href="../article.php?id=<?= $article['id'] ?>"> <?= htmlspecialchars($article['title']) ?></a></h3>
                    <p><?= htmlspecialchars($article['content'])  ?></p>
                </article>
            </li>
        <?php endforeach; ?>

    </ul>
<?php endif ?>
<?php require '../includes/footer.php' ?>