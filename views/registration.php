<?php 

defined('_KUHUG') or die('Restricted Access.');

?>

	
		<div class="body body-s">
		
			<form action="index.php?view=registration" method="POST" name="registration" onsubmit="return validateFormRegistration();" class="sky-form">
				<header>Registration - <?php echo SITE_NAME;?></header>
				
				<fieldset>					
					<section>
						<?php showError($error, $errorMsg); showSuccess($success, $successMsg); ?>
						<label class="input">
							<i class="icon-append icon-user"></i>
							<input type="text" name="username" maxlength="8" placeholder="Roll No.">
							<b class="tooltip tooltip-bottom-right">Enter your 8-digit Roll no.</b>
						</label>
					</section>
					
					<section>
						<label class="input">
							<i class="icon-append icon-envelope-alt"></i>
							<input type="text" name="email" maxlength="100" placeholder="Email address">
							<b class="tooltip tooltip-bottom-right">Needed to verify your account</b>
						</label>
					</section>
					
					<section>
						<label class="input">
							<i class="icon-append icon-lock"></i>
							<input type="password" name="password" maxlength="10" placeholder="Password">
							<b class="tooltip tooltip-bottom-right">Password length must be 5 to 10 characters long</b>
						</label>
					</section>
					
					<section>
						<label class="input">
							<i class="icon-append icon-lock"></i>
							<input type="password" name="conpassword" maxlength="10" placeholder="Confirm password">
							<b class="tooltip tooltip-bottom-right">Enter the same password as above</b>
						</label>
					</section>
                    <section>
						<label class="input">
							<i class="icon-append icon-envelope-alt"></i>
							<input type="text" name="mobile" maxlength="10" placeholder="Mobile No.">
							<b class="tooltip tooltip-bottom-right">Needed to verify your account</b>
						</label>
					</section>
				</fieldset>
					
				<fieldset>
					<div class="row">
						<section class="col col-6">
							<label class="input">
								<input type="text" name="firstname" maxlength="50" placeholder="First name">
                                <b class="tooltip tooltip-bottom-right">Enter your first name containing 2 to 50 characters</b>
							</label>
						</section>
						<section class="col col-6">
							<label class="input">
								<input type="text" name="lastname" maxlength="50" placeholder="Last name">
                                <b class="tooltip tooltip-bottom-right">Enter your last name containing 2 to 50 characters</b>
							</label>
						</section>
					</div>
					
					<section>
						<label class="select">
							<select name="gender" placeholder="Gender">
								<?php foreach($gender as $k => $v) { ?>
									<option value="<?php echo $k; ?>"><?php echo $v;?></option>
								<?php } ?>
							</select>
							<i class="::before ::after"></i>
						</label>
					</section>
					
					<section>
						<label class="checkbox"><input type="checkbox" name="checkbox"><i></i>I agree to the Terms of Service</label>
						
					</section>
				</fieldset>
				<footer>
					<input type="hidden" name="task" value="<?php echo encode('doRegistration'); ?>"></input>
					<button type="submit" class="button">Register</button>
					<a href="index.php?view=login" class="button button-secondary">Go to Login</a>
				</footer>
			</form>
			
		</div>
	
