<div class="main-content">
      <section class="section">
          <div class="section-header">
            <h1>SINARMAS LAND</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a ><?php echo date("D, d M Y "); ?></a></div>
            </div>
          </div>
      </section>
 	<div class="section-body">
 	<?= $this->session->flashdata('message'); ?>
      <div style="margin-top: 50px; ">
      	<button class="btn btn-danger" data-toggle="modal" data-target="#insert"><i class="fas fa-plus fa-sm"></i> Add Data</button>
      </div>
  	    <div class="card mt-2">
                <div class="card-header" style="background:#ff0000;">
                <h4 style="color: white;">Table Background</h4>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">

				<table class="table table-striped table-md" id = "tbl_versi">
                        <thead>
						<tr>
		                    	<th>No</th>
		                        <th>Name</th>
		                        <th>Img Source</th>
		                        <th>Update</th>
		                        <th>Status</th>
		                        <th>Created-At</th>
		                        <th>Modified-At</th>
		                        <th>Action</th>
		                    </tr>
                          </thead>
                          <tbody>
						  <?php 
                       		$no = 1;
                       		foreach ($background as $row): ?>
	                        <tr>
	                            <td><?= $no++; ?></td>
	                            <td><?= $row->name; ?></td>
	                            <td><img src="<?= base_url();?>assets/img/background/<?= $row->img_source ?>" class="img-thumbnail" width="80"></td>
                              <?php if($row->update == 1): ?>
	                            <td>Yes</td>
                              <?php else : ?>
                              	<td>No</td>	
                              <?php endif ?>
                              <?php if ($row->status == 1): ?>
	                            <td>Active</td>
                              <?php else : ?>
                              	<td>Inactive</td>
                              <?php endif ?>
	                            <td><?= $row->created_at; ?></td>
	                            <td><?= $row->modified_at; ?></td>
	                            <td><?= anchor('C_photo_booth/edit/' .$row->background_id , '<div class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></div>')  ?>
								<a onclick="javascript: return confirm('Anda Yakin Mau Menghapus')" href="<?= site_url('C_photo_booth/delete/').$row->background_id  ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>  
								</td>
	                        </tr>
                        	<?php endforeach ?>
                          </tbody>
                    </table>

                    <!-- <table class="table table-striped table-md" id="tbl_versi">
                        <thead>
		                    <tr>
		                    	<th>No</th>
		                        <th>Name</th>
		                        <th>Img Source</th>
		                        <th>Update</th>
		                        <th>Status</th>
		                        <th>Created-At</th>
		                        <th>Modified-At</th>
		                        <th>Action</th>
		                    </tr>
						</thead>
						<tbody>
                       		<?php 
                       		$no = 1;
                       		foreach ($background as $row): ?>
	                        <tr>
	                            <td><?= $no++; ?></td>
	                            <td><?= $row->name; ?></td>
	                            <td><img src="<?= base_url();?>assets/img/background/<?= $row->img_source ?>" class="img-thumbnail" width="80"></td>
                              <?php if($row->update == 1): ?>
	                            <td>Yes</td>
                              <?php else : ?>
                              	<td>No</td>	
                              <?php endif ?>
                              <?php if ($row->status == 1): ?>
	                            <td>Active</td>
                              <?php else : ?>
                              	<td>Inactive</td>
                              <?php endif ?>
	                            <td><?= $row->created_at; ?></td>
	                            <td><?= $row->modified_at; ?></td>
	                            <td><?= anchor('C_photo_booth/edit/' .$row->background_id , '<div class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></div>')  ?>
								<a onclick="javascript: return confirm('Anda Yakin Mau Menghapus')" href="<?= site_url('C_photo_booth/delete/').$row->background_id  ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>  
								</td>
	                          <td>
                              
                            </td>
	                        </tr>
                        	<?php endforeach ?>
                      	</tbody>
                    </table> -->
                </div>
            </div>
        </div>
  </div>	
</div>
<div class="modal fade" id="insert" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">FORM INPUT USER</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <form action="<?= base_url(). 'C_photo_booth/insert_action'; ?>" method="post" enctype="multipart/form-data">
       		
       		<div class="form-group">
       			<label>Name</label>
       			<input type="text" name="name" class="form-control" required="true">
			</div>
			<div class="form-group">
       			<label>Thumbnail</label>
       			<input type="file" name="thumbnail" class="form-control" required="true">
       		</div>
       		<div class="form-group">
       			<label>Img Source</label>
       			<input type="file" name="img_source" class="form-control" required="true">
			</div>
			 <div class="form-group">
       			<label>Icon</label>
       			<input type="file" name="icon" class="form-control" required="true">
			   </div>
			   <div class="form-group">
       			<label>Position</label>
       			<select class="form-control" name="position">
       				 <option value="kiri" >Kiri</option>
					 <option value="tengah">Tengah</option>
				     <option value="kanan">Kanan</option>
       			</select>
       		</div>
       		<div class="form-group">
       			<label>Status</label>
       			<select class="form-control" name="status">
       				<option value="1" >Active</option>
       				<option value="0">InActive</option>
       			</select>
       		</div>
		      <div class="modal-footer">
		        <button type="submit" class="btn btn-danger">Save</button>
		      </div>
		</form>
    </div>
  </div>
</div> 

<?php $this->load->view("asesoris/footer.php") ?>