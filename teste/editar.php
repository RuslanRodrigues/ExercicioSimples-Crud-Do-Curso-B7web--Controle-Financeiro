
<?php
require 'config.php';

$id = $_GET['id'];

try {
  if ($id) {
    $sql = $pdo->prepare("SELECT id, Nome_Despesa, Tipo_Despesa, Valor_Despesa, Data_Despesa, Situação_Despesa FROM Despesas WHERE id = :id");
    $sql->bindValue(':id', $id);
    $sql->execute();


    $info = $sql->fetch(PDO::FETCH_ASSOC);

    if ($info) {
      $UserId = $info['id'];
      $NameDesp = $info['Nome_Despesa'];
      $TipoDesp = $info['Tipo_Despesa'];
      $ValorDesp = $info['Valor_Despesa'];
      $DataDesp = $info['Data_Despesa'];
      $SituacaoDesp = $info['Situação_Despesa'];

    } else {
      echo "Usuário não encontrado";
    }
  } else {
    header("Location: index.php");
    exit;
  }
} catch (PDOException $e) {
  echo 'Erro na execução da consulta: ' . $e->getMessage();
}


?>

<h1>Editar Despesas</h1>

<form method="POST" action="editar_action.php">
  <input type="hidden" name="id" value="<?php echo $UserId; ?>">
  
  <label for="D">
    Nome Despesa:<br/>
    <input type="text" name="Nome" id="D" value="<?php echo $NameDesp; ?>" />
  </label><br/><br/>

  <label>
    Tipo Despesa:<br/>
    <select name="Tipo">
      <option value="1" <?php echo ($TipoDesp == 'Mensal') ? 'selected' : ''; ?>>Mensal</option>
      <option value="2" <?php echo ($TipoDesp == 'Alimentos') ? 'selected' : ''; ?>>Alimentos</option>
      <option value="3" <?php echo ($TipoDesp == 'Gastos Avulsos') ? 'selected' : ''; ?>>Gastos Avulsos</option>
    </select>
  </label><br/><br/>

  <label for="E">
    Valor Despesa:<br/>
    <input type="number" name="Valor" id="E" max="5000" value="<?php echo $ValorDesp; ?>"/>
  </label><br/><br/>

  <label for="F">
    Data Despesa:<br/>
    <input type="date" name="Data" id="F" value="<?php echo $DataDesp; ?>"/>
  </label><br/><br/>

  <label>
    Situação Despesa:<br/>
    <select name="Situacao">
      <option value="4" <?php echo ($SituacaoDesp == 'Pago') ? 'selected' : ''; ?>>Pago</option>
      <option value="5" <?php echo ($SituacaoDesp == 'Pendente Pagamento') ? 'selected' : ''; ?>>Pendente Pagamento</option>
    </select>
  </label><br/><br/>

  <input type="submit" value="Salvar" class="button" />
</form>
