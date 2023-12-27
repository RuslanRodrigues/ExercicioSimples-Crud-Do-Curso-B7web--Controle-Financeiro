<?php
include 'config.php';


$Name = $_POST['Nome'];
$Tipo = $_POST['Tipo'];
$Valor = $_POST['Valor'];
$Data = $_POST['Data'];
$Situacao =$_POST['Situacao'];

if ($Tipo) {
  switch ($Tipo) {
    case 1:
    $Tipo= "Mensal";
    break;
    case 2:
    $Tipo= "Alimentos";
    break;
    case 3:
    $Tipo= "Gastos Avulsos";
    break;
    default:
    echo "Vazio";
    break;
  }
}

if ($Situacao) {
  switch ($Situacao) {
    case 4:
    $Situacao="Pago";
    break;
    case 5:
    $Situacao="Pendente Pagamento";
    break;
    default:
    echo "Vazio";
    break;
  }
}

try {
  $Name = filter_var($Name, FILTER_SANITIZE_STRING);
  $Tipo = filter_var($Tipo, FILTER_SANITIZE_STRING);
  $Valor = filter_var($Valor,FILTER_SANITIZE_NUMBER_FLOAT);
  $Data = filter_var($Data, FILTER_SANITIZE_STRING);
  $Data = date('Y-m-d', strtotime($Data));
  $Situacao = filter_var($Situacao, FILTER_SANITIZE_STRING);


  if ($Name) {
    $sql = $pdo->prepare("INSERT INTO Despesas (Nome_Despesa, Tipo_Despesa, Valor_Despesa, Data_Despesa, Situação_Despesa) VALUES (:Nome, :Tipo, :Valor, :Data, :Situacao)");
    $sql->bindValue(':Nome', $Name);
    $sql->bindValue(':Tipo', $Tipo);
    $sql->bindValue(':Valor', $Valor);
    $sql->bindValue(':Data', $Data);
    $sql->bindValue(':Situacao', $Situacao);

    $sql->execute();

    header("Location: index.php");
    exit;

  }

} catch (PDOException $e) {
  error_log('Erro na execução da consulta: ' . $e->getMessage());
  exit;
}
