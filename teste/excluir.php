<?php

require 'config.php';

$id = $_GET['id'];

    if ($id) {
        $sql = $pdo->prepare("DELETE FROM Despesas WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();

    header("Location: index.php");
    exit;
}
