<div class="panel-body">
    <div class="row">
      <div class="col-md-12">
        <blockquote>
          <p>Informe de Cuentas por Banco y SAF</p>
        </blockquote>
      </div>
    </div>
    <div class="col-md-12">
    <form class="form-horizontal" role="form" action="informes_bancos.php" method="GET">
      
      <input type="hidden" name="var" value="bancos2">
      <div class="form-group">
        <label class="col-sm-2 control-label">Banco</label>
        <div class="col-sm-5">
          <select class="form-control" name="banco" required autofocus>
             <option value="">SELECCIONAR BANCO</option>
             <?php
              for($i=0;$i<sizeof($banco);$i++){
             ?>
                <option value="<?php echo $banco[$i]["nombre"]; ?>"> <?php echo $banco[$i]["nombre"]; ?></option>
             <?php
              }
             ?>
          </select>
        </div>
        <label class="col-sm-1 control-label">SAF</label>
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

      <div class="form-group">
        <label class="col-sm-2 control-label"></label>
        <div class="col-sm-6">
<!--           <label class="radio-inline">
              <input type="radio" name="radio" id="inlineRadio1" value="1" required>Todas</label> -->
            <label class="radio-inline">
              <input type="radio" name="radio" id="inlineRadio2" value="Operativa" required>Operativas</label>
            <label class="radio-inline">
              <input type="radio" name="radio" id="inlineRadio3" value="Cuenta Unica Tesoro" required>Cuentas Unicas del Tesoro</label>
        </div>
      </div>
      <input type="hidden" name="informe" value="2">

    </form>   
    </div>        
</div>

<?php if (!empty($listar)) { ?>

<div class="panel-body">
    <div class="row">
      <div class="col-md-9">
        <blockquote>
          <p>Informe por Banco y SAF</p><small><b>Banco: </b><?php echo $listar[0]["banco"]; ?></small> 
                                                         <small><b>Tipo de Cuenta: </b><?php echo $listar[0]["fdopropio"]; ?></small>
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
                          <th>SAF</th>
                          <th>Cuenta</th>
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
                                          <td><?php echo $listar[$i]["saf"]; ?></td>
                                          <td><?php echo $listar[$i]["cta"]; ?></td>
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
