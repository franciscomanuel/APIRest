<script type="text/javascript">
    
    $(document).ready(function(){
        
    	var insertar = $('#InpInsertar');
    	var cont=0;

    	/*
    		*	Funcion Jquery asociada al click del botón inserta

    	*/
	    insertar.mouseup(function(validar){
	            validar.preventDefault();

	            //Obtenemos los datos del formulario
	            var nombre = $('#InpNombre').val();
	            var apellidos = $('#InpApellidos').val();
	            var nacimiento = $('#InpNacimiento').val();
	            var sexo = $('input:radio[name="InpSexo"]:checked').val();
	            var departamento = $('#SelDepartamento').val();
	            var cargo = $('#SelCargo').val();
	            var ingresos = $('#InpSalario').val();
	            var id = $('#InpIdEmpleado').val();

	            //Validamos que no exista un campo vacío en el formulario
	            cont = valida(nombre, apellidos, nacimiento, sexo, departamento, cargo, ingresos);

	            var dataString = 'nombre=' + nombre + '&apellidos=' + apellidos + '&nacimiento=' + nacimiento + '&sexo=' + sexo +
	            '&departamento=' + departamento + '&cargo=' + cargo + '&ingresos=' + ingresos + '&id=' + id;

	            if(cont > 0){
	                $('#PerDivError').text("Inserta los campos vacíos o erroneos").addClass("mensajeErroneo").show();
	            }
	            else{
	            	$('#PerDivError').hide();
	            	$.ajax({
                    type: "POST",
                    url: "procesarDatosEmpleado.php",
                    data: dataString,
                    success: function(data) {  
                        if(data==1){
                            $('#PerDivError').hide();
                            $.ajax({
                                url: 'ejercicio3.php',
                                type: 'GET',
                                async: true,
                                data:'',
                                success: function(data){
                                    $('#ContenidoDivFormularios').html(data);
                                }
                            });
                        }else{
                            $('#PerDivError').text("Error al insertar").addClass("mensajeErroneo").show();
                        }
                    }
                });
	            }
	    });
	});
	
	/*
		*	Función para validar que no existan campos vacíos en el formulario.
	*/
    function valida(nom, ap, nac, sex, dep, carg, ingr){
    	var cont=0;

    	//Validación Nombre
        if (nom == ''){
            $('#InpNombre').addClass("campoErroneo");
            cont++;
        }else{
            $('#InpNombre').removeClass("campoErroneo");
        }

    	// Validación Apellidos
        if (ap == ''){
            $('#InpApellidos').addClass("campoErroneo");
            cont++;
        }else{
            $('#InpApellidos').removeClass("campoErroneo");
        }

        //Validación Fecha
        if (nac == ''){
            $('#InpNacimiento').addClass("campoErroneo");
            cont++;
        }else{
             $('#InpNacimiento').removeClass("campoErroneo"); 
        }

        //Validación Sexo
        if (!$('input[name="InpSexo"]').is(':checked')){
            $('#LblSexoM').addClass("radioError");
            $('#LblSexoF').addClass("radioError");
            cont++;
        }else{
            $('#LblSexoM').removeClass("radioError");
            $('#LblSexoF').removeClass("radioError");
        }

        if (dep == 0){
            $('#SelDepartamento').addClass("campoErroneo");
            cont++;
        }else{
            $('#SelDepartamento').removeClass("campoErroneo");
        }

        if (carg == 0){
            $('#SelCargo').addClass("campoErroneo");
            cont++;
        }else{
            $('#SelCargo').removeClass("campoErroneo");
        }

        if (nom == ''){
            $('#InpSalario').addClass("campoErroneo");
            cont++;
        }else{
            $('#InpSalario').removeClass("campoErroneo");
        }

        return cont;

       
    }

    //Función para validar fecha
    function validaFecha(value){

	var datePat = /^(\d{1,2})(\/|-)(\d{1,2})(\/|-)(\d{4})$/;
        var datePat2 = /^(\d{4})(\/|-)(\d{1,2})(\/|-)(\d{1,2})$/;
	var fechaCompleta = value.match(datePat);
        var fechaCompleta2 = value.match(datePat2);
 
	if (fechaCompleta == null && fechaCompleta2 == null) {
            return false;
        }
        else if(fechaCompleta != null){
            dia = fechaCompleta[1];
            mes = fechaCompleta[3];
            anio = fechaCompleta[5];
            
            if (dia < 1 || dia > 31) {
                return false;
            }

            if (mes < 1 || mes > 12) { 
                return false;
            }

            if ((mes==4 || mes==6 || mes==9 || mes==11) && dia==31) {
                return false;
            }

            if (mes == 2) { // bisiesto
                var bisiesto = (anio % 4 == 0 && (anio % 100 != 0 || anio % 400 == 0));
                if (dia > 29 || (dia==29 && !bisiesto)) {
                    return false;
                }
            }
            return true;
        }else{
            dia2 = fechaCompleta2[5];
            mes2 = fechaCompleta2[3];
            anio2 = fechaCompleta2[1];
            
            if (dia2 < 1 || dia2 > 31) {
                return false;
            }

            if (mes2 < 1 || mes2 > 12) { 
                return false;
            }

            if ((mes2==4 || mes2==6 || mes2==9 || mes2==11) && dia2==31) {
                return false;
            }

            if (mes2 == 2) { // bisiesto
                var bisiesto = (anio2 % 4 == 0 && (anio2 % 100 != 0 || anio2 % 400 == 0));
                if (dia2 > 29 || (dia2==29 && !bisiesto)) {
                    return false;
                }
            }
            return true;
        }        
    }

