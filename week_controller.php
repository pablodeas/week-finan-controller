<?php
date_default_timezone_set('America/Sao_Paulo')
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <title>Controle Financeiro Semanal</title>
</head>

<body>
    <!--Título da Página-->
    <div class="d-flex justify-content-center h4">Controle Semanal &#9749;</div>
    <br>

    <!--Variáveis de data atual e próximo domingo-->
    <?php
    $proximo_domingo = strtotime('next Sunday');
    $date = date('d-m-Y', $proximo_domingo);
    ?>

    <!--Texto básico-->
    <p class="d-flex justify-content-center">Hoje é o dia:</p>
    <p class="d-flex justify-content-center"><strong><?php echo date('d-m-Y'); ?></strong> </p>
    <p class="d-flex justify-content-center">A semana se encerrá no dia:</p>
    <p class="d-flex justify-content-center"><strong><?php echo $date; ?></strong> </p>

    <!--Formulário que recebe o valor gasto no dia-->
    <form action="/week_controller.php" method="post">
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label d-flex justify-content-center">Digite o gasto:</label>
            <input type="number" class="form-control" id="exampleInputNumber1" name="value">
        </div>
    </form>

    <!--Parte do cálculo-->
    <div class="d-flex justify-content-center">Você gastou até o momento:</div>
    <div class="d-flex justify-content-center">
        <?php
        session_start();

        if (!isset($_SESSION['total'])) {
            $_SESSION['total'];
        }

        if (isset($_POST['value'])) {
            $_SESSION['total'] += $_POST['value'];
        }

        if ($_SESSION['total'] >= 120) {
            $_SESSION['total'] = 0;
        }
        
        echo "R$" . $_SESSION['total']; 
        ?>
    </div>
    <div class="d-flex justify-content-center">Ainda tem disponível:</div>
    <div class="d-flex justify-content-center">
        <?php
        $limite = 120;
        $disponível = $limite - $_SESSION['total'];
        
        echo "R$" . $disponível;
        ?>
    </div>
</body>

</html>