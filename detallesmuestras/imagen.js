function ampliarImagen() {
    // Obtener los elementos HTML
    var modal = document.getElementById("modal");
    var img = document.getElementById("myImage");
    var modalImg = document.getElementById("img01");
  
    // Mostrar la ventana flotante y establecer la imagen ampliada
    modal.style.display = "block";
    modalImg.src = img.src;
  

    // Centrar la ventana modal en la pantalla
    var modalWidth = modal.offsetWidth;
    var modalHeight = modal.offsetHeight;
    modal.style.marginTop = -modalHeight / 2 + "px";
    modal.style.marginLeft = -modalWidth / 2 + "px";

    // Agregar evento al botón de cerrar
    var span = document.getElementsByClassName("close")[0];
    span.onclick = function() {
      cerrarModal();
    }
  }
  
  function cerrarModal() {
    // Obtener el elemento HTML de la ventana flotante y ocultarlo
    var modal = document.getElementById("modal");
    modal.style.display = "none";
  }
  