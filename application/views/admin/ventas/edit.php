   
      
    <ul class="breadcrumb">
        <li>
            <a href="<?php echo site_url("admin"); ?>">
                <?php echo ucfirst($this->uri->segment(1));?>
            </a> 
            <span class="divider"></span>
        </li>
        <li>
            <a href="<?php echo site_url("admin").'/'.$this->uri->segment(2); ?>">
                <?php echo ucfirst($this->uri->segment(2));?>
            </a> 
            <span class="divider"></span>
        </li>
        <li class="active">
            <a href="#">Editar</a>
        </li>
    </ul>
      
    <div class="page-header">
        <h2>
            Editar <?php echo ucfirst($this->uri->segment(2));?>
        </h2>
    </div>
 
    <?php
        //flash messages
        if($this->session->flashdata('flash_message')){
            if($this->session->flashdata('flash_message') == 'updated')
            {
                echo '<div class="alert alert-success">';
                echo '<a class="close" data-dismiss="alert">×</a>';
                echo '<strong>Exito!</strong> Documento ha sido  grabado.';
                echo '</div>';       
            }else{
                echo '<div class="alert alert-error">';
                echo '<a class="close" data-dismiss="alert">×</a>';
                echo '<strong>Error!</strong> Realize los  cambios  y envie de nuevo';
                echo '</div>';          
            }
        }
        
        //Trabajadores
        $options_trabajadores = array(0 => "Trabajador");

        foreach ($trabajadores as $row)
        {
          $options_trabajador[$row['id']] = $row['codigo'].' '.$row['apellidos'].' '.$row['nombres'].' '.$row['dni'];      
        }
        //Productos
        $options_productos = array(0 => "Producto");

        foreach ($productos as $row)
        {
          $options_producto[$row['id']] = $row['nombre'].' ['.$row['precio'].'] '.$row['cantidad'];
        }
    ?>
    <div class="row">
        <div class="col-md-8">
            <?php    
            $attributes = array('class' => 'form-horizontal', 'id' => '');
            //form validation
            echo validation_errors();
            echo form_open('admin/ventas/update/'.$this->uri->segment(4).'', $attributes);
            ?>
            <fieldset>
                <div class="control-group">
                    <label for="inputError" class="control-label">Cliente</label>
                    <div class="controls">                        
                        <?php 
                        echo form_dropdown('trabajadores_id', $options_trabajador, $venta[0]['trabajadores_id'], 'class="span2"');
                        ?>
                    </div>
                </div>

                <div class="control-group">
                    <label for="inputError" class="control-label">Producto</label>
                    <div class="controls">                        
                        <?php 
                        echo form_dropdown('productos_id', $options_producto, $venta[0]['productos_id'], 'class="span2"');
                        ?>
                    </div>
                </div>
                <div class="control-group">
                    <label for="inputError" class="control-label">Fecha Reporte</label>
                    <div class="controls"> 
                        <?php $fecha_reporte = substr($venta[0]['fecha_hora_reporte'],0,4).'-'.substr($venta[0]['fecha_hora_reporte'],5,2).'-'.substr($venta[0]['fecha_hora_reporte'],8,2);?>
                        <input type="date" id="fecha_hora_reporte" name="fecha_hora_reporte" class="input" value="<?php echo date($fecha_reporte)?>">                            
                    </div>
                </div>          
                <div class="control-group">
                    <label for="inputError" class="control-label">Total</label>
                    <div class="controls">
                        <input class="form-control" id="" name="total" readonly="readonly" value="<?php echo $venta[0]['total'];?>">                        
                    </div>
                </div>
                <div class="control-group">
                    <label for="inputError" class="control-label">Saldo</label>
                    <div class="controls">
                        <input class="form-control" id="" name="saldo" readonly="readonly" value="<?php echo $venta[0]['total']-$venta[0]['acuenta'];?>">
                        <!--<span class="help-inline">Apellidos</span>-->
                    </div>
                </div>
                <div class="control-group">
                    <label for="inputError" class="control-label">Cantidad</label>
                    <div class="controls">
                        <input class="form-control" id="" type="number" min="1" max="100" name="cantidad" value="<?php echo $venta[0]['cantidad'];?>">
                        <!--<span class="help-inline">Apellidos</span>-->
                    </div>
                </div>
                <div class="control-group">
                    <label for="inputError" class="control-label">A Cuenta</label>
                    <div class="controls">
                        <input class="form-control" type="number" step="0.1" id="" name="acuenta" value="<?php echo $venta[0]['acuenta'];?>">
                        <!--<span class="help-inline">Apellidos</span>-->
                    </div>
                </div>
                <p></p>

                <div class="form-actions">
                    <button class="btn btn-primary" type="submit">Grabar</button>
                    <button class="btn" type="reset">Cancel</button>
                </div>
            </fieldset>

            <?php echo form_close(); ?>
        </div>  
    </div>

   
     