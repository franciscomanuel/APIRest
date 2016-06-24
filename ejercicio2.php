<h2>2.	Obtención del perfil de un empleado con el departamento, cargo y salario actuales.</h2>
<?php
		
	require_once('conexion.php');

	$consultaSQL = "SELECT employees.emp_no, employees.first_name, employees.last_name, employees.gender, employees.birth_date, 
    employees.hire_date, titles.title, departments.dept_name, MAX(salary) FROM salaries, employees, titles, departments, dept_emp 
    WHERE departments.dept_no=dept_emp.dept_no AND dept_emp.emp_no=employees.emp_no AND titles.emp_no=employees.emp_no AND 
    employees.emp_no=salaries.emp_no group by employees.hire_date LIMIT 50"; 
    $resultados = $conex->query( $consultaSQL );

    
    $fil=1;
    echo "<table id='resultTableEjercicio2' border='1' align='center' class='tablas'>";
        echo "<thead id='resultTHeadEjercicio2' align='center'>";
            echo "<tr id='resultEjercicio2Fil0'>";
                echo "<th id='resultEjercicio2THID'>ID</th>";
                echo "<th id='resultEjercicio2THNombre'>Nombre</th>";
                echo "<th id='resultEjercicio2THApellidos'>Apellidos</th>";
                echo "<th id='resultEjercicio2THGenero'>Genero</th>";
                echo "<th id='resultEjercicio2THFNacimiento'>Fecha Nacimiento</th>";
                echo "<th id='resultEjercicio2THFFContratacion'>Fecha contratacion</th>";
                echo "<th id='resultEjercicio2THFCargo'>Cargo</th>";
                echo "<th id='resultEjercicio2THFDep'>Departamento</th>";
                echo "<th id='resultEjercicio2THFSalario'>Salario</th>";
            echo "</tr>";
        echo "</thead>";
        echo "<tbody id='resultTBodyEjercicio1' align='center'>";
            foreach ($resultados as $fila){
                echo "<tr id='resulEjercicioFil$fil'>";
                    echo "<td id='resultEjercicio2Fil$fil" . "Col0'>";
                        echo utf8_encode($fila['0']);  
                    echo "</td>";
                    echo "<td id='resultEjercicio2Fil$fil" . "Col1'>";
                        echo utf8_encode($fila['1']); 
                    echo "</td>";
                    echo "<td id='resultEjercicio2Fil$fil" . "Col2'>";
                        echo utf8_encode($fila['2']);  
                    echo "</td>";
                    echo "<td id='resultEjercicio2Fil$fil" . "Col3'>";
                        echo utf8_encode($fila['3']);  
                    echo "</td>";
                    echo "<td id='resultEjercicio2Fil$fil" . "Col3'>";
                        echo utf8_encode($fila['4']);  
                    echo "</td>";
                    echo "<td id='resultEjercicio2Fil$fil" . "Col3'>";
                        echo utf8_encode($fila['5']);  
                    echo "</td>";
                    echo "<td id='resultEjercicio2Fil$fil" . "Col3'>";
                        echo utf8_encode($fila['6']);  
                    echo "</td>";
                    echo "<td id='resultEjercicio2Fil$fil" . "Col3'>";
                        echo utf8_encode($fila['7']);  
                    echo "</td>";
                    echo "<td id='resultEjercicio2Fil$fil" . "Col3'>";
                        echo utf8_encode($fila['8']);  
                    echo "</td>";
                echo "</tr>";
            }
            $fil++;
        echo "</tbody>";
    echo "</table>";


?>