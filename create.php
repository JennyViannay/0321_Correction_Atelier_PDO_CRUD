<?php

require 'connec.php';

$pdo = new PDO(DSN, USER, PASS);

if ($pdo) {
    echo "Connection OK";
} else {
    echo "Connection KO";
}

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['title']) && !empty($_POST['content']) && !empty($_POST['author'])) {
        $statement = $pdo->prepare("INSERT INTO story (title, content, author) VALUES (:title, :content, :author)");
        $statement->bindValue(":title", $_POST['title'], PDO::PARAM_STR);
        $statement->bindValue(":content", $_POST['content'], PDO::PARAM_STR);
        $statement->bindValue(":author", $_POST['author'], PDO::PARAM_STR);
        $statement->execute();
        
        header('Location: index.php');
    } else {
        $error = "Tous les champs sont requis !";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create Article</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <form method="POST">

            <?php
                if (!empty($error)) {
                    echo "<div class='alert alert-danger'>".$error."</div>";
                }
            ?>

            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title">
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea class="form-control" id="content" rows="3" name="content"></textarea>
            </div>
            <div class="mb-3">
                <label for="author" class="form-label">Author</label>
                <input type="text" class="form-control" id="author" name="author">
            </div>
            <div class="mb-3 text-center">
                <button type="submit" class="btn btn-primary">Create</button>
            </div>
        </form>
    </div>
</body>

</html>
