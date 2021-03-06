<?php
session_start();
date_default_timezone_set('America/Sao_Paulo');
require_once "conecta.php";

// if (!empty($_SESSION['id_usuario'])) {
//     $_SESSION['id_usuario'];
// } else {
//     $_SESSION['msg'] = "Você precisa estar logado";
//     header("Location: index.php");
// }
// $idLogado = $_SESSION['id_usuario'];

$id = $_GET['id'];
$sql = "SELECT * FROM `horasalunos` WHERE `id_horas` = $id limit 1";
$horasAlunos = mysqli_query($conexao, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Horas Complementares</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- chamando CSS -->
    <link rel="stylesheet" href="estilo.css">
</head>


<body>
    <div class="topo-header">
        <img class="logo" src="img/logo.png">
        <p class="descricao">Plataforma para validação de atividades complementares</p>
    </div>
    <div class="row">

        <div id="menu" class="menu col-3">
            <nav>
                <div class="link">
                    <a href="paginaAdm.php">Principal</a>
                </div>
                <div class="link active">
                    <a href="acompanhamentoAdm.php">Acompanhamento de solicitações</a>
                </div>
                <div class="link">
                    <a href="relatorios.php">Relatorios</a>
                </div>
                <div class="link">
                    <a href="sistema.php">sistema</a>
                </div>
                <div class="link">
                    <?php echo "<a href='sair.php'>Sair</a>"; ?>
                </div>

            </nav>
        </div>

        <div id="principal" class="principal col-9">
            <h5>Dados da solicitação</h5>

            <?php while ($horas = mysqli_fetch_assoc($horasAlunos)) { ?>
                <div class="card border-secondary mb-3" style="max-width: 30rem;">
                    <div class="card-body text-secondary">
                        <label for="">Código solicitação: <?php echo $horas['id_horas']; ?> </label><br>
                        <label for="">Data de abertura: <?php echo $horas['dataCadastro']; ?></label><br>
                        <label for="">Título solicitação: <?php echo $horas['titulo']; ?></label><br>
                        <label for="">Modalidade: <?php echo $horas['modalidade']; ?></label><br>
                        <label for="">Descrição: <?php echo $horas['descricao']; ?></label><br>
                        <label for="">Arquivo: <?php echo $horas['arquivo']; ?></label>


                    </div>
                </div>
            <?php } ?>

            <h5>Gerencie abaixo a solicitação:</h5>

            <form method="POST" action="reconsidera.php?id=<?php echo $id; ?>">

                <div class="form-group">
                    <select style="width: 480px;" name="status" class="custom-select">
                        <option selected>Selecione...</option>
                        <option value="aprovado">Aprovar</option>
                        <option value="revisao">Revisar</option>
                        <option value="reprovado">Reprovar</option>
                    </select>
                </div>

                <div style="width: 480px;" class="form-group">
                    <textarea placeholder="Se necessário, adicione uma descrição" name="descricao" class="form-control" id="descricao" rows="3"></textarea>
                </div>

                <div class="btn-group">
                    <button style="width:150px;" type="submit" class="btn btn-primary">Enviar</button>

                </div>
            </form>
        </div>
        <footer>
            <p>
                Federação das Indústrias do Estado de Santa Catarina <br>
                Departamento Regional - Fone: 48 3231 4100 <br>
                Rod. Admar Gonzaga, 2765 - Florianópolis/SC - 88034-001
            </p>

        </footer>
</body>

</html>