<?php
    
    require_once('db-config.php');
    
    try {
        $statement = $connection->prepare("SELECT * FROM producto ORDER BY id_producto");
        $statement->execute();
        $products = $statement->fetchAll();
    
    } catch (PDOException $exception) {
        echo "Connection failed: " . $exception->getMessage();
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Análisis de Vino</title>
  <style>
   body {
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;      
    }

    .background {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: #000;
  z-index: -1;
  overflow: hidden;
}
.particles {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-image: url('img/vino1.jpg'); /* Reemplaza 'particle.png' con la ruta de tu imagen */
  background-repeat: no-repeat;
  background-size: cover;
  animation: particles 20s infinite;
  opacity: 0.6;
}

@keyframes particles {
  0% {
    background-position: 0 0;
  }
  100% {
    background-position: 100% 100%;
  }
}

.content {
    display: flex;
    justify-content: center;
      align-items: center;
  
  transform: translate(-50%, -50%);
  text-align: center;
  color: #fff;
  font-family: Arial, sans-serif;
  z-index: 1;
}

h1 {
  font-size: 48px;
  margin-bottom: 10px;
}

p {
  font-size: 20px;
}


   

    .container {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }    
    .cardd {
  width: 200px;
  height: 300px;
  background: linear-gradient(to bottom right, #8B0000, #000000);
  position: relative;
  perspective: 1000px;
  display: inline-block;
  margin: 10px;
}

.cardd:hover {
  transform: rotateY(10deg) rotateX(10deg);
  box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
  transition: transform 0.5s, box-shadow 0.5s;
}

.cardd::before {
  content: "";
  position: absolute;
  bottom: 0;
  right: 0;
  width: 100%;
  height: 100%;
  background: linear-gradient(to top left, rgba(255, 255, 255, 0.4), transparent);
  transform: rotateX(30deg) translate(0, 100%);
  z-index: -1;
  transition: transform 0.5s;
}

.cardd:hover::before {
  transform: rotateX(30deg) translate(0, 0);
}

h2, p {
  color: #fff;
  text-align: center;
}

.buttonn-container {
  position: absolute;
  bottom: 0;
  width: 100%;
  text-align: center;
  margin-top: 20px;
}

.buttonn {
  background-color: #fff;
  color: #8B0000;
  padding: 10px 20px;
  border: none;
  cursor: pointer;
}
.buttonn:hover {
  border: 2px solid #8B0000;
  opacity: 0.8;
  transition: border-color 0.3s, opacity 0.3s;
}

.buttonn:active {
  background-color: #8B0000;
  color: #fff;
  box-shadow: 0 0 10px #8B0000;
  transition: background-color 0.3s, color 0.3s, box-shadow 0.3s;
}

  </style>
</head>
<body>
    <div class="container">
    <?php foreach ($products as $product): ?>
    <div class="cardd">
        <h2><?php echo $product['codigo']; ?></h2>
        <p><?php echo $product['nombre']; ?></p>
        <p><?php echo $product['marca']; ?></p>
        <p><?php echo $product['orden']; ?></p>
        <div class="buttonn-container">
            <button class="buttonn" onclick="window.location.href='detalles.php?product-id=<?php echo $product['id_producto']; ?>'">Análisis</button>
        </div>
    </div>
    <?php endforeach; ?>
    </div>
  <div class="background">
  <div class="particles"></div>
  <div class="container">
    
  </div>
</body>
</html>

