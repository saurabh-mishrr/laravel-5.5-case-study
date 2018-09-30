<?php $__env->startSection('content'); ?>


<div class="container">
	<div class="row">
		<div class="col-md-4 col-md-push-4">
			<h1><?php echo e(isset($updateText) ? $updateText : "Add"); ?> Candidate</h1>
		</div>
		<div class="col-md-12">
			<?php if($message = Session::get('success')): ?>
				<div class="alert alert-success">
					<p><?php echo e($message); ?></p>
				</div>
			<?php endif; ?>
			<?php if($errors->any()): ?>
			    <div class="alert alert-danger">
			        <ul>
			            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			                <li><?php echo e($error); ?></li>
			            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			        </ul>
			    </div>
			<?php endif; ?>
		</div>
		<div class="col-md-4 col-md-push-4">
			<a href="<?php echo e(route('managecv')); ?>" class="btn btn-primary">View Candidates</a>
			<form method="post" enctype="multipart/form-data">
			  <?php echo e(csrf_field()); ?>

			  <div class="form-group">
			    <label for="exampleFormControlInput1">Name</label>
			    <input type="text" name = 'name' class="form-control" id="exampleFormControlInput1" placeholder="Name" value="<?php echo e(isset($candidates->name) ? $candidates->name : old('name')); ?>">
			  </div>
			  <div class="form-group">
			    <label for="exampleFormControlInput1">Company</label>
			    <input type="text" name = 'company'  class="form-control" id="exampleFormControlInput1" placeholder="Company" value="<?php echo e(isset($candidates->company) ? $candidates->company : old('company')); ?>">
			  </div>
			  <div class="form-group">
			    <label for="exampleFormControlInput1">Email</label>
			    <input type="text" name = 'email'  class="form-control" id="exampleFormControlInput1" placeholder="Email" value="<?php echo e(isset($candidates->email) ? $candidates->email : old('email')); ?>">
			  </div>
			  <div class="form-group">
			    <label for="exampleFormControlInput1">Hobbies</label>
			    	<?php if(!empty($candidates->hobbies)): ?>
				    	<?php
				    		$hobbies = explode(',', $candidates->hobbies);
				    		$i = 1;
				    		$moreHobbies = '';
				    	?>
					<?php endif; ?>
					<?php if(!empty($hobbies)): ?> 
						<?php $__currentLoopData = $hobbies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hobbiesVal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				    		<input type="text" name = 'hobbies[]'  class="form-control" id="exampleFormControlInput1" placeholder="Hobbies" value="<?php echo e($hobbiesVal); ?>">
				    		<?php if($i == 1): ?>
						    	<div class="input-group-append">
						    		<button type="button" class="btn btn-outline-secondary add-more-hobbies">+</button>
						    	</div>
				    		<?php endif; ?>
				    		<?php
				    		 	++$i;
				    		?>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>	
					<?php else: ?>
						<input type="text" name = 'hobbies[]'  class="form-control" id="exampleFormControlInput1" placeholder="Hobbies" value="<?php echo e(isset($candidates->hobbies) ? $candidates->hobbies : old('hobbies')); ?>">	
						<div class="input-group-append">
				    		<button type="button" class="btn btn-outline-secondary add-more-hobbies">+</button>
				    	</div>	    	
					<?php endif; ?>
			    <div class="more-hobbies-container"> </div>
			  </div>
			  <div class="form-group">
			    <label for="exampleFormControlSelect1">Qualification</label>
			    <select class="form-control" name = 'qualification'  id="exampleFormControlSelect1" value="<?php echo e(isset($candidates->qualification) ? $candidates->qualification : old('qualification')); ?>">
			      <option value="">Choose</option>
			      <option value="Graduate" <?php if(isset($candidates->qualification) && $candidates->qualification == 'Graduate'): ?> <?php echo e("selected"); ?>  <?php endif; ?>>Graduate</option>
			      <option value="Post Graduate" <?php if(isset($candidates->qualification) && $candidates->qualification == 'Post graduate'): ?> <?php echo e("selected"); ?>  <?php endif; ?>>Post Graduate</option>
			    </select>
			  </div>
			  <div class="form-group">
			    <label for="exampleFormControlFile1">Upload Resume</label>
			    <input type="file" value="<?php echo e(isset($candidates->resume) ? $candidates->resume : old('resume')); ?>" name = 'resume' class="form-control-file" id="exampleFormControlFile1">
			  </div>
			  <button type="submit" class="btn btn-primary"><?php echo e(isset($updateText) ? $updateText : "Submit"); ?></button>
			</form>
		</div>
	</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

<script type="text/javascript">
	
	$(function(){
		$('.add-more-hobbies').click(function(){
			let total_hobbies = $('input[name="hobbies"]').length;
			$('.more-hobbies-container').append('</br><input type="text" name = "hobbies[]"  class="form-control" id="exampleFormControlInput1" placeholder="Hobbies">');
		});
	})
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make("layouts.app", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>