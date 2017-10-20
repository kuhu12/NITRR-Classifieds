<?php 
defined('_KUHUG') or die('Restricted Access.');
?>
<div class="body body-s">
		
			<form action="index.php?view=resetpassword" method="POST" name="resetpassword" onsubmit="return validateFormResetPassword();" class="sky-form">
				<header>Reset Password - <?php echo SITE_NAME;?></header>
				
				<fieldset>
				    <section>
						<?php showError($error, $errorMsg); showSuccess($success, $successMsg); ?>
						<div class="row">
						
			               <section>
				              <p align="center">Enter the confirmation code that has already been sent to your mail.</p>
			               </section>
		                
							<label class="label col col-4">Confirmation code</label>
							<div class="col col-8">
								<label class="input">
									<i class="icon-append icon-user"></i>
									<input type="text" name="confirmationtoken" maxlength="25">
									<b class="tooltip tooltip-bottom-right">Enter your Confirmation Code</b>
								</label>
							</div>
						</div>
					</section>
                    
					
					<section>
						<div class="row">
							<label class="label col col-4">New Password</label>
							<div class="col col-8">
								<label class="input">
									<i class="icon-append icon-lock"></i>
									<input type="password" name="password" maxlength="10">
									<b class="tooltip tooltip-bottom-right">Password length must be 5 to 10 characters long</b>
								</label>
							</div>	
						</div>
					</section>
					<section>
						<div class="row">
							<label class="label col col-4">Confirm Password</label>
							<div class="col col-8">
								<label class="input">
									<i class="icon-append icon-lock"></i>
									<input type="password" name="conpassword" maxlength="10">
									<b class="tooltip tooltip-bottom-right">Enter the same password as above</b>
								</label>
							</div>	
						</div>
					</section>
					
					
				</fieldset>
				<footer>
					<input type="hidden" name="task" value="<?php echo encode('doResetPassword'); ?>"></input>
					<button type="submit" class="button">Submit</button>
					<a href="index.php?view=login" class="button button-secondary">Go to Login</a>
				</footer>
			</form>
			
	</div>