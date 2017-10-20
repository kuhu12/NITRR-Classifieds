<?php 

defined('_KUHUG') or die('Restricted Access.');

?>
		<div class="body body-s">
		
			<form action="index.php?view=submitad" method="POST" name="submitad" onsubmit="return validateFormSubmitAd();" class="sky-form">
				<div class="note toplink"><a href="<?php echo SITE_URL;?>">Back to Home Page</a></div>
				<header>Submit Ad</header>
				
				<fieldset>					
					<section>
						<?php showError($error, $errorMsg); showSuccess($success, $successMsg); ?>
						<label class="input">
							
							<input type="text" name="adtitle" maxlength="100" placeholder="Ad Title" value="<?php echo $Ad_title;?>">
							<b class="tooltip tooltip-bottom-right">Give your ad an attractive title in 15 to 100 characters.You can use only these special characters(+ - & * () , .) </b>
						</label>
					</section>
					<section>
						<label class="select">
							<select name="category" placeholder="Ad Category">
								<?php foreach($parent_category as $val) { ?>
									<optgroup label="<?php echo $all_category[$val] ?>">
										<?php foreach($child_category[$val] as $v) { $selected = ($v == $Ad_category)? ' selected="selected"':'';?>
											<option value="<?php echo $v; ?>"<?php echo $selected; ?>><?php echo $all_category[$v];?></option>
										<?php } ?>
									</optgroup>
								<?php } ?>
							</select>
							<i class="::before ::after"></i>
						</label>
					</section>
					
					<section>
						<label class="textarea">
							
							<textarea rows="5" cols="60" name="addescription" maxlength="200" placeholder="Ad Description"><?php echo $Ad_description;?></textarea>
							<b class="tooltip tooltip-bottom-right">Include the brand,model,age and any included accessories in 50  to 200 characters.You can use only these special characters(+ - & * () , .)</b>
						</label>
					</section>
					
					<section>
						<label class="input">
							
							<input type="text" name="price" maxlength="6" placeholder="Price" value="<?php echo $Ad_price;?>">
							<b class="tooltip tooltip-bottom-right">Give the price of the product.The price may range from Re.1 to Rs.500000.</b>
						</label>
					</section>
					<section>
						<p>Negotiable?</p>
						<label class="select">
							<select name="negotiable">
								<?php echo getChoiceOptions($Ad_negotiable); ?>
							</select>
							<i class="::before ::after"></i>
						</label>
					</section> 
					<section>
						<p>Published?</p>
						<label class="select">
							<select name="published">
								<?php echo getChoiceOptions($Ad_published); ?>
							</select>
							<i class="::before ::after"></i>
						</label>
					</section> 
				</fieldset>
					
				
				<footer>
					<input type="hidden" name="task" value="<?php echo encode('doSubmitAd'); ?>"></input>
					<?php if($adID > 0) { ?><input type="hidden" name="sdg" value="<?php echo encode($adID);?>"><?php } ?>
					<button type="submit" class="button">Submit</button>
				</footer>
			</form>
			
		</div>
	
