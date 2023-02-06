<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="./index.php">Rede Social</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="./index.php">Principal</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="./Sobre.php">Sobre</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="./Ranking.php">Ranking</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="dropDownUsuarios" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Usuários
          </a>
          <ul class="dropdown-menu" aria-labelledby="dropDownUsuarios">
            <li><a class="dropdown-item" href="./FormularioUsuario.php">Cadastro de Usuários</a></li>
            <li><a class="dropdown-item" href="./ListagemUsuario.php">Listagem de Usuários</a></li>
            <li><a class="dropdown-item" href="./ListagemRanking.php">Listagem de Ranking</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="dropDownNoticias" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Notícias
          </a>
          <ul class="dropdown-menu" aria-labelledby="dropDownNoticias">
            <li><a class="dropdown-item" href="./FormularioNoticia.php">Cadastro de Notícias</a></li>
            <li><a class="dropdown-item" href="./ListagemNoticia.php">Listagem de Notícias</a></li>
            <li><a class="dropdown-item" href="./ListagemNoticiaFake.php">Listagem de Fake News</a></li>
          </ul>
        </li>
      </ul>
    </div>
    <ul class="navbar-nav">
        <li class="nav-item d-flex flex-row-reverse">
            <a class="nav-link active" aria-current="page" href="./Logout.php">Logout</a>
        </li>
    </ul>
  </div>
</nav>