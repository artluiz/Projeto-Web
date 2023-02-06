<?php
$basePath = dirname(__FILE__);

require_once($basePath . '/utils/RedirectToLogin.php');
require_once($basePath . '/Cabecalho.php');
require_once($basePath . '/../configuracoes/ConexaoBancoDeDados.php');
require_once($basePath . '/Menu.php');

if (array_key_exists('id', $_GET) && !empty($_GET['id'])) {
    $id = intval($_GET['id']);
} else {
    echo 'ID é obrigatório';
    die();
}

$sql = 'SELECT n.ID,
            n.Titulo,
            n.Texto,
            n.Imagem,
            n.Fake
        FROM Noticias n
        WHERE n.ID = :id';

$sth = $dbh->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
$sth->bindParam(':id', $id, PDO::PARAM_INT);
$sth->execute();
$noticia = $sth->fetch(PDO::FETCH_OBJ);
$sth = null;
?>
<div class="container">
    <div class="jumbotron mt-2">
        <h1><?= $noticia->Titulo ?></h1>
    </div>
    <a href="./Pontuar.php?id=<?= $id ?>&operacao=positivo" class="btn btn-block btn-success"><i class="bi bi-hand-thumbs-up-fill"></i> Positivo</a>
    <a href="./Pontuar.php?id=<?= $id ?>&operacao=negativo" class="btn btn-block btn-danger"><i class="bi bi-hand-thumbs-down-fill"></i> Negativo</a>
    <a href="./Pontuar.php?id=<?= $id ?>&operacao=fake" class="btn btn-block btn-warning"><i class="bi bi-exclamation-diamond-fill"></i> Fake</a>
    <img class="card-img-top mt-3" src=".<?= $noticia->Imagem ?>" alt="Imagem da notícia">
    <p><?= $noticia->Texto ?></p>
</div>
<?php
require_once($basePath . '/Rodape.php');
?>