<?php
 /*error_reporting(E_ALL); 
 ini_set("display_errors", "1");*/
if ( ! function_exists( 'redirectionV2' ) ) :
	//Fonction qui permet d'intégrer les URLs du plan de migration
	function redirectionV2() {
		$server = $_SERVER["HTTP_HOST"];
		$path = $_SERVER["DOCUMENT_ROOT"] . "/wp-content/themes/agence14bis/redirection/redirection.csv";
		$uri = str_replace("informatique-old", "informatique", $_SERVER["REQUEST_URI"]);
		//On test si le fichier est bien là
		if(is_file($path)) {
			//On l'ouvre
			$file = fopen($path, "r");
			if($file) {
				$uriToRedirect = "";
				//On regarde ligne par ligne
				while(($content = fgetcsv ($file)) !== FALSE){
					if(count($content) == 2 && $content[0] == $uri) {
						$uriToRedirect = str_replace(" ", "", $content[1]);
						break;
					}
				}
				//On ferme le fichier
				fclose($file);
				
				//On redirige si on a trouvé la chaussure
				if(!empty($uriToRedirect)) {
					header('Status: 301 Moved Permanently', false, 301);      
					header("Location: http://" . $server . $uriToRedirect);
					exit;
				}
			}
		}
		
		$slug = explode("formation-", $uri);
		if(count($slug) == 2){
			//On vite le / de la fin s'il existe
			$slug = str_replace("/", "", $slug[1]);
			$slug = explode("?", $slug);
			$slug = $slug[0];
			
			global $wpdb;
			//On regarde si c'est un slug qui existe encore
			$result = $wpdb->get_results( "SELECT guid as url FROM wpapollo_posts WHERE post_name like '%$slug%'" );
			
			//Sinon on prend juste le premier mot
			if(count($result) == 0) {
				$slug = explode("-", $slug);
				if(count($slug) > 0) {
					$slug = $slug[0];
					$result = $wpdb->get_results( "SELECT guid as url FROM wpapollo_posts WHERE post_name like '%$slug%'" );
				}
			}
			
			//On redirige si on a un résultat
			if(count($result) > 0) {
				header('Status: 301 Moved Permanently', false, 301);      
				header("Location: " . $result[0]->url);
				exit;
			}
		}
	}
endif;

/**
 * Twenty Fourteen functions and definitions
 
 * @since Twenty Fourteen 1.0
 */
if ( ! isset( $content_width ) ) {
	$content_width = 474;
}

/**
 * Twenty Fourteen only works in WordPress 3.6 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '3.6', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}

if ( ! function_exists( 'twentyfourteen_setup' ) ) :
/**
 * Twenty Fourteen setup.
 *
 * Set up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support post thumbnails.
 *
 * @since Twenty Fourteen 1.0
 */
function twentyfourteen_setup() {

	/*
	 * Make Twenty Fourteen available for translation.
	 *
	 * Translations can be added to the /languages/ directory.
	 * If you're building a theme based on Twenty Fourteen, use a find and
	 * replace to change 'twentyfourteen' to the name of your theme in all
	 * template files.
	 */
	load_theme_textdomain( 'twentyfourteen', get_template_directory() . '/languages' );

	// This theme styles the visual editor to resemble the theme style.
	add_editor_style( array( 'css/editor-style.css', twentyfourteen_font_url(), 'genericons/genericons.css' ) );

	// Add RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	// Enable support for Post Thumbnails, and declare two sizes.
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 672, 372, true );
	add_image_size( 'twentyfourteen-full-width', 1038, 576, true );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary'   => __( 'Top primary menu', 'twentyfourteen' ),
		'secondary' => __( 'Mega Menu', 'twentyfourteen' ),
		'normal' => __( 'Menu Simple', 'twentyfourteen' ),
		'responsive' => __( 'Menu Responsive', 'twentyfourteen' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'audio', 'quote', 'link', 'gallery',
	) );

	// This theme allows users to set a custom background.
	add_theme_support( 'custom-background', apply_filters( 'twentyfourteen_custom_background_args', array(
		'default-color' => 'f5f5f5',
	) ) );

	// Add support for featured content.
	add_theme_support( 'featured-content', array(
		'featured_content_filter' => 'twentyfourteen_get_featured_posts',
		'max_posts' => 6,
	) );

	// This theme uses its own gallery styles.
	add_filter( 'use_default_gallery_style', '__return_false' );
}
endif; // twentyfourteen_setup
add_action( 'after_setup_theme', 'twentyfourteen_setup' );

/**
 * Adjust content_width value for image attachment template.
 *
 * @since Twenty Fourteen 1.0
 */
function twentyfourteen_content_width() {
	if ( is_attachment() && wp_attachment_is_image() ) {
		$GLOBALS['content_width'] = 810;
	}
}
add_action( 'template_redirect', 'twentyfourteen_content_width' );

/**
 * Getter function for Featured Content Plugin.
 *
 * @since Twenty Fourteen 1.0
 *
 * @return array An array of WP_Post objects.
 */
function twentyfourteen_get_featured_posts() {
	/**
	 * Filter the featured posts to return in Twenty Fourteen.
	 *
	 * @since Twenty Fourteen 1.0
	 *
	 * @param array|bool $posts Array of featured posts, otherwise false.
	 */
	return apply_filters( 'twentyfourteen_get_featured_posts', array() );
}

/**
 * A helper conditional function that returns a boolean value.
 *
 * @since Twenty Fourteen 1.0
 *
 * @return bool Whether there are featured posts.
 */
function twentyfourteen_has_featured_posts() {
	return ! is_paged() && (bool) twentyfourteen_get_featured_posts();
}

/**
 * Register three Twenty Fourteen widget areas.
 *
 * @since Twenty Fourteen 1.0
 */
