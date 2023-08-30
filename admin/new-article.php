<?php
include_once '../includes/autoloader.php';


Auth::requireLogin();


$article = new Article();


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $conn = new Database();
    $db = $conn->getConn();

    $article->title = $_POST['title'];
    $article->content = $_POST['content'];
    $article->published_at = $_POST['published_at'];




    if($article->create($db)) {
        header("Location: article.php?id={$article->id}");
    }
}

?>
<?php require '../includes/header.php' ?>

<h2>New article</h2>

<?php require 'includes/article-form.php'; ?>

<?php require '../includes/footer.php' ?>