<?php 

defined('_KUHUG') or die('Restricted Access.');

?>
<div class="body body-s">
		
			<form action="index.php?view=login" method="POST" name="login" onsubmit="return validateFormlogin();"  class="sky-form">
				<header>Login - <?php echo SITE_NAME;?></header>
				
				<fieldset>
				    <section>
						<?php showError($error, $errorMsg); showSuccess($success, $successMsg); ?>
						<div class="row">
							<label class="label col col-4">Roll No.</label>
							<div class="col col-8">
								<label class="input">
									<i class="icon-append icon-user"></i>
									<input type="number" name="username" maxlength="8">
									<b class="tooltip tooltip-bottom-right">Enter your 8-digit Roll no.</b>
								</label>
							</div>
						</div>
					</section>
                    <section>
                    <div class="row">
                    <div class="col col-8" align="center">
                    
                    <b align=>OR</b>
                    </div>
                    </div>
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
					
					<section>
						<div class="row">
							<label class="label col col-4">Password</label>
							<div class="col col-8">
								<label class="input">
									<i class="icon-append icon-lock"></i>
									<input type="password" name="password">
									<b class="tooltip tooltip-bottom-right">Password length must be 5 to 10 characters long</b>
								</label>
								<div class="note"><a href="index.php?view=forgotpassword">Forgot password?</a></div>
							</div>
						</div>
					</section>
					<?php /* ?>
					<section>
						<div class="row">
							<div class="col col-4"></div>
							<div class="col col-8">
								<label class="checkbox"><input type="checkbox" name="checkbox-inline" checked=""><i></i>Keep me logged in</label>
							</div>
						</div>
					</section>
					<?php */ ?>
				</fieldset>
				<footer>
					<input type="hidden" name="task" value="<?php echo encode('doLogin'); ?>" />
					<input type="submit" name="submit" value="Log In" class="button">
					<a href="index.php?view=registration" class="button button-secondary">Register</a>
				</footer>
			</form>
			
		</div>