function twentyfourteen_widgets_init() {
	require get_template_directory() . '/inc/widgets.php';
	register_widget( 'Twenty_Fourteen_Ephemera_Widget' );

//404
	register_sidebar( array(
		'name'          => __( 'Page 404', 'twentyfourteen' ),
		'id'            => 'sidebar-error',
		'before_widget' => '<aside id="%1$s" class="col-md-6">',
		'after_widget'  => '</aside>',
		'before_title' => '<div class="widget-title"><span>',
        'after_title' => '</span></div>',
	) );	
//NosRreferences
	register_sidebar( array(
		'name'          => __( 'Page Nos r&eacute;f&eacute;rences', 'twentyfourteen' ),
		'id'            => 'sidebar-calendrier',
		'before_widget' => '<aside id="%1$s">',
		'after_widget'  => '</aside>',
	) );	
	
//Formations
	register_sidebar( array(
		'name'          => __( 'Formation Bloc en bas', 'twentyfourteen' ),
		'id'            => 'sidebar-formation-bottom',
		'description'   => __( 'Situ&eacute; apr&egrave;s les mots-cl&eacute;s de la page Formation', 'twentyfourteen' ),
		'before_widget' => '<aside id="%1$s">',
		'after_widget'  => '</aside>',
		'before_title' => '<div class="widgettitle">',
        'after_title' => '</div>',
	) );	
	register_sidebar( array(
		'name'          => __( 'Formation Sidebar 1', 'twentyfourteen' ),
		'id'            => 'sidebar-formation-sidebarun',
		'description'   => __( 'Formation - droite troisi&egrave;me partie', 'twentyfourteen' ),
		'before_widget' => '<aside id="%1$s">',
		'after_widget'  => '</aside>',
		'before_title' => '<div class="widgettitle">',
        'after_title' => '</div>',
	) );
	register_sidebar( array(
		'name'          => __( 'Formation Sidebar 2', 'twentyfourteen' ),
		'id'            => 'sidebar-formation-sidebardeux',
		'description'   => __( 'Formation - droite deuxi&egrave;me partie', 'twentyfourteen' ),
		'before_widget' => '<aside id="%1$s">',
		'after_widget'  => '</aside>',
		'before_title' => '<div class="widgettitle">',
        'after_title' => '</div>',
	) );
	register_sidebar( array(
		'name'          => __( 'Formation Sidebar PDF Formation', 'twentyfourteen' ),
		'id'            => 'sidebar-formation-sidebarpdf',
		'description'   => __( 'Formation - droite Generateur de PDF', 'twentyfourteen' ),
		'before_widget' => '<aside id="%1$s">',
		'after_widget'  => '</aside>',
		'before_title' => '<div class="widgettitle">',
        'after_title' => '</div>',
	) );	
	register_sidebar( array(
		'name'          => __( 'Formation Sidebar 3', 'twentyfourteen' ),
		'id'            => 'sidebar-formation-sidebartrois',
		'description'   => __( 'Formation - droite troisi&egrave;me partie', 'twentyfourteen' ),
		'before_widget' => '<aside id="%1$s">',
		'after_widget'  => '</aside>',
		'before_title' => '<div class="widgettitle">',
        'after_title' => '</div>',
	) );		
	
	

//Header

	register_sidebar( array(
		'name'          => __( 'Contact Header', 'twentyfourteen' ),
		'id'            => 'sidebar-header',
		'description'   => __( 'Champs de contact dans le header', 'twentyfourteen' ),
		'before_widget' => '<aside id="%1$s">',
		'after_widget'  => '</aside>',
	) );
	

//Filieres

	register_sidebar( array(
		'name'          => __( 'Fili&egrave;res - droite premi&egrave;re partie', 'twentyfourteen' ),
		'id'            => 'sidebar-filieres',
		'description'   => __( 'Sidebar des pages Fili&egrave;res', 'twentyfourteen' ),
		'before_widget' => '<aside id="%1$s"><div class="bloc"><div class="content">',
		'after_widget'  => '</div></div></aside>',
		'before_title' => '<div class="widgettitle"><div class="content"><h5>',
        'after_title' => '</h5></div></div>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Fili&egrave;res - droite deuxi&egrave;me partie', 'twentyfourteen' ),
		'id'            => 'sidebar-filieresdeux',
		'description'   => __( 'Sidebar des pages Fili&egrave;res', 'twentyfourteen' ),
		'before_widget' => '<aside id="%1$s"><div class="bloc"><div class="content">',
		'after_widget'  => '</div></div></aside>',
		'before_title' => '<div class="widgettitle"><div class="content"><h5>',
        'after_title' => '</h5></div></div>',
	) );
	register_sidebar( array(
		'name'          => __( 'Fili&egrave;res - droite troisi&egrave;me partie', 'twentyfourteen' ),
		'id'            => 'sidebar-filierestrois',
		'description'   => __( 'Sidebar des pages Fili&egrave;res', 'twentyfourteen' ),
		'before_widget' => '<aside id="%1$s"><div class="bloc"><div class="content">',
		'after_widget'  => '</div></div></aside>',
		'before_title' => '<div class="widgettitle"><div class="content"><h5>',
        'after_title' => '</h5></div></div>',
	) );
	register_sidebar( array(
		'name'          => __( 'Fili&egrave;res - droite quatri&egrave;me partie', 'twentyfourteen' ),
		'id'            => 'sidebar-filieresquatre',
		'description'   => __( 'Sidebar des pages Fili&egrave;res', 'twentyfourteen' ),
		'before_widget' => '<aside id="%1$s"><div class="bloc"><div class="content">',
		'after_widget'  => '</div></div></aside>',
		'before_title' => '<div class="widgettitle"><div class="content"><h5>',
        'after_title' => '</h5></div></div>',
	) );
	
	
//Accueil

	register_sidebar( array(
		'name'          => __( 'Accueil - droite premi&egrave;re partie', 'twentyfourteen' ),
		'id'            => 'sidebar-accueilright',
		'description'   => __( 'Accueil - Colone de droite', 'twentyfourteen' ),
		'before_widget' => '<aside id="%1$s"><div class="bloc">',
		'after_widget'  => '</div></aside>',
		'before_title' => '<div class="widgettitle"><h5>',
        'after_title' => '</h5></div>',
	) );
	register_sidebar( array(
		'name'          => __( 'Accueil - droite deuxi&egrave;re partie', 'twentyfourteen' ),
		'id'            => 'sidebar-accueilrightdeux',
		'description'   => __( 'Accueil - Colone de droite', 'twentyfourteen' ),
		'before_widget' => '<aside id="%1$s"><div class="bloc">',
		'after_widget'  => '</div></aside>',
		'before_title' => '<div class="widgettitle"><h5>',
        'after_title' => '</h5></div>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Accueil - gauche premi&egrave;re partie', 'twentyfourteen' ),
		'id'            => 'sidebar-accueilleft',
		'description'   => __( 'Accueil - Colone de gauche (jusqu\'au bloc &quot;Demandez votre catalogue&quot;)', 'twentyfourteen' ),
		'before_widget' => '<aside id="%1$s"><div class="bloc">',
		'after_widget'  => '</div></aside>',
		'before_title' => '<div class="widgettitle"><div class="content"><h5>',
        'after_title' => '</h5></div></div>',
	) );
	register_sidebar( array(
		'name'          => __( 'Accueil - gauche deuxi&egrave;me partie', 'twentyfourteen' ),
		'id'            => 'sidebar-accueilleft2',
		'description'   => __( 'Accueil - Colone de gauche (&agrave; partir du bloc &quot;Zoom&quot;)', 'twentyfourteen' ),
		'before_widget' => '<aside id="%1$s"><div class="bloc">',
		'after_widget'  => '</div></aside>',
		'before_title' => '<div class="widgettitle"><div class="content"><h5>',
        'after_title' => '</h5></div></div>',
	) );
	register_sidebar( array(
		'name'          => __( 'Accueil - gauche troisi&egrave;me partie', 'twentyfourteen' ),
		'id'            => 'sidebar-accueilleft3',
		'description'   => __( 'Accueil - Colone de gauche (&agrave; partir du bloc &quot;Zoom&quot;)', 'twentyfourteen' ),
		'before_widget' => '<aside id="%1$s"><div class="bloc">',
		'after_widget'  => '</div></aside>',
		'before_title' => '<div class="widgettitle"><div class="content"><h5>',
        'after_title' => '</h5></div></div>',
	) );
	register_sidebar( array(
		'name'          => __( 'Accueil - top', 'twentyfourteen' ),
		'id'            => 'sidebar-accueiltop',
		'description'   => __( 'Accueil - sous le slider', 'twentyfourteen' ),
		'before_widget' => '<aside id="%1$s" class="col-md-4 bloctop">',
		'after_widget'  => '</aside>',
	) );


	register_sidebar( array(
		'name'          => __( 'Primary Sidebar', 'twentyfourteen' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Main sidebar that appears on the left.', 'twentyfourteen' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<div class="widget-title"><span>',
		'after_title'   => '</span></div>',
	) );
	register_sidebar( array(
		'name'          => __( 'Content Sidebar', 'twentyfourteen' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Additional sidebar that appears on the right.', 'twentyfourteen' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<div class="widget-title">',
		'after_title'   => '</div>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Bloc 1', 'twentyfourteen' ),
		'id'            => 'sidebar-footer-1',
		'description'   => __( 'Appears in the footer section of the site.', 'twentyfourteen' ),
		'before_widget' => '<aside id="%1$s" class="widgets %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<div class="widget-title">',
		'after_title'   => '</div>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Bloc 2', 'twentyfourteen' ),
		'id'            => 'sidebar-footer-2',
		'description'   => __( 'Appears in the footer section of the site.', 'twentyfourteen' ),
		'before_widget' => '<aside id="%1$s" class="widgets %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<div class="widget-title">',
		'after_title'   => '</div>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Bloc 3', 'twentyfourteen' ),
		'id'            => 'sidebar-footer-3',
		'description'   => __( 'Appears in the footer section of the site.', 'twentyfourteen' ),
		'before_widget' => '<aside id="%1$s" class="widgets %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<div class="widget-title">',
		'after_title'   => '</div>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Bloc 4', 'twentyfourteen' ),
		'id'            => 'sidebar-footer-4',
		'description'   => __( 'Appears in the footer section of the site.', 'twentyfourteen' ),
		'before_widget' => '<aside id="%1$s" class="widgets %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<div class="widget-title">',
		'after_title'   => '</div>',
	) );
}
add_action( 'widgets_init', 'twentyfourteen_widgets_init' );






