<?php

require 'config.php';

$id = $_GET['id'];

    if ($id) {
        $sql = $pdo->prepare("DELETE FROM Renda WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();

    header("Location:calculo.php");
    exit;
}
