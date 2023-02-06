<?php
session_start();
$basePath = dirname(__FILE__);

require_once($basePath . '/../configuracoes/ConexaoBancoDeDados.php');

$bannerDirectory = '/imagensEnviadas';
$uploadBannerPath = $basePath . $bannerDirectory;

$data = [
    'titulo' => $_POST['tituloInput'],
    'texto' => $_POST['textoInput']
];

// Insert
if ( !array_key_exists('idInput', $_POST) || (array_key_exists('idInput', $_POST) &&  $_POST['idInput'] == "")) {
    $data['id_usuario'] = $_SESSION['ID'];
    $sql = 'INSERT INTO Noticias
        (
            Titulo, Texto, Imagem, ID_Usuario, Fake
        )
        VALUES (
            :titulo, :texto, :imagem, :id_usuario, :fake
        )';
} else { // Update
    $data['id'] = $_POST['idInput'];
    $sql = 'UPDATE Noticias
        SET Titulo = :titulo, Texto = :texto, Fake = :fake';
    $sql .= ($_FILES['imagemInput']['size'] == 0)? '' : ', Imagem = :imagem';
    $sql .= ' WHERE id = :id';
}

if (($_FILES['imagemInput']['size'] != 0)) {
    $fileNewName = date("Y-m-d_H-i-s_")
        . basename($_FILES['imagemInput']['tmp_name'])
        . '_'
        . basename($_FILES['imagemInput']['name']);
    $uploadFilePath = $uploadBannerPath
        . '/'
        . $fileNewName;
    if (!move_uploaded_file($_FILES['imagemInput']['tmp_name'], $uploadFilePath)) {
        echo 'Erro ao enviar a imagem!';
        die();
    }

    $data['imagem'] = $bannerDirectory . '/' . $fileNewName;
}

$sth = $dbh->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

print_r($sql);

if (array_key_exists('fakeNewsInput', $_POST)) {
    $data['fake'] = 1;
} else {
    $data['fake'] = 0;
}

print_r($data);
$sth->execute($data);
$sth = null;

header('Location: ./index.php');
?>