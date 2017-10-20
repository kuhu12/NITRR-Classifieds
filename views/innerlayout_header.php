<?php 
defined('_KUHUG') or die('Restricted Access.');

?>
<!-- Preloader -->
        <div id="preloader">           
            <div id="status">
                <div class="loadicon icon-moustache wow tada infinite" data-wow-duration="8s"></div>
            </div>
        </div>
        
       <header>               
        <!-- ===========================
        HERO AREA
        =========================== -->
        <div id="hero">           
            <div class="container herocontent">               
                <h2 class="wow fadeInUp" data-wow-duration="2s"><?php echo SITE_NAME;?></h2>                
                <h4 class="wow fadeInDown" data-wow-duration="3s"><?php echo SITE_NAME;?> operates as a NIT Raipur's online classifieds marketplace for used goods such as furniture, musical instruments, sporting goods,books,rooms & PG , motorcycles, cameras, mobile phones and much more</h4>            
            </div>        
         
            <!-- Featured image on the Hero area -->
            <img class="heroshot wow bounceInUp" data-wow-duration="4s" src="img/hero-img.jpg" alt="Featured Work">            
        </div><!--HERO AREA END--> 		
        
        <!-- ===========================
         NAVBAR START
         =========================== -->
          <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
               <div class="container">
                   
                      <div class="navbar-header">
                       <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                           <span class="sr-only">Toggle navigation</span>
                           <span class="icon-bar"></span>
                           <span class="icon-bar"></span>
                           <span class="icon-bar"></span>
                        </button>
                        
                           <a class="navbar-brand" href="<?php echo SITE_URL;?>">
                            <!-- Replace Drifolio Bootstrap with your Site Name and remove icon-grid to remove the placeholder icon -->
                            <span class="brandicon icon-grid"></span>
                            <span class="brandname"><?php echo SITE_NAME;?></span>
                        </a>
                    </div>

                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right"><!--YOUR NAVIGATION ITEMS STRAT BELOW-->
                        
                        <li><a href="<?php echo SITE_URL;?>#services"><span class="btnicon icon-cup"></span>Services</a></li
                        
                        <!--don't forget to replace my email address below with yours-->
                        
                        <li class="active"><a href="<?php echo SITE_URL;?>index.php?view=login"><span class="btnicon icon-cloud-download"></span>Logout</a></li>
                    </ul>
                
                </div><!--.nav-collapse -->
            </div>
        </nav><!--navbar end-->        
     </header><!--header end-->     
     
    <hr><!-- SECTION SEPARETOR LINE -->