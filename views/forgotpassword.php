<?php 
defined('_KUHUG') or die('Restricted Access.');
?>
<div class="body body-s">
		
			<form action="index.php?view=forgotpassword" method="POST" name="forgotpassword" onsubmit="return validateFormForgotPassword();" class="sky-form">
				<header>Forgot Password - <?php echo SITE_NAME;?></header>
				
				<fieldset>
					<section>
					<?php showError($error, $errorMsg); ?>
					<label align="center">Please enter your e-mail address. You will receive an e-mail containing a confirmation code which can be used to reset your password.</label>
					</section>
					<section>
						<div class="row">
							<label class="label col col-4">E-mail</label>
							<div class="col col-8">
								<label class="input">
									<i class="icon-append icon-envelope-alt"></i>
									<input type="email" name="email" maxlength="100">
									<b class="tooltip tooltip-bottom-right">Enter your email address</b>
								</label>
							</div>
						</div>
					</section>
					
				</fieldset>
				<footer>
					<input type="hidden" name="task" value="<?php echo encode('doForgotPassword'); ?>"></input>
					<button type="submit" class="button">Submit</button>
				</footer>
					
					
					
			</form>
			
		</div>