<?php
$basePath = dirname(__FILE__);

require_once($basePath . '/utils/RedirectToLogin.php');
require_once($basePath . '/Cabecalho.php');
require_once($basePath . '/Menu.php');

$update = array_key_exists('id', $_GET);

if ($update) {
    require_once($basePath . '/../configuracoes/ConexaoBancoDeDados.php');
    $sql = 'SELECT ID, Nome, Email, Pontos FROM Usuarios WHERE ID = ?';
    $stm = $dbh->prepare($sql);
    $stm->bindValue(1, intval($_GET['id']));
    $stm->execute();
    $user = $stm->fetch(PDO::FETCH_OBJ);
}
?>

<div class="container">
    <div class="jumbotron mt-2">
        <h1><?= ($update) ? "Atualização" : "Cadastro"?> de Usuários</h1>
    </div>
    <form class="row" action="./SalvarUsuario.php" method="post">
        <div class="form-group mt-3 col-12">
            <label for="nomeInput">Nome: *</label>
            <input name="nomeInput" type="text" class="form-control" id="nomeInput" placeholder="Nome" maxlength="64" value="<?=($update) ? $user->Nome : "" ?>" required>
        </div>
        <div class="form-group mt-3 col-12">
            <label for="emailInput">Email: *</label>
            <input name="emailInput" type="email" class="form-control" id="emailInput" placeholder="Email" value="<?=($update) ? $user->Email : "" ?>" required>
        </div>
        <input name="idInput" type="text" class="form-control" id="idInput" value="<?=($update) ? $user->ID : "" ?>" hidden>
        <button type="submit" class="mt-3 btn btn-primary"><?= ($update) ? "Atualizar" : "Cadastrar"?></button>
    </form>
</div>

<?php
require_once($basePath . '/Rodape.php');
?>