<?php 
defined('_KUHUG') or die('Restricted Access.');

if($innerLayout) { ?>
	<!-- ===========================
    FOOTER START
    =========================== -->    
    <footer>
        <div class="container">
            <span class="bigicon icon-speedometer "></span>
             
            <div class="footerlinks"><!-- FOOTER LINKS START -->            
                <ul>
                    <li><a href="<?php echo SITE_URL;?>index.php?view=profile">My Profile</a></li>
                    <li><a href="<?php echo SITE_URL;?>index.php?view=myads#myads">My Ads</a></li>
                    <li><a href="#services">My Favourites</a></li>
                    <li><a href="<?php echo SITE_URL;?>index.php?view=viewads#viewads">View Ads</a></li>
                    <li><a href="<?php echo SITE_URL;?>index.php?view=submitad">Submit Ad</a></li>
					<li><a href="<?php echo SITE_URL;?>index.php?view=team#ourteam">Who We Are?</a></li>
					<li><a href="<?php echo SITE_URL;?>index.php?view=termsservice#terms">Terms of Services</a></li>

                    <!--replace the email address below with your email address-->
                                  
                </ul>
            </div><!-- FOOTER LINKS END -->
             
            <div class="copyright"><!-- FOOTER COPYRIGHT START -->
                <p><a href="<?php echo SITE_URL;?>"><?php echo SITE_NAME;?></a> stands for Nit Raipur Classifieds. This is a online classifieds marketplace designed and coded by <a href="<?php echo SITE_URL;?>index.php?view=team#ourteam">Nitrr classifieds Team.</a></p>
            </div><!-- FOOTER COPYRIGHT END -->
             
            <div class="footersocial wow fadeInUp" data-wow-duration="3s"><!-- FOOTER SOCIAL ICONS START -->
                <ul>
                    <li><a target="_blank" href="https://www.facebook.com/groups/nitrr/?fref=ts"><span class="icon-social-facebook"></span></a></li>
                    <li><a target="_blank" href="https://twitter.com/hashtag/nitrr"><span class="icon-social-twitter"></span></a></li>
                    
                 </ul>
             </div><!-- FOOTER SOCIAL ICONS END -->
         </div>
     </footer><!-- FOOTER END -->
<?php }

if(count($live_js) > 0) { 
	foreach($live_js as $jv) { ?>
		<script type="text/javascript" src="<?php echo $jv;?>"></script>
	<?php }
}

if(count($lib_js) > 0) { 
	foreach($lib_js as $jk => $jv) { ?>
		<script type="text/javascript" src="<?php echo SITE_URL.JS_PATH_LIB.$jv;?>"></script>
	<?php }
}

if(count($custom_js) > 0) { 
	foreach($custom_js as $jk => $jv) { ?>
		<script type="text/javascript" src="<?php echo SITE_URL.JS_PATH_CUSTOM.$jv;?>"></script>
	<?php }
}

if($innerLayout) { ?>
	<script>new WOW().init();</script> 
<?php }	?>
	</body>
</html>