<div class="panel-body">
    <div class="row">
      <div class="col-md-9">
        <blockquote>
          <p>Informe de Cantidad de Cuentas por Banco</p>
        </blockquote>
      </div>
          
      <div class="col-md-3">
         <button type="button" class="btn btn-danger" onclick="window.open('cuentas/cantidad_banco_pdf.php', 'popup')"><i class="fa fa-file-pdf-o"></i> PDF</button>      
         <button type="button" class="btn btn-success" onclick="location='cuentas/cantidad_banco_exel.php'"><i class="fa fa-file-excel-o"></i> EXEL</button>      
      </div>

    </div>

                <table class="table table-hover">
                  <thead>
                      <tr class="info">
                          <th>#</th>
                          <th>Nombre</th>
                          <th>Cantidad</th>
                      </tr>
                  </thead>
                    <tbody>
                         <?php
                            
                                      for($i=1;$i<sizeof($cantidadBanco);$i++){
                                         
                                      ?>
                                      <tr>
                                          <td><?php echo $i; ?></td>
                                          <td><?php echo $cantidadBanco[$i]["nombre"]; ?></td>
                                          <td><?php echo $cantidadBanco[$i]["cantidad"]; ?></td>
                                      </tr>
                                      <?php
                                        }
                                      ?>
                                      
                    </tbody>
                </table>
</div>  