<?php
$basePath = dirname(__FILE__);

require_once($basePath . '/../configuracoes/ConexaoBancoDeDados.php');

if (array_key_exists('id', $_GET) && !empty($_GET['id'])) {
    $id = intval($_GET['id']);
} else {
    echo 'Campo "id" é obrigatório';
    die();
}

if (array_key_exists('operacao', $_GET) && !empty($_GET['operacao'])) {
    $operacao = $_GET['operacao'];
} else {
    echo 'Campo "operacao" é obrigatório';
    die();
}

switch($operacao) {
    case "positivo":
        $pontos = 1;
        break;
    case "negativo":
        $pontos = -2;
        break;
    case "fake":
        $pontos = -4;
        break;
    default:
        $pontos = 0;
        break;
}

$sql = 'UPDATE Usuarios
        SET Pontos = (SELECT COALESCE(Pontos, 0) FROM Usuarios WHERE ID = (SELECT ID_Usuario FROM Noticias WHERE ID = :id)) + :pontos
        WHERE ID = (SELECT ID_Usuario FROM Noticias WHERE ID = :id)';

$sth = $dbh->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
$sth->execute([
    'id' => $id,
    'pontos' => $pontos,
]);

if ($operacao == 'fake') {
    $sql = 'UPDATE Noticias
    SET Fake = 1
    WHERE ID = :id';

    $sth = $dbh->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
    $sth->execute([
        'id' => $id,
    ]);
}

$sth = null;

header('Location: ./index.php');
?>