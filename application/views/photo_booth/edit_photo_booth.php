<div class="main-content">
  <div class="section-body">  
<!-- 	<?php if($this->session->flashdata('success')){ ?>  
     <div class="alert alert-success" id="flashdata-alert">  
       <a href="#" class="close" data-dismiss="alert">&times;</a>  
       <strong>Success!</strong> <?php echo $this->session->flashdata('success'); ?>  
     </div>  
   <?php } else if($this->session->flashdata('error')){ ?>  
     <div class="alert alert-danger">  
       <a href="#" class="close" data-dismiss="alert">&times;</a>  
       <strong>Error!</strong> <?php echo $this->session->flashdata('error'); ?>  
     </div>  
	 <?php }?> -->
    <?php echo form_open_multipart('C_photo_booth/update'); ?>
    <div class="card">
      <div class="card-header">
          <h2>Edit Form</h2>
      </div>
      <div class="card-body">
      <?php foreach ($background as $row) { ?>
         <input type="hidden" name="background_id" value="<?= $row->background_id ?>">
        <div class="form-group">
           <label>Name</label>
           <input type="text" name="name" class="form-control" value="<?= $row->name ?>">
        </div>
        <div class="form-group">
            <label>Thumbnail</label>
            <input type="file" name="thumbnail" class="form-control" value="">
            <input type="hidden" name="thumbnail_edit" value="<?php echo @$row->thumbnail ?>">
            <span><?= $row->thumbnail ?></span>
        </div>
        <div class="form-group">
            <label>Img Source</label>
            <input type="file" name="img_source" class="form-control" value="">
            <input type="hidden" name="img_source_edit" value="<?php echo @$row->img_source ?>">
            <span><?= $row->img_source ?></span>
        </div>
        <div class="form-group">
            <label>Icon</label>
            <input type="file" name="icon" class="form-control" value="">
            <input type="hidden" name="icon_edit" value="<?php echo @$row->icon ?>">
            <span><?= $row->icon ?></span>
        </div>
        <div class="form-grpup">
          <label>Position</label>
          <select name="position" class="form-control" value="">
              <option readonly="true">Position</option>

              <?php 

                $position = [ ['Kiri','kiri'] , ['Tengah','tengah'] , ['Kanan','kanan'] ];

                for ($i=0; $i < count($position) ; $i++) {  ?>

                <?php if ($row->position == $position[$i][1]): ?>
                  <option selected value="<?php echo $position[$i][1] ?>"><?php echo $position[$i][0] ?></option>
                <?php else: ?>
                  <option value="<?php echo $position[$i][1] ?>"><?php echo $position[$i][0] ?></option>
                <?php endif ?>

                

                <?php } ?>
          </select>
        </div>
        <div class="form-grpup">
          <label>Status</label>
          <select name="status" class="form-control" value="">
              <option readonly="true">Status</option>

              <?php 

                $status = [ ['Active','1'] , ['InActive','0'] ];

                for ($i=0; $i < count($status) ; $i++) {  ?>

                <?php if ($row->status == $status[$i][1]): ?>
                  <option selected value="<?php echo $status[$i][1] ?>"><?php echo $status[$i][0] ?></option>
                <?php else: ?>
                  <option value="<?php echo $status[$i][1] ?>"><?php echo $status[$i][0] ?></option>
                <?php endif ?>

                

                <?php } ?>
          </select>
        </div>

        <div class="modal-footer">
            <a  class="btn btn-success" href="<?= base_url('C_photo_booth/index') ?>">Back</a>   
            <button type="submit" class="btn btn-danger">Update</button>
        </div>
      <?php  } ?>
    </div>
  </div>     
  <?php form_close();  ?>
  </div>
</div>