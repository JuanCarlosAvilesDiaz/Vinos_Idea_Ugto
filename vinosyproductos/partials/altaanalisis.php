<?php
require_once('../detallesmuestras/db-config.php');

try {
    $statement = $connection->prepare("SELECT * FROM categoria_evaluacion ORDER BY id_categoria_evaluacion");
    $statement->execute();
    
    $categorias = $statement->fetchAll();  

} catch (PDOException $exception) {
    echo "Connection failed: " . $exception->getMessage();
}

?>
<link rel="shortcut icon" href="../main/images/LogoUgto.png" type="image/x-icon">
<link rel="icon" href="../main/images/LogoUgto.png" type="image/x-icon">
<meta charset="UTF-8">
<style>
    body {
  margin: 0;
  height: 100%;
  background: linear-gradient(to bottom left, #ffffff 15%, #cce3ff 90%);
}
    .container {
  position:static;
  max-width: 500px;
  width: 100%;
  background: #8a6d3b;
  padding: 25px;
  border-radius: 8px;
  box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
  margin: auto;
  margin-top: 5%;
}

.container header {
  font-size: 1.2rem;
  color: #000;
  font-weight: 600;
  text-align: center;
}

.container .form {
  margin-top: 15px;
}

.form .input-box {
  width: 100%;
  margin-top: 10px;
}

.input-box label {
  color: #000;
}

.form :where(.input-box input, .select-box) {
  position: relative;
  height: 35px;
  width: 100%;
  outline: none;
  font-size: 1rem;
  color: #808080;
  margin-top: 5px;
  border: 1px solid #0d3158;
  border-radius: 6px;
  padding: 0 15px;
  background: #FCEDDA;
}

.input-box input:focus {
  box-shadow: 0 1px 0 rgba(0, 0, 0, 0.1);
}

.form .column {
  display: flex;
  column-gap: 15px;
}

.form .gender-box {
  margin-top: 10px;
}

.form :where(.gender-option, .gender) {
  display: flex;
  align-items: center;
  column-gap: 50px;
  flex-wrap: wrap;
}

.form .gender {
  column-gap: 5px;
}

.gender input {
  accent-color: #0d3158;
}

.form :where(.gender input, .gender label) {
  cursor: pointer;
}

.gender label {
  color: #000;
}

.address :where(input, .select-box) {
  margin-top: 10px;
}

.select-box select {
  height: 100%;
  width: 100%;
  outline: none;
  border: none;
  color: #808080;
  font-size: 1rem;
  background: #FCEDDA;
}

.form button {
  height: 40px;
  width: 100%;
  color: #ffffff;
  font-size: 1rem;
  font-weight: 400;
  margin-top: 15px;
  border: none;
  border-radius: 6px;
  cursor: pointer;
  transition: all 0.2s ease;
  background: #0d3158;
}

.form button:hover {
  background: #4fa4fe;
  color: #000a3e;
}

.btnSalir {
   position: absolute;
    margin-left: 15%;
  font-size: 1.2rem;
  text-decoration: none;
  padding: 1rem 2.5rem;
  border: none;
  outline: none;
  border-radius: 0.4rem;
  cursor: pointer;
  text-transform: uppercase;
  background-color: rgb(14, 14, 26);
  color: rgb(234, 234, 234);
  font-weight: 700;
  transition: 0.6s;
  box-shadow: 0px 0px 60px #1f4c65;
  -webkit-box-reflect: below 10px linear-gradient(to bottom, rgba(0,0,0,0.0), rgba(0,0,0,0.4));
}

.btnSalir:active {
  scale: 0.92;
}

.btnSalir:hover {
  background: rgb(2,29,78);
  background: linear-gradient(270deg, rgba(2, 29, 78, 0.681) 0%, rgba(31, 215, 232, 0.873) 60%);
  color: rgb(4, 4, 38);
}
</style>
<a href="/vinosyproductos/main/" class="btnSalir">
    REGRESAR
</a>

<section class="container">
  <header>REGISTRO ANÁLISIS</header>
  <form class="form" action="guardaranalisis.php" method="POST">
      <div class="input-box">
          <label>Nombre del análisis</label>
          <input required="" placeholder="Enter full name" type="text" name="nombre">
      </div>
      <div class="column">
          <div class="input-box">
            <label>Fecha en que se realizará la evaluación</label>
            <input required="" placeholder="Enter birth date" type="date" name="fecha">
          </div>
      </div>
      <div class="input-box address">
        <label>Categorias disponibles</label>
        <div class="column">
          <div class="select-box">
            <select name="category">
              <option hidden="">Categoria</option>
              <?php foreach ($categorias as $categoria): ?>
              <option value=<?php echo $categoria['id_categoria_evaluacion']; ?>><?php echo $categoria['nombre']; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>
      </div>
      <button>GUARDAR</button>
  </form>
</section>