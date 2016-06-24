<script type="text/javascript">
    
    $(document).ready(function(){

    	var seleccionDep = $('#SelDepartamento');
    	var seleccionCarg = $('#SelCargo');

    	seleccionDep.change(function() {
            var dep = $(this).find(":checked").val();

            $.ajax({
                url: 'filtroDepartamento.php',
                type: 'POST',
                data: {dep:dep},
                success: function(data){
                    $('#resultDepartamento').html(data);
                }
            });

        });

        seleccionCarg.change(function() {
            var carg = $(this).find(":checked").val();

            $.ajax({
                url: 'filtroCargo.php',
                type: 'POST',
                data: {carg:carg},
                success: function(data){
                    $('#resultCargo').html(data);
                }
            });

        });
    });

</script>

<?php
	require_once('conexion.php');
?>


<h2>4.	A continuaci&oacute;n, y teniendo como base el API, construir una interfaz sencilla que muestre el listado de empleados obtenido a 
trav&eacute;s de una petici&oacute;n http a la API.</h2>

<h5>Listado de empleados por departamento. Una vez desplegado el listado, si pinchamos sobre el ID de un usuario, se mostrar&aacute;
informaci&oacute;n sobre el al final de la tabla generada.</h5>

<?php
	$consultaSQL = "SELECT * FROM departments"; 
    $resultados = $conex->query( $consultaSQL );

    echo "<select id='SelDepartamento'>";
        echo "<option id='departamento0' value='0'> --- </option>"; 
        foreach ( $resultados as $fila ) { 
            $dep=utf8_encode($fila['dept_name']);
            echo "<option id='departamento$fila[dept_no]' value='$fila[dept_no]'> $dep </option>"; 
    	}
    echo "</select>";

    echo "<br>";
    echo "<div id='resultDepartamento'></div>";

    echo "<br>";
    echo "<div id='resultEmpleadoDepartamento'></div>";
?>

<hr>

<h5>Listado de empleados por cargo. Una vez desplegado el listado, si pinchamos sobre el ID de un usuario, se mostrar&aacute;
informaci&oacute;n sobre el al final de la tabla generada.</h5>

<?php
        	
    $consultaSQL2 = "SELECT DISTINCT title FROM titles"; 
    $resultados2 = $conex->query( $consultaSQL2 );
    $cont=1;

    echo "<select id='SelCargo'>";
        echo "<option id='cargo0' value='0'> --- </option>"; 
        foreach ( $resultados2 as $fila2 ) { 
            $carg=utf8_encode($fila2['title']);
            echo "<option id='cargo$cont' value='$carg'> $carg </option>"; 
            $cont++;
        }
    echo "</select>";

    echo "<br>";
    echo "<div id='resultCargo'></div>";

    echo "<br>";
    echo "<div id='resultEmpleadoCargo'></div>";
?>
