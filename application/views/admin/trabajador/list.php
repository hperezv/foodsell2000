    
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
           
            $options_tipotrabajador = array(0 => "all");
            foreach ($tipotrabajador as $row)
            {
              $options_tipotrabajador[$row['id']] = $row['nombre'];
            }
            //save the columns names in a array that we will use as filter         
            $options_trabajador = array();    
            foreach ($trabajador as $array) {
              foreach ($array as $key => $value) {
                $options_trabajador[$key] = $key;
              }
              break;
            }

            echo form_open('admin/trabajador', $attributes);
     
              echo form_label('Buscar:', 'search_string');
              echo form_input('search_string', $search_string_selected, 'class="form-control input-sm"','style="width: 170px;height: 10px;"');
              
              $data_submit = array('name' => 'mysubmit', 'class' => 'btn btn-primary', 'value' => 'Buscar');

              echo form_submit($data_submit);
            ?>
            <a  href="<?php echo site_url("admin").'/'.$this->uri->segment(2); ?>/add" class="btn btn-primary">Nuevo</a>
      
          </div>
    <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                             Advanced Tables
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th >#</th>
                                            <th>Codigo</th>
                                            <th>Nombres</th>
                                            <th>Apellidos</th>
                                            <th>DNI</th>
                                            <th>Area</th>
                                            <th>Aciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                     foreach($trabajador as $row)
                                    {
                                      echo '<tr class="gradeU">';
                                            echo '<td>'.$row['id'].'</td>';
                                            echo '<td>'.$row['codigo'].'</td>';
                                            echo '<td>'.$row['nombres'].'</td>';
                                            echo '<td>'.$row['apellidos'].'</td>';
                                            echo '<td>'.$row['dni'].'</td>';
                                            echo '<td>'.$row['tipotrabajador_name'].'</td>';
                                            echo '<td class="crud-actions">
                                                  <a href="'.site_url("admin").'/trabajador/update/'.$row['id'].'"class="btn btn-primary btn-sm fa fa-edit">Editar</a>  
                                                  <a href="'.site_url("admin").'/trabajador/delete/'.$row['id'].'"class="btn btn-danger btn-sm fa fa-pencil">Borrar</a>

                                                  </td>';
                                      echo '</tr>';
                                       }
                                      ?>

                                    </tbody>
                                </table>

                            </div>
                            
                        </div>
                    </div>
                    
                </div>
            </div>



  
