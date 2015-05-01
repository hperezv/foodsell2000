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

    <h2>Listado de trabajadores</h2>
    <div style="text-align:center;">
    <button type="button" class="btn btn-success" title="Exportar a Excel" onclick="window.location='<?php echo base_url()?>admin/reportes';">Exportar a Excel</button>
