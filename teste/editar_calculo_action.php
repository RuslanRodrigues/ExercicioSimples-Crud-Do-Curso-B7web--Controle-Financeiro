<?php

require 'config.php';

$id = $_POST['id'];
$R = $_POST['Rend1'];
$RR = $_POST['Rend2'];
$E = $_POST['Extra'];

$id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
$R = filter_var($R, FILTER_VALIDATE_FLOAT);
$RR = filter_var($RR, FILTER_VALIDATE_FLOAT);
$E = filter_var($E, FILTER_VALIDATE_FLOAT);

try {
  if ($id) {
    $sql = $pdo->prepare("UPDATE Renda SET Renda_01=:Rend1, Renda_02=:Rend2, Renda_Extra=:Extra WHERE id=:id");
    $sql->bindValue(':id', $id);
    $sql->bindValue(':Rend1', $R);
    $sql->bindValue(':Rend2', $RR);
    $sql->bindValue(':Extra', $E);
    $sql->execute();

    header("Location: index.php");
    exit;

  } else {
    header('Location: index.php');
      exit;
  }
} catch (\Exception $e) {
  echo "ERRO !";
}

?>