</script>

<?php
	require_once('conexion.php');
?>

<h2>3.	Inserci&oacute;n de un empleado </h2>

<fieldset id="FldIdEmpleado" class="bloqueSinBordes">
    <?php
	    /*Consulta que obtiene todos los campos de la tabla Personal*/
	    $consultaSQL = "SELECT * FROM employees"; 
	    $resultados = $conex->query( $consultaSQL );
	    $cont=0;
	                    
	    foreach ($resultados as $fila){
	        $res=$fila['emp_no'];
	    }
	    $res=$res+1;
    ?>

    <label id="LblIdEmpleado" for="InpIdEmpleado">Identificador: </label>
    <input type="text" id="InpIdEmpleado" name="InpIdEmpleado" size="2" value="<?php echo $res; ?>" disabled> 
</fieldset>
            <br>

<div id="PerDivError"></div>

<fieldset id="FldNombre" class="bloqueSinBordes">

    <label id="LblNombre" for="InpNombre">Nombre: </label>
    <input type='text' id='InpNombre' name='InpNombre' size='30'>

</fieldset>

<fieldset id="FldApellidos" class="bloqueSinBordes">

    <label id="LblApellidos" for="InpApellidos">Apellidos: </label>
    <input type='text' id='InpApellidos' name='InpApellidos' size='30'>

</fieldset>

<fieldset id="FldCumple" class="bloqueSinBordes">

    <label id="LblNacimiento" for="InpNacimiento">Fecha de Nacimiento: </label>
    <input type='date' id='InpNacimiento' name='InpNacimiento' placeholder='dd/mm/aplaceaaa'>

</fieldset>

<fieldset id="FldGenero" class="bloqueSinBordes">

	<label id="LblGenero">Genero: </label>
    <label id='LblSexoM' for='InpSexoM'><input type='radio' id='InpSexoM' name='InpSexo' value='M'> Masculino </label>
    <label id='LblSexoF' for='InpSexoF'><input type='radio' id='InpSexoF' name='InpSexo' value='F' > Femenino </label>

</fieldset>

<fieldset id="FldDepartamento" class="bloqueSinBordes">

        <label id="LblDepartamento" for="InpDepartamento">Departamento: </label>

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
        ?>

</fieldset>

<fieldset id="FldCargo" class="bloqueSinBordes">

        <label id="LblCargo" for="InpCargo">Cargo: </label>

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
        ?>

</fieldset>

<fieldset id="FldSalario" class="bloqueSinBordes">

    <label id="LblSalario" for="InpSalario">Salario: </label>
    <input type='text' id='InpSalario' name='InpSalario' size='10'>

</fieldset>

<fieldset id='FldBotones' class='bloqueRedondeado'>
    <div id='DivBotones'>
        <input type='submit' value='Insertar' id='InpInsertar' class='procesaBotones'>
    </div>
</fieldset>