<?php

require "./classes/Database.php";
require "./classes/Article.php";


$conn = new Database();
$db = $conn->getConn();

if (isset($_GET['id'])) {

    $article = Article::getById($db,$_GET['id']);

    if (!$article) {
        die("Article not found");
    }
} else {
    die("Id not supplied, article not found");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $article->title = $_POST['title'];
    $article->content = $_POST['content'];
    $article->published_at = $_POST['published_at'];




    if($article->update($db)) {
        header("Location: article.php?id={$article->id}");
    }
}


?>
<h2>Edit article</h2>
<?php require './includes/article-form.php'; ?>

<?php require './includes/footer.php' ?>