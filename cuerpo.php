<script type="text/javascript">
    
    $(document).ready(function(){
        var enlace = $('.desplegable a');

        enlace.click(function (){

            var value = $(this).attr("value");

            $.ajax({
                url: value + '.php',
                type: 'GET',
                async: true,
                data: '',
                success: function(data){
                    $('#ContenidoDivFormularios').html(data);
                }
            });

        });
    });

    

</script>

<div id="contenedor">
            
    <?php

                /*$consultaSQL = "SELECT * FROM salaries"; 
                $resultados = $conex->query( $consultaSQL ); */
                /*$resultados2->execute();     
                $fila2=$resultados2->fetch(); */

                /*foreach ($resultados as $fila){
                    echo "<p>" . $fila['salary'] . "</p>";
                }*/

        include ('menu.php');
        include ('contenido.php');
                //include ('pie.php');
    ?>
</div>