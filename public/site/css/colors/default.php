<?php
header("Content-Type:text/css");
$primary = "#d92626"; // Change your Color Here
$secondary = "#ffda23"; // Change your Color Here

if (isset($_GET['primary']) && $_GET['primary'] != '') {
    $primary = $_GET['primary'];
}

if (isset($_GET['secondary']) && $_GET['secondary'] != '') {
    $secondary = $_GET['secondary'];
}
?>

/* Style ( default color ) d92626 ffda23 ----<?php echo $primary; ?>-----<?php echo $secondary; ?>-----------------------------
-----------------------------------------------------------------------------*/
h1,h2,h3,h4,h5,h6          { color: #333;}
pre                        { border: 1px solid #eae9e9; background-color: #FFF;}
input[type="email"],
input[type="number"],
input[type="search"],
textarea,
input[type="text"],
input[type="tel"],
input[type="url"],
input[type="password"]     { border:2px solid #d5d6d8; color:#333;  }


/*-----------------------------------------------------------------------------
----------------------------- 1 - Layout --------------------------------------
-----------------------------------------------------------------------------*/
a:link, a:visited          { color: #000; text-decoration: none; }
a:hover                    { color: <?php echo $primary; ?>; }
::-moz-selection           { background:#000; color: #fff; text-shadow: none; }
::selection                { background:#000; color: #fff; text-shadow: none; }
/* -- Header -- */
html body                  { color: #080e14; background-color: #fafafa; background: linear-gradient(to right, #fafafa , #fafafa); }
header                     { background: <?php echo $primary; ?>; background: linear-gradient(to right, <?php echo $primary; ?> , #27313b); }
/* - Layout content - */
.wrap-fullwidth-bg         { background-color: #FFF; border: 1px solid #f1f1f1;}
/* .page-content */
.single-content            { background-color: #FFF; border: 1px solid #f1f1f1;}
.wrap-content              { background-color: #FFF; -moz-box-shadow: 0 1px 2px rgba(0,0,0,0.1); -webkit-box-shadow: 0 1px 2px rgba(0,0,0,0.1); box-shadow: 0 1px 2px rgba(0,0,0,0.1);}


/*-----------------------------------------------------------------------------
----------------------------- 2 - Header --------------------------------------
-----------------------------------------------------------------------------*/
/* -- Top social icons -- */
ul.top-social                { background-color: #000;}
.top-social li a             { color: #FFF;}
.top-social li a i           { color: #3f677a; }
.top-social li a i.fa-facebook-f { color: #768bb7; }
.top-social li a i.fa-twitter { color: #a2d9f2; }
.top-social li a i.fa-pinterest { color: #ea4e56; }
.top-social li a i.fa-google-plus-g { color: #e3826d; }
.top-social li a i.fa-instagram { color: #5383a6; }
.top-social li a i.fa-vk { color: #8ca3bd; }
.top-social li a i.fa-xing { color: #d8e147; }
.top-social li a i.fa-youtube { color: #e85e57; }
.top-social li a i.fa-dribbble { color: #ee92b6; }
.top-social li a i.fa-vimeo-v { color: #76cafa; }
.top-social li a i.fa-soundcloud { color: #fa8247; }

/* -- Search Header (menu) -- */
#searchform2 .buttonicon   { background-color: #fff; color: #31363a; }
#searchform2 #s            { background-color: #FFF; border: 1px solid #f1f1f1; border-left-color: #FFF; color: #000 !important;}

/* -- Live Search -- */
ul.search_results li:hover { background-color: #f2f2f2 !important; }
ul.search_results          { -moz-box-shadow: 0 0 5px #999 !important; -webkit-box-shadow: 0 0 5px #999 !important; box-shadow: 0 0 5px #999 !important;}

/* -- Top Header Menu -- */
ul.ant-responsive-menu li.current_page_item > a,
ul.ant-responsive-menu li.current-menu-ancestor > a,
ul.ant-responsive-menu li.current-menu-item > a,
ul.ant-responsive-menu li.current-menu-parent > a { color: #000; background: <?php echo $secondary; ?>;  }
ul.ant-responsive-menu li.current_page_item > a > .arrow:before,
ul.ant-responsive-menu li.current-menu-ancestor > a > .arrow:before,
ul.ant-responsive-menu li.current-menu-item > a > .arrow:before,
ul.ant-responsive-menu li.current-menu-parent > a > .arrow:before { color: <?php echo $secondary; ?> !important; }
#respMenu li ul.sub-menu li.current_page_item a,
#respMenu li ul.sub-menu li.current-menu-ancestor a,
#respMenu li ul.sub-menu li.current-menu-item a,
#respMenu li ul.sub-menu li.current-menu-parent a,
#respMenu li ul.sub-menu,
#respMenu li ul.sub-menu a,
#respMenu li ul.sub-menu li { background-color: #FFF !important;}

/*Top level menu link items style*/
.ant-responsive-menu > li > a > .arrow:before { color: #FFF !important; }
.ant-responsive-menu li i { color: <?php echo $secondary; ?>; }
.ant-responsive-menu li a { color: #FFF; }
.ant-responsive-menu li a:hover { color: #000 !important; background: #FFF; text-decoration: none !important; }
.ant-responsive-menu li:hover a { color: #000 !important; background-color: #FFF; text-decoration: none !important; border-radius: 3px;}
.ant-responsive-menu li ul li a { color:#000; }
.ant-responsive-menu li ul li ul li a { color:#000;}
/*1st sub level menu*/
.ant-responsive-menu li ul { background-color: #FFF;}
.ant-responsive-menu li ul li ul { background-color: #FFF;}
.ant-responsive-menu li ul li { background-color: #FFF; }
/* Sub level menu links style */
.ant-responsive-menu li ul li:hover { color: #000 !important;}
.ant-responsive-menu li ul li a:hover { opacity: 0.5; color: #000 !important;}
/* -- Responsive Menu Styles -- */
@media screen and (max-width: 980px) {
	ul.ant-responsive-menu li.current_page_item > a,
	ul.ant-responsive-menu li.current-menu-ancestor > a,
	ul.ant-responsive-menu li.current-menu-item > a,
	ul.ant-responsive-menu li.current-menu-parent > a,
	ul.ant-responsive-menu li ul li.current_page_item > a,
	ul.ant-responsive-menu li ul li.current-menu-ancestor > a,
	ul.ant-responsive-menu li ul li.current-menu-item > a,
	ul.ant-responsive-menu li ul li.current-menu-parent > a,
	.ant-responsive-menu li a:hover,
	.ant-responsive-menu li:hover a { background: transparent; color: #FFF !important;}
	.ant-responsive-menu { background: #000; box-shadow: 0 0 5px #999 !important; -moz-box-shadow: 0 0 5px #999 !important; }
	.ant-responsive-menu li ul li ul { background-color: #000 !important;}
	.ant-responsive-menu li ul li    { background: #000 !important; }
	.ant-responsive-menu li ul li ul li ul { background: #000 !important;}
	.ant-responsive-menu li ul li ul li    { background: #000 !important; }
	.ant-responsive-menu li ul.sub-menu li a { border-bottom: 1px solid #111; color: #FFF !important; }
	.ant-responsive-menu li ul li:hover   { color: #FFF !important;}
	.ant-responsive-menu li ul li:hover a { background-color: #000 !important; color: #FFF !important;}
	.ant-responsive-menu li ul            { border: 1px solid #000; background-color: #000 !important;}
    .ant-responsive-menu > li             { border-bottom: 1px solid #111; }
    .ant-responsive-menu li ul li a:hover { background-color: #000 !important; color: #FFF !important;}
    .ant-responsive-menu > li > a         { color: #FFF !important; }
	#respMenu li ul.sub-menu li.current_page_item a,
	#respMenu li ul.sub-menu li.current-menu-ancestor a,
	#respMenu li ul.sub-menu li.current-menu-item a,
	#respMenu li ul.sub-menu li.current-menu-parent a,
	#respMenu li ul.sub-menu,
	#respMenu li ul.sub-menu a,
	#respMenu li ul.sub-menu li { background-color: #000 !important;}
}


/*-----------------------------------------------------------------------------
----------------------------- 3 - Home Content --------------------------------
-----------------------------------------------------------------------------*/
/* -- Home Featured Posts -- */
#featured-posts-section  { background: linear-gradient(to right, <?php echo $primary; ?> , #27313b);}
ul.featured-home-posts li div.inner-small h2 span { color: #fbda59; }
ul.featured-home-posts li h2 span { color: #fbda59; }
ul.featured-home-posts li div.bou-date i { color: <?php echo $secondary; ?>;}
ul.featured-home-posts li div.post-views i { color: <?php echo $primary; ?>;}

/* - Categories ribbon - */
.article-category a              { color: #FFF !important;  background-color: <?php echo $primary; ?>; }

/* -- Blog Style -- */
ul.grid_list li         { background-color: #fafafa; background: linear-gradient(to right, #fafafa , #ffffff);}
ul.grid_list li a h2    { color: #222; }
ul.grid_list li .content-grid i { color: <?php echo $primary; ?>; }
ul.grid_list li ul li   { background: transparent;}
ul.grid_list li div.post-views i { color: <?php echo $primary; ?>; }

/* -- Title Home / Modules -- */
div.content-modules     { background-color: #f8f8f8;}
h3.title-homepage       { background-color: <?php echo $secondary; ?>; color: #000; }
div.content-modules h3.title-homepage { background-color: <?php echo $secondary; ?>; color: #000; }

/* -- Module Topics -- */
ul.modern-topics h4     { background-color: #000; color: <?php echo $secondary; ?>; }
ul.modern-topics div.topicname a { background-color: #000; color: <?php echo $secondary; ?>;}
ul.modern-list li div.post-views i { color: <?php echo $primary; ?>; }

/* -- Module Grid -- */
ul.module-grid li div.post-views i { color: <?php echo $primary; ?>; }
ul.module-grid li div.bou-date i { color: <?php echo $secondary; ?>;}

/* - Like & unlike - */
.thumbs-rating-already-voted   { color: #F00 !important; }
.thumbs-rating-container .thumbs-rating-up,
.thumbs-rating-container .thumbs-rating-up i { color: #27313b !important; }
.thumbs-rating-container .thumbs-rating-down,
.thumbs-rating-container .thumbs-rating-down i { color: <?php echo $primary; ?> !important; }

 /* -- Icons -- */
 ul.meta-icons-home li.sticky-lm   { background-color: #27313b; }
.sticky-lm .tooltiptext { background-color: #27313b; }
.sticky-lm .tooltiptext::after { border-color: transparent transparent #27313b transparent; }

/* -- Sticky Posts style -- */
ul.grid_list li.sticky { background-color: #f1f1f1; background: linear-gradient(to right, #ebebeb , #ffffff);}

/* -- Pagination -- */
.wp-pagenavi a, .wp-pagenavi span, .wp-pagenavi .disabled a:hover { background-color: #191919; color: #FFF;  }
.wp-pagenavi .active a { background-color: <?php echo $secondary; ?> !important; }
.wp-pagenavi a:hover { color: #000 !important; background-color: <?php echo $secondary; ?>;}
.wp-pagenavi span.current { background-color: <?php echo $secondary; ?>; color: #000 !important; }


/*-----------------------------------------------------------------------------
----------------------------- 4 - Entry Content -------------------------------
-----------------------------------------------------------------------------*/

/* -- Archive-header -- */
h3.index-title          { border-bottom: 2px solid <?php echo $secondary; ?>; }
.wrap-content .title-home-circle i { color: <?php echo $secondary; ?>; }

/* ##### Related articles single #####
################################## */
.single-related           { background-color: #f8f8f8; }
.single-related h3        { border-bottom: 2px solid <?php echo $secondary; ?>;}
.one_half_last_sr .title-home-circle i { color: <?php echo $secondary; ?>;}

/* -- Page / Article Title -- */
h1.article-title           { color: <?php echo $primary; ?>; }
.entry h1.page-title       { color: <?php echo $primary; ?>; border-bottom: 5px solid #f2f2f2; }

/* -- Entry bottom -- */
.single-content h3.title   { color: #000 !important; background-color: <?php echo $secondary; ?>; }

/*-- Entry button -- */
.entry-btn                 { background-color: <?php echo $secondary; ?>; color: #000 !important;  }

/* -- Prev and Next articles --*/
.prev-articles             { background-color: #FFF; }

/* -- blockquote -- */
blockquote                 { background: #f8f8f8; border-left: 10px solid <?php echo $secondary; ?>; }

/* -- Entry content style -- */
.entry p a        { color: <?php echo $primary; ?>; }
.entry p a:hover  { color: #000 !important; }

/* -- Responsive Images -- */
.wp-caption-text           { color: #888;}
.entry .wp-caption-text a         { color: #000 !important; }
.wp-caption-text a:hover   { color: #000 !important; }

/* -- Pagination entry articles -- */
.my-paginated-posts span { background-color: <?php echo $secondary; ?>; color: #000 !important;}
.my-paginated-posts p a  { background-color: #222; color:#fff !important;}
.my-paginated-posts p a:hover { color:#fff !important; }
.my-paginated-posts p span a  { color: #FFF !important;}


/*-----------------------------------------------------------------------------
----------------------------- 5 - Sidebar & Widgets ---------------------------
-----------------------------------------------------------------------------*/

/* -- Sidebar -- */
.sidebar h3.title { border-bottom: 2px solid <?php echo $secondary; ?>; color: #000; }
.sidebar .widget  {  background-color: #FFF; border: 1px solid #f1f1f1; }
.sidebar .title-home-circle i { color: <?php echo $secondary; ?>;}

/* -- FeedBurner -- */
div.feed-info i        { color: <?php echo $secondary; ?>;}
div.feed-info strong   { border-bottom: 1px solid <?php echo $secondary; ?>;}
#newsletter-form input.newsletter  { border:1px solid #d5d6d8; color:#333; }
#newsletter-form input.newsletter-btn  { color: #000; background-color: <?php echo $secondary; ?>; }

/* -- Article widget -- */
.article_list li         { border-bottom: 1px solid rgba(241, 241, 241, .8); }
ul.article_list li div.post-nr { background-color: <?php echo $secondary; ?>; }
ul.article_list .an-widget-title h4  { content: #222;}
ul.article_list .an-widget-title i {color: <?php echo $primary; ?>;}

/* -- Categories in two columns -- */
.widget_anthemes_categories li { color: <?php echo $secondary; ?>; }

/* -- Default Tags -- */
/* div.tagcloud a:hover  { } */
div.tagcloud a        { background: #f5f5f5 !important; }
div.tagcloud span     { color: <?php echo $secondary; ?>; }

/* -- Archives in two columns -- */
div.widget_archive select, div.widget_categories select { border-radius: 3px; border:1px solid #d5d6d8; color:#999; }

/* -- Default Search -- */
div.widget_search #searchform2 #s { background-color: #FFF; border: 1px solid #f5f4f4; }
div.widget_search #searchform2 .buttonicon   { background-color: <?php echo $secondary; ?>; color: #FFF; }

/* -- Archives in two columns -- */
.widget_nav_menu li { border-bottom: 1px solid #f0eee9; color: <?php echo $secondary; ?>;}
.widget_archive li  { border-bottom: 1px solid #f0eee9; color: <?php echo $secondary; ?>;}

/* -- Meta in two columns -- */
.widget_pages li, .widget_meta li { border-bottom: 1px solid #f0eee9; color: <?php echo $secondary; ?>;}

/* -- Calendar -- */
#wp-calendar tbody td#today { background-color: #000; color: #FFF;}
#wp-calendar tbody td#today a { color: #FFF !important;}


/*-----------------------------------------------------------------------------
----------------------------- 6 - Comments Form -------------------------------
-----------------------------------------------------------------------------*/

ul.comment li                 { background-color: #fafafa; border-bottom: 1px solid #f1f1f1; }
ul.comment li ul.children li  { background-color: #FFF; border-bottom: none; border-top: 20px solid #fafafa;}
ul.comment li ul.children li > ul.children li { background-color: #FFF; border-bottom: none; border-top: 20px solid #fafafa;}
ul.comment li span.comment-reply-button { background-color: <?php echo $secondary; ?>; }
ul.comment li span.comment-reply-button a { color: #000 !important; }

/* -- Comments -- */
.comments h3.comment-reply-title  { color: #000 !important; background-color: <?php echo $secondary; ?>; }
.comments h3.comment-reply-title a { color: #000; }

/* -- comment Form -- */
#commentform #author, #email  { border:2px solid #d5d6d8; color:#333; }
#commentform textarea         { border:2px solid #d5d6d8; color:#333;}
#commentform #submit          { background-color: <?php echo $secondary; ?>; color: #000; }
#commentform label span       { color:#F00;}
#commentform span             { color:#F00;}


/*-----------------------------------------------------------------------------
----------------------------- 7 - Contact Form --------------------------------
-----------------------------------------------------------------------------*/

/* -- Contact Form 7 Plugin -- */
form.wpcf7-form input         { border:2px solid #d5d6d8; color:#333; }
form.wpcf7-form textarea      { border:2px solid #d5d6d8; color:#333; }
form.wpcf7-form input.wpcf7-submit    { background-color: #222; color: #FFF; border: none; }
form.wpcf7-form .wpcf7-validation-errors { color: red;}


/*-----------------------------------------------------------------------------
----------------------------- 8 - Custom Pages --------------------------------
-----------------------------------------------------------------------------*/



/*-----------------------------------------------------------------------------
------------------------------ 9 - Footer -------------------------------------
-----------------------------------------------------------------------------*/
footer                        { background-color: #191919;}

/* -- Top Footer Section -- */
.top-footer-section           { background: <?php echo $primary; ?>; background: linear-gradient(to right, <?php echo $primary; ?> , #27313b); }
.top-footer-section h2 span   { color: <?php echo $secondary; ?>; background-color: #111; border-bottom: 3px solid #000; }
.top-footer-section h2        { color: #FFF; }
.top-footer-section p         { color: #FFF; }
.top-footer-section a.button  { background-color: #111; color: #FFF !important; border-bottom: 3px solid #000; }
.top-footer-section a.button:hover { color: <?php echo $secondary; ?> !important;}

/* -- Bottom Footer Section -- */
footer .wrap-middle p         { color: #999 !important;}
footer .wrap-middle p > span a     { color: <?php echo $secondary; ?>; }
footer .wrap-middle p > a:hover   { color: #444 !important;}
footer .wrap-middle p > span     { color: #fff; background-color: #000;}

/* -- bottom social icons -- */
.bottom-social li a i          { color: #3f677a; }
.bottom-social li a i.fa-facebook-f { color: #768bb7; }
.bottom-social li a i.fa-twitter { color: #a2d9f2; }
.bottom-social li a i.fa-pinterest { color: #ea4e56; }
.bottom-social li a i.fa-google-plus-g { color: #e3826d; }
.bottom-social li a i.fa-instagram { color: #5383a6; }
.bottom-social li a i.fa-vk { color: #8ca3bd; }
.bottom-social li a i.fa-xing { color: #d8e147; }
.bottom-social li a i.fa-youtube { color: #e85e57; }
.bottom-social li a i.fa-dribbble { color: #ee92b6; }
.bottom-social li a i.fa-vimeo-v { color: #76cafa; }
.bottom-social li a i.fa-soundcloud { color: #fa8247; }

/* -- Back to Top -- */
#back-top span                { background-color: <?php echo $secondary; ?>;}
#back-top a:hover             { opacity: 0.7; }
