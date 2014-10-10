<div class="panel-body">
    <div class="row">
      <div class="col-md-9">
        <blockquote>
          <p>Informe de Cuentas por SAF</p>
        </blockquote>
      </div>
    </div>

    <form class="form-horizontal" role="form" action="informes_saf.php" method="GET">
      
      <input type="hidden" name="var" value="saf1">
      <div class="form-group">
        <label class="col-sm-2 control-label">SAF</label>
        <div class="col-sm-2">
          <select class="form-control" name="saf" required autofocus>
             <option value="">SAF</option>
             <?php
              for($i=0;$i<sizeof($saf);$i++){
             ?>
                <option value="<?php echo $saf[$i]["servicio"]; ?>"> <?php echo $saf[$i]["servicio"]; ?></option>
             <?php
              }
             ?>
          </select>
        </div>
        <button class="btn btn-success" type="submit"><span class="glyphicon glyphicon-search"></span></button>
      </div>
      <input type="hidden" name="informe" value="1">

    </form>           
</div>

<?php if (!empty($listar)) { ?>

<div class="panel-body">
    <div class="row">
      <div class="col-md-9">
        <blockquote>
          <p>Informe por SAF</p><small><b>SAF: </b><?php echo $listar[0]["saf"]; ?></small> 
        </blockquote>
      </div>
          
      <div class="col-md-3">
         <button type="button" class="btn btn-danger" onclick="window.open('cuentas/cantidad_banco_pdf.php', 'popup')"><i class="fa fa-file-pdf-o"></i> PDF</button>      
         <button type="button" class="btn btn-success" onclick="location='cuentas/cantidad_banco_exel.php'"><i class="fa fa-file-excel-o"></i> EXEL</button>      
      </div>

    </div>

                <table class="table">
                  <thead>
                      <tr class="info">
                          <th>#</th>
                          <th>Cuenta</th>
                          <th>Organismo</th>
                          <th>Tipo</th>
                          <th>Denominación</th>
                          <th>Fecha de Alta</th>
                      </tr>
                  </thead>
                    <tbody>
                                    <?php
                            
                                      for($i=0;$i<sizeof($listar);$i++){
                                         
                                      ?>
                                      <tr>
                                          <td><?php echo $i; ?></td>
                                          <td><?php echo $listar[$i]["cta"]; ?></td>
                                          <td><?php echo $listar[$i]["organismo"]; ?></td>
                                          <td><?php echo $listar[$i]["fdopropio"]; ?></td>
                                          <td><?php echo $listar[$i]["denominacion"]; ?></td>                                    
                                          <td><?php echo $listar[$i]["fecha"]; ?></td>                                    
                                      </tr>
                                     
                                     <?php
                                        }
                                      ?>
                    </tbody>
                </table>
</div>  

<?php } ?>
