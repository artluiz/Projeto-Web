<?php
$basePath = dirname(__FILE__);

require_once($basePath . '/utils/RedirectToLogin.php');
require_once($basePath . '/../configuracoes/ConexaoBancoDeDados.php');
require_once($basePath . '/Cabecalho.php');
require_once($basePath . '/Menu.php');

$update = array_key_exists('id', $_GET);

if ($update) {
    $sql = 'SELECT ID, Titulo, Texto, Imagem, Fake FROM Noticias WHERE ID = ?';
    $stm = $dbh->prepare($sql);
    $stm->bindValue(1, intval($_GET['id']));
    $stm->execute();
    $news = $stm->fetch(PDO::FETCH_OBJ);
}
?>

<div class="container">
    <div class="jumbotron mt-2">
        <h1><?= ($update) ? "Atualização" : "Cadastro"?> de Notícias</h1>
    </div>
    <form class="row" action="./SalvarNoticia.php" method="post" enctype="multipart/form-data">
        <div class="form-group mt-3 col-12">
            <label for="tituloInput">Título: *</label>
            <input name="tituloInput" type="text" class="form-control" id="tituloInput" placeholder="Título" maxlength="255" value="<?=($update) ? $news->Titulo : "" ?>" required>
        </div>
        <div class="form-group mt-3 col-12">
            <label for="textoInput">Texto: *</label>
            <textarea name="textoInput" class="form-control" id="textoInput" placeholder="Texto" rows="5" maxlength="3000" required><?=($update) ? $news->Texto : "" ?></textarea>
        </div>
        <div class="form-group mt-3 col-12">
            <label for="imagemInput">Imagem: *</label>
            <input name="imagemInput" type="file" class="form-control" id="imagemInput" placeholder="Imagem" <?= ($update)? "" : "required" ?>>
        </div>
        <div class="form-group mt-3 col-4">
            <input type="checkbox" class="form-check-input" id="fakeNewsInput" name="fakeNewsInput" <?= ($news->Fake)? "checked" : "" ?>>
            <label class="form-check-label" for="fakeNewsInput">Fake News</label>
        </div>
        <input name="idInput" type="text" class="form-control" id="idInput" value="<?=($update) ? $news->ID : "" ?>" hidden>
        <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
        <button type="submit" class="mt-3 btn btn-primary"><?= ($update) ? "Atualizar" : "Cadastrar"?></button>
    </form>
</div>

<?php
require_once($basePath . '/Rodape.php');
?>