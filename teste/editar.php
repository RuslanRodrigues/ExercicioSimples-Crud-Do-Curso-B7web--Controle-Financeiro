
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Despesas</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        body {
            padding: 20px;
        }
        h1 {
          font-size: 24px;
          font-weight: bold;
          color: #007bff; /* Cor azul do Bootstrap */
        }
        form {
            max-width: 600px;
            margin: auto;
        }
        label {
            display: block;
            margin-bottom: 10px;
        }
        .button {
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>


    <div class="text-center">
        <h1 class="mt-4">Editar Despesas</h1>
    </div>

    <form method="POST" action="editar_action.php">
        <input type="hidden" name="id" value="<?php echo $UserId; ?>">

        <div class="form-group">
            <label for="D">Nome Despesa:</label>
            <input type="text" class="form-control" name="Nome" id="D" value="<?php echo $NameDesp; ?>" />
        </div>

        <div class="form-group">
            <label>Tipo Despesa:</label>
            <select class="form-control" name="Tipo">
                <option value="1" <?php echo ($TipoDesp == 'Mensal') ? 'selected' : ''; ?>>Mensal</option>
                <option value="2" <?php echo ($TipoDesp == 'Alimentos') ? 'selected' : ''; ?>>Alimentos</option>
                <option value="3" <?php echo ($TipoDesp == 'Gastos Avulsos') ? 'selected' : ''; ?>>Gastos Avulsos</option>
            </select>
        </div>

        <div class="form-group">
            <label for="E">Valor Despesa:</label>
            <input type="number" class="form-control" name="Valor" id="E" max="5000" value="<?php echo $ValorDesp; ?>"/>
        </div>

        <div class="form-group">
            <label for="F">Data Despesa:</label>
            <input type="date" class="form-control" name="Data" id="F" value="<?php echo $DataDesp; ?>"/>
        </div>

        <div class="form-group">
            <label>Situação Despesa:</label>
            <select class="form-control" name="Situacao">
                <option value="4" <?php echo ($SituacaoDesp == 'Pago') ? 'selected' : ''; ?>>Pago</option>
                <option value="5" <?php echo ($SituacaoDesp == 'Pendente Pagamento') ? 'selected' : ''; ?>>Pendente Pagamento</option>
            </select>
        </div>

        <input type="submit" value="Salvar" class="btn btn-primary button" />
    </form>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
