<?php
$basePath = dirname(dirname(__FILE__));

require_once($basePath . '/configuracoes/ConexaoBancoDeDados.php');
session_start();
 
$email = (isset($_POST['email'])) ? $_POST['email'] : '';
 
if (!empty($email)) {
	$sql = 'SELECT ID, Nome, Email FROM Usuarios WHERE email = ?';
	$stm = $dbh->prepare($sql);
	$stm->bindValue(1, $email);
	$stm->execute();
	$dados = $stm->fetch(PDO::FETCH_OBJ);

	if(!empty($dados)) {
		$_SESSION['ID'] = $dados->ID;
		$_SESSION['Nome'] = $dados->Nome;
		$_SESSION['Email'] = $dados->Email;
		$_SESSION['logado'] = TRUE;
        header('Location: ./index.php');
	} else {
		$_SESSION['logado'] = FALSE;
        header("Location: ./LoginPage.php");
	}
}
?>