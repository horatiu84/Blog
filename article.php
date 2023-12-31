<?php

include_once './includes/autoloader.php';

$conn = new Database();
$db=$conn->getConn();

if (isset($_GET['id'])) {
// get the article based on the ID record
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
                <h3> <?= htmlspecialchars($article->title)  ?></h3>
                <p><?= htmlspecialchars($article->content)  ?></p>
            </article>
        </li>
    </ul>

<?php endif ?>