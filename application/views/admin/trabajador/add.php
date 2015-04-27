    
      
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
          <a href="#">New</a>
        </li>
      </ul>
      
      <div class="page-header">
        <h2>
          Adding <?php echo ucfirst($this->uri->segment(2));?>
        </h2>
      </div>
 
      <?php
      //flash messages
      if(isset($flash_message)){
        if($flash_message == TRUE)
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Correcto!</strong> El Nuevo Documento ha sido creado';
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
      //form data
      $attributes = array('class' => 'form-horizontal', 'id' => '');
      $options_manufacture = array('' => "Select");
      foreach ($manufactures as $row)
      {
        $options_manufacture[$row['id']] = $row['nombre'];
      }

      //form validation
      echo validation_errors();
      
      echo form_open('admin/trabajador/add', $attributes);
      ?>
        <fieldset>
          <div class="control-group">
            <label for="inputError" class="control-label">Código</label>
            <div class="controls">
              <input class="form-control"  id="" name="codigo" value="<?php echo set_value('codigo'); ?>" >
              <!--<span class="help-inline">Woohoo!</span>-->
            </div>
          </div>
          
          <div class="control-group">
            <label for="inputError" class="control-label">Nombres</label>
            <div class="controls">
              <input class="form-control"  id="" name="nombres" value="<?php echo set_value('nombres'); ?>">
              <!--<span class="help-inline">Fecha</span>-->
            </div>
          </div>          
          
          <div class="control-group">
            <label for="inputError" class="control-label">Apellidos</label>
            <div class="controls">
              <input class="form-control" placeholder="Apellidos" name="apellidos" value="<?php echo set_value('apellidos'); ?>">
              <!--<span class="help-inline">OOps</span>-->
            </div>


          </div>
          <div class="control-group">
            <label for="inputError" class="control-label">DNI</label>
            <div class="controls">
              <input class="form-control"  id="" name="dni" value="<?php echo set_value('dni'); ?>">
              <!--<span class="help-inline">Fecha</span>-->
            </div>
          </div> 

            <?php
          echo '<div class="control-group">';
            echo '<label for="tipodoc_id" class="control-label">Area</label>';
            echo '<div class="controls">';
              //echo form_dropdown('tipodoc_id', $options_manufacture, '', 'class="span2"');
              
              echo form_dropdown('area', $options_manufacture, set_value('area'), 'class="span2"');

            echo '</div>';
          echo '</div">';
          ?>
           <p></p>
          <div class="form-actions">
            <button class="btn btn-primary" type="submit">Grabar</button>
            <button class="btn" type="reset">Cancel</button>
          </div>
        </fieldset>

      <?php echo form_close(); ?>

      </div>
    
</div>



