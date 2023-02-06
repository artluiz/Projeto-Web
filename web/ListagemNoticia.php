<?php
$basePath = dirname(__FILE__);

require_once($basePath . '/utils/RedirectToLogin.php');
require_once($basePath . '/Cabecalho.php');
require_once($basePath . '/Menu.php');
require_once($basePath . '/../configuracoes/ConexaoBancoDeDados.php');

$sql = 'SELECT n.ID, n.Titulo, n.Fake, u.Nome, u.Email FROM Noticias n JOIN Usuarios u ON u.ID = n.ID_Usuario';

$sth = $dbh->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
$sth->execute();
$lines = $sth->fetchAll(PDO::FETCH_OBJ);
?>

<div class="container">
    <div class="jumbotron mt-2">
        <h1>Listagem de Notícias</h1>
    </div>
    <table class="table table-striped">
    <thead>
        <tr>
        <th scope="col">Ações</th>
        <th scope="col">Id</th>
        <th scope="col">Titulo</th>
        <th scope="col">Notícia</th>
        <th scope="col">Nome Usuário</th>
        <th scope="col">Email Usuário</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($lines as $line): ?>
        <tr>
        <td scope="row"><a href="./FormularioNoticia.php?id=<?= $line->ID ?>" class="btn btn-primary">Editar</a></td>
        <td scope="row"><?= $line->ID ?></td>
        <td scope="row"><?= $line->Titulo ?></td>
        <td scope="row"><?= ($line->Fake == 1)? "Falsa" : "Verdadeira" ?></td>
        <td scope="row"><?= $line->Nome ?></td>
        <td scope="row"><?= $line->Email ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
    </table>
</div>

<?php
require_once($basePath . '/Rodape.php');
?>