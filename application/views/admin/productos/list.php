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
    echo form_open('admin/productos', $attributes);
    echo form_label('Buscar:', 'search_string');
    echo form_input('search_string', $search_string, 'style="width: 170px; height: 26px;"');
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
                    Resultados
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th >id</th>
                                    <th>Nombre</th>
                                    <th>Precio</th>
                                    <th>Cantidad</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php                                    
                                    foreach($productos as $row)
                                    {
                                        echo '<tr class="gradeU">';
                                        echo '<td>'.$row['id'].'</td>';
                                        echo '<td>'.$row['nombre'].'</td>';
                                        echo '<td>'.$row['precio'].'</td>';
                                        echo '<td>'.$row['cantidad'].'</td>';                                            
                                        echo '<td class="crud-actions">
                                                <a href="'.site_url("admin").'/productos/update/'.$row['id'].'"class="btn btn-primary btn-sm fa fa-edit">Editar</a>  
                                                <a href="'.site_url("admin").'/productos/delete/'.$row['id'].'"class="btn btn-danger btn-sm fa fa-pencil">Borrar</a>
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