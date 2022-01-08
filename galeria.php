<?php include 'header.php';?>
<?php include 'conexion.php';?>
<?php 
    
    if($_POST){
        //print_r($_POST);
        //toca  verificar si el $_post esta vacio o no :V isset
        $nombre=(isset($_POST['nombre']))?$_POST['nombre']:""; 
        (isset($_POST['nombre']))?$_POST['nombre']:"";
        $descripcion=$_POST['descripcion'];
        $fecha=$_POST['fecha'];
        $hora=$_POST['hora'];

        //subir imagen
        //Para evitar que las imagenes no sean iguales la concatetaremos
        //con el tiempo 
        $fecha_imagen= new DateTime();
        $imagen=$fecha_imagen->getTimestamp()."_".$_FILES['archivo']['name'];
        $imagen_temporal=$_FILES['archivo']['tmp_name'];
        move_uploaded_file($imagen_temporal,"imagenes/".$imagen);

        //$id=$objConexion->ejecutar($sql); ->odbtener la id y relacionar info

        $objConexion=new conexion();
        $sql="INSERT INTO `proyectos`(
            id, nombre, imagen, descripcion, fecha)
        VALUES ('','$nombre','$imagen','$descripcion','$fecha.$hora');";
     
        $objConexion->ejecutar($sql);
        
        //para que una vez ejecutada la consulta refrescar la pagina
        // y no queden atributos en el link
        header("location:galeria.php");


    }

    if($_GET){
        //dado que vamos a eliminar el registro  de la bd tambien tenemos que eliminar
        //la imagen que se encuentra en la ruta del proyecto
        $id=$_GET['borrar'];
        $objConexion=new conexion();
        // consultar en imagen 
        $imagen_borrada=$objConexion->consultar("SELECT imagen FROM proyectos WHERE id=$id");
        //print_r($imagen_borrada);
        //print_r($imagen_borrada[0]['imagen']);

        //unlink ->funcion para borrar la imagen dentro del proyecto
        //pero dado que esta en una carpeta hay que poner la ruta

        unlink("imagenes/".$imagen_borrada[0]['imagen']);

        //Una vez borrada la imagen del proyecto se borra el registro en la base de datos
        //$sql="DELETE FROM proyectos WHERE `proyectos`.`id`=".$id;
        $sql="DELETE FROM proyectos WHERE proyectos.id=$id";
        $objConexion->ejecutar($sql);

        header("location:galeria.php");
    }
    
    $objConexion=new conexion();
    $proyectos=$objConexion->consultar("SELECT * FROM proyectos");
    //print_r($resultado);

  

    
?>

<br/>
<div class="container">
    <!-- bs5-grid default--> 
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <!-- bs5-card hader -footer--> 
                <div class="card">
                    <div class="card-header">
                        Datos del proyecto
                    </div>
                    <div class="card-body">

                        <!-- SI queremos que el usuario por obligacion ingrese un dato
                        usabamos required pero esta se puede alteral desde el impecionar codigo
                        asi que tenemos que hacerlo por el  backend evitar inserciones en la base de datos-->
                        <form action="galeria.php" method="post" enctype="multipart/form-data" id="datos_formulario">

                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre:</label>
                                <input type="text" class="form-control" id="nombre" required>
                            </div>

                            <div class="mb-3">
                                <label for="archivo">Imagen del proyecto:</label>
                                <input class="form-control" type="file" name="archivo" id="archivo" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="descripcion">Descripcion:</label>
                                <textarea class="form-control" name="descripcion" id="descripcion" cols="30" rows="3" required></textarea>
                            </div>

                            <div class="mb-3 row">
                                <div class="col">
                                    <input type="date" class="form-control"  name="fecha" aria-label="fecha" required>
                                </div>
                                <div class="col">
                                    <!--- step="1" es para mostrar los segundos pero a la hora de valdar se petea-->
                                    <input type="time" class="form-control"  name="hora" aria-label="hora" required>
                                </div>
                            </div>

                            <div class="col-12">
                                <button class="btn btn-success" type="submit">enviar</button>
                            </div>
                
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <!-- bs5- table default--> 
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Imagen</th>
                            <th>Descripcion</th>
                            <th>Fecha</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($proyectos as $nproyecto){ ?>
                            <tr>
                                <td><?php echo $nproyecto['id'];?></td>
                                <td><?php echo $nproyecto['nombre'];?></td>
                                <td>
                                    <img width="100" src="imagenes/<?php echo $nproyecto['imagen']?>" alt="">
                                </td>
                                <td><?php echo $nproyecto['descripcion'];?></td>
                                <td><?php echo $nproyecto['fecha'];?></td>
                                <!-- metodo get para enviar paremtros por url ?borrar=-->
                                <td><a name="" id="" class="btn btn-danger" href="?borrar=<?php echo $nproyecto['id'];?>" role="button">Eliminar</a></td>
                                   
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>  

        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>


