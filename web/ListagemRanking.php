<?php
$basePath = dirname(__FILE__);

require_once($basePath . '/utils/RedirectToLogin.php');
require_once($basePath . '/Cabecalho.php');
require_once($basePath . '/Menu.php');
require_once($basePath . '/../configuracoes/ConexaoBancoDeDados.php');

$sql = 'SELECT ID, Nome, Email, Pontos FROM Usuarios ORDER BY Pontos DESC';

$sth = $dbh->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
$sth->execute();
$users = $sth->fetchAll(PDO::FETCH_OBJ);
?>

<div class="container">
    <div class="jumbotron mt-2">
        <h1>Listagem de Ranking</h1>
    </div>
    <table class="table table-striped">
    <thead>
        <tr>
        <th scope="col">Rank</th>    
        <th scope="col">Id</th>
        <th scope="col">Nome</th>
        <th scope="col">Email</th>
        <th scope="col">Pontos</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $rank = 0;
        foreach($users as $user):
            $rank++;
        ?>
        <tr>
        <th scope="row"><?= $rank ?></th>
        <th scope="row"><?= $user->ID ?></th>
        <td><?= $user->Nome ?></td>
        <td><?= $user->Email ?></td>
        <td><?= $user->Pontos ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
    </table>
</div>

<?php
require_once($basePath . '/Rodape.php');
?>