/**
 * Register Lato Google font for Twenty Fourteen.
 *
 * @since Twenty Fourteen 1.0
 *
 * @return string
 */
function twentyfourteen_font_url() {
	$font_url = '';
	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Lato, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Open Sans font: on or off', 'twentyfourteen' ) ) {
		$query_args = array(
			'family' => urlencode( 'Open+Sans:400,300,600,700,800' ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);
		$font_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css?' );
	}

	return $font_url;
}

/**
 * Enqueue scripts and styles for the front end.
 *
 * @since Twenty Fourteen 1.0
 */
function twentyfourteen_scripts() {
	// Add Lato font, used in the main stylesheet.
	
	
	// Load our main stylesheet.
	wp_enqueue_style( 'twentyfourteen-style', get_stylesheet_uri() );

	// Load the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'twentyfourteen-ie', get_template_directory_uri() . '/css/ie.css', array( 'twentyfourteen-style' ), '20131205' );
	wp_style_add_data( 'twentyfourteen-ie', 'conditional', 'lt IE 9' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'twentyfourteen-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20130402' );
	}

	if ( is_active_sidebar( 'sidebar-3' ) ) {
		wp_enqueue_script( 'jquery-masonry' );
	}

	//if ( is_front_page() && 'slider' == get_theme_mod( 'featured_content_layout' ) ) {
//		wp_enqueue_script( 'twentyfourteen-slider', get_template_directory_uri() . '/js/slider.js', array( 'jquery' ), '20131205', true );
//		wp_localize_script( 'twentyfourteen-slider', 'featuredSliderDefaults', array(
//			'prevText' => __( 'Previous', 'twentyfourteen' ),
//			'nextText' => __( 'Next', 'twentyfourteen' )
//		) );
//	}

	wp_enqueue_script( 'twentyfourteen-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20150315', true );
}
add_action( 'wp_enqueue_scripts', 'twentyfourteen_scripts' );

/**
 * Enqueue Google fonts style to admin screen for custom header display.
 *
 * @since Twenty Fourteen 1.0
 */
function twentyfourteen_admin_fonts() {
	wp_enqueue_style( 'twentyfourteen-lato', twentyfourteen_font_url(), array(), null );
}
add_action( 'admin_print_scripts-appearance_page_custom-header', 'twentyfourteen_admin_fonts' );

if ( ! function_exists( 'twentyfourteen_the_attached_image' ) ) :
/**
 * Print the attached image with a link to the next attached image.
 *
 * @since Twenty Fourteen 1.0
 */
function twentyfourteen_the_attached_image() {
	$post                = get_post();
	/**
	 * Filter the default Twenty Fourteen attachment size.
	 *
	 * @since Twenty Fourteen 1.0
	 *
	 * @param array $dimensions {
	 *     An array of height and width dimensions.
	 *
	 *     @type int $height Height of the image in pixels. Default 810.
	 *     @type int $width  Width of the image in pixels. Default 810.
	 * }
	 */
	$attachment_size     = apply_filters( 'twentyfourteen_attachment_size', array( 810, 810 ) );
	$next_attachment_url = wp_get_attachment_url();

	/*
	 * Grab the IDs of all the image attachments in a gallery so we can get the URL
	 * of the next adjacent image in a gallery, or the first image (if we're
	 * looking at the last image in a gallery), or, in a gallery of one, just the
	 * link to that image file.
	 */
	$attachment_ids = get_posts( array(
		'post_parent'    => $post->post_parent,
		'fields'         => 'ids',
		'numberposts'    => -1,
		'post_status'    => 'inherit',
		'post_type'      => 'attachment',
		'post_mime_type' => 'image',
		'order'          => 'ASC',
		'orderby'        => 'menu_order ID',
	) );

	// If there is more than 1 attachment in a gallery...
	if ( count( $attachment_ids ) > 1 ) {
		foreach ( $attachment_ids as $attachment_id ) {
			if ( $attachment_id == $post->ID ) {
				$next_id = current( $attachment_ids );
				break;
			}
		}

		// get the URL of the next image attachment...
		if ( $next_id ) {
			$next_attachment_url = get_attachment_link( $next_id );
		}

		// or get the URL of the first image attachment.
		else {
			$next_attachment_url = get_attachment_link( reset( $attachment_ids ) );
		}
	}

	printf( '<a href="%1$s" rel="attachment">%2$s</a>',
		esc_url( $next_attachment_url ),
		wp_get_attachment_image( $post->ID, $attachment_size )
	);
}
endif;



/**
 * Extend the default WordPress body classes.
 *
 * Adds body classes to denote:
 * 1. Single or multiple authors.
 * 2. Presence of header image except in Multisite signup and activate pages.
 * 3. Index views.
 * 4. Full-width content layout.
 * 5. Presence of footer widgets.
 * 6. Single views.
 * 7. Featured content layout.
 *
 * @since Twenty Fourteen 1.0
 *
 * @param array $classes A list of existing body class values.
 * @return array The filtered body class list.
 */
function twentyfourteen_body_classes( $classes ) {
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	if ( get_header_image() ) {
		$classes[] = 'header-image';
	} elseif ( ! in_array( $GLOBALS['pagenow'], array( 'wp-activate.php', 'wp-signup.php' ) ) ) {
		$classes[] = 'masthead-fixed';
	}

	if ( is_archive() || is_search() || is_home() ) {
		$classes[] = 'list-view';
	}

	if ( ( ! is_active_sidebar( 'sidebar-2' ) )
		|| is_page_template( 'page-templates/full-width.php' )
		|| is_page_template( 'page-templates/contributors.php' )
		|| is_attachment() ) {
		$classes[] = 'full-width';
	}

	if ( is_active_sidebar( 'sidebar-footer-1' ) && is_active_sidebar( 'sidebar-footer-2' )  && is_active_sidebar( 'sidebar-footer-3' )  && is_active_sidebar( 'sidebar-footer-4' ) ) {
		$classes[] = 'footer-widgets';
	}

	if ( is_singular() && ! is_front_page() ) {
		$classes[] = 'singular';
	}
	if ( is_single() ) {
		$classes[] = 'page';
	}

	//if ( is_front_page() && 'slider' == get_theme_mod( 'featured_content_layout' ) ) {
//		$classes[] = 'slider';
//	} elseif ( is_front_page() ) {
//		$classes[] = 'grid';
//	}

	return $classes;
}
add_filter( 'body_class', 'twentyfourteen_body_classes' );

/**
 * Extend the default WordPress post classes.
 *
 * Adds a post class to denote:
 * Non-password protected page with a post thumbnail.
 *
 * @since Twenty Fourteen 1.0
 *
 * @param array $classes A list of existing post class values.
 * @return array The filtered post class list.
 */
function twentyfourteen_post_classes( $classes ) {
	if ( ! post_password_required() && ! is_attachment() && has_post_thumbnail() ) {
		$classes[] = 'has-post-thumbnail';
	}

	return $classes;
}
add_filter( 'post_class', 'twentyfourteen_post_classes' );

/**
 * Create a nicely formatted and more specific title element text for output
 * in head of document, based on current view.
 *
 * @since Twenty Fourteen 1.0
 *
 * @global int $paged WordPress archive pagination page count.
 * @global int $page  WordPress paginated post page count.
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */
function twentyfourteen_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() ) {
		return $title;
	}

	// Add the site name.
	$title .= get_bloginfo( 'name', 'display' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title = "$title $sep $site_description";
	}

	// Add a page number if necessary.
	if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
		$title = "$title $sep " . sprintf( __( 'Page %s', 'twentyfourteen' ), max( $paged, $page ) );
	}

	return $title;
}
add_filter( 'wp_title', 'twentyfourteen_wp_title', 10, 2 );

