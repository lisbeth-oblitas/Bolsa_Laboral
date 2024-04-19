<?php
include("../includes/head.php");
include("../includes/conectar.php");
$conexion = conectar();
?>
<div class="container-fluid">
    <h1>Lista de Empresas</h1>
    <?php
    $sql = "SELECT * FROM empresas";
    $registros = mysqli_query($conexion, $sql);
    echo "<table class='table table-success table-hover'>";
    echo "<th>Razón Social</th><th>RUC</th><th>Dirección</th><th>Teléfono</th><th>Correo</th><th>Acciones</th>";
    while ($fila = mysqli_fetch_array($registros)) {
        echo "<tr>";
        echo "<td>".$fila['razon_social']."</td>";
        echo "<td>".$fila['ruc']."</td>";
        echo "<td>".$fila['direccion']."</td>";
        echo "<td>".$fila['telefono']."</td>";
        echo "<td>".$fila['correo']."</td>";
        echo "<td>";
        ?>
        <button type="button" class="btn btn-primary" onClick="f_editar('<?php echo $fila['id']; ?>');">Editar</button>
        <button type="button" class="btn btn-danger" onClick="f_eliminar('<?php echo $fila['id']; ?>');">Eliminar</button>

        <button type="button" class="btn btn-success" onClick="f_mostrar_usuarios('<?php echo $fila['id']; ?>');">Asignar Usuario</button>

        <?php
        echo "</td>";
        echo "</tr>";
    }
    echo "</table>";
    ?>
</div>


<div id="div_usuarios">
    <h1>Lista de Usuarios</h1>
    <?php
        $sql_usuarios="SELECT * FROM usuarios";
        $registros_usuarios = mysqli_query($conexion, $sql_usuarios);

        while ($fila_user = mysqli_fetch_array($registros_usuarios)){
            echo '<a href="#" onClick="f_asignar('.$fila_user['id'].')"  >';
                echo $fila_user['dni'].' '.$fila_user['nombres'].' '.$fila_user['apellidos'].'<br>';
            echo '</a>';
        }
    ?>
</div>

<script src="<?php echo RUTAGENERAL; ?>templates/vendor/jquery/jquery.min.js"></script>

<script>

    var ID_EMPRESA; //esta es una variable GLOBAL

    $(document).ready(function(){ //inicio de jquery

        $("#div_usuarios").dialog({	       
           width: 600,
           height: 400,
           title: "Lista de usuarios...",                    
        });

        $("#div_usuarios").dialog("close");

    }); //fin jquery


    function f_editar(id) {
        location.href = "modificar_empresa.php?id=" + id;
    }

    function f_eliminar(id) {
        if (confirm('¿Está seguro de eliminar esta empresa?')) {
            location.href = "eliminar_empresa.php?id=" + id;
        }
    }

    function f_mostrar_usuarios(pid_empresa){
        ID_EMPRESA = pid_empresa;

        //alert(pid_empresa);
        $("#div_usuarios").dialog("open");
    }

    function f_asignar(pid_usuario){
        alert('funcion asignar para el usuario: '+pid_usuario);
        alert('funcion asignar para la empresa : '+ID_EMPRESA);

        //aqui es donde tenemos que hacer la asignacion:
        //...       


    }


</script>
<?php
include("../includes/foot.php");
?>