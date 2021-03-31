<?php
require 'connec.php';

$pdo = new PDO(DSN, USER, PASS);

if (isset($_GET) && !empty($_GET)) {
    // DELETE FROM story WHERE id=:id
    $statement = $pdo->prepare("DELETE FROM story WHERE id=:id");
    $statement->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
    $statement->execute();
    header('Location: index.php');
}