// Implement Custom Header features.
require get_template_directory() . '/inc/custom-header.php';

// Custom template tags for this theme.
require get_template_directory() . '/inc/template-tags.php';

// Add Customizer functionality.
require get_template_directory() . '/inc/customizer.php';

/*
 * Add Featured Content functionality.
 *
 * To overwrite in a plugin, define your own Featured_Content class on or
 * before the 'setup_theme' hook.
 */
if ( ! class_exists( 'Featured_Content' ) && 'plugins.php' !== $GLOBALS['pagenow'] ) {
	require get_template_directory() . '/inc/featured-content.php';
}


//Dashboard 14 Bis

add_action('wp_dashboard_setup', 'my_custom_dashboard_widgets');
function my_custom_dashboard_widgets() {
global $wp_meta_boxes;
wp_add_dashboard_widget('custom_help_widget', 'Bienvenue', 'custom_dashboard_help');
}
function custom_dashboard_help() {
echo '<p>Th&egrave;me cr&eacute;e pour <b>Apollo Formation</b> par l&rsquo;Agence 14 Bis - <a href="http://14bis.fr" target="_blank">14bis.fr</a></p>
Votre contact : <br/>Vanessa Sant&rsquo;Andr&eacute;<br/>
<a href="mailto:vanessa@14bis.fr">vanessa@14bis.fr</a><br/>
06 62 05 63 36<br/>
skype : vanessa.14bis
<br/>
<br/>
<a href="http://14bis.fr" target="_blank"><img src="http://www.14bis.fr/wp-content/uploads/signature-email.png" style="width:100%" /></a>';

}

//Supprimer Scripts et css Emoji
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );

//Supprimer CSS SuperPost
add_action( 'wp_print_styles', 'deregister_my_styles', 100 );
function deregister_my_styles() {
	wp_deregister_style( 'super-post' );
	
} 


//Custom posts : Slider Accueil & References Client & Formation
add_action( 'init', 'create_post_type' );
function create_post_type() {
	//Slider
  register_post_type( 'slider_post',
    array(
      'labels' => array(
        'name' => __( 'Slider' ),
        'singular_name' => __( 'Sliders' )
      ),
      'public' => true,
      'has_archive' => false,
	  'menu_icon' => 'dashicons-images-alt',
    )
  );
  //References
  register_post_type( 'references_post',
    array(
      'labels' => array(
        'name' => __( 'R&eacute;f&eacute;rences' ),
        'singular_name' => __( 'R&eacute;f&eacute;rences' )
      ),
      'public' => true,
      'has_archive' => false,
	  'capability_type'    => 'post',

        'capabilities'       => array( 'create_posts' => false ),       

        'map_meta_cap'       => true,
	  'menu_icon' => 'dashicons-universal-access-alt',
    )
  );
   //Images Modals
  register_post_type( 'modals_post',
    array(
      'labels' => array(
        'name' => __( 'Images Modals' ),
        'singular_name' => __( 'Images Modals' )
      ),
      'public' => true,
      'has_archive' => false,
	  'capability_type'    => 'post',

        'capabilities'       => array( 'create_posts' => false ),       

        'map_meta_cap'       => true,
	  'menu_icon' => 'dashicons-media-spreadsheet',
    )
  );
  //Formation
   register_post_type( 'formation_post',
    array(
      'labels' => array(
        'name' => __( 'Formation' ),
        'singular_name' => __( 'Formation' ),
		'add_new' => _x( 'Ajouter', 'formation_post' ),
        'add_new_item' => _x( 'Ajouter une formation', 'formation_post' ),
		'edit_item' => _x( 'Editer une formation', 'formation_post' ),
        'new_item' => _x( 'Nouvelle formation', 'formation_post' ),
        'view_item' => _x( 'Voir la formation', 'formation_post' ),
        'search_items' => _x( 'Rechercher une formation', 'formation_post' ),
        'not_found' => _x( 'Aucune formation trouvee', 'formation_post' ),
        'not_found_in_trash' => _x( 'Aucune formation dans la corbeille', 'formation_post' ),
        'menu_name' => _x( 'Formations', 'formation_post' ),
      ),
      'public' => true,
	  'menu_icon' => 'dashicons-smiley',
      'has_archive' => true,
	  'capability_type' => 'post',
	  
	  
	  'rewrite'		=> array('slug' => 'informatique/%filieres%',"with_front'=>false"),
	  //'rewrite' => array("slug" => "formation"), // Permalinks format
	  	//'publicly_queryable' => true,
	'supports' => array('title','author','excerpt','revisions','editor','thumbnail'),
	'description' => 'Toutes les formations Apollo Formation',
	'taxonomies' => array( 'filieres' ),
	'menu_position' => 2,
	'show_in_nav_menus' => true,
     'exclude_from_search' => false,
	  'can_export' => true,
	  'show_ui' => true,
	  'hierarchical' => false,
    )
	 );
}




//.HTML dans les Pages
add_action('init', 'html_page_permalink', -1);
register_activation_hook(__FILE__, 'active');
register_deactivation_hook(__FILE__, 'deactive');


function html_page_permalink() {
	global $wp_rewrite;
 if ( !strpos($wp_rewrite->get_page_permastruct(), '.html')){
		$wp_rewrite->page_structure = $wp_rewrite->page_structure . '.html';
 }
}
add_filter('user_trailingslashit', 'no_page_slash',66,2);
function no_page_slash($string, $type){
   global $wp_rewrite;
	if ($wp_rewrite->using_permalinks() && $wp_rewrite->use_trailing_slashes==true && $type == 'page'){
		return untrailingslashit($string);
  }else{
   return $string;
  }
}

function active() {
	global $wp_rewrite;
	if ( !strpos($wp_rewrite->get_page_permastruct(), '.html')){
		$wp_rewrite->page_structure = $wp_rewrite->page_structure . '.html';
 }
  $wp_rewrite->flush_rules();
}	
	function deactive() {
		global $wp_rewrite;
		$wp_rewrite->page_structure = str_replace(".html","",$wp_rewrite->page_structure);
		$wp_rewrite->flush_rules();
	}





// Redirection des posts formation vers la page single formation.php
function my_template_redirect()
{
	global $wp;
	global $wp_query;
	if ($wp->query_vars["post_type"] == "formation_post")
	{
		// Let's look for the formation.php template file in the current theme
		if (have_posts())
		{
			include(TEMPLATEPATH . '/formation.php');
			die();
		}
		else
		{
			$wp_query->is_404 = true;
		}
	}
}
// Creer un template specifique pour les formations
add_action("template_redirect", 'my_template_redirect');


//Redirection de la recherche formation vers la page search recherche-formation.php
 function template_chooser($template)   
{    
  global $wp_query;   
  $post_type = get_query_var('post_type');   
  if( $wp_query->is_search && $post_type == 'formation_post' )   
  {
    return locate_template('recherche-formation.php');  //  redirect to recherche-formation.php
  }   
  return $template;   
}
add_filter('template_include', 'template_chooser');    





//Taxonomie Filieres

