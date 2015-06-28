<!DOCTYPE html>
<!-- saved from url=(0054)http://twitter.github.com/bootstrap/examples/hero.html -->
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Theme documentation for ShowShop - WP theme">
<meta name="author" content="http://aligator-studio.com">


<link href="../css/foundation.min.css" rel="stylesheet">
<style type="text/css">
h2, h3 { padding-top: 70px !important; }
.top-bar-section .logo { padding: 0 1rem; background: #F2F2F2; }
img.logo { max-height: 25px;width: auto; }
</style>

<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<!-- Fav and touch icons -->
<link rel="shortcut icon" href="assets/images/favicon-32-32-c.png">
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/images/favicon-144-144-c.png">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/images/favicon-72-72-c.png">
<link rel="apple-touch-icon-precomposed" sizes="57x57" href="assets/images/favicon-57-57-c.png">

</head>

<body>
	
	<div class="row">
        
		<div class="contain-to-grid sticky">
		
		<nav class="top-bar" data-options="sticky_on: large" data-topbar role="navigation">
	
			<div class="top-bar-section">		
				
				<div class="left logo"><img src="../img/logo.svg" class="logo"></div>
				
				<ul class="right">
				 <li><a href="#theme-main" class="active">Main theme (parent) set up </a></li>
				 <li><a href="#theme-child">Child themes set up </a></li>
				 <li class="has-dropdown">
					<a href="#">Theme Content</a>
					<ul class="dropdown">
					  <li><a href="#products">Products (WooCommerce plugin)</a></li>
					  <li><a href="#lookbook">Lookbook (WooCommerce Lookbook plugin)</a></li>
					  <li><a href="#portfolio">Portfolio (AS Portfolio plugin )</a></li>
					  <li><a href="#featured">Featured content</a></li>
					  <li><a href="#media">Media sizes and formats</a></li>
					  <li><a href="#page-templates">Page templates </a></li>
					</ul>
				  </li>
				  <li class="has-dropdown">
					<a href="#">Theme features</a>
					<ul class="dropdown">
					  <li><a href="#vc-theme">Visual Composer theme elements </a></li>
					  <li><a href="#post-formats">Post formats and custom meta </a></li>
					  <li><a href="#mega-menu">Menu locations and mega menu</a></li>
					  <li><a href="#widgets">Widgets areas (sidebars)</a></li>
					  <li><a href="#theme-options">Theme options</a></li>
					  <li><a href="#plugins">Plugins</a></li>
					  <li><a href="#wpml">WPML plugin compatibility</a></li>
					</ul>
				  </li>
				   <li><a href="#scripts-credits" class="dropdown-toggle">Scripts and credits</a></li>
				  
				</ul>
            </div>
        </nav>
		
		</div>
		
      </div>
	
	<div class="row panel">
		
		<h1>ShowShop WP theme
			<br>
			<small>By Aligator Studio</small>
		</h1>
		
		<p>Email: <a href="mailto:themes@aligator-studio.com">themes@aligator-studio.com</a></p>
		
		<h4 class="alert">Included premium plugins:</h4>
		<ul>
			<li>Visual Composer</li>
			<li>Slider Revolution</li>
		</ul>
		
	
	</div>			
		
	<div class="row">		
	
		<div class="small-12" style="text-align: center;">
					
			<h4>Thank you for purchasing our theme.</h4>
			
			<h4>ShowShop theme is e-commerce WordPress theme compatible with WooCommerce plugin</h4>
			
		</div>	
		
	</div>
	
	
	<!-- ===================== THEME MAIN SET UP ============================== -->
	
	<div class="row">

		<div class="small-12">

			<h2 id="theme-main"><span class="panel" style="display:block;">Main Theme (parent) set up</span></h2>

			<h5 class="panel radius callout">This documentation assumes you already know how to install wordpress on your site (download installation, set up database and run server wordpress installation), and have basic knowledge of wordpress concepts, routines and terminology. </h5>
			
			
			<h3 id="install-best-procedure"><strong>ShowShop theme installation best practice</strong>:</h3>
			
			<hr>
			
			<ul class="small-block-grid-1 large-offset-1">
				
				<li><strong><span class="label radius">1.</span> make clean WP installation</strong></li>
				
				<li><strong><span class="label radius">2.</span> install and activate ShowShop theme</strong>
					
					<a href="#" class="label round alert" data-reveal-id="modal-after-activation">IMPORTANT -After theme activation</a>
				
				</li>
				<li><strong><span class="label">3.</span> install REQUIRED PLUGINS</strong> (install and activate):
					
					<a href="#" class="label round alert" data-reveal-id="modal-setup-plugins">IMPORTANT - Plugins installation procedure</a>

					<br />
					<br />
					
					<p class="panel">ShowShop is compatible with <strong>Visual composer plugin</strong> and it  uses it's own VC elements for even better usage of Visual Composer.<br>
					
					Although theme is perfectly capable to function without VC plugin (especially blog, products and standard pages), theme would miss some great features targeted for integration with this plugin.<br><br>
					Perhaps "required" is maybe to strong word, but we surely highly recommend to install "required plugins", especially <strong>WooCommerce</strong> and <strong>Visual Composer</strong>.
					</p>
					
				
					
					<ol class="large-offset-1">
						<li>WooCommerce - <a href="#" class="label round alert" data-reveal-id="modal-setup-woo">Important notes</a></li>
						<li>Visual Composer - <a href="#" class="label round alert" data-reveal-id="modal-vc">Important notes</a></li>
						<li>Slider Revolution - <a href="#" class="label round alert" data-reveal-id="modal-revolution">Important notes</a></li>
						<li>Envato Wordpress Toolkit - <strong>for automatic theme updates</strong></li>
						<li>WooCommerce Lookbook</li>
						
					</ol>
					
					<br>
					
					<p><strong>You should also consider installing <u>recommended plugins</u>, too:</strong></p>
					
					<ul class="large-offset-1">
						<li>Search & Filter</li>
						<li>YITH WooCommerce Wishlist</li>
						<li>Mailchimp for WordPress</li>
						<li>AS Portfolio - portfolio custom post type</li>
						<li>Attachment importer - in case of demo content import</li>
						<li>YITH WooCommerce Ajax Search</li>
						<li>WooCommerce ShareThis Integration</li>
					</ul>
					
				</li>
				
				<li><strong><span class="label radius">4.</span> import demo content</strong> - <a href="#" class="label round alert" data-reveal-id="modal-setup-import">Import notes</a></li>
				
				<li><strong><span class="label radius">5.</span> set home page</strong> 
				<br /><br />				
				<div class="panel callout large-offset-1">
					<h5>IMPORTANT NOTE -DEFAULT HOME PAGE:</h5>
					Since default WP home page is set to display <strong>blog posts</strong>, such is the case with ShowShop theme, too.<br /><br />
					To set home page <u>as in theme demo</u> (with imported content) in <strong>Settings > Reading</strong> set "Front page displays" to "<strong>A static page (select below)</strong>" and select imported <strong>"Home page"</strong>.
				
				</div>
				
				</li>
				
				<li><strong><span class="label radius">5.</span> set permalinks</strong> - <a href="#" class="label round alert" data-reveal-id="modal-setup-permalinks">Important notes</a></li>
				
				<li><strong><span class="label radius">6.</span> set menus</strong> - <a href="#" class="label round alert" data-reveal-id="modal-setup-menus">Important notes</a></li>
				
			</ul>



		</div><!-- /small-12 -->

	</div><!-- /row -->
	
	
	<div class="row"><br><hr class="label alert small-6 large-offset-3 columns"><br><br><br></div>

	
	<div class="row">
	
		<div class="small-12">
		
			<h2 id="theme-child"><strong>Child theme set up</strong></h2>
			
			<h6 class="panel callout">TO INSTALL CHILD THEME, PARENT (MAIN) THEME MUST BE INSTALLED.<br>TO LEARN BASICS ABOUT CHILD THEMES, CONCEPTS AND REQUIREMENTS, CHECK <a href="http://codex.wordpress.org/Child_Themes" target="_blank"><strong>WP CODEX - CHILD THEMES</strong></a></h6>
			

			<p>
				<strong><span class="label radius">1.</span> install main (parent) theme</strong>
				<br>
				<br>
				first install parent theme, as described <a href="#theme-main">above</a>
				<br>
			</p>
						
			<p>
				<strong><span class="label radius">2.</span> install and activate child theme</strong>
				<br><br>
				ShowShop has one starter child theme provided in downloaded package.<br>
				Starter theme has the same functionality as parent theme with added functionality of child theme ( Please, <a href="http://codex.wordpress.org/Child_Themes" target="_blank"><strong>read carefully WP Codex</strong></a> about child themes )
			</p>
			
			<p>
				<strong><span class="label radius">3.</span> use child's style css to make style changes.</strong>
				<p class="panel">- to change <strong>javascript functionalities,</strong> copy one of files from <strong>parent's "js"</strong> folder to <strong>child "js" folder</strong>, open child's <strong>functions.php</strong> and follow the instructions in comments to dequeue / enqueue child script<br>
				- to change html layout and/or php files copy the files from parent theme, respecting directory structure, and edit files in child theme</p>
			</p>
			
		
		</div>
		
	</div>
	
	
	
	
	<!-- ======================= MODALS FOR THEME MAIN SETUP =========================== -->
	
	
	<!-- Modal SET UP - AFTER THEME ACT.  -->
	<div id="modal-after-activation" class="reveal-modal" data-reveal>
		
		<a class="close-reveal-modal">&#215;</a>
		
		<h4 class="modal-title">After theme activation</h4>

		
		
			<p class="alert alert-info">After theme activation, some files CSS and Javascript are created to apply theme options DEFATULT settings (mostly font settings and css styles). <br><br>
			
			<strong>If you are updating theme :</strong>
			<br />
			<br />
			Navigate to <strong>Appearance > Theme options</strong> and hit <strong>"Save all changes"</strong></p>
		
	</div><!-- /.modal -->
	
	
	

	<!-- Modal SET UP - PLUGINS -->
	<div id="modal-setup-plugins" class="reveal-modal" data-reveal>

		<a class="close-reveal-modal">&#215;</a>
		
		<h4 class="modal-title">Theme plugins installation procedure</h4>
				
		<p>After theme activation, the "Install Plugins" link will appear - click on it to install <strong>required plugins</strong></p>
		
		<p>If you ignore "Install Plugins", link, the <strong>yellow box</strong> on the top of the admin pages with required and optional plugins info and installation routines will display notice the start plugins installation.
		</p>
		
		<p>Click on <strong>"Begin installing plugins"</strong> (at the message box bottom) and install theme required plugins. On "Install required plugins" page check the 
		<ul>
			<li>WooCommerce</li>
			<li>Visual Composer</li>
			<li>Slider Revolution</li>
			<li>Envato Wordpress Toolkit</li> 
			<li>WooCommerce Lookbook</li> 
		</ul>
		
		plugins, set <strong>"Bulk actions"</strong> to "Install" and click "Apply".
		
		<p>After plugins are installed, check the same plugins and select "Activate".</p>

	</div><!-- /.modal -->
	
	
	<!-- Modal SET UP - WooCommerce-->
	<div id="modal-setup-woo" class="reveal-modal" data-reveal>
					
		<a class="close-reveal-modal">&#215;</a>
		
		<h4>WooCommerce shop pages creation</h4>
				
		<p>
		After WooCommerce plugin installation and activation, the WooCommerce prompt message <strong>(in the box at the top - "Welcome to WooCommerce – You're almost ready to start selling :)")</strong>  asking to create shop pages:
		</p>
		
		<p class="alert alert-danger"><strong>RECOMMENDED: Click on <u>"Install WooCommerce Pages"</u>. All the pages for shop will be added and all the endpoints for "My account", "Cart" and "Checkout" will be set in WooCommerce settings .</strong>
		</p>

	</div><!-- /.modal -->
	
	
	<!-- Modal SET UP - VC-->
	<div id="modal-vc" class="reveal-modal" data-reveal>
					
		<a class="close-reveal-modal">&#215;</a>
		
		<h4>Visual composer</h4>
				
		

	</div><!-- /.modal -->
	
	
	<!-- Modal SET UP - VC-->
	<div id="modal-revolution" class="reveal-modal" data-reveal>
					
		<a class="close-reveal-modal">&#215;</a>
		
		<h4>Revolution Slider</h4>
				

	</div><!-- /.modal -->
	
	
	
	<!-- Modal SET UP - IMPORT-->
	<div id="modal-setup-import" class="reveal-modal" data-reveal>

		<a class="close-reveal-modal">&#215;</a>
		
		<h4>Import demo content</h4>

		<p>In WP admin menu go to <strong>Tools > Import</strong>, and select <strong>"Wordpress"</strong>  from import choices table.</p>
		
		<p class="panel callout">XML import file can be found <strong>in the theme root</strong> and it's called <strong>showshop.demo.content.xml</strong></p>
		
		<p class="alert alert-info">If you choose to Import Attachments, <strong>please, DON'T check "Download and import file attachments"</strong>. First, install all the content WITHOUT media.<br><br>
		Then, if you haven't done yet, install recommended plugin "Attachment Importer" and in Tools > Import click on "Attachment import" link and use sam XML file to upload images.<br>
		

		<u>Please be patient</u>, as the <strong>downloading of images may take a while</strong> due to some number of quality images to download. 
		
		It might happen that your server has time or upload limits so the download interrupts or fails, so check your server settings.</p>
		
		
		<div class="alert alert-warning">
			
			<strong>NOTE:</strong><br />
			Due to limitations of WP export/import procedure not every data is transferred.
			What is not imported from demo content:
			<ul>
				<li>product categories images</li>
				<li>post formats for custom post types</li>
			</ul>
			
		</div>


	</div><!-- /.modal -->
	
	<!-- Modal SET UP - PERMALINKS-->
	<div id="modal-setup-permalinks"  class="reveal-modal" data-reveal>
	
		<a class="close-reveal-modal">&#215;</a>
				
		<h4 class="modal-title">Set permalinks</h4>

		<p>
		It's important that after the installing theme, plugins and demo content import the permalinks are set to re-create inner connections between content (posts, taxonomies, meta data...) and create permalink, which are important for SEO.
		</p>
		<p>
		In WP admin menu go to Settings > Permalinks and in "Common Settings" section select "Post name".<br />
		In "Product permalink base" we recommend setting "Shop base with category" as permalinks base for your shop.
		</p>
					
	</div><!-- /.modal -->
	
	
	<!-- Modal SET UP - MENUS-->
	<div id="modal-setup-menus"  class="reveal-modal" data-reveal>

		<a class="close-reveal-modal">&#215;</a><a class="close-reveal-modal">&#215;</a>
		
		<h4 class="modal-title">Set menus</h4>

		<p>
		If you imported demo content, the menus and menu items will also be imported. However, the import process <strong>doesn't manage menus created by import and menus locations</strong>, programmed by theme.
		</p>

		ShowShop theme has following menus location (both in header) so set following imported menus to menus locations:
			<ul>
				<li>Main horizontal menu</li>
				<li>Main vertical menu </li>
				<li>Main mobile menu</li>
				<li>Secondary menu - "Secondary menu"</li>
			</ul>
		
		<p class="panel">
		Theme specific menu feature "Mega menu" is explained in section <a href="#mega-menu"  class="close-and-go-to"><strong>"Menu locations and mega menu"</strong></a>
		</p>
		
		<p class="panel">
		<strong>Visual Composer "Custom menu" element</strong><br>
		Other then menus locations, menus can be used with Visual Composer "Custom menu" element. With "Custom menu" create a menu and place it to any custom location created with VC element. More about VC "Custom menu" in <a href="#vc-theme" class="close-and-go-to"><strong>Visual Composer elements</strong></a> section. 
		</p>
		
		
	</div><!-- /.modal -->
	
	<!-- Modal SLIDER REVOLUTION -->
	<div id="modal-revolution"  class="reveal-modal" data-reveal>

		<a class="close-reveal-modal">&#215;</a>
		
		<h4 class="modal-title">Slider Revolution </h4>
		
		<p>
		ShowShop theme includes the great <strong>"Slider Revolution" - a Premium CodeCanyon plugin</strong>.
		</p>
		
		<p>Slider Revolution zip included in theme plugins installation procedure does not contain documentation or plugin import files to minimize the theme total size for shorter download time. The plugin authors have made the documentation available online:<br />
		<a data-toggle="modal" href="http://themepunch.com/codecanyon/revolution_wp/documentation/" class="btn btn-primary btn-success btn-xs" style="text-shadow: none;" target="_blank">Click here for Slider Revolution documentation</a>
		</p>
		
		<p>
		ShowShop theme include also sliders used in theme demo, and these files can be found in theme's downloaded package, zipped in "Sliders.zip" file.
		</p>
		
		<p><strong>IMPORTANT: "Slider Revolution" plugin included in this theme is not licenced for updates. To receive plugin's updates, purchase licence on <a href="http://codecanyon.net/item/slider-revolution-responsive-wordpress-plugin/2751380">CodeCanyon item site</a></strong></p>

	</div><!-- /.modal -->
	

	<!-- ======================= END MODALS FOR THEME MAIN SETUP =========================== -->
	
	<div class="row"><br><hr class="label alert small-6 large-offset-3 columns"><br><br><br></div>
	
	

	<div class="row">
	
		<div class="small-12">
		
			<h2><b>Theme features<br /><small>theme specific content</small></b></h2>
		
		</div>
		
	</div>	
	
	<!-- ============ PRODUCTS ===============-->
	
	<div class="row" id="products">	
		
		<div class="small-12">
		
			<h3><b>Products</b></h3>
		
		</div>	
	
		<div class="small-12">
		
			<p>After installing WooCommerce plugin, you will be able to add products, which are actually custom post type ("product" custom post type).</p>
			
			<p>Adding products can be done in WP admin menu -<strong> Products > Add product</strong>, the list of all products is in <strong>Products > Products</strong></p>
			
			<p>
			If you imported demo content you'll be able to see that there are set <strong>Product categories, Attributes</strong> and <strong>product tags</strong>.
			<p>
			There are plenty of settings, options and possibilities you can add to your products and this is all covered in <a href="http://docs.woothemes.com/documentation/plugins/woocommerce/"><strong>WooCommerce documentation</strong></a> which we highly recommend to use during your e-commerce shop activation.
			</p>
			
			<p class="alert alert-info">
			NOTE:<br />
			ShowShop theme adds <u>nothing in administering</u> shop or products, <strong> all the shop related settings are part of WooCommerce plugin</strong> - theme is dealing with products front end presentation (css styling and adapting shop pages layout to theme), especially in Visual Composer custom theme blocks.
			</p>
			
			<h4>ShowShop theme / WooCommerce related specifics (plugins and theme options) :</h4>
			
			<br />
			
			<p><strong>Visual Composer</strong> / ShowShop theme and WooCommerce - ShowShop theme has built in VC elements (blocks) to display WooCommerce products. More about those elements in <a href="#vc-theme"> <strong>Visual Composer custom theme elements</strong></a> section.</p>
			
			<p><strong>WooCommerce Lookbook</strong> / ShowShop theme and WooCommerce - ShowShop theme features lookbook CPT for grouping products. More about WC Lookbook in <a href="#lookbook"><strong>WooCommerce Lookbook</strong></a> section.</p>
						
			<p><strong>Theme options Shop settings</strong> adds additional layer of control over displaying products. For more info, head over to <a href="#theme-options"><strong>Theme options section</strong></a>.</p>
			<br />
			
			
		</div>	
	
	
	</div><!--  end PRODUCTS -->
	
	
	<div class="row"><br><hr class="label secondary small-6 large-offset-3 columns"><br><br></div>
	
	<!-- ============ LOOKBOOK  ===============-->
	
	<div class="row well" id="lookbook">

	
		<div class="small-12">
		
			<h3><b>Lookbook (plugin and custom post type)</b></h3>
		
		</div>	
	
		<div class="small-12">
		
			<p>After finishing your theme installation, additional plugin is required for installation - <strong>WooCommerce Lookbook</strong>. After installation and activation of plugin, new WP admin menu item will appear <strong>"Lookbook" > "Lookbook", "Add new", "Lookbook categories"</strong>.
			</p>
			
			<strong>Lookbook post type </strong> is created to work together with WooCommerce plugin installed. Lookbook item (lookbook single post) links individual WC products - a products which share similar concept or purpose.<br>
			Perhaps the best usage would be to make a showcase of clothing products that are wearable well toghether.
			<br><br>
			Some examples of lookbook item contents:
			<ul>
				<li>Lookbook item: Featured image with model wearing dress, purse, shirt, hat...<br>
					- Linked single products: dress, purse, shoes, shirt, hat</li>
			
				<li>Lookbook item: Toys package<br>
					- Linked single products: individual toys from the package for single sales.</li>
			</ul>
			<br />
			
			<h4>Adding a lookbook item</h4>
			<ul>
				<li>Lookbook categories - recommended to add categories, before adding any new lookbook item (WP admin menu : Lookbook > Lookbook Categories - Add New Lookbook Category)</li>
				<li>In WP admin menu go to Lookbook > Add New Item</li>
				<li>Set title, featured image, and description excerpt (optionally)</li>
				<li>select lookbook category (<strong>required</strong>)</li>
				<li>In <strong>Lookbook settings</strong> meta box choose settings for:
					<ul>
						<li>Lookbook image format - main (featured) lookbook image</li>
						<li>Products image format</li>
						<li>Number of products in a row</li>
						<li>Smaller buttons and text - if there are more products in row, images will be smaller, and buttons and titles will go off layout. Make them smaller to fit into.</li>
					</ul>
				</li>
				<li>Select linked woocommerce products (in "Lookbook settings" meta box, bellow main editor):
				
					<ul>
						<li>Drag products from right "List of all available products" box to left "Selected products" box</li>
						<li>To remove products from "Selected products" simply drag back to "List of all available products"</li>
						<li>Check the "Hide lookbook item title" if you don't want to display title</li>
					</ul>
				
				</li>
				<li></li>
				
			</ul>
			
			<br />
			
			<h4>Creating a lookbook page</h4>
			<ul>
				<li>In WP admin menu:</li>
				<li>go to Pages > Add new - add title, select featured image (optionally)</li>
				<li> select "Lookbook page" page template (in "Page attributes" meta box) and <strong>save page</strong></li>
				<li>in "Lookbook page settings" meta box (bellow the main editor) set the following options:
					<ul>
						<li>Lookbook categories - choose lookbook categories from which to display items</li>
						<li>Number of lookbook items</li>
						<li>Number of items in a row (or items columns)</li>
						<li>Main lookbook image format - image format for main lookbook image</li>
					</ul>
				</li>
			
			</ul>
			
			Visual Composer elements are explained in <a href="#vc-theme"><strong>Visual Composer elements</strong></a> section. <br>
			
		</div>	
	
	
	</div><!--  end lookbook   -->
	
	
	<div class="row"><br><hr class="label secondary small-6 large-offset-3 columns"><br><br></div>
	
	<!-- ============ PORTFOLIO  ===============-->
	
	<div class="row" id="portfolio">

	
		<div class="small-12">
		
			<h3><b>Portfolio</b></h3>
		
		</div>	
	
		<div class="small-12">
		
			<p>After finishing your theme installation, additional plugin is recommended for installation - <strong>AS Portfolio</strong>. AS Portfolio adds new "portfolio" custom post type to you WP installation. After installation and activation of plugin, new WP admin menu item will appear <strong>"Portfolio" > "Portfolio", "Add new item", "Portfolio tags" and "Portfolio categories".</strong>
			</p>
			
			<p>
			<strong>Portfolio post type </strong>is another way to format you content in special way - different then posts, pages or products - to show your latest projects, models, sales actions ...
			</p>
			
			<br />
			
			<h4>Adding portfolio item</h4>
			<ul>
				<li>In WP admin menu go to Portfolio > Add New Item</li>
				<li>Add title, text and set featured image</li>
				<li>Create and select <strong>portfolio categories</strong> and <strong>tags</strong> (in side meta boxes)</li>
				<li><strong>Featured item</strong> - in first side meta box check if you want to make item featured (for usage in page builder blocks )</li>
				<li class="alert alert-info"><strong>Post formats tabs (above the title)</strong> are used to assign post format to the portfolio item (<em>standard, image, gallery, audio, video or quote</em>) - details about Post formats settings (custom meta boxes) are in the section<a href="#post-formats" class="btn btn-primary"> <strong>"Post formats"</strong></a></li>
				<li><strong>Portfolio custom meta box:</strong><br /><br />
					<ul>
						<li>Portfolio custom meta box adds additional information to main content and featured image and that data is displayed <strong>in single portfolio page only</strong>:</li>
						<li><strong>Tagline</strong> - displayed bellow the item title</li>
						<li><strong>Layout mode</strong> - float image left, right or stretch in full width (good for image post format)</li>
						<li><strong>Featured image format</strong> - choose between registered image formats</li>
						<li><strong>Number of related items</strong> - in the single page bottom there are related portfolio items section - set the number of items</li>
						<li><strong>Button URL and label</strong> - button and link to eventual external or internal "project" page</li>
					</ul>
				</li>
				
			</ul>
			
			<br />
			
			<h4>Creating portfolio page</h4>
			<p>
			Portfolio page (or page section) can be created with Visual Composer elements - <strong>Ajax content</strong> or <strong>Filtered content</strong>.
			</p>
			Visual Composer portfolio elements are explained in <a href="#vc-theme"><strong>Visual Composer elements</strong></a> section. <br>
			
		</div>	
			
	</div><!--  end portfolio   -->
	
	
	<div class="row"><br><hr class="label secondary small-6 large-offset-3 columns"><br><br></div>
	
	
	<!-- ============ FEATURED CONTENT  ===============-->
	
	<div class="row">
	
		<div class="small-12">
		
			<h3 id="featured"><b>Featured content</b></h3>
		
		</div>
		
		<div class="small-12">
		
			<h4>Featured posts, products, portfolios ...</h4><br />
			
			<p>ShowShop theme utilizes featured content for additional layer of filtering content. Since great deal of delivering content is done with Visual Composer plugin, in plugin blocks there is a option <strong>"Show only featured"</strong> and it filters featured posts, products or portfolio items, along with other filter (post type, taxonomy, number of items etc ...)</p>
			
			Making items featured:<br />
			<ul>
			<li><strong>Posts</strong> - use "sticky post" feature - in post <strong>"Publish"</strong> box - toggle "Visibility" setting and check the <strong>"Stick this post to the front page"</strong></li>
			<li><strong>Products</strong> - in products list page (WP menu - Products > Products)- click on little grey star in line of each product you want to be featured</li>
			<li><strong>Portfolio items</strong>- in item edit page, in <strong>"Featured" </strong>box check the <strong>"Make this item featured"</strong></li>
			</ul>
			<br />
			<h4>Featured image ( or, post thumbnail)</h4><br />
			
			<p>Each of upper post types are using Featured post image - this is the image that represents the content and it is used in archive pages and single pages as bellow post titles and  title background, respectively. </p>
		</div>
		
	</div><!--  end featured   -->
	
	
	
	<div class="row"><br><hr class="label secondary small-6 large-offset-3 columns"><br><br></div>
	
	<!-- ============ MEDIA  ===============-->
	
	<div class="row">
	
		<div class="small-12">
		
			<h3 id="media"><b>Media sizes and formats</b></h3>
		
		</div>
		
		<div class="small-12">
		
			 <br />
			 <h4><strong>Image sizes</strong></h4>
			
			<h4><u>ShowShop recommended image size is <strong>min. 1600px in width</strong></u>. Ideally, the ratio between with / height would be in ratio 1 : 1.618 (golden ratio) - 1600px x 990px in landscape mode or 1400px x 2600px in portrait mode.</h4>
			<br />
			<p class="alert secondary"><strong>Additional mage sizes created  by theme are - ShowShop portrait and ShowShop landscape.</strong></p>
			
			<br />
			
			<div class="alert">NOTE: because of the theme <strong>responsive</strong> and <strong>flexible</strong> nature, the relevant concepts for images are: <br><br>
				<ul>
					<li><strong>width/height ratio (aka portrait or landscape)</strong> and </li>
					<li><strong>image resolution</strong> (the bigger resolution the better quality - but loading time is longer / more bandwidth consumed).</li>
				</ul><br>
				We recommend usage of <strong>ShowShop portrait</strong> of <strong>landscape</strong> formats, and only if necessary custom image sizes (available in Visual Composer blocks), smaller sizes (bigger sizes will heavy load image resizing script.)
			</div>
			
			<h4><strong>Audio</strong></h4>
			
			<p>It' very easy to use audio and video with embedded media player:</p>
			<p><strong>Audio files</strong> - upload files (<strong>mp3 </strong>) via media uploader ( activate "Audio" post format tab ) from custom meta box "Audio settings" for self-hosted audio, or simply enter audio file URL in the same input field. Audio files uploaded this way will be display in <strong>post archive pages, single pages and in page builder blocks</strong> ( ajax content and filtered content blocks ) </p>
			
			
			<p>Audio mp3 files can be added with "Add media" pop-up window, in which case for the uploaded audio will be added [audio] shortcode. Audio files added that way will be visible only on posts <strong>single page</strong>.
			</p>
			 <br />
			<h4><strong>Video</strong></h4>
			
			<p>ShowShop is using video hosting services such as YouTube, Vimeo, Sreenr etc. to add video as featured media using post formats and custom meta boxes.<br /><br />
			<strong>First</strong> - select <strong>post format video</strong> tab, then in custom meta box "Video settings" enter <strong>video ID</strong> code (not full address of video), and then enter the values of width and heigh of video. </p>
			
			
		</div>
		
	</div>	
	
	
	<div class="row"><br><hr class="label secondary small-6 large-offset-3 columns"><br><br></div>
	
	<!-- ============ PAGE TEMPLATES  ===============-->
	
	<div class="row" id="page-templates">
	
		<div class="small-12">
		
			<h3><b>Page templates</b></h3>
		
		</div>
		
		<div class="small-12">
		
			ShowShop has following defined page templates ( "static" pages - in WP admin menu - "Pages" )
			<br><br>
			<ol>
				<li>Default template - standard WP template with sidebar</li>
				<li>Blank template - template with no header (with logo and menus) and footer - good for "Landing pages"</li>
				<li>Full width page - page without the sidebar</li>
				<li><strong>Page builder template</strong> - page template best suited for usage with <strong>Visual Composer elements and templates</strong></li>
				<li>Page of posts - page with blog posts archive display capability ( with pagination )</li>
				<li>Page of posts INFINITE load - page with blog posts archive display capability with AJAX infinite posts loading</li>
				<li>Lookbook page - to display lookbook items with associated products.</li>
			</ol>
			
		</div>
		
	</div><!-- end PAGE TEMPLATES  ===============-->
	
	
	<div class="row"><br><hr class="label secondary small-6 large-offset-3 columns"><br><br></div>
	
	
	<!-- ============ VISUAL COMPOSER =============== -->
	
	
	<div class="row" id="vc-theme">
	
		<div class="small-12">
		
			<h3><b>Visual Composer theme elements</b></h3>
		
		</div>
		
		<div class="small-12">
		
			<p class="panel">
			ShowShop theme <strong> is heavily adapted for usage with Visual Composer premium plugin</strong> (third party plugin) - building custom pages with pre packed blocks, using page builder page scaffolding ( grid system ) and many blocks customization options.
			<br /><br />
			To learn about Visual Composer before continuing with ShowShop VC elements, please visit <strong><a href="https://wpbakery.atlassian.net/wiki/display/VC/Visual+Composer+Pagebuilder+for+WordPress" target="_blank">plugin's documentation page</a></strong>
			
			</p>
			<br />
			
			<h5>To extend plugin's capability ShowShop theme offers following powerful VC elements : </h5>
				
				<p class="panel calluot">
					<span class="label alert">NOTE:</span><br>
					VC default "Row block" has additional theme specific options added:
				</p>
				<ul class="large-offset-1">
					<li>Parallax checkbox - to apply parallax effect to row background image</li>
					<li>Overlay color - color overlay between background and content -to improve content visibility</li>
					<li>Overlay opacity</li>
					<li>Boxed content - by default, row element is fullwidth - check this to "box" the content</li>
					<li>Add grid spacing - add grid spaces between elements in row</li>
					<li>Equalize row elements - applied to elements not congaing child elements - to make equal heights of theme banner block</li>
					<li>Theme row video setting tab - number of self-explanatory settings to place video as background of row</li>
				</ul>
				
				<p class="panel calluot">
				<span class="label alert">NOTE:</span><br>
				Each theme VC element has same "Title and subtitle settings tab" (except for "Banner" element), with following options:
				</p>
				
				<ul class="large-offset-1">
					<li>Element title and subtitle / block style (float left, right, centered) - optional</li>
					<li>Element subtitle style - above or bellow title</li>
					<li>Element subtitle style - position of subtitle - above or bellow title</li>
					<li>Title color</li>
					<li>Subtitle color</li>
					<li>Remove title shadow - heading shadow is transparent duplicated title text, under the title</li>
					<li>Title additional sizing - increase or decrease title size, html tag for element titles are by default H3 (SEO reasons)</li>
				</ul>
			
			
			<br />
			
			<ul class="accordion large-block-grid-2 small-block-grid-1" data-accordion>
				
				
				<li class="accordion-navigation">
				
					<a href="#el-ajax-content"><strong>Ajax load content</strong></a>
					

					<div id="el-ajax-content" class="content">
						
						
						Ajax content is using <strong>ajax loading of posts</strong>, products or portfolio items by selecting it's categories.<br /><br />
						
						<p class="panel">
						<strong>IMPORTANT NOTES</strong>
						
						<strong>Post type and categories (taxonomies) must match</strong> - post with categories, products with product categories, and portfolio items with portfolio categories.
						</p>	
						
						<strong>OPTIONS</strong>
							
							<ul>	
								<li>Viewport enter animation - css block animation when enters in the browser view.</li>
								<li>Block style - 3 styles of Ajax content block layout</li>
								<li>Post type - first and the most important filter - required</li>
								<li>Taxonomy menu style - display inline or in toggle menu</li>
								
								<li>Taxonomies select (post, portfolio or product cateogories) - must match post type selection</li>
								<li>Image format - registered image sizes (automatically created upon image uploads)</li>
								<li>Image width and height - custom image size - if set overrides registered image formats - using image resizing script</li>
								<li>Total items - total number of items to display - default is 8 if empty it will display max. item number, given the filters above.</li>
								<li>Offset - move the post start - if offset is set to 3, post list will start from 3rd post.</li>
								<li>No post thumbnail - show only post title, meta, excerpt (simple post listing)</li>
								<li>Show only featured - additional filter layer - if checked only featured (or sticky) items will display</li>
								<li>Disable/hide slider, slider pagination, navigation - if items should be displayed in slider ( OWL carousel slider - responsive, touch and mouse drag capable slider)</li>
								<li>Responsive slider items number - set number of items per different screen resolutions</li>
								<li>Hide zoom and/or Item link buttons - buttons appearing on item hover</li>

								<li>Hover animations - separate for image (and zoom/link buttons) and post text</li>
								
								<li>Additional button - custom link to given URL address</li>
								<li>Additional CSS classes - add css classes defined in child theme or theme options custom css</li>
						</ul>
						
						
						
					</div>
				
				</li>
				
				<li class="accordion-navigation">
				
				
					<a href="#block-ajax-prods"><strong>Ajax load products</strong></a>
					

					<div id="block-ajax-prods" class="content">
						<hr>
						<p>
						Ajax products block is displaying products, filtered by product categories, selected via <strong>ajax loading</strong>.
						</p>
						
						<strong>IMPORTANT NOTE:</strong>
						<ul>
							
							<li>Ajax products categories block is designed to display <strong>product categories images</strong> in menu, so it's advisable to <strong>upload images for your products categories</strong></li>
						</ul>
						
						<strong>OPTIONS</strong>
							<ul>

								<li>Viewport enter animation - css block animation when enters in the browser view.</li>
								<li>== PRODUCT CATEGORIES AND MENU SETTINGS: ==</li>
								<li>Product categories select</li>
								<li>Product categories menu - select between categories images, categories titles only or none</li>
								<li>Menu items in a row - select the style of menu columns (items) display</li>
								<li>Categories menu alignment</li>
								<li>Menu color settings - change menu image overlay and text color</li>
								
								<li>Product image format - registered image sizes (automatically created upon image uploads)</li>
								<li>Hide zoom and/or Item link buttons - buttons appearing on item hover</li>
								<li>Hover animations - separate css animations for image and product info, on tiem hover</li>
								
								<li>Hide "Quick view", "Add to cart/Select options" and "Add to Wishlist"( YITH WooCommerce Wishlist plugin must be installed)</li>
								
								<li>Hide poduct info altogether - hide all product action buttons</li>
								
								<li>Special filters - select to display latest, featured, BEST SELLING or BEST RATED products (WooCommerce features)</li>
								
								<li>Total items - total number of items to display - default is 8 if empty it will display max. item number, given the filters above.</li>
								
								<li>Disable/hide slider, slider pagination, navigation, slider timing (in miliseconds) - if items should be displayed in slider ( OWL carousel slider - responsive, touch and mouse drag capable slider)</li>
								
								<li>Responsive slider items number - set number of items per different screen resolutions</li>
								
								<li>Additional button - custom link to given URL address</li>
								<li>Additional CSS classes - add css classes defined in child theme or theme options custom css</li>
						</ul>
						
					</div>
				
				
				</li>
				
				
				<li class="accordion-navigation">
				
				
					<a href="#block-filter-content"><strong>Filtered content</strong></a>


					<div id="block-filter-content" class="content">
						<hr>
						<p>
						Filter content is displaying content filtered by number of filters (categories, number of items. etc.) with dynamic javascript filtering and sorting with auto sizing and layout.
						</p>
						
						<strong>IMPORTANT NOTES</strong>
						<ul>
							<li><strong>Post type and categories (taxonomies) must match</strong> - post with categories, products with product categories, and portfolio items with portfolio categories.</li>
							<li>Multiple categories are selected using CTRL + click (use same combination to deselect ) - when selected the menu (with two different layouts will display)</li>
						</ul>
						
						<strong>OPTIONS</strong>
							<ul>

								<li>Viewport enter animation - css block animation when enters in the browser view.</li>
								<li>Block style - 3 styles of block layout</li>
								<li>Post types - first and the most important filter - required</li>
								<li>Post or portfolio categories select</li>
								<li>Show only featured - additional filter layer - if checked only featured (or sticky) items will display</li>
								<li>Image format - registered image sizes (automatically created upon image uploads)</li>
								<li>Image width and height - custom image size - if set overrides registered image formats - using image resizing script</li>
								<li>Hide zoom and/or link button - if both are hidden, link will apply to featured image</li>
								<li>Taxonomy menu style - display inline, toggling menu or none</li>
								<li>Show sorting dropdown - select menu to sort items dynamically</li>
								<li>Taxonomy menu alignment</li>
								<li>Total items - total number of items to display - default is 8 if empty it will display max. item number, given the filters above.</li>
								<li>Items in one row - number if items in one row (value changes on mobile devices - check the demo)</li>
								<li>Hover animations - separate css animations for image and product info, on tiem hover</li>
								
								<li>Additional button - custom link to given URL address</li>
								<li>Additional CSS classes - add css classes defined in child theme or theme options custom css</li>
						</ul>
						
					</div>
				
				
				</li>
				
				
				<li class="accordion-navigation">
				
					
					<a href="#block-filter-prod"><strong>Filtered products</strong></a>
					

					<div id="block-filter-prod" class="content">
						<hr>
						<p>
						Filtered products is displaying products filtered by number of filters (categories, number of items. etc.) with dynamic javascript filtering and sorting with auto sizing and layout.
						</p>
						
						<strong>OPTIONS</strong>
						<ul>
							
							<li>Viewport enter animation - css block animation when enters in the browser view.</li>
							<li>Product categories select</li>
							<li>Categories menu style - display inline, toggling menu or none</li>
							<li>Show sorting dropdown - select menu to sort items dynamically</li>
							<li>Categories menu alignment - center, left or right align</li>
							<li>Special filters - select to display latest, featured, BEST SELLING or BEST RATED products (WooCommerce features)</li>
						
							<li>Image format - registered image sizes (automatically created upon image uploads)</li>
							<li>Image width and height - custom image size - if set overrides registered image formats - using image resizing script</li>
							<li>Hide "Quick view", "Add to cart/Select options" and "Add to Wishlist"( YITH WooCommerce Wishlist plugin must be installed)</li>
							<li>Hide zoom and/or link buttons</li>
							
							<li>Total items - total number of items to display - default is 8 if empty it will display max. item number, given the filters above.</li>
							<li>Smaller buttons and text</li>
							<li>In one row - number if items in one row (value changes on mobile devices - check the demo)</li>
							<li>Hover animations - separate css animations for image and product info, on tiem hover</li>
							
							<li>Additional button - custom link to given URL address</li>
							<li>Additional CSS classes - add css classes defined in child theme or theme options custom css</li>
						</ul>
						
					</div>

				</li>
				
				
				<li class="accordion-navigation">
				
				
					<a href="#block-single-lookbook"><strong>Single lookbook</strong></a>

					<div id="block-single-lookbook" class="content">
						<hr>
						<p>
						Lookbook is custom post type registered by WooCommerce Lookbook plugin. More about administering lookbook items <a href="#lookbook"><strong>HERE</strong></a>
						</p>
						<p><strong>OPTIONS</strong></p>
						<ul>
							<li>Block style - style of the layout - centred , or float left or right</li>
							<li>Viewport animation select - css block animation when enters in the browser view. </li>
							
							<li>Select lookbook item - select single item for display</li>
							<li>Main lookbook image format - use one of the registered image formats</li>
							<li>Products image format - use one of the registered image formats</li>
							<li>Hide "Quick view", "Add to cart/Select options", "Wishlist" buttons</li>
							<li>Smaller buttons and text</li>
							<li>Background color - back color for single product block</li>
							<li>Background opacity - opacity for background color</li>
							<li>Lookbook additional content - WYSIWYG to add more description (optional)</li>
							<li>Text to display - choice between displaying descriptional text from lookbook item (item excerpt) and/or text for "Lookbook additional content" setting from above. </li>
							<li>Additional CSS classes - add css classes defined in child theme or theme options custom css</li>
						</ul>
					</div>
				
				</li>
				<li class="accordion-navigation">
				
				
					<a href="#block-single"><strong>Single product</strong></a>

					<div id="block-single" class="content">
						<hr>
						<p>
						ShowShop "speciality" - single product block - best used in combination with ROW block and it's paralax property (using large product image as paralax background - as in theme demo.)
						</p>
						<p><strong>OPTIONS</strong></p>
						<ul>
							<li>Block style - style of the layout - centred , or float left or right</li>
							<li>Viewport animation select - css block animation when enters in the browser view. </li>
							<li>Product select - select single product for display</li>
							<li>Image format - use one of the registered image formats</li>
							<li>(product) Image gallery pagination, navigation and timing - settings for sliding product images.</li>
							
							<li>Product info background - back color for single product block</li>
							<li>Product options display- choice between displaying product details with options dropdowns (like in WooCommerce product single page - "Reduced"), or displaying simple "Add to Cart/Select options" (like in WooCommerce catalog page - "Full")</li>
							<li>Hide product short description</li>
							<li>Hide product image</li>
							<li>Additional CSS classes - add css classes defined in child theme or theme options custom css</li>
						</ul>
					</div>
				
				</li>
				
				<li class="accordion-navigation">
				
				
					<a href="#block-single-cat-prods"><strong>Single category products</strong></a>

					<div id="block-single-cat-prods" class="content">
						<hr>
						<p>
						Single category	products block - display product from single product category
						</p>
						<p><strong>OPTIONS</strong></p>
						<ul>
							<li>Viewport animation select - css block animation when enters in the browser view. </li>
							<li>Product category select </li>
							<li>Force hiding title (category name) - check this to use custom element title (from "Title and subtitle settings")</li>
							<li>Force hiding subtitle (category descriptions) - check this to use custom element subtitle (from "Title and subtitle settings")</li>
							<li>Text and overlay color</li>
							<li>Image format - use one of the registered image formats</li>
							<li>Hover animations - separate css animations for image and product info, on tiem hover</li>
							<li>Hide "Quick view", "Add to cart/Select options" and "Add to Wishlist"( YITH WooCommerce Wishlist plugin must be installed)</li>
							<li>Smaller buttons and text</li>
							<li>Special filters - select to display latest, featured, BEST SELLING or BEST RATED products (WooCommerce features)</li>
							<li>Total items - total number of items to display - default 12, if empty it will display max. item number, given the filters above.</li>
							<li>Responsive slider settings - set number of items per slide in different screen resolutions.</li>
							
							<li>Additional button - custom link to given URL address</li>
							<li>Additional CSS classes - add css classes defined in child theme or theme options custom css</li>
						</ul>
					</div>
				
				</li>
				
				<li class="accordion-navigation">
				
				
					<a href="#block-single-cat-image"><strong>Single product category image</strong></a>

					<div id="block-single-cat-image" class="content">
						<hr>
						<p>
						Single product category image - select one product category image (image must be set first in "Products" > "Product categories")
						</p>
						<p><strong>OPTIONS</strong></p>
						<ul>
							<li>Viewport animation select - css block animation when enters in the browser view. </li>
							<li>Product category select </li>
							<li>Image width and height (in pixels, enter only value, not unit)</li>
							<li>Text and overlay color</li>
							<li>Additional CSS classes</li>
						</ul>
					</div>
				
				</li>
				
				
				<li class="accordion-navigation">
				
					<a href="#block-heads"><strong>Headings</strong></a>
					

					<div id="block-heads" class="content">
						<hr>
						<ul>
							<li>Element title (or heading)</li>
							<li>Element subtitle</li>
							<li>Element title style - centred or float left or right</li>
							<li>Element subtitle style - above or bellow title (heading)</li>
							<li>Colors - title, subtitle and background</li>
							<li>Remove title shadow - heading shadow is transparent duplicated title text, under the title</li>
							<li>Title additional sizing - increase or decrease title size</li>
							<li>Heading tag -  html tag for element titles are by default H3 (SEO reasons), but you can change it, depending on your needs.</li>
							<li>Viewport enter animation - css block animation when enters in the browser view.</li>
							<li>Viewport Animation delay</li>
							<li>Absolute heading positioning - absolute position will disable heading element to "stack" between other elements - instaed it will position itself in relation to first parent relative element (VC column)</li>
							<li>Additional CSS classes - add css classes defined in child theme or theme options custom css</li>
						</ul>
						
					</div>
				
				</li>
				
				<li class="accordion-navigation">
				
				
					<a href="#block-banner"><strong>Banner</strong></a>
					

					<div id="block-banner" class="content">
						
						<p>
						Banner block can be used for discounts announcements, big notices, and additional attraction to different aspects of your site.
						</p>
						<strong>OPTIONS</strong>
						<ul>
							<li>Title</li>
							<li>Title size - choose between extra large, large, medium and normal</li>
							<li>Subtitle - additional layer of text</li>
							<li>Banner text</li>
							<li>Banner text color - applies to title, subititle and text</li>
							<li>Text float - choice between right. left and centred</li>
							<li>Text padding</li>
							<li>Text border style - for text layer - choice between solid, dashed, dotted and double border</li>
							<li>Disable invert colors on hover - turn on/off hover changing colors</li>
							<li>Text overlay color - separate control over text layer color</li>
							
							<li>Banner overlay color - coloured layer over whole container</li>
							<li>Banner opacity - overall block opacity</li>
							<li>Banner height - best used to set height to 100%</li>
							
							<li>Additional layout and styles settings - CSS applied on elements overall - border, background color/ image, and padding / margin (default VC css control) - if banner image is selected it overrides background image from this setting. </li>
							
							<li>Viewport enter animation - css block animation when enters in the browser view.</li>
							<li>Viewport Animation delay</li>
							<li>Additional button - custom link to given URL address</li>
							<li>Additional CSS classes - add css classes defined in child theme or theme options custom css</li>
						</ul>
					</div>
				</li>

				
				<li class="accordion-navigation">
				
				
					<a href="#block-gmap"><strong>Google Map block</strong></a>
					

					<div id="block-gmap" class="content">
						
						<p class="alert alert-danger">
						IMPORTANT NOTICE: Only one Google Map Block per page can be used
						</p>
						<p><strong>OPTIONS</strong></p>
						<ul>
							<li>Viewport enter animation - css block animation when enters in the browser view.</li>
							<li>Viewport Animation delay</li>
							<li>Address input fields - address STREET, and address TOWN, COUNTRY</li>
							<li>Address additional info</li>
							<li>Location image - thumbnail image that will be displayed with click on map marker</li>
							<li>Location latitude and longitude (will override the Address input fields in map location search )</li>
							<li>Width and height of the map (enter units - preferable percentage for width and pixels for height)</li>
							<li>Map color - color overlay for map - adjust it to your site's color</li>
							<li>Map desaturation - desaturation of color - default or the one set above</li>
							<li>Disable scroll zoom - useful disabling to prevent "un-scrolling" of the page</li>
							
							<li>Additional CSS classes - add css classes defined in child theme or theme options custom css</li>
						</ul>
						
					</div>
					
				</li>
				
				<li class="accordion-navigation">
				
				
					<a href="#block-contact"><strong>Contact form</strong></a>
				

					<div id="block-contact" class="content">
						
						<p><strong>OPTIONS</strong></p>
						
						<ul>
							<li>Viewport enter animation - css block animation when enters in the browser view.</li>
							<li>Recipient email address - required</li>
							<li>Location image - optional image - example usage - company headquarters</li>
							<li>Location description</li>
							<li>Additional CSS classes - add css classes defined in child theme or theme options custom css</li>
						</ul>
					</div>
				
				</li>
				
				
				<li class="accordion-navigation">
				
				
					<a href="#block-test"><strong>Testimonials</strong></a>


					<div id="block-test" class="content">
						
						<p><strong>OPTIONS</strong></p>
						<ul>
							<li>Viewport enter animation - css block animation when enters in the browser view.</li>
							<li>Testimonial items align</li>
							<li>Testimonial images - add as many sub-blocks as you like</li>
							<li>Images style - diamond(default) , square or rounded (not applicable in IE8 and less)</li>
							<li>Testimonial author name - for each image you added, add name, separated with new line (press Enter)</li>
							<li>Testimonial text - for each image you added, add testimonial text, separated with new paragraph (press Enter)</li>
							<li>Testimonial and author text colors</li>
							<li><div class="panel">IMPORTANT: testimonial names and texts must be separated in the described manner in order to make testimoials slider work</div></li>
							<li>Slider pagination, navigation hiding and timing input (in miliseconds)</li>
							<li>Responsive slider items number - set number of items per different screen resolutions</li>
							<li>Additional CSS classes - add css classes defined in child theme or theme options custom css</li>
						</ul>
					</div>
				
				</li>
				
				
				<li class="accordion-navigation">
				
				
					<a href="#block-slider"><strong>Slick Slider</strong></a>
					

					<div id="block-slider" class="content">
						
						<p>
						Slider block is designed to display post types: Posts, portfolio and products.
						</p>
						
						<strong>OPTIONS</strong>
						<ul>
							<li>Post type - select which post type will be displayed</li>	
							<li>Post, portfolio or product categories - must match with selected post type</li>
							<li>Custom images width and height</li>	
							<li>Image format - choose between registed image sizes</li>
							<li>Special filters - select to display latest, featured, BEST SELLING or BEST RATED products (WooCommerce features)</li>	
							<li>Total items - number of items to slide in slider</li>	
							<li>Style settings - colors for text, links and background</li>
							<li>Use KenBurns effect - slow zooming out effect</li>
							<li>Hide text layer (hide title, excerpt and buttons layer)</li>
							<li>Use text layer animation - animation after each slider</li>
							<li>Slider navigation dots and arrows show</li>
							<li>Slider timing - how much time will each slide display before change (in milliseconds)</li>
							<li>Fade images - check if you prefer fading images over sliding</li>
							<li>Thumbnails format - image size for thumbnail navigation</li>
							<li>Hide thumbnail navigation</li>
							<li>Additional CSS classes - add css classes defined in child theme or theme options custom css</li>
						</ul>
					
					</div>
				
				</li>
				
				<li class="accordion-navigation">
				
				
					<a href="#block-superslides"><strong>Superslides</strong></a>
					

					<div id="block-superslides" class="content">
						
						<p>
						Superslides is slider with speciality to stretch with layout container (row element), to full width of other elements in row. It's designed to be display post types: Posts, portfolio and products. 
						</p>
						
						<strong>OPTIONS</strong>
						<ul>
							<li>Fixed or stretched 
								<ul>
									<li>If "Stretch", the slider will resize (width and height) with other elements in row.</li>
									<li>Row settings must have checked "Equalize row elements" (Theme row settings tab)</li>
									<li>If set to "Stretched" the "Set slides height" will be overriden</li>
									<li>Use "Stretched" only with other elements in row</li>
								</ul>
							
							</li>
							<li>Post type or images - select which post type will be displayed, or simply array of images</li>
							<li>Slide images selection (multiple)</li>
							<li>Post, portfolio or product categories - must match with selected post type</li>
							<li>Image format - choose between registed image sizes</li>
							<li>Special filters - select to display latest, featured, BEST SELLING or BEST RATED products (WooCommerce features)</li>	
							<li>Total items - number of items to slide in slider</li>	
							<li>Style settings - colors for text, links and background</li>
							<li>Use KenBurns effect - slow zooming out effect</li>
							<li>Use text layer animation - animation after each slider</li>
							<li>Slider navigation dots and arrows show</li>
							<li>Slider timing - how much time will each slide display before change (in milliseconds)</li>
							<li>Fade images - check if you prefer fading images over sliding</li>
							<li>Set slides height - force height of slider</li>
							<li>Additional CSS classes - add css classes defined in child theme or theme options custom css</li>
						</ul>
					
					</div>
				
				</li>

				<li class="accordion-navigation">
				
				
					<a href="#block-image-slides"><strong>Images slider</strong></a>
					

					<div id="block-image-slides" class="content">
						
						<p>
						Images slider displays simple images selected from media library in slider
						</p>
						
						<strong>OPTIONS</strong>
						<ul>
							<li>Viewport enter animation</li>
							<li>Images select (multiple)</li>
							<li>Image format (selection from registered image sizes)</li>
							<li>Image style (diamond, round or square)</li>
							<li>Image titles</li>
							<li>Image descriptions</li>
							<li>Colors for descriptions, titles and hover overlay</li>
							<li>Hide slider navigation/pagination</li>
							<li>Slider timing (pause between each slide)</li>
							<li>Responsive slide settings (number of images per one slide in screen resolutions)</li>
							<li>Additional CSS classes</li>
						</ul>
					
					</div>
				
				</li>

								
				<li class="accordion-navigation">
				
				
					<a href="#block-prod-cat"><strong>Product categories block</strong></a>


					<div id="block-prod-cat" class="content">
						
						<p>
						Simple product categories block.
						</p>
						<p><strong>NOTE: same menu as in Ajax Products block, except for ajax loading products, this menu links to product archive pages.</strong></p>
						<strong>OPTIONS</strong>
						<ul>

							<li>Viewport enter animation - css block animation when enters in the browser view.</li>
							<li>Product categories select</li>
							<li>Categories menu - with category images (set on Products > Categories) or without images</li>
							<li>Menu columns - autostretch, autofloat or fixed number</li>
							<li>Images width and height</li>

							<li>Category images - text and overlay color</li>
							
							<li>Additional CSS classes - add css classes defined in child theme or theme options custom css</li>
						</ul>
					</div>
				
				</li>
				
				<li class="accordion-navigation">
				
					<a href="#block-custom-menu"><strong>Custom menu</strong></a>


					<div id="block-custom-menu" class="content">
					
						<p>
						Display any menu created in Appearance > Menus, and place it to any custom location.
						</p>
						<p><strong>NOTE:For the moment, custom menu is usable only in manner shown in theme demo - vertical, in one third of row. Other options available soon </strong></p>
						
						<strong>OPTIONS</strong>
						<ul>

							<li>Viewport enter animation - css block animation when enters in the browser view.</li>
							<li>Select menu to display</li>
							<li>Additional CSS classes - add css classes defined in child theme or theme options custom css</li>
						</ul>
					</div>
				
				</li>
				
				<li class="accordion-navigation">
				
					<a href="#block-custom-widget"><strong>Widget area (sidebar)</strong></a>


					<div id="block-custom-widget" class="content">
					
						<p>
						Display any widget area (sidebar) created in Appearance > Widgets, and place it to any custom location.
						</p>

						<strong>OPTIONS</strong>
						<ul>

							<li>Viewport enter animation - css block animation when enters in the browser view.</li>
							<li>Widget area to display</li>
							<li>Widget title size</li>
							<li>CSS settings</li>
							<li>Additional CSS classes - add css classes defined in child theme or theme options custom css</li>
						</ul>
					</div>
				
				</li>
				
				<li class="accordion-navigation">
				
					<a href="#block-social"><strong>Social links</strong></a>


					<div id="block-social" class="content">
					
					
						<p><strong>NOTE:For the moment, custom menu is usable only in manner shown in theme demo - vertical, in one third of row. Other options available soon </strong></p>
						
						<strong>OPTIONS</strong>
						<ul>

							<li>Viewport enter animation - css block animation when enters in the browser view.</li>
							<li>Social links to display</li>
							<li>Social icons size</li>
							<li>Social icons align</li>
							<li>Social icons in row</li>
							<li>Additional CSS classes - add css classes defined in child theme or theme options custom css</li>
						</ul>
					</div>
				
				</li>
				
				<li class="accordion-navigation">
				
					<a href="#block-video"><strong>Video player</strong></a>


					<div id="block-video" class="content">
					
						<p>
						Display video from a number of video hosting services.
						</p>
						
						
						<strong>OPTIONS</strong>
						<ul>

							<li>Video hosting service selection (YouTube, Vimeo, Screenr ...)</li>
							<li>Video ID - unique video identifier - only ID, not the whole address</li>
							<li>Video width and height</li>
						</ul>
					</div>
				
				</li>
				
			</ul>
		</div>
		
	</div><!--  end Visual Composer   -->
	

	
	
	<div class="row"><br><hr class="label secondary small-6 large-offset-3 columns"><br><br></div>
	
	<!-- ============ POST FORMATS  ===============-->
	
	<div class="row" id="post-formats">
	
		<div class="small-12">
		
			<h3><b>Post formats and custom meta</b></h3>
		
		</div>
		
		<div class="small-12">
		
			<p>ShowShop theme uses Wordpress feature - <strong>post formats</strong> - to add one more layer of control over content formatting. </p>
			
			<p><strong>CUSTOM META</strong> - each post type has it's own specific settings, grouped in <strong>custom meta boxes</strong> and meta fields.</p>
			
			
			<p><strong>Post formats are used in POSTS and PORTFOLIO ITEMS</strong></p>
			
			<p class="alert alert-info"><strong>NOTE:</strong> after import of demo content <strong>WP importer doesn't import post formats for PORTFOLIO items</strong>, so those will need to be set after the import of demo content.</p>
			
			
			
			<h4>POST FORMATS used in ShowShop theme:</h4>
			
			<ul class="accordion large-block-grid-2 small-block-grid-1" data-accordion>
				
				<li class="accordion-navigation">
				
					<a href="#standard"><strong>Standard</strong></a>
					
					<div id="standard" class="content">- no special settings, apart from "General settings" metabox</div>
					
				</li>
				
				<li class="accordion-navigation">
				
				
					<a href="#pf-audio"><strong>Audio</strong></a>

					<div id="pf-audio" class="content">
						
						<p>
						by clicking on <strong>"Audio" post format tab</strong> the following <strong>custom meta box</strong> options will appear bellow the main editor
						</p>
						<strong>OPTIONS</strong>
						<ul>
							<li>Audio file - upload your mp3 audio file.</li>
						</ul>
					</div>
				
				</li>
				
				<li class="accordion-navigation">
				
					
					<a href="#pf-video"><strong>Video</strong></a>
					

					<div id="pf-video" class="content">
						
						<p>
						by clicking on <strong>"Video" post format tab</strong> the following <strong>custom meta box</strong> options will appear bellow the main editor.
						</p>
						<p class="alert alert-info">NOTE: ShowShop utilizes video host services to deliver video content, self-hosted video is not supported. With custom meta box settings add featured video, but you can add more videos with use of shortcodes.</p>
						<strong>OPTIONS</strong>
						<ul>
							<li>Video host site - choose between video host services</li>
							<li>Video ID - <strong>enter ONLY video ID</strong>, not the whole URL address to video page</li>
							<li>Width of video - enter the value AND the unit (px, em or %)</li>
							<li>Height of video - same as above</li>
							<li>Featured image or video thumbnail - ShowShop theme supports automatic usage of video thumbnails for featured image, but we recommend usage of standard WP featured image (post thumbnail)</li>
						</ul>
					</div>
					
				</li>
				
				<li class="accordion-navigation">
				
					
					<a href="#pf-gallery"><strong>Gallery</strong></a>
					

					<div id="pf-gallery" class="content">
						
						<p>
						by clicking on <strong>"Gallery" post format tab</strong> the following <strong>custom meta box</strong> options will appear bellow the main editor.
						</p>
						<p class="alert alert-info">NOTE: we recommend usage of <strong>gallery meta box</strong> for displaying image galleries - <strong>if using WP native gallery the gallery meta box settings won't apply</strong></p>
						<strong>OPTIONS</strong>
						<ul>
							<li>Gallery images - add/remove/sort images with <em>sortable and repeatable fields</em> box</li>
							<li>Gallery image format - front-end image display format (choose between registered image sizes)</li>
							<li>Slider or thumbs - display image in slider sequence or thumbnails</li>
							<li>Thumbnail columns - if "thumbs" (from prev. settings is selected) enter the number of columns</li>
							<li><strong>If slider is selected for images presentation</strong></li>
							<li>Slider navigation - show previous / next arrows on hover</li>
							<li>Slider pagination - show pagination on hover</li>
							<li>Slider timing - interval between slide transitions ( in milliseconds )</li>
							<li>Slider transition effect - css transitions</li>

						</ul>
					</div>
				</li>
				
				<li class="accordion-navigation">
				
					
					<a href="#pf-image"><strong>Image</strong></a>
					

					<div id="pf-image" class="content">
						
						<p>
						by clicking on <strong>"Image" post format tab</strong> the following <strong>custom meta box</strong> options will appear bellow the main editor.
						</p>
						Use standard "Featured image" (post thumbnail) feature. If the image caption is entered (when uploading image or in "Media" settings).
					</div>
				</li>
				
				<li class="accordion-navigation">
				
					<a href="#pf-quote"><strong>Quote</strong></a>
				

					<div id="pf-quote" class="content">
						
						<p>
						by clicking on <strong>"Quote" post format tab</strong> the following <strong>custom meta box</strong> options will appear bellow the main editor.
						</p>
						<strong>OPTIONS</strong>
						<ul>
							<li></li>
						</ul>
					</div>
				</li>
				
			</ul>
			
			<div class="clearfix"></div>
			
			<br><br>
			
			<p class="panel callout">Other supported post types: CHAT, LINK and STATUS doesn't have any additional settings</p>
			
			<p class="panel callout"><strong>GENERAL CUSTOM META</strong> - regardless on whether you are editing post, page, portfolio or slide, there is CUSTOM META BOX <strong>"General settings"</strong> on the side of the edit page. Those settings are "cross-posts" settings, some can be applied to several post types, some to all.<br />
			All general settings are explained in the general settings metabox.
			</p>
		
		</div>
		
	</div>	<!-- end pst formats -->
	
	<div class="row"><br><hr class="label secondary small-6 large-offset-3 columns"><br><br></div>
	
	
	<!-- ============ MEGA MENU  ===============-->
	
	
	<div class="row" id="mega-menu">
	
		<div class="small-12">
		
			<h3><b>MENU LOCATIONS and MEGA MENU</b></h3>
		

		</div>
		
		<div class="small-12">
		
			<p>ShowShop has following registered menus locations:</p>
			
			<ol>
				<li>Offcanvas menu </li>
				<li>Horizontal menu </li>
				<li>Vertical menu</li>
				<li>Secondary menu </li>
			</ol>
			
			<p>Any number of menu items, grouped under any menu name can be created, as long as they are <strong>assigned to menu locations using "Manage locations"</strong> or in "<strong>Menu Settings</strong>" at the bottom of menu items edit section.</p>
			
			<div class="panel">
			
				<strong>NOTICE:</strong><br>
				- one created menu can be assigned to <strong>any location</strong> or <strong>multiple locations</strong><br>
				- it's recommended to use at least two menu locations:
				<ul>
					<li>Offcanvas</li>
					<li>Horizontal or vertical</li>
				</ul>

				To make editing menus faster, there is a nice plugin for duplicating menus - <a href="http://wordpress.org/plugins/duplicate-menu/" target="_blank"><strong>Duplicate Menu</strong></a>
			
			</div>
			
			
			<div class="panel">To learn basics of administering Wordpress menu system - visit this Wordpress.org address - <a href="http://codex.wordpress.org/WordPress_Menu_User_Guide">http://codex.wordpress.org/WordPress_Menu_User_Guide</a></div>
			
			<div class="row"><hr class="label secondary small-4 large-offset-4 columns"><br></div>
			
			
			<h4><strong>MEGA MENU</strong></h4>
			
			<p><strong>Mega menu</strong> is theme built-in specific feature of ShowShop theme. It turns regular WP menu into Mega menu capable menu using <strong>custom post meta</strong> additional input fields in menu items edit page (Appearance > Menus)</p>
			
			<p class="panel"><strong>Mega menu is created with simplicity in mind, yet to offer additional options and menu system expandability. Please read carefully explanations bellow:</strong></p>
			
			<br />
			
			<h4><strong>Create Mega menu:</strong></h4><br />
			
				<ul class="large-offset-1">
					
					<li>
					
					Create 1st level menu item using <strong>"Links" (custom menu item)</strong> - drag and drop to main items editor
					
					Check the "Mega menu" checkbox - this will be the "parent" of mega menu - on this item mouse hover the sub-menu with "mega menu capabilities" will appear 
						
						<br><strong>NOTES:</strong><br>
						<p class="alert alert-danger"><strong>Only the 1st level of menu items can be MEGA MENU PARENTS</strong></p>
						<p class="alert alert-danger"><strong>Only "Links" (custom menu item) can be MEGA MENU PARENTS (or mega menu holder)</strong></p>
					
					</li>
					
					<li>Under the same 1st level menu item, create <strong>sub-menu (2nd level) item</strong> as<strong> mega menu section</strong> title (can be link too - use any menu type)
					
					</li>
					
					<li>Under the 2nd level menu item (added as section title) - add any number of menu items (in 3rd level) - those items will be grouped under the same section with title of the 2nd level item</li>
				</ul>
		
				<div class="panel callout large-offset-1"><strong>NOTE:</strong> custom fields used for creating Mega menus are also not imported with XML file- you'll need to set those manually.	
				</div>
			
				<div class="clearfix"></div>
			
			
			<h5><strong>Mega menu width</strong></h5><br />
			
				<div class="panel callout large-offset-1">Mega menu width setting is entered in <strong>1st level (parent of mega menu)</strong>, NOT in 2nd level. Use any value and unit ( % recommended)
				</div>
			
			<h5><strong>Mega menu section width</strong></h5><br />
			
				<div class="panel callout large-offset-1">Mega menu <strong>section width</strong> - use theme (Foundation) grid system to size main mega menu section.  
				</div>
			
			
			<h5><strong>"Clear for row" checkbox: </strong></h5><br />
			
			After creation of several 2nd level menu sections (and 3rd level menu items inside), it's possible to shift new menu sections in new row, separated by line. To do that:<br /><br />
			
				<ul class="large-offset-1">
					
					<li>Create 2nd level menu item - under 1st level menu item with checked "Mega menu" checkbox</li>
					
					<li>
					In 2nd level item edit box, check the <strong>"Clear for row"</strong> checkbox.
					</li>
					
					<li>
					Add more 2nd level section with 3rd level menu items (or mega menu images) after item marked "Clear new row).
					</li>
					
				</ul>
			
			<div class="clearfix"></div>
			
						
			<h5><strong>"Invisible item" checkbox:</strong></h5><br />
			
				<p class="large-offset-1">
				Invisible item (when checked) is acting as a whitespace stretcher, with space width of one regular menu item, to keep uniform layout. Usefull to make mega menu back image not interfere with menu items text (readability)
				</p>
			
			<h5><strong>"Item as section title" checkbox:</strong></h5><br />
			
				<p class="large-offset-1">
				When checked, item width will stretch to full, menu item title will be larger and styled as section title
				</p>
			
			<h5><strong>Custom image:</strong></h5><br />
			
			
			<ul class="large-offset-1">
				
				<li>Create 2nd level menu item - under 1st level menu item with checked "Mega menu" checkbox</li>
				
				<li>
				In 2nd level item edit box, under "Custom image", click on <strong>"Upload"</strong> button to upload image or select the image from media library
				</li>
				
			</ul>
			
			<div class="clearfix"></div>
			
			<h5><strong>"Post thumb and excerpt" checkbox:</strong></h5><br />
			
			
			<ul class="large-offset-1">
				
				<li>Create 2nd level menu item - under 1st level menu item with checked "Mega menu" checkbox
				
					<br><br>
					<p class="alert alert-danger"><strong>NOTE: item must be "Posts", "Products" or "Portfolio"</strong></p>
				
				</li>
				
				<li>
				In 2nd level item edit box, check the "Post thumb and excerpt" checkbox.
				</li>
				
			</ul>
			
			<div class="clearfix"></div>
			
			<h5><strong>Select icon for item</strong></h5><br />
			
				<p class="large-offset-1">
				Select icon which will be displayed before menu item navigation label
				</p>
			
			
			<h5><strong>"Simple clear" checkbox :</strong></h5><br />
			
			<p class="panel large-offset-1"><strong>2nd level mega menu items</strong> are formatted to <strong>act as section titles</strong>. To override this feature and use them as regular menu items just add <strong>simple-clear</strong> css class selector in "CSS classes (optional)" menu item field (that field must be enabled in "Screen options" )</p>
			

			
		</div>
		
	</div><!-- end MEGA MENU  ===============-->
	
	
	<div class="row"><br><hr class="label secondary small-6 large-offset-3 columns"><br><br></div>
	
	
	<!-- ============ WIDGETS  ===============-->
	
	<div class="row" id="widgets">
	
		<div class="small-12">
		
			<h3><b>Widget areas (sidebars)</b></h3>
		
		</div>
		
		<div class="small-12">
		
			
			<p class="panel callout"><strong>CUSTOM SIDEBARS</strong> - Showshop theme is equipped with custom sidebars (widget areas) creation. Custom sidebars (widget areas) can be created in APPEARANCE > THEME OPTIONS > LAYOUT SETTINGS. Custom widget areas can be selected in each post / page  edit "Custom Sidebar" meta box or in Visual Composer page builder.
			</p>
			
			
			ShowShop has following defined sidebars (or, widget areas) available for adding widgets (WP default, WooComerce or theme specific)
			<br><br>
			<ol>
				<li><strong>Sidebar</strong> - standard (left or right, depending on theme options)</li>
				<li><strong>Shop sidebar</strong> - used only on shop pages</li>
				<li><strong>Product page filter widgets</strong> only in product catalog page - use with <strong>WooCommerce Layered  Navigation</strong> widget</li>
				<li><strong>Filter reset widget</strong> - widget area reserved ONLY for reset layered navigation - use "<strong>WooCommerce Layered Nav Filters</strong>" widget <strong>ONLY</strong></li>
				<li><strong>Header widgets</strong> - for <strong>vertical</strong> side menu</li>
				<li><strong>Bottom page widgets</strong></li>
				<li><strong>Footer widgets 1</strong></li>
				<li><strong>Footer widgets 2</strong></li>
				<li><strong>Footer widgets 3</strong></li>
				<li><strong>Footer widgets 4</strong></li>
			</ol>
			<br><br>
			<p><strong>Widgets icons</strong> - All the <u>default widgets, WooCommerce widgets and theme widgets</u> have icons representing specific widgets feature or purpose - this is ShowShop specific and will be turned off on theme switch. </p>
			
			<p><strong>Widget icons</strong> can also be "turned off" in theme options (Appearance > Theme options > Blog settings > "Widget title icons ?" section)</p>
			<p><strong>NOTE: Widget icons won't apply on 3rd party widgets (the ones not mentioned above)</strong></p>
			
			<p class="alert alert-info">
			NOTE: <strong>"Shop sidebar"</strong> and widgets inside will appear only on shop pages (All products, product categories, single product, cart, checkout, account page ...) and INSTEAD of standard sidebar</p>
			
		</div>
		
	</div><!-- end WIDGETS  ===============-->
	
	
	<div class="row"><br><hr class="label secondary small-6 large-offset-3 columns"><br><br></div>
	
	
	<!-- ============ THEME OPTIONS  ===============-->
	
	<div class="row" id="theme-options">
	
		<div class="small-12">
		
			<h3><b>Theme options</b></h3>
		
		</div> 
		
		<div class="small-12">
		
			ShowShop has large array of theme options settings that will affect your site's look, feel and behaviour.
			We won't go in detailed explanation of each and every option as those are explained in Theme options panel itself (in little icon <strong>"i"</strong> on side of each option)
			
			<h4><strong>Theme options list</strong></h4>
			
			<ul class="accordion large-block-grid-2 small-block-grid-1" data-accordion>
				
				<li class="accordion-navigation">
				
					<a href="#to-general"><strong>General settings</strong></a>
				

					<div id="to-general" class="content">
						<ul>
							<li>Dynamic CSS and JS - for theme options generated files</li>
							<li>Site logo image</li>
							<li>Logo, site title and site description on/off</li>
							<li>Custom favicon</li>
							<li>Placeholder image</li>
							<li>Customize login page</li>
							<li>Login page background image</li>
							<li>Block non-admin users from WP dashboard</li>
							<li>Sidebar missing widget replacement content</li>
							<li>Hide edit pages metaboxes</li>
							<li>Email for theme contact form</li>
							<li>Smooth mousewheel scrolling toggle</li>
							<li>Use Nice scroll on SIDE MENU and MEGA MENUS</li>
							<li>Visual Composer frontend editing toggle</li>
							<li>Use preloader effect toggle</li>
							<li>Preloader animation selection</li>
							<li>Preloader and preloader background color</li>
							<li>Demo mode toggle</li>
							
						</ul>
					</div>
				
				</li>
				
				<li class="accordion-navigation">
				
					<a href="#to-shop"><strong>Shop settings</strong></a>

					<div id="to-shop" class="content">
						<ul>
							
							<li>Catalog and single page numbers (Products per page, Products columns, Related total, Related columns, Upsell products total, in row)</li>
							<li>Product categories catalog numbers (categories columns, image width and height)</li>
							<li>Category images text color</li>
							<li>Catalog shopping action buttons (toggle "Quick view", "Add to cart" and "Wishlist")</li>
							<li>Products catalog full width page toggle</li>
							<li>Single product full width page</li>
							<li>Cart and checkout full width page</li>
							<li>Products display settings (Products display settings, Disable zoom button,Disable link button)</li>
							<li>Image format for products catalog page</li>
							<li>Single product image display ( slider, thumbnails or magnifier )</li>
							<li>Single product image format select</li>
							<li>Quick view image format select</li>
							<li>Catalog page viewport animation</li>
							<li>Product image hover animation</li>
							<li>Product info hover animation</li>
							<li>Display shop title background image ?</li>
							<li>Shop title background image toggle</li>
							<li>Review stars color</li>
						</ul>
					</div>
				</li>	
				<li class="accordion-navigation">
				
					<a href="#to-layout"><strong>Layout settings</strong></a>

					<div id="to-layout" class="content">
						<ul>
							
							<li>Boxed layout (set width of boxed layout)</li>
							<li>Layout (float left, right, full width)</li>
							<li>Search type for offcanvas</li>
							<li>Advanced search fields (Search & Filter plugin)</li>
							<li>Custom sidebar (widget areas) creation</li>
							<li>Bottom widgets layout</li>
							<li>Bottom widgets grid spacing</li>
						</ul>
					</div>
				</li>
				
								
				<li class="accordion-navigation">
				
					<a href="#to-header"><strong>Header /  Side menu</strong></a>

					<div id="to-header" class="content">
						<ul>
							<li>Side menu or header menu (layout orientation)</li>
							<li>- Side menu blocks (vertical side menu)</li>
							<li>- Logo max height (vertical side menu)</li>
							<li>Header info / social links</li>
							<li>UNDER HEADER titles background image</li>
							<li>Opacity for UNDER HEADER image</li>
							<li>Logo/title height (width is auto)</li>
							<li>Title font size (percentage)</li>
							<li>Title word breaking</li>	
							<li>Header size increase</li>
							<li>Header / Side menu background color</li>
							<li>Header background color opacity</li>
							<li>Side menu background color opacity</li>
							<li>Header / Side menu font color</li>
							<li>Header / Side menu links color (primary)</li>
							<li>Header / Side menu links hover color (secondary)</li>
							<li>Show breadcrumbs toggle</li>
							<li>Breadcrumbs font color</li>
							<li>Language flags toggle (if WPML plugin is active)</li>							
						</ul>
					</div>
				</li>
				
				
				<li class="accordion-navigation">
				
					<a href="#to-typo"><strong>Style - fonts</strong></a>


					<div id="to-typo" class="content">
						<ul>
							<li>Google fonts or Typekit fonts (or system)? toggle</li>
							<li>HEADINGS FONT : Google Font</li>
							<li>BODY FONT - Google Font</li>
							<li>HEADINGS FONT : Typekit font ID</li>
							<li>Additional Google fonts (fonts separated wit comma, will display google fonts select menu after save and refreash page)</li>
							<li>HEADINGS - system font</li>
							<li>BODY FONT - system fonts</li>
						</ul>
					</div>
				</li>
				
				
				<li class="accordion-navigation">
				
					<a href="#to-style-colors"><strong>Style - colors</strong></a>


					<div id="to-style-colors" class="content">
						<ul>
							<li>Theme skins</li>
							<li>Accent colors 1 and 2</li>
							<li>Images hover overlay color</li>
							<li>Images hover overlay opacity</li>
							<li>Links color (primary)</li>
							<li>Links hover color (secondary)</li>
							<li>Buttons background color</li>
							<li>Buttons HOVER background color</li>
							<li>Buttons FOCUS background color</li>
							<li>Buttons font color</li>
							<li>Buttons HOVER font color</li>
							
						</ul>
					</div>
				</li>
				
				
				<li class="accordion-navigation">
				
					<a href="#to-style-back"><strong>Style backgrounds</strong></a>

					<div id="to-style-back" class="content">
						
						<ul>
							<li>Site background color</li>
							<li>Site background tiles or uploaded images</li>
							<li>Site tiles</li>
							<li>Site upload</li>
							<li>Site repeat, attachment, scroll</li>
							<li>Body background color</li>
							<li>Body background color opacity</li>
							<li>Theme background tiles or uploaded images</li>
							<li>Background tiles</li>
							<li>Background upload</li>
							<li>Background repeat, attachment, scroll</li>
							
						</ul>
					</div>
				</li>
				
				<li class="accordion-navigation">
				
					<a href="#to-style-special"><strong>Style special</strong></a>

					<div id="to-style-special" class="content">
						
						<ul>
							<li>Hide pages title shadow - title shadows are title duplicates, transparent and placed under page titles</li>
							<li>Borders and lines color and opacity - borders (lines) color control generally</li>
							<li>Custom CSS</li>
						</ul>
					</div>
				</li>
				
				<li class="accordion-navigation">
				
					<a href="#to-footer"><strong>Footer settings</strong></a>
					
					
					<div id="to-footer" class="content">
						<ul>
							<li>Footer font color</li>
							<li>Footer links and buttons color (primary)</li>
							<li>Footer links and buttons hover color (secondary)</li>
							<li>Footer background color</li>
							<li>Footer background color opacity</li>
							<li>Footer Credits text</li>
						</ul>
					</div>
				</li>
				
				<li class="accordion-navigation">
				
					<a href="#to-home"><strong>Home settings</strong></a>
					
					<div id="to-home" class="content">
						<ul>
							<li>Blog home page title</li>
							<li>Blog home page header background image</li>
							<li>Upload blog home page header background image</li>
						</ul>
					</div>
				</li>
				
				<li class="accordion-navigation">
				
					<a href="#to-blog"><strong>Blog</strong></a>
					
					<div id="to-blog" class="content">
						<ul>
							<li>Featured image size (in px)</li>
							<li>Single blog page title background image (featured) ?</li>
							<li>Blog archive title background image ?</li>
							<li>Upload blog archive title background image</li>
							<li>Blog CATEGORIES/TAGS title background image ?</li>
							<li>Upload blog CATEGORIES/TAGS title background image</li>
							<li>Blog AUTHOR pages title background image ?</li>
							<li>Upload blog AUTHOR pages title background image</li>
							<li>Post meta settings</li>
							<li>Post date format</li>
							<li>Show post format icons ?</li>
							<li>Widget title icons ?</li>
							<li>Archive/index page viewport animation</li>
							<li>Taxonomies page (archive) viewport animation</li>
						</ul>
					</div>
				</li>
				
				<li class="accordion-navigation">
				
					<a href="#to-port"><strong>Portfolio</strong></a>
					

					<div id="to-port" class="content">
						<ul>
							<li>Single portfolio page title background image (featured) ?</li>
							<li>Portfolio archive/taxonomies title background image ?</li>
							<li>Set portfolio archive/taxonomies title background image</li>
						</ul>
					</div>
				</li>
				
				<li class="accordion-navigation">
				
					<a href="#to-backup"><strong>Backup</strong></a>
				

					<div id="to-backup" class="content">
						<ul>
							<li>Backup theme options</li>
							<li>Transfer Theme Options Data</li>
						</ul>
					</div>
				</li>
				
			</ul>
			
			
			
		</div>
		
	</div>	<!--  end theme options  -->
	
	
	<div class="row"><br><hr class="label secondary small-6 large-offset-3 columns"><br><br></div>
	
	<!-- ============ Plugins =============== -->
	
	<div class="row" id="plugins">
		
		<div class="small-12">
		
			<h3><b>Plugins</b></h3>
		
		</div>
		
		<div class="small-12">
		
			<p>
			ShowShop theme is crafted to work with few obligatory plugins (or better - <u>highly recommended</u> - ShowShop can function without any plugin), such as:</p>
			
			
			<ul>
				<li>WooCommerce</li>
				<li>Visual Composer (PREMIUM - included in theme)</li>
				<li>Slider Revolution (PREMIUM - included in theme)</li>
				<li>Envato Wordpress Toolkit (USEFULL FOR THEME UPDATES)</li>
				<li>WooCommerce Lookbook (theme related plugin)</li>
			</ul>
			
			
			<p>and is compatible with few recommended  (3rd party) plugins, such as:</p>
			
			<ul>
				<li>Search & Filter</li>
				<li>YITH WooCommerce Wishlist</li>
				<li>Mailchimp for WordPress</li>
				<li>AS Portfolio - portfolio custom post type</li>
				<li>Attachment importer - in case of demo content import</li>
				<li>YITH WooCommerce Ajax Search</li>
				<li>WooCommerce ShareThis Integration</li>
			</ul>
			
			<hr>
			<h4><em>MailChimp / ShowShop specifics</em></h4>
			
			To set up <strong>MailChimp widget form</strong> for same appearance as in theme demo (http://aligator-studio.com/ShowShop), use following HTML code in form: ( in MailChimp fo WP > Forms )
			
			
			
			<pre>
&lt;label for="mc4wp_email"&gt;Email address: &lt;/label&gt; 

&lt;div class="showshop-mailchimp"&gt;
	&lt;input type="email" id="mc4wp_email" name="EMAIL" required placeholder="Your email address" /&gt;
	&lt;input type="submit" value="Sign up" /&gt;
&lt;/div&gt;
			</pre>
			
			
			
			If you want to revert to default (starter) MailChip form, here's the code to copy:
			
			<pre>
&lt;p&gt;
	&lt;label for="mc4wp_email"&gt;Email address: &lt;/label&gt;
	&lt;input type="email" id="mc4wp_email" name="EMAIL" required placeholder="Your email address" /&gt;
&lt;/p&gt;
&lt;p&gt;
	&lt;input type="submit" value="Sign up" /&gt;
&lt;/p&gt;
			</pre>
				
		</div>
	
	</div>	<!-- end plugins -->
	
	
	<div class="row"><br><hr class="label secondary small-6 large-offset-3 columns"><br><br></div>
	
	
	<!-- ============ WPML =============== -->
	
	<div class="row" id="wpml">	
	
		<div class="small-12">
		
			<h3><b>WPML plugin compatibility</b></h3>
		
		</div>
		
		
		<div class="small-12">
		
			<p class="alert alert-info">ShowShop theme is compatible with WPML plugin. Since WPML is third party plugin, please, first get all the info on WMPL setting up and functioning on <a href="http://wpml.org" target="_blank">WPML.org</a> pages.
			</p>
			
			<h4 class="info">LANGUAGE FILES:</h4>
			
			<ul>
				<li><strong>To translate ShowShop strings</strong> (words and phrases in theme code), use .po (and .mo) files found in ShowShop's "<strong>languages</strong>" folder.</li>
				<li><strong>WooCommerce language file</strong> can be found in plugin's "<strong>i18n/languages</strong>" directory</li>
				<li><strong>Wordpress languages files</strong> can be found in <a href="http://codex.wordpress.org/WordPress_in_Your_Language" target="_blank">Your Country WP site</a> and should be add to "<strong>wp-content/languages</strong>" directory. WP langauge files are mostly usable for default widgets translation.</li>
			
			</ul>
			
			
			<p>With ShowShop theme activated, translate posts, pages and products (and categories, custom taxonomies etc.) as for default WP themes (TwentyThirteen, TwentyTwelve ...) - ShowShop will display all the translations. However, there are some ShowShop specifics in functioning with WPML:</p>

			
			<strong>ShowShop and WMPL specific features and settings:</strong><br /><br /> 
			
			<ol>
				
				<li>
					<strong>[wmpl_translate] </strong>shortcodes:<br /><br /> 
					ShowShop utilizes custom shortcode function for usage for

					<strong>WIDGETS TITLES</strong> (if you are not going to use <a href="http://wpml.org/download/wpml-string-translation/" target="_blank">"String translation"</a> WMPL extension - <strong>NOTE: String translation for widgets work only if widgets are activated after WPML and String translation plugin activation</strong>)
					
					
					Example of shortcode usage:<br />
					
<pre>
[wpml_translate lang=en]This is my english content[/wpml_translate]
[wpml_translate lang=es]Este es el contenido español[/wpml_translate]
</pre>
			<div class="clearfix"></div>
			
				<br><br>
					
				</li>
				
				
				<li><strong>Visual Composer and WPML</strong>
				
					<p>For instructions on how to use Visual Compser and WPML in synergy - please visit this page at Wpml.org :<br> <strong><a href="http://wpml.org/2014/06/use-visual-composers-page-builders-wpml/">http://wpml.org/2014/06/use-visual-composers-page-builders-wpml/</a></strong></p>
				
				
				</li>
				
				
				<li><strong>WOOCOMMERCE AND WPML</strong>:<br /><br /> 
					<p class="info"><strong>IMPORTANT</strong>: WooCommerce and WMPL must have <a href="http://wordpress.org/extend/plugins/woocommerce-multilingual/"><strong>WooCommerce multilingual</strong></a> plugin installed (along with both WooCommerce and WPML plugins)</p>
					
					<p>For translating WooCommerce products, product categories, attributes, tags and all related to WooCommerce, please read the "<a href="http://wpml.org/documentation/related-projects/woocommerce-multilingual/" title="_blank"><strong>WooCommerce multilingual</strong></a>" tutorial section on wpml.org website</p>
				
				</li>
				

				
				<li><strong>List of all WMPL related necessary plugins</strong> (or recommended) for ShowShop/WooCommerce:
					<ul>
						<li>WPML Multilingual CMS - necessary</li>
						<li>WooCommerce Multilingual -necessary </li>
						<li>WPML CMS Nav - necessary</li>
						<li>WPML String Translation (recommended)</li>
						<li>WPML Translation Management (recommended)</li>
						<li>WPML Sticky Links (recommended)</li>
					</ul>

				</li>
				
				
			</ol>
		
		</div>
	
	</div><!-- end wpml   -->
	
	
	<div class="row"><br><hr class="label secondary small-6 large-offset-3 columns"><br><br></div>
	
	
	<!-- ============ CSS, JAVASCRIPTS, CREDITS  =============== -->
	
	<div class="row" id="scripts-credits">	
		
		<div class="small-12">
		
			<h3><b>Scripts and credits</b></h3>
		
		</div>
		
		<br />
		
		<div class="small-12">
		
			<h4><b>CSS files</b></h4>
		
		</div>
		
		<div class="small-12">
		
			<p>If you would like to edit the color, font, or style of any elements, and you have the knowledge to edit CSS files there are couple of CSS files included in theme:
			
			<ul>
				<li><strong>style.css</strong> - main ShowShop styles</li>
				<li><strong>----- In "CSS" folder:-----</strong></li>
				<li><strong>foundation.min.css</strong> - base style for grid and theme elements</li>
				<li><strong>slick.css</strong> - for slick slider</li>
				<li><strong>theme_various.min.css</strong> - reset.css, wp-defaut.css, animate.css minified in single css</li>
				<li><strong>hover.css</strong> - include in next versions - buttons hover css effects</li>
				<li><strong>----- In "CSS/admin" folder:-----</strong></li>
				<li><strong>admin/admin_styles.css</strong> - styles for different admin theme customizations</li>
				<li><strong>admin/customlogin.css</strong> - styles for admin custom login</li>
				<li><strong>admin/glyphs.css</strong> - icon fonts styles to admin pages</li>

			</ul>

			<p>or, you can edit appearance in theme options under menu in admin section ( Appearance - Theme Options - Styling Options ).</p> 	
		
		</div>

		<hr>
		
		<div class="small-12">
			<h4><b>SCRIPTS :Javascript files (jQuery).</b></h4>
		</div>
		
		<div class="small-12">
		
			<p>ShowShop uses couple of javascript files, mostly jQuery plugins by other people, and some custom created code by us. Here is the list of jQuery files use in ShowShop, all (most) in "js" folder</p>
			
			<ol>
				<li>PrettyPhoto</li>
				<li>OwlCarousel plugin</li>
				<li>jQuery Transform</li>
				<li>Debounced Resize jQuery plugin</li>
				<li>Modernizr</li>
				<li>jQuery Waypoints</li>
				<li>jQuery Easing</li>
				<li>jQuery Formalize</li>
				<li>jQuery Shuffle</li>
				<li>jQuery Paralax</li>
				<li>jQuery NiceScroll</li>
				<li>jQuery mb.YTPlayer</li>
				<li>retina.js</li>
				<li>jQuery Elevate Zoom</li>
				<li>jQuery Match Height</li>
				<li>jQuery One Page Nav Plugin</li>
				<li>Flexie - flexbox polyfill</li>
				<li>Sidebar Effects</li>
				<li>Slick slider</li>
				<li>Superslides</li>
				<li>Waypoints</li>
				<li>Sticky-Kit (sticky sidebar)</li>
				<li>DLmenu - offcanvas menu</li>
				<li>ShowShop Custom jQuery code</li>
				
			</ol>
			  

			<p>jQuery is a Javascript library that greatly reduces the amount of code that you must write.<br />
			Most of the animation in this site is carried out from the jQuery plugins included in theme and some or executed by customs scripts.<br /><br />
			To learn more about usage of <b>jQuery plugins</b> visit <a href="http://jquery.com/">jQuery site</a>:	
			</p>
		
		</div>
		
		<hr>
		
		<div class="small-12">
			<h4><b>Other (PHP frameworks and scripts)</b></h4>
		</div>
		
		<div class="small-12">
		
			<ol>
				<li>SMOF by Aquagraphite - theme options framework</li>
				<li>Custom Metaboxes and Fields framework</li>
				<li>TGM-Plugin-Activation</li>
			</ol>
		
		</div>

		<hr>
		
		<div class="small-12">
			<h4 id="plugins-2"><strong>Plugins</strong></h4>
		</div>
		
		<div class="small-12">
		
			<p>ShowShop have included <strong>Visual Composer, Slider Revolution, WooCommere Lookbook and Envato Wordpress Toolkit </strong> inside the theme, but their separate installation is needed, as well as WooCommerce, which is not included. All the plugins bellow are required: </p>
			
			<ul>
				<li><strong>WooComerce</strong>,</li> 
				<li><strong>Visual Composer</strong></li>
				<li><strong>Slider Revolution </strong></li>
				<li><strong>WooCommerce Lookbook</strong></li>
				<li><strong>Envato Wordpress Toolkit</strong></li>
			</ul>
			
			<div class="panel callout">
			ShowShop theme is <strong><em>highly customized for usage with Visual Composer plugin </em></strong>, so it is advisable to install <strong>Visual Composer</strong>. <br />
			Also, ShowShop theme is <strong>built for WooCommerce plugin</strong>, and as base for Wordpress shop site driven by WooCommerce ( not compatible with other e-commerce plugins - WP e-Commerce, Jiggo Shop etc.)<br /><br /><br />
			<strong>Slider Revolution plugin</strong> (although proclaimed as required) is optional, but we actually highly recommend it. <a href="http://themepunch.com/codecanyon/revolution_wp/documentation/" target="_blank"><strong>Slider Revolution documentation.</strong></a>
			</div>
		
		</div>
		
		<hr>
		
		
		<div class="small-12">
		
			<h4 id="credits"><strong>Sources and Credits</strong> </h4>
			
		</div>
		<div class="small-12">
		
			<p>We've used the following assets, listed with licencing info.</p> 
	
			<ul>
				
				<li><a href="http://aquagraphite.com"><strong>SMOF by Aquagraphite</strong></a> - theme options framework (  KIA Options Framework, Options Framework forks), /under GNU GPL licence </li>				
								
				<li><a href="https://github.com/thomasgriffin/TGM-Plugin-Activation"><strong>TGM-Plugin-Activation</strong></a> by Thomas Griffin / Licence under GPL v2 licence</li>
				
				<li><a href="http://foundation.zurb.com/"><strong>ZURB Foundation</strong></a> - MIT Licenced</li>
				
				<li><strong>Custom Metaboxes and Fields</strong> by <a href="http://andrewnorcross.com "> Andrew Norcross</a> ( @norcross ), <a href="http://jaredatchison.com">Jared Atchison</a> ( @jaredatch ), 
			<a href="http://billerickson.net ">Bill Erickson</a> ( @billerickson ), 
			<a href="http://hmn.md">Human Made Limited</a> ( @humanmadeltd ), 
			<a href="http://jonathanbardo.com">Jonathan Bardo</a> ( @jonathanbardo ) / Licence under GPL v2 licence or later</li>
	
				<li><a href="http://www.no-margin-for-errors.com/projects/prettyphoto-jquery-lightbox-clone/#prettyPhoto" target="_blank">PrettyPhoto</a> / Licenced under MIT and GPLv2 and “Creative Commons 2.5”</li>
				
				<li><a href="http://owlgraphic.com/owlcarousel/" target="_blank">Owl Carousel jQuery plugin</a> by Bartosz Wojciechowski / Licenced under the MIT License </li>
				
				
				<li><a href="https://github.com/louisremi/jquery.transform.js">jQuery Transform </a>by Lous Remi / Licenced under MIT licence</li>
				
				<li><a href="https://github.com/louisremi/jquery-smartresize/blob/master/jquery.debouncedresize.js">Debounced Resize jQuery plugin</a> by Louis Remi / Licenced under MIT licence</li>
				
				<li><a href="http://modernizr.com/">Modernizr</a> / Licenced under BSD and MIT licences.</li>
				
				<li><a href="https://github.com/imakewebthings/jquery-waypoints">jQuery Waypoints</a> by Caleb Troughton / Dual licensed under the MIT license and GPL license.</li>
				
				<li><a href="http://remysharp.com/" target="_blank">jQuery html5 enabling-script</a> by Remy Sharp / Licenced under MIT</li>

				
				<li><a href="http://gsgd.co.uk/sandbox/jquery/easing/">jQuery Easing</a> by George McGinley Smith/ Released under the BSD License</li>
				
				<li><a href="http://vestride.github.io/Shuffle/">jQuery Shuffle Plugin</a> by Glen Cheney / Licenced under MIT license</li>
				
				<li><a href="http://www.ianlunn.co.uk/plugins/jquery-parallax/">jQuery Parallax</a> by Ian Lunn / Licenced under MIT licence</li>
				
				<li><a href="http://malsup.com/jquery/form/">jQuery form plugin</a> Dual licensed under the MIT and GPL licenses </li>
				
				<li><a href="https://github.com/inuyaksa/jquery.nicescroll">jQuery Nicescroll plugin</a> Licensed under the MIT license </li>
				
				<li><a href="http://pupunzi.open-lab.com">jquery.mb.YTPlayer</a> by Matteo Bicocchi (Pupunzi) / Licenced under MIT licence</li>
				
				
				<li><a href="http://github.com/davist11/jQuery-One-Page-Nav">jQuery One Page Nav Plugin</a> by Trevor Davis  / Dual licensed under the MIT and GPL licenses</li>
				
				<li><a href="http://flesler.blogspot.com/2007/10/jqueryscrollto.html">jQuery.ScrollTo </a> by Ariel Flesler  / Dual licensed under the MIT and GPL licenses</li>
				
				<li><a href="www.elevateweb.co.uk/image-zoom">jQuery Elevate Zoom</a> by Andrew Eades / Dual licensed under the GPL and MIT licenses.</li>
				
				
				<li><a href="http://leafo.net/sticky-kit/">Sticky-Kit</a> by leafo / licensed under the WTFPL license.</li>
									
				<li>SmoothScroll for websites v1.2.1 by Balazs Galambosi / Michael Herf - Licensed MIT license.</li>
				
			</ul>
			
		</div>
		
		<hr>
		
		<div class="small-12">
		
			<h4><strong>Photos, images and graphics authors:</strong></h4>
			
		</div>
		<div class="small-12">
		
			<p class="alert alert-info">Bellow listed are image source pages, except for YouTube and Vimeo videos, which are linked to video pages and video author (profile) pages .<br /><br /><strong>All assets used in demo are Creative Commons and / or MIT licensed for commercial use with (or without) attributon to their authors:</strong></p>

			<ul>
					
					<li><a href="http://www.flickr.com/photos/brennuskrux/">Christian Mairitsch(brennuskrux)</a></li>
					<li><a href="http://www.flickr.com/photos/danielviero/">Daniel M Viero</a></li>
					<li><a href="http://www.flickr.com/photos/nebcat/">Deneb Catalan</a></li>
					<li><a href="http://www.flickr.com/photos/61808613@N06/">Ejja Pahlevi (saturatedhigh)</a></li>
					
					<li><a href="http://www.flickr.com/photos/31246066@N04/">Ian Sane</a></li>
					<li><a href="http://www.flickr.com/photos/jirka_matousek/">Jirka Matousek</a></li>

					<li><a href="http://www.flickr.com/photos/10797963@N03">Kuhlman</a></li>
					<li><a href="http://www.flickr.com/photos/limaoscarjuliet/">Pawel Loj</a></li>
					<li><a href="http://www.flickr.com/photos/milchcow_peng/">Peng Chen</a></li>
					<li><a href="http://www.flickr.com/photos/85546319@N04/">Robert Sheie</a></li>
					<li><a href="http://www.flickr.com/photos/abeslice/">Ryan Abel</a></li>
					<li><a href="http://www.flickr.com/photos/sbl83/">stilletobootlover</a></li>
					<li><a href="http://www.flickr.com/photos/backgroundsetc/">Bakgrounds Etc.</a></li>
					<li><a href="https://www.flickr.com/photos/126326682@N03/">Blue Inc.</a></li>
					

					<li><strong>===== no flickr: =====</strong></li>
					<li><a href="http://subtlepatterns.com/">Subtle patterns</a></li>
					<li><strong>===== VIDEO VIMEO: =====</strong></li>
					<li><strong><a href="http://vimeo.com/60736012">ETXART & PANNO | Fashion Film SS12</a></strong> from  <a href="http://vimeo.com/casanova">Casanova Comunicación</a></li>
					<li><strong><a href="http://vimeo.com/65878164">Phuong My Fashion - The Full Video</a></strong> from  <a href="http://vimeo.com/cinematicstudios">The Cinematic Studio</a></li>
					<li><strong>===== VIDEO YOUTUBE: =====</strong></li>
					<li><a href="http://www.youtube.com/watch?v=ZRswkqtANFc"><strong>WOW Love's Carner Barcelona RIMA XI</strong></a> by <a href="http://www.youtube.com/user/WOWRevista">WOW Revista</a> </li>
					<li><a href="http://www.youtube.com/watch?v=HsluhvZrtFw"><strong>Lufthansa Cargo Product Specials EN</strong></a> by <a href="http://www.youtube.com/user/LHCargoAG?feature=watch">LHCargoAG</a></li>
					<li><a href="http://www.youtube.com/watch?v=aq3P0NqxiD0"><strong>Y  & Y | River Island - Life Of Tailor Teaser</strong></a> by <a href="http://www.youtube.com/user/YinnYang7?feature=watch">Yin and Yang blog</a></li>
					<li><br><strong> ===== GRAPHIC ASSETS USED IN DEMO: ======</strong><br><br>  </li>

					<li><a href="http://www.vecteezy.com/">Vecteezy</a> vector graphics</li>
				</ul>
		
		</div>
		
		<hr>
		
		<div class="small-12">
		
			<h4><strong>Fonts used by ShowShop:</strong></h4>
			
		</div>
		<div class="small-12">
		
			<p>ShowShop features scripts for utilizing <a href="http://typekit.com">Typekit.com</a> fonts - premium web service for quality web font</p>
			
			<p>standard system fonts and web fonts and <a href="http://www.google.com/webfonts" target="_blank">Google Web Fonts</a></p>
			<hr>
		
		</div>
		
		
		
		<p class="alert alert-info">Once again, thank you very much for purchasing this theme. We would be glad to help you if you have any questions relating to this theme. No guarantees, but we'll do our best to assist.</p> 
		
		
	</div><!-- /.row --><!-- end credits-->

<footer class="row">
	
	<p class="small-12 panel">© Aligator Studio <script>document.write(new Date().getFullYear());</script></p>

</footer>


<script src="assets/js/jquery.js"></script>
<script src="../js/foundation.min.js"></script>

<script>
	$(document).foundation();

	$('a.close-and-go-to').on('click', function() {
		//$('#modal-setup-menus').foundation('reveal', 'close');
		$(this).closest('.reveal-modal').foundation('reveal', 'close');
	});

 </script>
  
</body></html>