<?php
/* Template Name: Athletics Form */
?>

<!doctype HTML>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
    <head profile="http://gmpg.org/xfn/11">
    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type') ?>; charset=<?php bloginfo('charset') ?>" />
    <title><?php wp_title( '|', true, 'right' ); bloginfo( 'name' ); ?></title>

    <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('template_url'); ?>/style.css" />
    <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('template_url'); ?>/athletics_form/form_styles.css" />
    
    <link href='http://fonts.googleapis.com/css?family=Inder|Carme' rel='stylesheet' type='text/css' />
    <script src="http://code.jquery.com/jquery-latest.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/css/jquery.fancybox.css" media="screen" />

    <script src="<?php bloginfo('template_url'); ?>/js/jquery.tools.min.js" type="text/javascript"></script>
    <script src="<?php bloginfo('template_url'); ?>/js/jquery.bxSlider.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery.fancybox.js"></script>
    <script type="text/javascript" src="<?php bloginfo('template_url'); ?>/athletics_form/form_scripts.js"></script>

    <?php wp_head(); ?>

</head>
<body>
    <div class="wrapper">
        <!--GLOBAL NAVIGATION HOLDER-->
        <div id="global_navigation_holder">
            <div id="global_navigation">
                <!--FOUNDATION LOGO-->
                <div id="foundation_logo"><a href="http://www.uifoundation.org"><img src="http://www3.uifoundation.org/inspire/wp-content/themes/annual-report/images/uif-banner-small.gif" border="0" /></a></div>
                
                <!--FOUNDATION NAVIGATION-->
                <ul>
                     <li><strong><a  href="http://www.givetoiowa.org/" target="_blank">Give Now</a></strong></li>&nbsp;|&nbsp;
                    <li><a href="http://www.uifoundation.org/about/" target="_blank">About the Foundation</a></li>&nbsp;|&nbsp;
                    <li><a href="http://www.uifoundation.org/thanks/" target="_blank">Recognition and Thanks</a></li>&nbsp;|&nbsp;
                    <li><a href="http://www.uifoundation.org/ways/" target="_blank">Ways to Give</a></li>
                </ul>
                <!--CLEAR-->
                <div class="clear"></div>
            </div>
        </div>    <!--END GLOBAL NAVIGATION HEADER-->
        <!--BEGIN WRAPPER-->
        <div id="content_wrapper">
            <!--CONTENT NAVIGATION-->
            <div id="content_navigation">
                <h2><a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></h2>
                <!--NAVIGATION-->
                <ul>
                    <?php mytheme_nav(); ?>
                </ul>
            </div><!--END CONTENT NAVIGATION-->
            
            <!--BEGIN CONTENT HOLDER-->
            <div id="content_holder">
            <? if (is_home() && strpos($_SERVER['REQUEST_URI'], "/page/") === false): ?>
                <!--BEGIN FEATURE IMAGE HOLDER-->
                <div id="featured_image_holder">
                    <ul id="slider">        	
                        <li><img src="<?php bloginfo('template_url'); ?>/images/main_image.jpg" width="960" height="450" title="<h2>Iowa Football Complex</h2><p>We like chicken</p>" /></li>
                        <li><img src="<?php bloginfo('template_url'); ?>/images/main_image2.jpg" width="960" height="450" title="<h2>Iowa Football Complex</h2><p>What's for dinner</p>" /></li>
                        <li><img src="<?php bloginfo('template_url'); ?>/images/main_image2.jpg" width="960" height="450" title="<h2>Iowa Football Complex</h2><p>What's for dinner</p>" /></li>
                        <li><img src="<?php bloginfo('template_url'); ?>/images/main_image3.jpg" width="960" height="450" title ="<h2>Iowa Football Complex</h2><p>I race cars really fast</p>"/></li>
                    </ul>
                </div><!--END FEATURE IMAGE HOLDER-->
            <?php endif;?>
            <!--LEFT CONTENT HOLDER-->
            <div class="left_content_holder">        
                <!-- WP CONTENT-->
                 <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <h3><?php the_title(); ?></h3>
                    <?php the_content(); ?>
                  <?php endwhile; endif; ?>  
                <!--ATHLETICS FORM-->
                <?php require_once 'wp-content/themes/football/athletics_form/form.php'; ?>
            </div><!--END LEFT CONTENT HOLDER-->
            <?php get_sidebar() ?>

            </div><!--END CONTENT HOLDER-->
            <!--CLEAR-->
            <div class="clear"></div>
        </div>
        <div class="push"></div>
    </div>
    <!--BEGIN FOOTER-->
    <div class="footer">
        <!--FOOTER HOLDER-->
        <div id="footer_holder">
            <!--NOTICE-->
            <div id="footer_left">
                <p><strong>NOTICE:</strong> The State University of Iowa Foundation is a 501(c)(3) tax-exempt organization soliciting tax-deductible private contributions for the benefit of The University of Iowa. Please                review its <a href="http://www.uifoundation.org/about/disclosures/">full disclosure statement.</a></p>
            </div>
            <!--END NOTICE-->

            <!--FOUNDATION ADDRESS-->
            <div id="footer_right">
                <p><strong><a href="/">The University of Iowa Foundation</a></strong> | P.O. Box 4550 | Iowa City, Iowa 52244 | <a href="http://maps.google.com/maps?source=embed&amp;hl=en&amp;q=levitt+center+for+university+advancement&amp;ie=UTF8&amp;sll=41.670925,-91.539375&amp;sspn=18.860078,38.809454&amp;ei=DyKBSc3_NIfSM7za9ZIL&amp;sig2=ehhzM_cjc2Bd2wFS-D1QUA&amp;cd=1&amp;cid=41670925,-91539375,13894139055214442334&amp;li=lmd&amp;ll=41.670925,-91.539375&amp;spn=0.006295,0.006295&amp;iwloc=A">Directions</a><br />
                (319) 335-3305 / (800) 648-6973 | <a href="http://www.uifoundation.org/contact/">Contact Us</a> | <a href="http://www.uifoundation.org/about/privacy/">Privacy Policy</a> | <a href="http://www.givetoiowa.org/">Give Online Now</a><br />
                &copy; 1996-2011 | <a href="http://www.uifoundation.org/about/site/ ">Trouble viewing this site?</a> | <a href="mailto:uiowa-foundation@uiowa.edu?subject=Help: uifoundation.org ">Questions?</a></p>
                </div>
            <!--END FOUNDATION ADDRESS-->

            <div class="clear"></div>
        </div><!--END FOOTER HOLDER-->
    </div> <!--END FOOTER-->

    <script type="text/javascript">
        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-9499432-1']);
        _gaq.push(['_trackPageview']);

        (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
        })();
    </script>

    <?php wp_footer(); ?>
</body>
</html>