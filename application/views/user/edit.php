<div class="container">

    <h2>Update User</h2>
    <?php if($this->session->flashdata('error')){ ?>
    	<div class="alert alert-warning" role="alert">
	    	<?php echo $this->session->flashdata('error') ?>
	    </div>
	<?php } ?>
	<form role="form" method="post" action="<?php echo base_url('user/editUserPost')?>" enctype="multipart/form-data">

		<input type="hidden" value="<?php echo $user[0]->id ?>" name="user_id">


		<div class="form-group">
            <label for="username">Username:
            <?php echo $user[0]->username ?></label>
			<!-- <input type="hidden" value="<?php echo $user[0]->username ?>" class="form-control" id="username"
				name="username"> -->
        </div>
        
        
		<div class="form-group">
			<label for="email">Email: <?php echo $user[0]->email ?></label>
			<!-- <input type="email" value="<?php echo $user[0]->email ?>" class="form-control" id="email" name="email"> -->
        </div>
        <br><br>
		<div class="form-group">
			<label for="firstname">Firstname:</label>
			<input type="text" value="<?php echo $user[0]->firstname ?>" class="form-control" id="firstname"
				name="firstname">
		</div>
		<div class="form-group">
			<label for="lastname">Lastname:</label>
			<input type="text" value="<?php echo $user[0]->lastname ?>" class="form-control" id="lastname"
				name="lastname">
        </div>
        <div class="form-group">
            <label for="password">Change Password:</label>
			 <input type="password" value="" class="form-control" id="password"
				name="password"> 
        </div>
		<div class="form-group">
			<?php $actives=json_decode($user[0]->active); ?>
			<label for="active">Active:</label>

			<input type="checkbox" name="active" value="checked" <?php if($actives){ echo "checked"; } ?>> 
        </div>

       
        

        <div class="space-50"></div>
        <a href="<?php echo base_url('/user') ?>" class="btn btn-warning">Back </a>
		<button type="submit" class="btn btn-primary">Submit</button>
	</form>
</div>