function custcpt_category_taxonomy() {
    $labels = array(
        'name'              => __( 'Fili&egrave;re' ),
        'singular_name'     => __( 'Fili&egrave;re' ),
        'search_items'      => __( 'Rechercher une Fili&egrave;re' ),
        'all_items'         => __( 'Toutes les Fili&egrave;res' ),
        'parent_item'       => __( 'Fili&egrave;re Parent' ),
        'parent_item_colon' => __( 'Fili&egrave;re Parent:' ),
        'edit_item'         => __( 'Editer Fili&egrave;re' ), 
        'update_item'       => __( 'Mise &agrave; jour de la Fili&egrave;re' ),
        'add_new_item'      => __( 'Ajouter une nouvelle Fili&egrave;re' ),
        'new_item_name'     => __( 'Nouvelle Fili&egrave;re' ),
        'menu_name'         => __( 'Fili&egrave;res' ),
    ); 
    $args = array(
        'labels'            => $labels,
        'public'            =>  true,
        'hierarchical'      =>  true,
        'show_in_nav_menus' =>  true,
        'has_archive'       =>  true,
        'rewrite'           =>  array('slug' => 'informatique', 'with_front' => true,'hierarchical' => true),
	
    );
    register_taxonomy( 'filieres', 'formation_post', $args );
	
	
}
add_action( 'init', 'custcpt_category_taxonomy');
function custcpttag_category_taxonomy() {
	//Taxonomie Tags
	$labels = array(
        'name'              => __( 'Tags' ),
        'singular_name'     => __( 'Tags' ),
    ); 
    $args = array(
        'labels'            => $labels,
        'public'            =>  true,
        'hierarchical'      =>  false,
        'has_archive'       =>  false,
    );
    register_taxonomy( 'formation_tags', 'formation_post', $args );
}
add_action( 'init', 'custcpttag_category_taxonomy');


/*Rewriting formations*/

add_filter('rewrite_rules_array', 'mmp_rewrite_rules');
function mmp_rewrite_rules($rules) {
    $newRules  = array();
    $newRules['informatique/(.+)/(.+)/(.+)/(.+)/?.html$'] = 'index.php?formation_post=$matches[4]'; // my custom structure will always have the post name as the 5th uri segment
	$newRules['informatique/(.+)/(.+)/(.+)/?.html$'] = 'index.php?formation_post=$matches[3]'; // my custom structure will always have the post name as the 5th uri segment
	$newRules['informatique/(.+)/(.+)/?.html$'] = 'index.php?formation_post=$matches[2]'; // my custom structure will always have the post name as the 5th uri segment
	$newRules['informatique/(.+)/?.html$'] = 'index.php?formation_post=$matches[1]'; // my custom structure will always have the post name as the 5th uri segment
    $newRules['informatique/(.+)/?$'] = 'index.php?filieres=$matches[1]'; 
	
	$newRules['metiers/(.+)/(.+)/(.+)/(.+)/?.html$'] = 'index.php?formation_post=$matches[4]'; // my custom structure will always have the post name as the 5th uri segment
	$newRules['metiers/(.+)/(.+)/(.+)/?.html$'] = 'index.php?formation_post=$matches[3]'; // my custom structure will always have the post name as the 5th uri segment
	$newRules['metiers/(.+)/(.+)/?.html$'] = 'index.php?formation_post=$matches[2]'; // my custom structure will always have the post name as the 5th uri segment
	$newRules['metiers/(.+)/?.html$'] = 'index.php?formation_post=$matches[1]'; // my custom structure will always have the post name as the 5th uri segment
    $newRules['metiers/(.+)/?$'] = 'index.php?filieres=$matches[1]'; 
	
    return array_merge($newRules, $rules);
}



function filter_post_type_link($link, $post)
{
    if ($post->post_type != 'formation_post')
        return $link;

    if ($cats = get_the_terms($post->ID, 'filieres'))
    {
        $link = str_replace('informatique/%filieres%', get_taxonomy_parents(array_pop($cats)->term_id, 'filieres', false, '/', true), $link);
		
    }
    return $link.'.html';
}
add_filter('post_type_link', 'filter_post_type_link', 10, 2);



function filter_post_type_link_metiers($link, $post)
{
    if ($post->post_type != 'formation_post')
        return $link;

    if ($cats = get_the_terms($post->ID, 'filieres'))
    {
        $link = str_replace('metiers/%filieres%', get_taxonomy_parents(array_pop($cats)->term_id, 'filieres', false, '/', true), $link);
		
    }
    return $link;
}
add_filter('post_type_link', 'filter_post_type_link_metiers', 10, 3);


function get_taxonomy_parents($id, $taxonomy, $link = false, $nicename = false, $visited = array()) {       
    $chain = '';   
    $parent = &get_term($id, $taxonomy);

    if (is_wp_error($parent)) {
        return $parent;
    }

    if ($nicename)    
        $name = $parent -> slug;        
    else    
        $name = $parent -> name;
$visited= array();
    if ($parent -> parent && ($parent -> parent != $parent -> term_id) && !in_array($parent -> parent, $visited)) {    
        $visited[] = $parent -> parent;    
        $chain .= get_taxonomy_parents($parent -> parent, $taxonomy, $link, $nicename, $visited); 
        $chain .= "/"; 
    }

    if ($link) {
    } else    
        $chain .= $name;
    return $chain;
}




/*Ajouter formation dans Nom Classe pr defaul*/

function prefix_post_year( $post_id ) {
    $current_post = get_post( $post_id );

    if ( $current_post->post_date == $current_post->post_modified ) {
        wp_set_object_terms( $post_id,'Uncategorized','filieres', true );
    }
}
add_action( 'save_post_formation_post', 'prefix_post_year' );


/**Size slider image*/
add_image_size( 'image-slider', 2200, 638 , true ); 


/**Limiter excerpt*/
function excerpt($num) {
        $limit = $num+1;
        $excerpt = explode(' ', get_the_excerpt(), $limit);
        array_pop($excerpt);
        $excerpt = implode(" ",$excerpt)."...";
        echo $excerpt;
    }


/**Breadcrumb*/
add_filter( 'wpseo_breadcrumb_output', 'custom_wpseo_breadcrumb_output' );

function custom_wpseo_breadcrumb_output( $output ){
if ( is_singular( 'formation_post' ) ){
$from = 'informatique/%filieres%" rel="v:url" property="v:title">Formation</a>'; 
$to = 'informatique" rel="v:url" property="v:title">informatique</a>';
$output = str_replace( $from, $to, $output );
}
return $output;
}


/**Empecher maj des plugins sur mesure pour pas ecraser nos modifications**/ 

remove_action( 'load-update-core.php', 'wp_update_plugins' );
add_filter( 'pre_site_transient_update_plugins', create_function( '$a', "return null;" ) );


function stop_plugin_update( $value ) {
 unset( $value->response['ajax-search-pro/ajax-search-pro.php'] );
 unset( $value->response['fix-filieres/remove-taxonomy-base-slug.php'] );
  unset( $value->response['super-post/super-post.php'] );
 return $value;
}
add_filter( 'site_transient_update_plugins', 'stop_plugin_update' );



/**Ajouter html dans le titre du widget**/
function html_widget_title( $title ) {
$title = str_replace( '[', '<', $title );
$title = str_replace( '[/', '</', $title );
$title = str_replace( 'b]', 'b>', $title );
$title = str_replace( 'b]', 'b>', $title );
return $title;
}
add_filter( 'widget_title', 'html_widget_title' );

/**Compteur d'articles dans le menu**/
//add_filter('the_title', 'wpse165333_the_title', 10, 2);
//function wpse165333_the_title($title, $post_ID)
//{
//    if( 'nav_menu_item' == get_post_type($post_ID) )
//    {
//        if( 'taxonomy' == get_post_meta($post_ID, '_menu_item_type', true) && 'filieres' == get_post_meta($post_ID, '_menu_item_object', true) )
//        {
//            $category = get_category( get_post_meta($post_ID, '_menu_item_object_id', true) );
//            $title .= sprintf('<span class="count">%d</span>', $category->count);
//        }
//    }
//    return $title;
//}

/**Ajouter body_class dans la page 404**/
add_filter( 'body_class','notfound_body_class' );
function notfound_body_class( $classes ) {
 
    if ( is_404() ) {
		//On check le plan de migration des URLs
		redirectionV2();
        $classes[] = 'page singular';
    }
	if ( '22021' == $post->post_parent) {
        $classes[] = 'page-template-default singular';
    }
	if ( is_category() ) {
        $classes[] = 'page singular';
    }
	if ( is_home() ) {
        $classes[] = 'page singular';
    }
    return $classes;
     
}


