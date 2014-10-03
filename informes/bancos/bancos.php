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

    <form class="form-horizontal" role="form" action="informes_bancos.php" method="GET">
      
      <input type="hidden" name="var" value="bancos1">
      <div class="form-group">
        <label class="col-sm-2 control-label">Banco</label>
        <div class="col-sm-6">
          <select class="form-control" name="banco">
             <?php
              for($i=0;$i<sizeof($banco);$i++){
             ?>
                <option value="<?php echo $banco[$i]["id"]; ?>"> <?php echo $banco[$i]["nombre"]; ?></option>
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
          <label class="radio-inline">
              <input type="radio" name="radio" id="inlineRadio1" value="1" required>Todas</label>
            <label class="radio-inline">
              <input type="radio" name="radio" id="inlineRadio2" value="2" required>Operativas</label>
            <label class="radio-inline">
              <input type="radio" name="radio" id="inlineRadio3" value="3" required>Cuentas Unicas del Tesoro</label>
        </div>
      </div>
      <input type="hidden" name="informe" value="1">

    </form>           
</div>