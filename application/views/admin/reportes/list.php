    <ul class="breadcrumb">
        <li>
            <a href="<?php echo site_url("admin"); ?>">
                <?php echo ucfirst($this->uri->segment(1));?>
            </a> 
            <span class="divider"></span>
        </li>
        <li class="active">
            <?php echo ucfirst($this->uri->segment(2));?>
        </li>
    </ul>

    <div class="page-header users-header">
        <h2>
            <?php echo ucfirst($this->uri->segment(2));?>           
        </h2>
    </div>

    <div class="well">        
    <?php 
        $attributes = array('class' => 'form-inline reset-margin', 'id' => 'myform');
        echo form_open('admin/reportes/procesar', $attributes);
    ?>
        
         <div class="control-group">
            
            <label for="inputError" class="control-label">Fecha inicio</label>
            <div class="controls">
              <input type="date" id="fecha_inicio" name="fecha_inicio" class="input">    
            </div>
          </div> 

          <div class="control-group">
            
            <label for="inputError" class="control-label">Fecha Final</label>
            <div class="controls">
              <input type="date" id="fecha_fin" name="fecha_fin" class="input">    
            </div>
          </div>
         
          <div class="form-actions">
            <button class="btn btn-success" type="submit" value = "deudas">Exportar a Excel</button>            
          </div>
        </fieldset>
        

      <?php echo form_close(); ?>

     </div>    
    