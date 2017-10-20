<?php 
defined('_KUHUG') or die('Restricted Access.');

callInnerLayoutHeader();
?>
 <!-- ===========================
    SERVICE SECTION START
    =========================== -->
    <div id="services" class="container">
       
        <!-- SERVICE SECTION HEADING START -->
        <div class="sectionhead  row wow fadeInUp">
            <span class="bigicon icon-cup "></span>
            <h3>This is what I can do for you</h3>
            <hr class="separetor">
         </div><!--SERVICE SECTION HEADING END-->
         
        <!-- SERVICE ITEMS START -->
        <div class="row">
               <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-duration="3s">
                   <a href="<?php echo SITE_URL;?>index.php?view=profile">
					<img src="img/s1.png" alt="">
					<h4>My Profile</h4>
					<p>View and Edit your Pofile</p>
				   </a>
                </div> <!-- ITEM END -->

                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-duration="3s">
                    <a href="<?php echo SITE_URL;?>index.php?view=myads#myads">
				   <img src="img/s2.png" alt="">
                   <h4>My Ads</h4>
                   <p>View and Edit your Ads</p>
				   </a>
                </div> <!-- ITEM END -->

                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-duration="3s">
                   <img src="img/s6.png" alt="">
                   <h4>My Favourites</h4>
                   <p>View Ads marked as Favourites by you</p>
                </div> <!-- ITEM END -->

               <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-duration="3s">
                   <a href="<?php echo SITE_URL;?>index.php?view=viewads#viewads">
				   <img src="img/s4.png" alt="">
                   <h4>View Ads</h4>
                   <p>View Ads under various categories</p>
				   </a>
                </div> <!-- ITEM END -->

                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-duration="3s">
                   <a href="<?php echo SITE_URL;?>index.php?view=submitad">
				   <img src="img/s3.png" alt="">
                   <h4>Submit Ad</h4>
                   <p>Submit your own Ad</p>
				   </a>
                </div> <!-- ITEM END -->

                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-duration="3s">
                   <a href="<?php echo SITE_URL;?>index.php?view=team#ourteam">
				   <img src="img/s5.png" alt="">
                   <h4>Who We Are?</h4>
                   <p>Team of Nitrr Classifieds</p>
				   </a>
                </div> <!-- ITEM END -->
        </div><!-- SERVICE ITEMS END-->
    </div><!-- SERVICE SECTION END -->