<?php
$basePath = dirname(__FILE__);

require_once($basePath . '/utils/RedirectToLogin.php');
require_once($basePath . '/Cabecalho.php');
require_once($basePath . '/Menu.php');
require_once($basePath . '/../configuracoes/ConexaoBancoDeDados.php');

$sql = 'SELECT ID, Nome, Email, Pontos FROM Usuarios';

$sth = $dbh->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
$sth->execute();
$users = $sth->fetchAll(PDO::FETCH_OBJ);
?>

<div class="container">
    <div class="jumbotron mt-2">
        <h1>Listagem de Usuários</h1>
    </div>
    <table class="table table-striped">
    <thead>
        <tr>
        <th scope="col">Ações</th>
        <th scope="col">Id</th>
        <th scope="col">Nome</th>
        <th scope="col">Email</th>
        <th scope="col">Pontos</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($users as $user): ?>
        <tr>
        <td scope="row"><a href="./FormularioUsuario.php?id=<?= $user->ID ?>" class="btn btn-primary">Editar</a></td>
        <td scope="row"><?= $user->ID ?></td>
        <td scope="row"><?= $user->Nome ?></td>
        <td scope="row"><?= $user->Email ?></td>
        <td scope="row"><?= $user->Pontos ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
    </table>
</div>

<?php
require_once($basePath . '/Rodape.php');
?>