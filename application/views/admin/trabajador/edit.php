   
      
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
          <a href="#">Update</a>
        </li>
      </ul>
      
      <div class="page-header">
        <h2>
          Updating <?php echo ucfirst($this->uri->segment(2));?>
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

      echo form_open('admin/trabajador/update/'.$this->uri->segment(4).'', $attributes);
      ?>
        <fieldset>
          <div class="control-group">
            <label for="inputError" class="control-label">Código</label>
            <div class="controls">
              <input class="form-control" id="" name="codigo" value="<?php echo $product[0]['codigo']; ?>" >
              <!--<span class="help-inline">Woohoo!</span>-->
            </div>
          </div>
          
          <div class="control-group">
            <label for="inputError" class="control-label">Nombres</label>
            <div class="controls">
              <input class="form-control" id="" name="nombres" value="<?php echo $product[0]['nombres']; ?>">
              <!--<span class="help-inline">Apellios</span>-->
            </div>
          </div>          
          <div class="control-group">
            <label for="inputError" class="control-label">Apellidos</label>
            <div class="controls">
              <input class="form-control" id="" name="apellidos" value="<?php echo $product[0]['apellidos'];?>">
              <!--<span class="help-inline">Apellidos</span>-->
            </div>
          </div>
          <div class="control-group">
            <label for="inputError" class="control-label">DNI</label>
            <div class="controls">
              <input class="form-control" name="dni" value="<?php echo $product[0]['dni']; ?>">
              <!--<span class="help-inline">OOps</span>-->
            </div>
          </div>
          <?php
          echo '<div class="control-group">';
            echo '<label for="tipodoc_id" class="control-label">Tipo Doc</label>';
            echo '<div class="controls">';
              //echo form_dropdown('tipodoc_id', $options_manufacture, '', 'class="span2"');
              
              echo form_dropdown('area', $options_manufacture, $product[0]['area'], 'class="span2"');

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

   
     