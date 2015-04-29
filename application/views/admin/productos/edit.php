   
      
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
    ?>
    <div class="row">
        <div class="col-md-8">
            <?php    
            $attributes = array('class' => 'form-horizontal', 'id' => '');
            //form validation
            echo validation_errors();
            echo form_open('admin/productos/update/'.$this->uri->segment(4).'', $attributes);
            ?>
            <fieldset>
                <div class="control-group">
                    <label for="inputError" class="control-label">Nombre</label>
                    <div class="controls">
                        <input class="form-control" id="" name="nombre" value="<?php echo $product[0]['nombre']; ?>" >
                        <!--<span class="help-inline">Woohoo!</span>-->
                    </div>
                </div>

                <div class="control-group">
                    <label for="inputError" class="control-label">Precio</label>
                    <div class="controls">
                        <input class="form-control" id="" name="precio" value="<?php echo $product[0]['precio']; ?>">
                        <!--<span class="help-inline">Apellios</span>-->
                    </div>
                </div>          
                <div class="control-group">
                    <label for="inputError" class="control-label">Cantidad</label>
                    <div class="controls">
                        <input class="form-control" id="" name="cantidad" value="<?php echo $product[0]['cantidad'];?>">
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

   
     