<?php 

defined('_KUHUG') or die('Restricted Access.');

?>
		<div class="body body-s">
		
			<form action="index.php?view=profile" method="POST" name="profile" onsubmit="return validateFormProfile();" class="sky-form">
				<div class="note toplink"><a href="<?php echo SITE_URL;?>">Back to Home Page</a></div>
				<header>My Profile</header>
				
				<fieldset>					
					<section>
						<?php showError($error, $errorMsg); showSuccess($success, $successMsg); ?>
						<label class="input">
							<i class="icon-append icon-user"></i>
							<input disabled="disabled" title="Roll No can not be edited." type="text" name="username" placeholder="Roll No." value="<?php echo $_SESSION['user_info']['user_rollno'];?>">
							<b class="tooltip tooltip-bottom-right">Roll No can not be edited.</b>
						</label>
					</section>
					<div class="row">
						<section class="col col-6">
							<label class="input">
								<input type="text" value="<?php echo $_SESSION['user_info']['user_fname'];?>" name="firstname" maxlength="50" placeholder="First name">
                                <b class="tooltip tooltip-bottom-right">Edit your first name containing 2 to 50 characters</b>
							</label>
						</section>
						<section class="col col-6">
							<label class="input">
								<input type="text" value="<?php echo $_SESSION['user_info']['user_lname'];?>" name="lastname" maxlength="50" placeholder="Last name">
                                <b class="tooltip tooltip-bottom-right">Edit your last name containing 2 to 50 characters</b>
							</label>
						</section>
					</div>
					<section>
						<label class="select">
							<select name="dept_id" placeholder="Branch" >
								<?php foreach($branch_category as $key => $val) { $selected = ($key == $profileData->dept_id)? ' selected="selected"':''; ?>
									<option value="<?php echo $key; ?>"<?php echo $selected;?>><?php echo $val; ?></option>
								<?php } ?>
							</select>
						<i class="::before ::after"></i>
						</label>
					</section>
					<section>
						<label class="select">
						 <?php ?>
							<select name="semester" placeholder="Semester">
							    
								<?php foreach($semesters as $val) { $selected = ($val == $profileData->semester)? ' selected="selected"':''; ?>
									<option value="<?php echo $val; ?>"<?php echo $selected;?>><?php echo $val; ?></option>
								<?php } ?>
							</select>
							<i class="::before ::after"></i>
						
						</label>
					</section>
					<section>
						<label class="input">
							<i class="icon-append icon-user"></i>
							<input type="text" name="enroll_no" placeholder="Enrollment No." maxlength="6" value="<?php echo $profileData->enroll_no; ?>">
							<b class="tooltip tooltip-bottom-right">Enter your Enrollment no.</b>
						</label>
					</section>
					
					<section>
						<label class="input">
							<i class="icon-append icon-envelope-alt"></i>
							<input type="email" name="email" placeholder="Email" value="<?php echo $_SESSION['user_info']['user_email']; ?>">
							<b class="tooltip tooltip-bottom-right">Edit your Email Address</b>
						</label>
					</section>
					
					
                    <section>
						<label class="input">
							<i class="icon-append icon-envelope-alt"></i>
							<input type="text" name="mobile" placeholder="Mobile No." value="<?php echo $_SESSION['user_info']['user_mobile']; ?>">
							<b class="tooltip tooltip-bottom-right">Edit your Mobile No.</b>
						</label>
					</section>
				</fieldset>
				<footer>
					<input type="hidden" name="task" value="<?php echo encode('SaveProfile'); ?>"></input>
					<button type="submit" class="button">Save Profile</button>
					
				</footer>
			</form>
			
		</div>