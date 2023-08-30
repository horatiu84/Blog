<?php

include_once '../includes/autoloader.php';

Auth::requireLogin();

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

  if ($article->delete($db)) {
      header("Location: blog.php");
      exit;
  }

}

?>

<?php require '../includes/header.php' ?>

<h2>Delete article</h2>
<form method="post" >
    <p>Are you sure?</p>
    <button>Delete</button>
    <a href="../article.php?id=<?= $article->id; ?>">Cancel</a>
</form>
<?php require_once '../includes/footer.php'; ?>