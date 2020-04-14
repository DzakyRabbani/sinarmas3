<div class="main-content">
      <section class="section">
          <div class="section-header">
            <h1>VERSION</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a ><?php echo date("D, d M Y "); ?></a></div>
            </div>
          </div>
      </section>
 	<div class="section-body">
 	<?= $this->session->flashdata('message'); ?>
      
  	    <div class="card mt-2">
                <div class="card-header" style="background:#ff0000;">
                <h4 style="color: white;">Table Version</h4>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped table-md" id = "tbl_background">
                        <thead>
		                    <tr>
		                    	<th>No</th>
		                        <th>Id_version</th>
		                        <th>Versi</th>
		                        <th>Created_at</th>
		                    </tr>
                          </thead>
                          <tbody>
                            <?php $no=1; foreach($versi as $row) :?>
                                <tr>
                                    <th><?php echo $no++?></th>
                                    <th><?php echo $row->version_id?></th>
                                    <th><?php echo $row->versi?></th>
                                    <th><?php echo $row->created_at?></th>
                                </tr>
                            <?php endforeach?>
                          </tbody>
                    </table>
                </div>
            </div>
        </div>
  </div>	
</div>

    <?php $this->load->view("asesoris/footer.php") ?>
