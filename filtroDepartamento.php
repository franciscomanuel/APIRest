<script type="text/javascript">
    
    $(document).ready(function(){

    	var enlace = $('.tablas a');
        var nEmpleado = $('#insertEmple');

    	enlace.click(function (){

            var value = $(this).attr("value");

            $.ajax({
                url: 'infoEmpleado.php',
                type: 'POST',
                data: {id:value},
                success: function(data){
                    $('#resultEmpleadoDepartamento').html(data);
                }
            });
        });

        nEmpleado.click(function (){

            var dep = $(this).attr('value');
            
            $.ajax({
                url: 'nuevoEmpleado.php',
                type: 'POST',
                data: {dep:dep},
                success: function(data){
                    $('#ContenidoDivFormularios').html(data);
                }
            });

        });

    });

</script>

<?php

	require_once('conexion.php');
    
    //Datos a insertar
    $dep = $_POST['dep'];

    $consultaSQL = "SELECT employees.emp_no, employees.first_name, employees.last_name, employees.hire_date, titles.title, 
    departments.dept_name, MAX(salary) FROM salaries, employees, titles, departments, dept_emp WHERE departments.dept_no=dept_emp.dept_no 
    AND dept_emp.emp_no=employees.emp_no AND titles.emp_no=employees.emp_no AND employees.emp_no=salaries.emp_no AND departments.dept_no='$dep' 
    GROUP BY employees.hire_date LIMIT 50"; 
    $resultados = $conex->query( $consultaSQL );

    echo "<br>";
    echo "<button id='insertEmple' value='$dep'>Inserta Empleado</button>";
    echo "<br>";

    $fil=1;
    echo "<br>";
    echo "<table id='resultTableEjercicio1' border='1' align='center' class='tablas'>";
        echo "<thead id='resultTHeadEjercicio1' align='center'>";
            echo "<tr id='resultEjercicio1Fil0'>";
                echo "<th id='resultEjercicio1THID'>ID</th>";
                echo "<th id='resultEjercicio1THNombre'>Nombre</th>";
                echo "<th id='resultEjercicio1THApellidos'>Apellidos</th>";
                echo "<th id='resultEjercicio1THFFContratacion'>Fecha contratacion</th>";
                echo "<th id='resultEjercicio1THFCargo'>Cargo</th>";
                echo "<th id='resultEjercicio1THFDep'>Departamento</th>";
                echo "<th id='resultEjercicio1THFSalario'>Salario</th>";
            echo "</tr>";
        echo "</thead>";
        echo "<tbody id='resultTBodyEjercicio1' align='center'>";
            foreach ($resultados as $fila){
                echo "<tr id='resulEjercicioFil$fil'>";
                    echo "<td id='resultEjercicio1Fil$fil" . "Col0'>";
                    	echo "<a href='#' value='$fila[0]'>";
                        	echo $fila['0']; 
                        echo "</a>"; 
                    echo "</td>";
                    echo "<td id='resultEjercicio1Fil$fil" . "Col1'>";
                        echo $fila['1']; 
                    echo "</td>";
                    echo "<td id='resultEjercicio1Fil$fil" . "Col2'>";
                        echo $fila['2'];  
                    echo "</td>";
                    echo "<td id='resultEjercicio1Fil$fil" . "Col3'>";
                        echo $fila['3'];  
                    echo "</td>";
                    echo "<td id='resultEjercicio1Fil$fil" . "Col3'>";
                        echo $fila['4'];  
                    echo "</td>";
                    echo "<td id='resultEjercicio1Fil$fil" . "Col3'>";
                        echo $fila['5'];  
                    echo "</td>";
                    echo "<td id='resultEjercicio1Fil$fil" . "Col3'>";
                        echo $fila['6'];  
                    echo "</td>";
                echo "</tr>";
            }
            $fil++;
        echo "</tbody>";
    echo "</table>";





?>