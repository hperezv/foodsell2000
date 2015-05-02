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
        
   <?php echo form_open('admin/documents/add', $attributes);
      ?>
        
         <div class="control-group">
            
            <label for="inputError" class="control-label">Fecha inicio</label>
            <div class="controls">
              <input type="date" id="fecha_inio" name="fecha_ini" class="input"  value="<?php set_value('fecha'); ?>" >    
            </div>
          </div> 

          <div class="control-group">
            
            <label for="inputError" class="control-label">Fecha Final</label>
            <div class="controls">
              <input type="date" id="fecha_final" name="fecha" class="input"  value="<?php set_value('fecha'); ?>" >    
            </div>
          </div>
         
          <div class="form-actions">
            <button class="btn btn-primary" type="submit">Grabar</button>
            <button class="btn" type="reset">Cancel</button>
          </div>
        </fieldset>
        <input type="date" name="fecha">

      <?php echo form_close(); ?>

     </div>



    <div style="text-align:center;">
    <button type="button" class="btn btn-success" title="Exportar a Excel" onclick="window.location='<?php echo base_url()?>admin/reportes/exporta';">Exportar a Excel</button>
    <script> 
    