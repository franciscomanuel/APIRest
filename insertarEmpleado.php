<?php
 
    require_once('conexion.php');
    
    //Datos a insertar
    $nombre = utf8_decode($_POST['nombre']);
    $apellidos = utf8_decode($_POST['apellidos']);
    $nacimiento = $_POST['nacimiento'];
    $sexo = $_POST['sexo'];
    $departamento = $_POST['departamento'];
    $cargo = $_POST['cargo'];
    $ingresos = $_POST['ingresos'];
    $id = $_POST['id'];
    
    //Consultarmos previamente si el empleado a insertar no existe ya en la base de datos
    $consultaSQL2 = "SELECT * FROM employees WHERE first_name='$nombre' AND last_name='$apellidos'"; 
    $resultados2 = $conex->query( $consultaSQL2 ); 
    
    //Si existe no lo inserta y da un mensaje de error, en caso contrario hace los insert
    if ($resultados2->rowCount()!=0){
        echo "2";
    }else{
        $consultaSQL="INSERT INTO employees(emp_no, birth_date, first_name, last_name, gender)
        values('$id', '$nacimiento','$nombre','$apellidos','$sexo')";

        $consultaSQL3 = "INSERT INTO dept_emp(emp_no, dept_no, from_date)
        values('$id', '$departamento', CURDATE())";

        $consultaSQL4 = "INSERT INTO titles(emp_no, title, from_date)
        values('$id', '$cargo', CURDATE())";

        $consultaSQL5 = "INSERT INTO salaries(emp_no, salary, from_date)
        values('$id', '$ingresos', CURDATE())";
        echo "1";
    }
    
    //Ejecutamos cada uno de los insert
    try{
        $conex->query($consultaSQL);
        $conex->query($consultaSQL3);
        $conex->query($consultaSQL4);
        $conex->query($consultaSQL5);
    }catch(PDOException $e){
            echo "Consulta fallida: " . $e->getMessage();
    }
    
?>