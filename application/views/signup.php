<?php include('include/header.php'); ?>
<div class="container">
  <div class="d-flex justify-content-center h-100">
    <div class="card-signup">
      <div class="card-header">
        <h3>Sign Up</h3>
        <div class="d-flex justify-content-end social_icon">
          <!-- <span><i class="fab fa-facebook-square"></i></span>
          <span><i class="fab fa-google-plus-square"></i></span>
          <span><i class="fab fa-twitter-square"></i></span> -->
        </div>
      </div>
      <div class="card-body">
        <form class="" method="POST" enctype="multipart/form-data" action="<?php echo base_url();?>home/signup">

          <div class="input-group form-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-user"></i></span>
            </div>
            <input type="text" id="full_name" class="form-control" name="full_name" placeholder="Full name" required>
          </div>

          <div class="input-group form-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-user"></i></span>
            </div>
            <input type="text" id="email" name="email" class="form-control" placeholder="email" required>
          </div>

          <div class="input-group form-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-key"></i></span>
            </div>
            <input type="password" id="password" name="password" class="form-control" placeholder="password" required>
          </div>

          <div class="input-group form-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-user"></i></span>
            </div>
            <input type="text" id="phone" name="phone" class="form-control" placeholder="Phone" required>
          </div>

          <div class="form-group">
            <input type="submit" id="submit" name="submit" value="Signup" class="btn float-right login_btn">
          </div>
        </form>
      </div>
      <div class="card-footer">
        <div class="d-flex justify-content-center links">
          Already have an Account?<a href="<?php echo base_url();?>home/login"">Sign In</a>
        </div>
        <div class="d-flex justify-content-center">
          <!-- <a href="#">Forgot your password?</a> -->
        </div>
      </div>
      <?php 
	      if($this->session->flashdata('message')) 
	      {
	      ?>
	      <div class="alert alert-danger" style="background-color: red; color: white;">
	        <p><?php echo $this->session->flashdata('message_detail'); ?></p>
	      </div>
	    <?php }?>
    </div>
  </div>
</div>
<?php include('include/footer.php'); ?>
