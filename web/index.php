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
    $limite = 10;
}

$offset = intval(($pagina - 1) * $limite);

$mainSql = 'SELECT n.ID,
            n.Titulo,
            n.Texto,
            n.Imagem,
            n.Fake,
            u.Nome,
            u.Email,
            u.Rank
        FROM Noticias n
        JOIN (
            SELECT ROW_NUMBER() OVER (ORDER BY Pontos DESC) AS Rank,
                ID, 
                Nome, 
                Email, 
                Pontos 
            FROM Usuarios 
            ORDER BY Pontos DESC
        ) u ON u.ID = n.ID_Usuario
        ORDER BY n.ID DESC
        LIMIT :limite
        OFFSET :offset';

$countSql = 'SELECT COUNT(*) FROM Noticias n JOIN Usuarios u ON u.ID = n.ID_Usuario';

$sth = $dbh->prepare($countSql);
$sth->execute();
$qtdLinhas = intval($sth->fetchColumn());

$sth = $dbh->prepare($mainSql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
$sth->bindParam(':limite', $limite, PDO::PARAM_INT);
$sth->bindParam(':offset', $offset, PDO::PARAM_INT);
$sth->execute();
$lines = $sth->fetchAll(PDO::FETCH_OBJ);
?>
<div class="container">
    <div class="btn-toolbar justify-content-between mt-3" role="toolbar" aria-label="Toolbar with button groups">
        <div class="btn-group" role="group">
            <a href="./index.php?pagina=1" class="btn btn-secondary">Início</a>
            <a href="./index.php?pagina=<?= (($pagina - 1) < 1)? 1 : $pagina - 1 ?>" class="btn btn-secondary">Anterior</a>
        </div>
        <div class="btn-group" role="group">
            <button type="button" class="btn btn-secondary" disabled><?= $pagina ?></button>
        </div>
        <div class="btn-group" role="group">
        <a href="./index.php?pagina=<?= ($pagina + 1 > ceil($qtdLinhas / $limite))? $pagina : $pagina + 1 ?>" class="btn btn-secondary">Próximo</a>
            <a href="./index.php?pagina=<?= ceil($qtdLinhas / $limite) ?>" class="btn btn-secondary">Final</a>
        </div>
    </div>
    <?php foreach($lines as $line): ?>
    <div class="row mt-2 border shadow bg-white">
        <div class="card-header border-0 col-2">
            <img src="./<?= $line->Imagem ?>" style="max-width: 150px" alt="">
        </div>
        <div class="card-block px-2 col-10">
            <h4 class="card-title my-2"><?= $line->Titulo ?></h4>
            <p class="card-text mb-2"><?= (strlen($line->Texto) > 400)? substr($line->Texto, 0, 400) . ' [...]' : $line->Texto ?></p>
            <p class="card-text mb-2">Autor: <?= $line->Nome ?> (#<?= $line->Rank ?>)</p>
            <a href="./DetalheNoticia.php?id=<?= $line->ID ?>" class="btn btn-primary mb-2">Ver mais...</a>
        </div>
        <div class="w-100"></div>
    </div>
    <?php endforeach; ?>
    <div class="btn-toolbar justify-content-between mt-3" role="toolbar" aria-label="Toolbar with button groups">
        <div class="btn-group" role="group">
            <a href="./index.php?pagina=1" class="btn btn-secondary">Início</a>
            <a href="./index.php?pagina=<?= (($pagina - 1) < 1)? 1 : $pagina - 1 ?>" class="btn btn-secondary">Anterior</a>
        </div>
        <div class="btn-group" role="group">
            <button type="button" class="btn btn-secondary" disabled><?= $pagina ?></button>
        </div>
        <div class="btn-group" role="group">
        <a href="./index.php?pagina=<?= ($pagina + 1 > ceil($qtdLinhas / $limite))? $pagina : $pagina + 1 ?>" class="btn btn-secondary">Próximo</a>
            <a href="./index.php?pagina=<?= ceil($qtdLinhas / $limite) ?>" class="btn btn-secondary">Final</a>
        </div>
    </div>
</div>
<?php
require_once($basePath . '/Rodape.php');
?>