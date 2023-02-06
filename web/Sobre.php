<?php
$basePath = dirname(__FILE__);

require_once($basePath . '/utils/RedirectToLogin.php');
require_once($basePath . '/Cabecalho.php');
require_once($basePath . '/Menu.php');
?>

<div class="container">
    <div class="jumbotron mt-2">
        <h1>Sobre</h1>
        <p>Trabalho de "NOME DA MATERIA" criando uma rede social feito pelos seguintes alunos:</p>
    </div>
    <table class="table table-striped">
    <thead>
        <tr>
        <th scope="col">Matrícula</th>    
        <th scope="col">Nome</th>
        <th scope="col">Email</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th scope="row">Matricula1</th>
            <th scope="row">Nome1</th>
            <th scope="row">Email1</th>
        </tr>
        <tr>
            <th scope="row">Matricula2</th>
            <th scope="row">Nome2</th>
            <th scope="row">Email2</th>
        </tr>
        <tr>
            <th scope="row">Matricula3</th>
            <th scope="row">Nome3</th>
            <th scope="row">Email3</th>
        </tr>
    </tbody>
    </table>
</div>

<?php
require_once($basePath . '/Rodape.php');
?>