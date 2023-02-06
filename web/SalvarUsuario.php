<?php
$basePath = dirname(__FILE__);

require_once($basePath . '/../configuracoes/ConexaoBancoDeDados.php');

$data = [
    'nome' => $_POST['nomeInput'],
    'email' => $_POST['emailInput'],
];

// Insert
if ( !array_key_exists('idInput', $_POST) || (array_key_exists('idInput', $_POST) &&  $_POST['idInput'] == "")) {
    $sql = 'INSERT INTO Usuarios
        (
            Nome, Email, Pontos
        )
        VALUES (
            :nome, :email, 0
        )';
} else { // Update
    $data['id'] = $_POST['idInput'];
    $sql = 'UPDATE Usuarios
        SET Nome = :nome, Email = :email
        WHERE id = :id';
}

$sth = $dbh->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
$sth->execute($data);
$sth = null;

header('Location: ./index.php');
?>