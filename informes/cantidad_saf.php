 <div class="panel-body">

    <div class="row">
      <div class="col-md-9">
        <blockquote>
              <p>Informe de Cantidad de Cuentas por SAF</p>
        </blockquote>
      </div>
    
        <div class="col-md-3">
         <button type="button" class="btn btn-danger" onclick="window.open('cuentas/cantidad_saf_pdf.php', 'popup')"><i class="fa fa-file-pdf-o"></i> PDF</button>      
         <button type="button" class="btn btn-success" onclick="location='cuentas/cantidad_saf_exel.php'"><i class="fa fa-file-excel-o"></i> EXEL</button>      
        </div>
    </div>

          <table class="table table-hover">
            <thead>
                <tr class="info">
                   <th>Nro. SAF</th>
                    <th>Nombre</th>
                    <th>Cantidad</th>
                </tr>
            </thead>
              <tbody>
                    <?php
                      
                                for($i=0;$i<sizeof($cantidadSaf);$i++){
                                   
                                ?>
                                <tr>
                                    <td><?php echo $cantidadSaf[$i]["saf"]; ?></td>
                                    <td><?php echo $cantidadSaf[$i]["nombre"]; ?></td>
                                    <td><?php echo $cantidadSaf[$i]["cantidad"]; ?></td>
                                </tr>
                                <?php
                                  }
                                ?>
                                
              </tbody>
          </table>
</div>  