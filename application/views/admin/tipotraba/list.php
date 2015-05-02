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
      
      <div class="row">
        <div class="span12 columns">
          <div class="well">
           
            <?php
           
            $attributes = array('class' => 'form-inline reset-margin', 'id' => 'myform');
           
            echo form_open('admin/tipotrab', $attributes);
     
              echo form_label('Buscar:', 'search_string');
              echo form_input('search_string', $search_string_selected,'class="form-control"','style="width: 170px; height: 26px;"');

              $data_submit = array('name' => 'mysubmit', 'class' => 'btn btn-primary', 'value' => 'Buscar');

              echo form_submit($data_submit);
            ?>
             <a  href="<?php echo site_url("admin").'/'.$this->uri->segment(2); ?>/add" class="btn btn-primary">Nuevo</a>
          </div>

          <table class="table table-striped table-bordered table-condensed">
            <thead>
              <tr>
                <th class="header">#</th>
                <th class="yellow header headerSortDown">Name</th>
                <th class="yellow header headerSortDown">Acciones</th>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach($tipodetraba as $row)
              {
                echo '<tr>';
                echo '<td>'.$row['id'].'</td>';
                echo '<td>'.$row['nombre'].'</td>';
                echo '<td class="crud-actions">
                  <a href="'.site_url("admin").'/tipotrab/update/'.$row['id'].'" class="btn btn-primary btn-sm fa fa-edit">Editar</a>  
                  <a href="'.site_url("admin").'/tipotrab/delete/'.$row['id'].'" class="btn btn-danger btn-sm fa fa-pencil">Borrar</a>
                </td>';
                echo '</tr>';
              }
              ?>      
            </tbody>
          </table>

          <?php echo '<div class="pagination">'.$this->pagination->create_links().'</div>'; ?>

      </div>
    </div>