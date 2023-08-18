<?php
require './includes/dbcon.php';

session_start();

$db = dbConnect();

$sql = "SELECT *
        FROM articole
        ORDER BY id;";

if (isset($db)) { // we can check to see if the db is set, if not we return empty array, so we won't have error
    $results = mysqli_query($db, $sql);
    $articles = mysqli_fetch_all($results, MYSQLI_ASSOC);
} else {
    $articles = [];
}




?>

<?php require './includes/header.php' ?>


<?php if (isset($_SESSION['is_logged_in']) &&$_SESSION['is_logged_in']) : ?>
    <p>You are logged in. <a href="logout.php">Log Out</a></p>
<?php else : ?>
    <p>You are not logged in. <a href="login.php">Log in</a></p>
<?php endif ?>
<a href="new-article.php">Add a new article</a>
<h2>Articles : </h2>
<?php if (empty($articles)) : ?>
    <p>No articles in the database</p>
<?php else : ?>
    <ul>
        <?php foreach ($articles as $article) : ?>
            <li>
                <article>

                    <h3> <a href="article.php?id=<?= $article['id'] ?>"> <?= htmlspecialchars($article['title']) ?></a></h3>
                    <p><?= htmlspecialchars($article['content'])  ?></p>
                </article>
            </li>
        <?php endforeach; ?>

    </ul>
<?php endif ?>
<?php require './includes/footer.php' ?>