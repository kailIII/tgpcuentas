 <script type="text/javascript">
            $(function () {
                $('#container').highcharts({
                    chart: {
                        type: 'column'
                    },
                    title: {

                        <?php if(isset($_GET["var"]) AND $_GET["var"] == "cuentas1") { ?>
                                  
                            text: 'Grafico de Cantidad de Cuentas por SAF'

                          <?php } ?>

                          <?php if(isset($_GET["var"]) AND $_GET["var"] == "cuentas2") { ?>
                                  
                            text: 'Grafico de Cantidad de Cuentas por BANCO'

                          <?php } ?>

                    },
                    xAxis: {
                        type: 'category',
                        title: {

                           <?php if(isset($_GET["var"]) AND $_GET["var"] == "cuentas1") { ?>
                                  
                            text: 'Numero de SAF'

                           <?php } ?>

                           <?php if(isset($_GET["var"]) AND $_GET["var"] == "cuentas2") { ?>
                                  
                            text: 'Numero de BANCO'

                           <?php } ?>
                        },
                        labels: {
                            rotation: -45,
                            style: {
                                fontSize: '10px',
                                fontFamily: 'Verdana, sans-serif'
                            }
                        }
                    },
                    yAxis: {
                        min: 0,
                        title: {

                          <?php if(isset($_GET["var"]) AND $_GET["var"] == "cuentas1") { ?>
                                  
                            text: 'Cantidad de Cuentas por SAF'

                          <?php } ?>

                          <?php if(isset($_GET["var"]) AND $_GET["var"] == "cuentas2") { ?>
                                  
                            text: 'Cantidad de Cuentas por BANCO'

                          <?php } ?>
                        }
                    },
                    legend: {
                        enabled: false
                    },
                    tooltip: {
                        pointFormat: 'Contiene: <b>{point.y} cuenta/s</b>'
                    },
                    series: [{
                        name: 'Population',

                        data: (function() {
                            // generate an array of random data
                            var data = [];
                             
                             <?php  

                              if(isset($_GET["var"]) AND $_GET["var"] == "cuentas1")
                                  {
                                    $obj1 = new Informes();
                                    $cantidadSaf = $obj1->cantidadPorSaf();

                                  
                                    for($i=0;$i<sizeof($cantidadSaf);$i++){
                                    
                                        $saf = $cantidadSaf[$i]["saf"];
                                        $cantidad =  $cantidadSaf[$i]["cantidad"];

                                 ?>
                               
                                data.push(['<?php echo "$saf"; ?>', <?php echo "$cantidad"; ?>]);

                                <?php } 

                                  } 

                                if(isset($_GET["var"]) AND $_GET["var"] == "cuentas2")
                                  {
                                    $obj1 = new Informes();
                                    $cantidadBanco = $obj1->cantidadPorBanco();

                                    for($i=0;$i<sizeof($cantidadBanco);$i++){

                                         $banco = $cantidadBanco[$i]["nombre"];
                                         $cantidad = $cantidadBanco[$i]["cantidad"];

                                ?>
                               
                                data.push(['<?php echo "$i"; ?>', <?php echo "$cantidad"; ?>]);

                                <?php } 
                                    }
                                ?>

                            return data;
                        })(),

                         dataLabels: {
                            enabled: true,
                            rotation: 0,
                            color: '#00000',
                            align: 'center',
                            x: 0,
                            y: 1,
                            style: {
                                fontSize: '10px',
                                fontFamily: 'Verdana, sans-serif',
                                
                            }
                        }

              
                    }]
                });
            });
    </script>