add_filter( 'gform_pre_render_1', 'populate_information_request' );
add_filter( 'gform_pre_render_6', 'populate_information_request' );
add_filter( 'gform_pre_render_10', 'populate_information_request' );
add_filter( 'gform_pre_render_11', 'populate_information_request' );

function populate_information_request( $form ) {
	$formation = get_post( get_query_var( 'formation_id' ) );

	global $wpdb;
	$sessions = $wpdb->get_results( $wpdb->prepare( "
		SELECT c.id as id, a.NomAgence as agence, c.date_cal AS date
		FROM form_calendrier c
		LEFT JOIN agences a ON a.IdAgence = c.id_agence
		WHERE c.id_formation = %d
		AND c.date_cal >= NOW()
		ORDER BY c.date_cal ASC
	" , $formation->ID ));

	/** @var GF_Field $field */
	foreach ( $form['fields'] as &$field ) {
		if ( $field->type === 'select' && $field->inputName === 'agence_session' ) {
			$choices = array();
			foreach ( $sessions as $session ) {
				$text = sprintf( __( "%s, le %s" ), $session->agence, date_i18n( get_option( 'date_format' ), strtotime( $session->date ) ));
				$choices[] = array( 'text' => $text, 'value' => $session->id, 'isSelected' => $session->id == get_query_var( 'session_id', null ) );
			}

			$field->choices = $choices;

		} else if ( $field->inputName === 'id_formation' ) {
			$field->defaultValue = $formation->ID;

		} else if ( $field->inputName === 'nom_formation' ) {
			$field->defaultValue = $formation->post_title;
		}
	}

	return $form;
}

add_action( 'gform_after_submission_1', 'save_information_request_1', 10, 2 );

function save_information_request_1( $entry, $form ) {
	session_start();
	global $wpdb;

	$post_id = $entry['29'];
	$formation = get_post($post_id);

	$inter_intrat = array(
		'Inter-entreprise' => '0',
		'Intra-entreprise' => '1',
		'Cours Particulier' => '2'
	);

	$civilite_contact = array(
		'Monsieur' => 'M',
		'Madame' => 'Mme'
	);

	$data = array(
		'inter_intra' => $inter_intrat[$entry['3']],
		'agence_apollo' => '',
		'date_souhaitee' => '',
		'todo' => '',
		'periode_debut' => '',
		'periode_fin' => '',
		'civilite_contact' => $civilite_contact[$entry['6']],
		'nom_contact' => $entry['8.6'],
		'prenom_contact' => $entry['8.3'],
		'email_contact' => $entry['9'],
		'tel_contact' => $entry['10'],
		'nom_societe' => $entry['40'],
		'adresse1_societe' => $entry['15.1'],
		'adresse2_societe' => $entry['15.2'],
		'cp_societe' => $entry['15.5'],
		'ville_societe' => $entry['15.3'],
		'pays_societe' => $entry['15.6'],
		'precision_client' => $entry['12'],
		'date_demande' => date('Y-m-d H:i:s'),
		'id_formation' => $formation->ID,
		'provenance' => '1',
		'statut' => '0',
		'etape' => '0',
		'nb_jour_formation' => get_field( 'duree', $formation->ID ),
		'site_save' => '',
		'objectifs' => $formation->post_excerpt,
		'plan_formation' => $formation->post_content,
		'prix_inter' => get_field( 'inter', $formation->ID ),
		'prix_intra' => get_field( 'intra', $formation->ID ),
		'inter_intra_origine' => $inter_intrat[$entry['3']],
		'id_statut_contact' => get_id_statut_contact( $entry['11'] ),
		'id_secteur_activite' => get_id_secteur_activite( $entry['34'] ),
		'id_fonction' => get_id_fonction( $entry['36'] ),
		'id_departement' => get_id_departement( $entry['35'] )

	);

	if ( $entry['3'] == 'Inter-entreprise' ) {
		$session_id = $entry[4];

		// Récupération de la session choisie
		$session = $wpdb->get_row( $wpdb->prepare( "
				SELECT c.id as id, a.NomAgence as agence, a.IdAgence as agence_id, c.date_cal AS date
				FROM form_calendrier c
				LEFT JOIN agences a ON a.IdAgence = c.id_agence
				WHERE c.id = %d
			" , $session_id ));

		$data['agence_apollo'] = $session->agence_id;
		$data['date_souhaitee'] = $session->date;

	} else {
		$data['periode_debut'] = $entry[41];
		$data['periode_fin'] = $entry[42];
		$data['todo'] = $entry[44];
	}

	$wpdb->insert( 'affaire_formation', $data );
	$affaire_id = $wpdb->insert_id;

	$data['nb_participants'] = $entry['2'];
	for ( $i = 1; $i <= $data['nb_participants']; $i++ ) {
		$wpdb->insert( 'affaire_formation_participant', array( 'id_affaire' => $affaire_id ) );
	}

	if ( isset( $session ) ) {
		$data['agence_name'] = $session->agence;
		$data['agence_id'] = $session->agence_id;

		$wpdb->insert( 'lieu_affaire', array( 'id_affaire' => $affaire_id, 'id_agence' => $session->agence_id ) );
	}

	$_SESSION['entry_information_request'] = $data;
}

add_action( 'gform_after_submission_6', 'save_information_request_6', 10, 2 );

function save_information_request_6( $entry, $form ) {
	session_start();
	global $wpdb;

	$post_id = $entry['29'];
	$formation = get_post($post_id);

	$inter_intrat = array(
		'Inter-entreprise' => '0',
		'Intra-entreprise' => '1',
		'Cours Particulier' => '2'
	);

	$civilite_contact = array(
		'Monsieur' => 'M',
		'Madame' => 'Mme'
	);

	$data = array(
		'inter_intra' => $inter_intrat[$entry['3']],
		'agence_apollo' => '',
		'date_souhaitee' => '',
		'todo' => $entry[37],
		'periode_debut' => $entry[38],
		'periode_fin' => $entry[39],
		'civilite_contact' => $civilite_contact[$entry['6']],
		'nom_contact' => $entry['8.6'],
		'prenom_contact' => $entry['8.3'],
		'email_contact' => $entry['9'],
		'tel_contact' => $entry['10'],
		'nom_societe' => $entry['43'],
		'adresse1_societe' => $entry['15.1'],
		'adresse2_societe' => $entry['15.2'],
		'cp_societe' => $entry['15.5'],
		'ville_societe' => $entry['15.3'],
		'pays_societe' => $entry['15.6'],
		'precision_client' => $entry['12'],
		'date_demande' => date('Y-m-d H:i:s'),
		'id_formation' => $formation->ID,
		'provenance' => '1',
		'statut' => '0',
		'etape' => '0',
		'nb_jour_formation' => get_field( 'duree', $formation->ID ),
		'site_save' => '',
		'objectifs' => $formation->post_excerpt,
		'plan_formation' => $formation->post_content,
		'prix_inter' => get_field( 'inter', $formation->ID ),
		'prix_intra' => get_field( 'intra', $formation->ID ),
		'inter_intra_origine' => $inter_intrat[$entry['3']],
		'id_statut_contact' => get_id_statut_contact( $entry['11'] ),
		'id_secteur_activite' => get_id_secteur_activite( $entry['34'] ),
		'id_fonction' => get_id_fonction( $entry['36'] ),
		'id_departement' => get_id_departement( $entry['35'] )
	);

	$wpdb->insert( 'affaire_formation', $data );
	$affaire_id = $wpdb->insert_id;

	$data['nb_participants'] = $entry['2'];
	for ( $i = 1; $i <= $data['nb_participants']; $i++ ) {
		$wpdb->insert( 'affaire_formation_participant', array( 'id_affaire' => $affaire_id ) );
	}

	$_SESSION['entry_information_request'] = $data;
}

add_action( 'gform_after_submission_10', 'save_information_request_10', 10, 2 );

function save_information_request_10( $entry, $form ) {
	session_start();
	global $wpdb;

	$post_id = $entry['29'];
	$formation = get_post($post_id);

	$inter_intrat = array(
		'Inter-entreprise' => '0',
		'Intra-entreprise' => '1',
		'Cours Particulier' => '2'
	);

	$civilite_contact = array(
		'Monsieur' => 'M',
		'Madame' => 'Mme'
	);

	$data = array(
		'inter_intra' => $inter_intrat[$entry['45']],
		'agence_apollo' => '',
		'date_souhaitee' => '',
		'todo' => '',
		'periode_debut' => '',
		'periode_fin' => '',
		'civilite_contact' => $civilite_contact[$entry['6']],
		'nom_contact' => $entry['8.6'],
		'prenom_contact' => $entry['8.3'],
		'email_contact' => $entry['9'],
		'tel_contact' => $entry['10'],
		'nom_societe' => $entry['42'],
		'adresse1_societe' => '',
		'adresse2_societe' => '',
		'cp_societe' => '',
		'ville_societe' => '',
		'pays_societe' => '',
		'precision_client' => $entry['12'],
		'date_demande' => date('Y-m-d H:i:s'),
		'id_formation' => $formation->ID,
		'provenance' => '1',
		'statut' => '0',
		'etape' => '0',
		'nb_jour_formation' => get_field( 'duree', $formation->ID ),
		'site_save' => '',
		'objectifs' => $formation->post_excerpt,
		'plan_formation' => $formation->post_content,
		'prix_inter' => get_field( 'inter', $formation->ID ),
		'prix_intra' => get_field( 'intra', $formation->ID ),
		'inter_intra_origine' => $inter_intrat[$entry['45']],
		'id_statut_contact' => get_id_statut_contact( $entry['11'] ),
		'id_secteur_activite' => get_id_secteur_activite( $entry['34'] ),
		'id_fonction' => get_id_fonction( $entry['36'] ),
		'id_departement' => get_id_departement( $entry['35'] )
	);

	if ( $entry['45'] == 'Inter-entreprise' ) {
		$session_id = $entry[51];

		// Récupération de la session choisie
		$session = $wpdb->get_row( $wpdb->prepare( "
				SELECT c.id as id, a.NomAgence as agence, a.IdAgence as agence_id, c.date_cal AS date
				FROM form_calendrier c
				LEFT JOIN agences a ON a.IdAgence = c.id_agence
				WHERE c.id = %d
			" , $session_id ));

		$data['date_souhaitee'] = $session->date;

	} else {
		$data['periode_debut'] = $entry[47];
		$data['periode_fin'] = $entry[48];
		$data['todo'] = $entry[49];
	}

	$wpdb->insert( 'affaire_formation', $data );
	$affaire_id = $wpdb->insert_id;

	$data['nb_participants'] = $entry['44'];
	for ( $i = 1; $i <= $data['nb_participants']; $i++ ) {
		$wpdb->insert( 'affaire_formation_participant', array( 'id_affaire' => $affaire_id ) );
	}

	if ( isset( $session ) ) {
		$data['agence_name'] = $session->agence;
		$data['agence_id'] = $session->agence_id;

		$wpdb->insert( 'lieu_affaire', array( 'id_affaire' => $affaire_id, 'id_agence' => $session->agence_id ) );
	}

	$_SESSION['entry_information_request'] = $data;
}

add_action( 'gform_after_submission_11', 'save_information_request_11', 10, 2 );

function save_information_request_11( $entry, $form ) {
	session_start();
	global $wpdb;

	$post_id = $entry['29'];
	$formation = get_post($post_id);

	$inter_intrat = array(
		'Intra-entreprise' => '1',
		'Cours Particulier' => '2'
	);

	$civilite_contact = array(
		'Monsieur' => 'M',
		'Madame' => 'Mme'
	);

	$data = array(
		'inter_intra' => $inter_intrat[$entry['3']],
		'agence_apollo' => '',
		'date_souhaitee' => '',
		'todo' => $entry[37],
		'periode_debut' => $entry[38],
		'periode_fin' => $entry[39],
		'civilite_contact' => $civilite_contact[$entry['6']],
		'nom_contact' => $entry['8.6'],
		'prenom_contact' => $entry['8.3'],
		'email_contact' => $entry['9'],
		'tel_contact' => $entry['10'],
		'nom_societe' => $entry['43'],
		'adresse1_societe' => '',
		'adresse2_societe' => '',
		'cp_societe' => '',
		'ville_societe' => '',
		'pays_societe' => '',
		'precision_client' => $entry['12'],
		'date_demande' => date('Y-m-d H:i:s'),
		'id_formation' => $formation->ID,
		'provenance' => '1',
		'statut' => '0',
		'etape' => '0',
		'nb_jour_formation' => get_field( 'duree', $formation->ID ),
		'site_save' => '',
		'objectifs' => $formation->post_excerpt,
		'plan_formation' => $formation->post_content,
		'prix_inter' => get_field( 'inter', $formation->ID ),
		'prix_intra' => get_field( 'intra', $formation->ID ),
		'inter_intra_origine' => $inter_intrat[$entry['3']],
		'id_statut_contact' => get_id_statut_contact( $entry['11'] ),
		'id_secteur_activite' => get_id_secteur_activite( $entry['34'] ),
		'id_fonction' => get_id_fonction( $entry['36'] ),
		'id_departement' => get_id_departement( $entry['35'] )
	);

	$wpdb->insert( 'affaire_formation', $data );
	$affaire_id = $wpdb->insert_id;

	$data['nb_participants'] = $entry['2'];
	for ( $i = 1; $i <= $data['nb_participants']; $i++ ) {
		$wpdb->insert( 'affaire_formation_participant', array( 'id_affaire' => $affaire_id ) );
	}

	$_SESSION['entry_information_request'] = $data;
}

function get_id_statut_contact( $name ) {
	$ids = array (
		'Une entreprise' => 1,
		'Un organisme public' => 2,
		'Un indépendant' => 3,
		'Un demandeur d\'emploi' => 4,
		'Autre' => 5
	);

	if ( isset ( $ids[$name] ) ) {
		return $ids[$name];
	}

	return null;
}

function get_id_secteur_activite( $name ) {
	$ids = array (
		'Grande Entreprise' => 1,
		'Entreprise de Taille Intermédiaire' =>2,
		'PME' => 3,
		'ESN/SSII' => 4,
		'Éditeur de logiciel' => 5,
		'Autre' => 6
	);

	if ( isset ( $ids[$name] ) ) {
		return $ids[$name];
	}

	return null;
}

function get_id_fonction( $name ) {
	$ids = array (
		'Directeur/Responsable/Manager' => 1,
		'Chef de Projet' =>2,
		'Ingénieur/Développeur/Technicien' => 3,
		'Assistant(e)' => 4,
		'Autre' => 5
	);

	if ( isset ( $ids[$name] ) ) {
		return $ids[$name];
	}

	return null;
}

function get_id_departement( $name ) {
	$ids = array (
		'Direction générale' => 1,
		'Direction informatique' =>2,
		'Direction RH' => 3,
		'Direction formation' => 4,
		'Autre' => 5
	);

	if ( isset ( $ids[$name] ) ) {
		return $ids[$name];
	}

	return null;
}

add_filter( 'gform_pre_render_9', 'populate_information_request_confirmation' );

function populate_information_request_confirmation( $form ) {
	$affaire = $_SESSION['entry_information_request'];

	if ( !empty( $affaire ) ) {
		$post_id = $affaire['id_formation'];
		$formation = get_post($post_id);

		/** @var GF_Field $field */
		foreach ( $form['fields'] as &$field ) {
			switch ( $field->id ) {
				case '9':
					$field->defaultValue = $affaire['civilite_contact'];
					break;

				case '4':
					$field->defaultValue = $affaire['prenom_contact'];
					break;

				case '5':
					$field->defaultValue = $affaire['nom_contact'];
					break;

				case '3':
					$field->defaultValue = $affaire['email_contact'];
					break;

				case '6':
					$field->defaultValue = $affaire['tel_contact'];
					break;

				case '7':
					if ( $formation ) {
						$field->defaultValue = 'AF ' . $post_id . ' - ' . $formation->post_title;
					}
					break;

				case '8':
					$type_session = array(
						'0' => 'Inter-entreprise',
						'1' => 'Intra-entreprise',
						'3' => 'Cours Particulier'
					);

					$field->defaultValue = $type_session[$affaire['inter_intra']];
					break;

				case '10':
					if ( $affaire['agence_name'] && $affaire['date_souhaitee'] ) {
						$ville = $affaire['agence_name'];
						$startDate = $affaire['date_souhaitee'];
						$endDate = strtotime( $affaire['date_souhaitee'] . ' + ' . get_field( 'duree', $formation->ID ) . ' days' );

					} else  {
						$ville = $affaire['todo'];
						$startDate = strtotime( $affaire['periode_debut'] );
						$endDate = strtotime( $affaire['periode_fin']);

					}

					$field->defaultValue = $ville . ' du ' . date_i18n( get_option( 'date_format' ), $startDate ) . ' au ' . date_i18n( get_option( 'date_format' ), $endDate );

					break;
			}
		}
	}

	return $form;
}

add_action( 'gform_after_submission_9', 'save_information_request_confirmation', 10, 2 );

function save_information_request_confirmation( $entry, $form ) {
	if ( !empty( $entry['1.1'] ) ) {
		$affaire = $_SESSION['entry_information_request'];
		$data = array(
			'date_demande' => date('Y-m-d H:i:s'),
			'nom' => $affaire['nom_contact'],
			'prenom' => $affaire['prenom_contact'],
			'societe' => $affaire['nom_societe'],
			'fonction' => $affaire['id_fonction'] === null ? '' : $affaire['id_fonction'],
			'service' => $affaire['id_departement'] === null ? '' : $affaire['id_departement'],
			'adresse' => $affaire['adresse1_societe'] . ' ' . $affaire['adresse2_societe'],
			'code_postal' => $affaire['cp_societe'],
			'ville' => $affaire['ville_societe'],
			'tel' => $affaire['tel_contact'],
			'email' => $affaire['email_contact'],
			'veut_catalogue' => 1
		);

		global $wpdb;
		$wpdb->insert( 'inscriptions', $data );
	}
}

add_filter( 'super_post_query_options', 'next_formations' );
function next_formations( $queries ) {
	$queries['next_formations'] = "Prochaines Formations";

	return $queries;
}

add_action( 'init', 'add_calendar_routes' );
function add_calendar_routes() {
	add_rewrite_rule(
		'^calendrier/(.+)/(.+).html$',
		'index.php?page_id=22019&calendar_year=$matches[1]&calendar_month=$matches[2]',
		'top'
	);
}

function add_query_vars_filter( $vars ) {
	$vars[] = "calendar_month";
	$vars[] = "calendar_year";
	$vars[] = "formation_id";
	$vars[] = "session_id";
	return $vars;
}
add_filter( 'query_vars', 'add_query_vars_filter' );

/**Devis express**/
function custom_devisexpress($output) {
	global $wpdb;
	$post = get_post();
	$sessions = $wpdb->get_results( $wpdb->prepare( "
	   SELECT a.NomAgence as agence
       FROM form_calendrier c
       LEFT JOIN agences a ON a.IdAgence = c.id_agence
       WHERE c.id_formation = %d
	" , $post->ID ));
	

	
if ( is_singular( 'formation_post' ) ){
	if ( count($sessions ) == 0 ){
$output = str_replace( '#myModalX', '#myModal3', $output);
	}
	else{
$output = str_replace( '#myModalX', '#myModal1', $output);
	}
}
return $output;
}
add_filter( 'widget_text', 'custom_devisexpress' );



/**Supprimer canonical dans le blog**/
// Remove Canonical Link Added By Yoast WordPress SEO Plugin
function at_remove_dup_canonical_link() {	
	if ( is_home() ) {
       return false;
    }		
}
add_filter( 'wpseo_canonical', 'at_remove_dup_canonical_link' );


/* Hide WP version strings from scripts and styles
 * @return {string} $src
 * @filter script_loader_src
 * @filter style_loader_src
 */
function fjarrett_remove_wp_version_strings( $src ) {
     global $wp_version;
     parse_str(parse_url($src, PHP_URL_QUERY), $query);
     if ( !empty($query['ver']) && $query['ver'] === $wp_version ) {
          $src = remove_query_arg('ver', $src);
     }
     return $src;
}
add_filter( 'script_loader_src', 'fjarrett_remove_wp_version_strings' );
add_filter( 'style_loader_src', 'fjarrett_remove_wp_version_strings' );

/* Hide WP version strings from generator meta tag */
function wpmudev_remove_version() {
return '';
}
add_filter('the_generator', 'wpmudev_remove_version');



/*Gravity forms, validation du tel*/
add_filter("gform_field_validation", "custom_validation", 10, 4);

function custom_validation($result, $value, $form, $field){

    if($field->type == 'phone' && !preg_match('~^\d+$~', $value)){
        $result["is_valid"] = false;
        $result['message']  = 'T&eacute;l&eacute;phone invalide';
    }

    return $result;
}

//Corrections SEO
function callback($buffer) {
if ( is_singular( 'formation_post' ) ){
  $buffer = str_replace('€ HT",', '",', $buffer);
  $buffer = str_replace('€HT",', '",', $buffer);
  $buffer = str_replace('<span rel="v:child" typeof="v:Breadcrumb"><a href="http://www.apollo-formation.com/informatique" rel="v:url" property="v:title">informatique</a> <i class="separateur">/</i> <span rel="v:child" typeof="v:Breadcrumb"><a href="http://www.apollo-formation.com/informatique" rel="v:url" property="v:title">Informatique</a> <i class="separateur">/</i>', '<span rel="v:child" typeof="v:Breadcrumb"><a href="http://www.apollo-formation.com/informatique" rel="v:url" property="v:title">Informatique</a> <i class="separateur">/</i> ', $buffer);
   $buffer = str_replace('<span rel="v:child" typeof="v:Breadcrumb"><a href="http://www.apollo-formation.com/informatique" rel="v:url" property="v:title">informatique</a> <i class="separateur">/</i> <span rel="v:child" typeof="v:Breadcrumb"><a href="http://www.apollo-formation.com/metiers" rel="v:url" property="v:title">Métiers</a> <i class="separateur">/</i>', '<span rel="v:child" typeof="v:Breadcrumb"><a href="http://www.apollo-formation.com/metiers" rel="v:url" property="v:title">Métiers</a> <i class="separateur">/</i> ', $buffer);
  
  }
  return $buffer;
}

function buffer_start() { ob_start("callback"); }

function buffer_end() { ob_end_flush(); }

add_action('wp_head', 'buffer_start');
add_action('wp_footer', 'buffer_end');

/**Corriger les droits admin**/
	   add_action( 'admin_enqueue_scripts', 'load_admin_style' );
      function load_admin_style() {
        wp_register_style( 'admin_css', get_template_directory_uri() . '/css/admin-style.css', false, '1.0.0' );
//OU
        wp_enqueue_style( 'admin_css', get_template_directory_uri() . '/css/admin-style.css', false, '1.0.0' );
       }

add_shortcode('formation_title', 'formation_title_shortcode');
function formation_title_shortcode() {
	$formation_id = get_query_var( 'formation_id', null );
	if ( $formation_id ) {
		$formation = get_post($formation_id);

		if ($formation !== null) {
			return $formation->post_title;
		}
	}

	return null;
}