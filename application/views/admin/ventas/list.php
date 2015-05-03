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
    //Trabajadores
    $options_trabajadores = array(0 => "Trabajador");
            
    foreach ($trabajadores as $row)
    {
      $options_trabajador[$row['id']] = $row['codigo'].' '.$row['apellidos'].' '.$row['nombres'].' '.$row['dni'];      
    }
    //Productos
    $options_productos = array(0 => "Producto");
            
    foreach ($productos as $row)
    {
      $options_producto[$row['id']] = $row['nombre'].' ['.$row['precio'].'] '.$row['cantidad'];
    }
    
    $attributes = array('class' => 'form-inline reset-margin', 'id' => 'myform');
    echo form_open('admin/ventas', $attributes);
    echo form_dropdown('trabajadores_id', $options_trabajador, 0, 'class="form-control input-sm"');
    echo '<p>';
    echo form_dropdown('productos_id', $options_producto, 0, 'class="form-control input-sm"');
    ?>
    <input type="date" id="fecha_hora_reporte" name="fecha_hora_reporte" class="input" value="<?php echo date('Y-m-d')?>">    
    <?php
    echo form_input('cantidad', '','class="form-control input-sm" placeholder="Cantidad" ', 'style="width: 170px; height: 26px;"');
    echo form_input('acuenta', '', 'class="form-control input-sm" placeholder="A Cuenta"','style="width: 170px; height: 26px;"');
    //echo form_label('Buscar:', 'search_string');
    //echo form_input('search_string', $search_string,'class="form-control input-sm"', 'style="width: 170px; height: 26px;"');
    //$data_submit = array('name' => 'mysubmit', 'class' => 'btn btn-primary', 'value' => 'Buscar');
    //echo form_submit($data_submit);
    $data_submit = array('name' => 'mysubmit', 'class' => 'btn btn-primary', 'value' => 'Nuevo');
    echo form_submit($data_submit);
    ?>
    
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
                                    <th>Ope</th>
                                    <th>Fecha-Hora</th>
                                    <th>Area</th>
                                    <th>Cliente</th>
                                    <th>DNI</th>
                                    <th>Producto</th>
                                    <th>P Unitario</th>
                                    <th>Cantidad</th>
                                    <th>Total</th>
                                    <th>A cuenta</th>
                                    <th>Saldo</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php                                    
                                    foreach($ventas as $row)
                                    {                                        
                                        echo '<tr class="gradeU">';
                                        echo '<td>'.$row['id'].'</td>';
                                        echo '<td>'.$row['fecha_hora_reporte'].'</td>';
                                        echo '<td>'.$row['area'].'</td>';
                                        echo '<td>'.$row['trabajador'].'</td>';
                                        echo '<td>'.$row['dni'].'</td>';
                                        echo '<td>'.$row['producto'].'</td>';
                                        echo '<td>'.$row['precio_unitario'].'</td>';
                                        echo '<td>'.$row['cantidad'].'</td>';
                                        echo '<td>'.$row['total'].'</td>';
                                        echo '<td>'.$row['acuenta'].'</td>';
                                        echo '<td>'.($row['total'] - $row['acuenta']).'</td>';
                                        echo '<td class="crud-actions">
                                                <a href="'.site_url("admin").'/ventas/update/'.$row['id'].'"class="btn btn-primary btn-sm fa fa-edit">Editar</a>  
                                                <a href="'.site_url("admin").'/ventas/delete/'.$row['id'].'"class="btn btn-danger btn-sm fa fa-pencil">Borrar</a>
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
