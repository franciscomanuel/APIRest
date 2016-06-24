<?php

	require_once('conexion.php');
    
    //Datos a insertar
    $id = $_POST['id'];

    $consultaSQL="SELECT * FROM employees.employees WHERE employees.emp_no='$id'";
    $resultados = $conex->query( $consultaSQL );
    $resultados->execute();     
    $fila=$resultados->fetch();

    echo "<h5 id='colorRojo'>Informacion sobre el usuario seleccionado";
    echo "<p>ID: " . $fila[0] . "</p>";
    echo "<p>Nombre: " . $fila[2] . "</p>";
    echo "<p>Apellidos: " . $fila[3] . "</p>";
    echo "<p>Genero: " . $fila[4] . "</p>";
    echo "<p>Fecha de nacimiento: " . $fila[1] . "</p>";

?>