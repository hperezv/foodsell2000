    
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
          <a  href="<?php echo site_url("admin").'/'.$this->uri->segment(2); ?>/add" class="btn btn-primary">Nuevo</a>
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
              echo form_input('search_string', $search_string_selected, 'style="width: 170px;
height: 26px;"');

              echo form_label('Filtrar por Tipo de Doc:', 'tipodoc_id');
              echo form_dropdown('tipodoc_id', $options_tipotrabajador, $trabajador_selected, 'class="span2"');

              echo form_label('Ordenar por:', 'order');
              echo form_dropdown('order', $tipotrabajador, $order, 'class="span2"');

              $data_submit = array('name' => 'mysubmit', 'class' => 'btn btn-primary', 'value' => 'Buscar');

              $options_order_type = array('Asc' => 'Asc', 'Desc' => 'Desc');
              echo form_dropdown('order_type', $options_order_type, $order_type_selected, 'class="span1"');

              echo form_submit($data_submit);

            echo form_close();
            ?>

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
                                            echo '<td>'.$row['area'].'</td>';
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