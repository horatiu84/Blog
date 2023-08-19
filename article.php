<?php

require "./classes/Database.php";
require "./classes/Article.php";

$conn = new Database();
$db=$conn->getConn();

if (isset($_GET['id'])) {

    $article = Article::getById($db,$_GET['id']);
} else {
    $article = null;
}
?>


<h2>Article : </h2>
<?php if (empty($article)) : ?>
    <p>No article found</p>
<?php else : ?>
    <ul>
        <li>
            <article>
                <h3> <?= htmlspecialchars($article['title'])  ?></h3>
                <p><?= htmlspecialchars($article['content'])  ?></p>
            </article>
        </li>
    </ul>
    <a href="edit-article.php?id=<?= $article['id'] ?>">Edit</a>
    <a href="delete-article.php?id=<?= $article['id'] ?>">Delete</a>
<?php endif ?>