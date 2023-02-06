<?php
$basePath = dirname(__FILE__);

require_once($basePath . '/utils/RedirectToLogin.php');
require_once($basePath . '/Cabecalho.php');
require_once($basePath . '/Menu.php');
require_once($basePath . '/../configuracoes/ConexaoBancoDeDados.php');

if (array_key_exists('pagina', $_GET) && !empty($_GET['pagina'])) {
    $pagina = intval($_GET['pagina']);
} else {
    $pagina = 1;
}

if (array_key_exists('limite', $_GET) && !empty($_GET['limite'])) {
    $limite = intval($_GET['limite']);
} else {
    $limite = 30;
}

$offset = intval(($pagina - 1) * $limite);

$mainSql = 'SELECT ROW_NUMBER() OVER (ORDER BY Pontos DESC) AS Rank,
                ID, 
                Nome, 
                Email, 
                Pontos 
            FROM Usuarios 
            ORDER BY Pontos DESC
            LIMIT :limite
            OFFSET :offset';

$countSql = 'SELECT COUNT(*) FROM Usuarios';

$sth = $dbh->prepare($countSql);
$sth->execute();
$qtdLinhas = intval($sth->fetchColumn());

$sth = $dbh->prepare($mainSql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
$sth->bindParam(':limite', $limite, PDO::PARAM_INT);
$sth->bindParam(':offset', $offset, PDO::PARAM_INT);
$sth->execute();
$users = $sth->fetchAll(PDO::FETCH_OBJ);
?>

<div class="container">
    <div class="jumbotron mt-2">
        <h1>Ranking</h1>
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
        <?php foreach($users as $user): ?>
        <tr>
        <td scope="row"><?= $user->Rank ?></td>
        <td scope="row"><?= $user->ID ?></td>
        <td scope="row"><?= $user->Nome ?></td>
        <td scope="row"><?= $user->Email ?></td>
        <td scope="row"><?= $user->Pontos ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
    </table>
    <div class="btn-toolbar justify-content-between mt-3" role="toolbar" aria-label="Toolbar with button groups">
        <div class="btn-group" role="group">
            <a href="./Ranking.php?pagina=1" class="btn btn-secondary">Início</a>
            <a href="./Ranking.php?pagina=<?= (($pagina - 1) < 1)? 1 : $pagina - 1 ?>" class="btn btn-secondary">Anterior</a>
        </div>
        <div class="btn-group" role="group">
            <button type="button" class="btn btn-secondary" disabled><?= $pagina ?></button>
        </div>
        <div class="btn-group" role="group">
        <a href="./Ranking.php?pagina=<?= ($pagina + 1 > ceil($qtdLinhas / $limite))? $pagina : $pagina + 1 ?>" class="btn btn-secondary">Próximo</a>
            <a href="./Ranking.php?pagina=<?= ceil($qtdLinhas / $limite) ?>" class="btn btn-secondary">Final</a>
        </div>
    </div>
</div>

<?php
require_once($basePath . '/Rodape.php');
?>