<?php include 'header.php'?>
<?php include 'conexion.php'?>

<?php 
    $objetoConexion= new conexion();
    $vistaproyecto = $objetoConexion->consultar("SELECT * FROM proyectos");

?>

<body>
    <div class="container">
        <div class="p-5 bg-light">
            <h1 class="display-3">Bienvenidos</h1>
            <p class="lead">Este es un portafolio</p>
            <hr class="my-2">
            <p>Mas informacion</p> 
        </div>
    
        <br/>
    
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php foreach($vistaproyecto as $vista){?>
                <div class="col">
                    <div class="card h-100">
                        <img src="imagenes/<?php echo $vista['imagen']?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $vista['nombre']?></h5>
                            <p class="card-text"><?php echo $vista['descripcion']?></p>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted"><?php echo "Fecha: ".$vista['fecha']?></small>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

  
</body>

<?php include 'footer.php'?>

</html>