<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="principal.php">Principal</a>   
    <a class="navbar-brand" href="clima.php">Clima</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDarkDropdown" aria-controls="navbarNavDarkDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
      <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Insertar Medición
          </a>
          <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
          <li><a class="dropdown-item" href="insertarArtificial.php">Muestra Artificial</a></li>
          <li><a class="dropdown-item" href="insertarVino.php">Muestra Vino</a></li>
          <li><a class="dropdown-item" href="insertarMosto.php">Muestra Mosto</a></li>
          <li><a class="dropdown-item" href="insertarUva.php">Muestra Uva</a></li>
          </ul>
        </li>
      </ul>   
      <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Ver registros
          </a>
          <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
          <li><a class="dropdown-item" href="registrosArtificiales.php">Muestra Artificial</a></li>
          <li><a class="dropdown-item" href="registrosVino.php">Muestra Vino</a></li>
          <li><a class="dropdown-item" href="registrosMosto.php">Muestra Mosto</a></li>
          <li><a class="dropdown-item" href="registrosUva.php">Muestra Uva</a></li>
          </ul>
        </li>
      </ul>
      <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Perfil
          </a>
          <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
          <li><a class="dropdown-item" href="../login/logout.php">Cerrar Sesion</a></li>
          </ul>
        </li>
      </ul>   
    </div>
  </div>
</nav>