
<?php
include 'config.php';

$lista = [];
$sql = $pdo->query("SELECT * FROM Despesas");
if ($sql->rowCount() > 0) {
    $lista = $sql->fetchAll(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Lista de Despesas</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>

    <div class="container mt-4">
        <h1><a href="adicionar.php" class="btn btn-primary">Adicionar</a></h1>

        <br><br>

        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>NOME DESPESA</th>
                    <th>TIPO DESPESA</th>
                    <th>VALOR DESPESA</th>
                    <th>DATA DESPESA</th>
                    <th>SITUAÇÃO DESPESA</th>
                    <th>AÇÕES</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($lista as $usuario): ?>
                    <tr>
                        <td><?php echo $usuario['id']; ?></td>
                        <td><?php echo $usuario['Nome_Despesa']; ?></td>
                        <td><?php echo $usuario['Tipo_Despesa']; ?></td>
                        <td><?php echo $usuario['Valor_Despesa']; ?></td>
                        <td><?php echo date('d/m/Y', strtotime($usuario['Data_Despesa'])); ?></td>
                        <td><?php echo $usuario['Situação_Despesa']; ?></td>
                        <td>
                            <a href="editar.php?id=<?= $usuario['id']; ?>" class="btn btn-warning">Editar</a>
                            <a href="excluir.php?id=<?= $usuario['id']; ?>" class="btn btn-danger">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <br><br>

        <?php
        include 'config.php';

        $lista_calc = [];
        $sql = $pdo->query("SELECT * FROM Renda");

        if ($sql && $sql->rowCount() > 0) {
            $lista_calc = $sql->fetchAll(PDO::FETCH_ASSOC);
        }
        ?>

        <fieldset>
            <legend>Sálarios</legend>
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Renda_01</th>
                        <th>Renda_02</th>
                        <th>Renda_Extra</th>
                        <th>AÇÕES</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($lista_calc as $cac): ?>
                        <tr>
                            <td><?php echo $cac['id']; ?></td>
                            <td><?php echo $cac['Renda_01']; ?></td>
                            <td><?php echo $cac['Renda_02']; ?></td>
                            <td><?php echo $cac['Renda_Extra']; ?></td>
                            <td>
                                <a href="editar_calculo.php?id=<?php echo $cac['id']; ?>" class="btn btn-warning">Editar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
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

            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>TOTAL [RENDA]</th>
                        <th>TOTAL [PENDENTE]</th>
                        <th>TOTAL [PAGO]</th>
                        <th>DIFERENÇA DE CAIXA</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $somaRendas; ?></td>
                        <td><?php echo $somaTipo; ?></td>
                        <td><?php echo $somaTipo1; ?></td>
                        <td><?php echo $somaTipo2; ?></td>
                    </tr>
                </tbody>
            </table>
        </fieldset>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
