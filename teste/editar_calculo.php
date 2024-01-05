<?php
require 'config.php';

$id = $_GET['id'];

$list = [];

try {
  if ($id) {
    $sql = $pdo->prepare("SELECT id, Renda_01, Renda_02, Renda_Extra FROM Renda WHERE id=:id");
    $sql->bindValue(':id', $id);
    $sql->execute();
    $list = $sql->fetchAll(PDO::FETCH_ASSOC);
  } else {
    header("Location: index.php");
  }

} catch (PDOException $e) {
  echo 'Erro na execução da consulta: ' . $e->getMessage();
}

?>

<head>
  <meta charset="utf-8">
  <title>Editar Renda</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <style>
    body {
      padding: 20px;
    }

    p {
      font-size: 24px;
      font-weight: bold;
      color: #007bff; /* Cor azul do Bootstrap */
    }
    form {
        max-width: 600px;
        margin: auto;
    }

    input {
      margin-bottom: 10px;
    }
    label {
        display: block;
        margin-bottom: 10px;
    }

    input[type="submit"] {
      background-color: #28a745; /* Cor verde do Bootstrap */
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
      <p>Editar Renda</p>
  </div>
  <?php foreach ($list as $array): ?>
    <form method="POST" action="editar_calculo_action.php">
      <input type="hidden" name="id" value="<?php echo $array['id']; ?>">

      <div class="form-group">
        <label>Renda_01:</label>
        <input type="number" class="form-control" name="Rend1" value="<?php echo $array['Renda_01']; ?>">
      </div>

      <div class="form-group">
        <label>Renda_02:</label>
        <input type="text" class="form-control" name="Rend2" value="<?php echo $array['Renda_02']; ?>">
      </div>

      <div class="form-group">
        <label>Renda_Extra:</label>
        <input type="text" class="form-control" name="Extra" value="<?php echo $array['Renda_Extra']; ?>">
      </div>

      <br>
      <input type="submit" class="btn btn-primary" value="Editar">
    </form>
  <?php endforeach; ?>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
