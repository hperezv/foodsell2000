        
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
            <a href="#">Nuevo</a>
        </li>
    </ul>
      
    <div class="page-header">
        <h2>
            Nuevo Venta
        </h2>
    </div>
 
    <?php
        //flash messages
        if(isset($flash_message)){
            if($flash_message == TRUE)
            {
                echo '<div class="alert alert-success">';
                echo '<a class="close" data-dismiss="alert">×</a>';
                echo '<strong>Correcto!</strong> La nueva venta se ha realizado con exito';
                echo '</div>';       
            }else{
                echo '<div class="alert alert-error">';
                echo '<a class="close" data-dismiss="alert">×</a>';
                echo '<strong>Cuidado!</strong> Vuelva a intentarlo.';
                echo '</div>';          
            }
        }
    ?>
      
    <div class="row">
        <div class="col-md-8">

        <?php       
        $attributes = array('class' => 'form-horizontal', 'id' => '');
        echo validation_errors();      
        echo form_open('admin/ventas/add', $attributes);
        ?>
        <fieldset>
          <div class="control-group">
            <label for="inputError" class="control-label">Trabajador</label>
            <div class="controls">
              <input class="form-control"  id="" placeholder="Nombre" name="nombre" value="<?php echo set_value('nombre'); ?>" >
              <!--<span class="help-inline">Woohoo!</span>-->
            </div>
          </div>
          
          <div class="control-group">
            <label for="inputError" class="control-label">Producto</label>
            <div class="controls">
              <input class="form-control"  placeholder="Precio" id="" name="precio" value="<?php echo set_value('precio'); ?>">
              <!--<span class="help-inline">Fecha</span>-->
            </div>
          </div>          
          
          <div class="control-group">
            <label for="inputError" class="control-label">Cantidad</label>
            <div class="controls">
              <input class="form-control" placeholder="Cantidad" name="cantidad" value="<?php echo set_value('cantidad'); ?>">
              <!--<span class="help-inline">OOps</span>-->
            </div>
          </div>
            
          <div class="control-group">
            <label for="inputError" class="control-label">A Cuenta</label>
            <div class="controls">
              <input class="form-control" placeholder="A Cuenta" name="acuenta" value="<?php echo set_value('acuenta'); ?>">
              <!--<span class="help-inline">OOps</span>-->
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



