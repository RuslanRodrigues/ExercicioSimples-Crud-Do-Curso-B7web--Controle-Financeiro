
<?php
include'config.php';

$lista = [];
$sql = $pdo->query("SELECT * FROM Despesas");
if($sql->rowCount() > 0) {
  $lista = $sql->fetchAll(PDO::FETCH_ASSOC);
}


?>
<h1><a href="adicionar.php">Adicionar</a></h1>

<br><br>

<table border="1" width="100%">
  <tr>
    <th>ID</th>
    <th>NOME DESPESA</th>
    <th>TIPO DESPESA</th>
    <th>VALOR DESPESA</th>
    <th>DATA DESPESA</th>
    <th>SITUAÇÃO DESPESA</th>
    <th>AÇÕES</th>
  </tr>
  <?php foreach ($lista as $usuario): ?>
    <tr>
      <td><?php echo $usuario['id']; ?></td>
      <td><?php echo $usuario['Nome_Despesa'];?></td>
      <td><?php echo $usuario['Tipo_Despesa'];?></td>
      <td><?php echo $usuario['Valor_Despesa'];?></td>
      <td><?php echo date('d/m/Y', strtotime($usuario['Data_Despesa'])); ?></td>
      <td><?php echo $usuario['Situação_Despesa'];?></td>
      <td>
        <a href="editar.php?id=<?= $usuario['id'];?>">[Editar]</a>

        <a href="excluir.php?id=<?=$usuario['id'];?>">[Excluir]</a>
      </td>
    </tr>
  <?php endforeach; ?>
</table>

<br><br>

<?php
include 'config.php';

$lista_calc= [];
$sql = $pdo->query("SELECT * FROM Renda");

  if ($sql && $sql->rowCount() > 0) {
    $lista_calc = $sql->fetchAll(PDO::FETCH_ASSOC);
  }
  ?>

<fieldset>
  <legend>Sálarios</legend>
  <table border="1" width="100%">
    <tr>
      <th>ID</th>
      <th>Renda_01</th>
      <th>Renda_02</th>
      <th>Renda_Extra</th>
      <th>AÇÕES</th>
    </tr>
<?php foreach ($lista_calc as $cac): ?>
      <tr>
        <td><?php echo $cac['id']; ?></td>
        <td><?php echo $cac['Renda_01']; ?></td>
        <td><?php echo $cac['Renda_02']; ?></td>
        <td><?php echo $cac['Renda_Extra']; ?></td>
        <td>
          <a href="editar_calculo.php?id=<?=$cac['id'];?>">[Editar]</a>
        </td>
      </tr>
  <?php endforeach; ?>
  </table>
</fieldset>

<br><br>


<?php
include 'config.php';

$lista_calc1 = [];
$sql = $pdo->query("SELECT * FROM Renda");

if ($sql && $sql->rowCount() > 0) {
    $lista_calc1 = $sql->fetchAll(PDO::FETCH_ASSOC);
}

$lista_calc2 = [];
$sql = $pdo->query("SELECT * FROM Despesas");

if ($sql && $sql->rowCount() > 0) {
    $lista_calc2 = $sql->fetchAll(PDO::FETCH_ASSOC);
}

$somaRendas = 0;
$somaTipo = 0;
$somaTipo1 = 0;

foreach ($lista_calc1 as $usuario1) {
    if (isset($usuario1['Renda_01'], $usuario1['Renda_02'], $usuario1['Renda_Extra'])) {
        $somaRendas += $usuario1['Renda_01'] + $usuario1['Renda_02'] + $usuario1['Renda_Extra'];
    }
}

foreach ($lista_calc2 as $usuario2) {
    if ($usuario2['Situação_Despesa'] == 'Pendente Pagamento') {
        $somaTipo += $usuario2['Valor_Despesa'];
    } elseif ($usuario2['Situação_Despesa'] == 'Pago') {
        $somaTipo1 += $usuario2['Valor_Despesa'];
    }
}

$somaTipo2 = $somaRendas - ($somaTipo1 + $somaTipo);
?>

<fieldset>
    <legend>Calculo Despesas</legend>

    <table border="1" width="100%">
        <tr>
            <th>TOTAL [RENDA]</th>
            <th>TOTAL [PENDENTE]</th>
            <th>TOTAL [PAGO]</th>
            <th>DIFERENÇA DE CAIXA</th>

        </tr>

        <tr>
            <td><?php echo $somaRendas; ?></td>
            <td><?php echo $somaTipo; ?></td>
            <td><?php echo $somaTipo1; ?></td>
            <td><?php echo $somaTipo2; ?></td>

        </tr>
    </table>
</fieldset>
