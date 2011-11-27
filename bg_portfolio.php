<?php
/*
Plugin Name: BG Portfolio
Plugin URI: http://www.pamparam.net
Description: Enables a portfolio post type and taxonomies.
Version: 2.0
Author: ButuzGOL
Author URI: http://www.pamparam.net
*/

function bg_portfolio() {

	/**
	 * Enable the Portfolio custom post type
	 * http://codex.wordpress.org/Function_Reference/register_post_type
	 */

	$labels = array(
		'name' => __( 'Portfolio', 'bg_portfolio' ),
		'singular_name' => __( 'Portfolio Item', 'bg_portfolio' ),
		'add_new' => __( 'Add New Item', 'bg_portfolio' ),
		'add_new_item' => __( 'Add New Portfolio Item', 'bg_portfolio' ),
		'edit_item' => __( 'Edit Portfolio Item', 'bg_portfolio' ),
		'new_item' => __( 'Add New Portfolio Item', 'bg_portfolio' ),
		'view_item' => __( 'View Item', 'bg_portfolio' ),
		'search_items' => __( 'Search Portfolio', 'bg_portfolio' ),
		'not_found' => __( 'No portfolio items found', 'bg_portfolio' ),
		'not_found_in_trash' => __( 'No portfolio items found in trash', 'bg_portfolio' )
	);

	$args = array(
    	'labels' => $labels,
    	'public' => true,
		'supports' => array( 'title', 'editor', 'thumbnail', 'comments' ),
		'capability_type' => 'post',
		'rewrite' => array( 'slug' => 'portfolio'),
        'menu_position' => 5,
		'has_archive' => false,
        'show_ui' => true,
	    'exclude_from_search' => true,
        'hierarchical' => true,
		'query_var'	=> true,
		'register_meta_box_cb' => 'bg_portfolio_init_metaboxes_for_post',
	);

    register_post_type( 'portfolio', $args );

    wp_enqueue_script( 'datepicker', WP_PLUGIN_URL .'/bg_portfolio/js/datepicker/datepicker.js', array( 'jquery' ) );
    wp_enqueue_style( 'datepicker', WP_PLUGIN_URL .'/bg_portfolio/js/datepicker/datepicker.css' );
   
	/**
	 * Register a taxonomy for Portfolio Technologies
	 * http://codex.wordpress.org/Function_Reference/register_taxonomy
	 */


	$taxonomy_portfolio_technology_labels = array(
		'name' => _x( 'Technologies', 'bg_portfolio' ),
		'singular_name' => _x( 'Technology', 'bg_portfolio' ),
		'search_items' => _x( 'Search Technologies', 'bg_portfolio' ),
		'popular_items' => _x( 'Popular Technologies', 'bg_portfolio' ),
		'all_items' => _x( 'All Technologies', 'bg_portfolio' ),
		'parent_item' => _x( 'Parent Technology', 'bg_portfolio' ),
		'parent_item_colon' => _x( 'Parent Technology:', 'bg_portfolio' ),
		'edit_item' => _x( 'Edit Technology', 'bg_portfolio' ),
		'update_item' => _x( 'Update Technology', 'bg_portfolio' ),
		'add_new_item' => _x( 'Add New Technology', 'bg_portfolio' ),
		'new_item_name' => _x( 'New Technology Name', 'bg_portfolio' ),
		'separate_items_with_commas' => _x( 'Separate technologies with commas', 'bg_portfolio' ),
		'add_or_remove_items' => _x( 'Add or remove technologies', 'bg_portfolio' ),
		'choose_from_most_used' => _x( 'Choose from the most used technologies', 'bg_portfolio' ),
		'menu_name' => _x( 'Technologies', 'bg_portfolio' )
	);

	$taxonomy_portfolio_technology_args = array(
		'labels' => $taxonomy_portfolio_technology_labels,
		'public' => true,
		'show_in_nav_menus' => true,
		'show_ui' => true,
		'show_tagcloud' => true,
		'hierarchical' => false,
		'rewrite' => true,
		'query_var' => true,
	);

	register_taxonomy( 'portfolio_technology', array( 'portfolio' ), $taxonomy_portfolio_technology_args );

	/**
	 * Register a taxonomy for Portfolio Categories
	 * http://codex.wordpress.org/Function_Reference/register_taxonomy
	 */

    $taxonomy_portfolio_category_labels = array(
		'name' => _x( 'Categories', 'bg_portfolio' ),
		'singular_name' => _x( 'Category', 'bg_portfolio' ),
		'search_items' => _x( 'Search Categories', 'bg_portfolio' ),
		'popular_items' => _x( 'Popular Categories', 'bg_portfolio' ),
		'all_items' => _x( 'All Categories', 'bg_portfolio' ),
		'parent_item' => _x( 'Parent Category', 'bg_portfolio' ),
		'parent_item_colon' => _x( 'Parent Category:', 'bg_portfolio' ),
		'edit_item' => _x( 'Edit Category', 'bg_portfolio' ),
		'update_item' => _x( 'Update Category', 'bg_portfolio' ),
		'add_new_item' => _x( 'Add New Category', 'bg_portfolio' ),
		'new_item_name' => _x( 'New Category Name', 'bg_portfolio' ),
		'separate_items_with_commas' => _x( 'Separate categories with commas', 'bg_portfolio' ),
		'add_or_remove_items' => _x( 'Add or remove categories', 'bg_portfolio' ),
		'choose_from_most_used' => _x( 'Choose from the most used categories', 'bg_portfolio' ),
		'menu_name' => _x( 'Categories', 'bg_portfolio' ),
    );

    $taxonomy_portfolio_category_args = array(
		'labels' => $taxonomy_portfolio_category_labels,
		'public' => true,
		'show_in_nav_menus' => true,
		'show_ui' => true,
		'show_tagcloud' => true,
		'hierarchical' => true,
		'rewrite' => true,
		'query_var' => true
    );

    register_taxonomy( 'portfolio_category', array( 'portfolio' ), $taxonomy_portfolio_category_args );

    /**
	 * Register a taxonomy for Portfolio Clients
	 * http://codex.wordpress.org/Function_Reference/register_taxonomy
	 */

    $taxonomy_portfolio_client_labels = array(
		'name' => _x( 'Clients', 'bg_portfolio' ),
		'singular_name' => _x( 'Client', 'bg_portfolio' ),
		'search_items' => _x( 'Search Clients', 'bg_portfolio' ),
		'popular_items' => _x( 'Popular Clients', 'bg_portfolio' ),
		'all_items' => _x( 'All Clients', 'bg_portfolio' ),
		'parent_item' => _x( 'Parent Client', 'bg_portfolio' ),
		'parent_item_colon' => _x( 'Parent Client:', 'bg_portfolio' ),
		'edit_item' => _x( 'Edit Client', 'bg_portfolio' ),
		'update_item' => _x( 'Update Client', 'bg_portfolio' ),
		'add_new_item' => _x( 'Add New Client', 'bg_portfolio' ),
		'new_item_name' => _x( 'New Client Name', 'bg_portfolio' ),
		'separate_items_with_commas' => _x( 'Separate clients with commas', 'bg_portfolio' ),
		'add_or_remove_items' => _x( 'Add or remove clients', 'bg_portfolio' ),
		'choose_from_most_used' => _x( 'Choose from the most used clients', 'bg_portfolio' ),
		'menu_name' => _x( 'Clients', 'bg_portfolio' ),
    );

    $taxonomy_portfolio_client_args = array(
		'labels' => $taxonomy_portfolio_client_labels,
		'public' => true,
		'show_in_nav_menus' => true,
		'show_ui' => true,
		'show_tagcloud' => true,
		'hierarchical' => false,
		'rewrite' => true,
		'query_var' => true
    );

    register_taxonomy( 'portfolio_client', array( 'portfolio' ), $taxonomy_portfolio_client_args );

    // Custom field in taxonomy
    
    global $bg_custom_taxonomy_fields;
    $bg_custom_taxonomy_fields = array('portfolio_client'=>array('name'=>'url', 'label'=>'Url', 'alt'=>'Url to client webpage'));
    bg_custom_taxonomy_field();
}

add_action( 'init', 'bg_portfolio' );

function portfolio_portfolio_icons() { ?>
    <style type="text/css" media="screen">
        #menu-posts-portfolio .wp-menu-image {
            background: url(<?php echo plugin_dir_url( __FILE__ ); ?>images/portfolio-icon.png) no-repeat 6px 6px !important;
        }
		#menu-posts-portfolio:hover .wp-menu-image, #menu-posts-portfolio.wp-has-current-submenu .wp-menu-image {
            background-position:6px -16px !important;
        }
		#icon-edit.icon32-posts-portfolio {background: url(<?php echo plugin_dir_url( __FILE__ ); ?>images/portfolio-32x32.png) no-repeat;}
    </style>
<?php }

add_action( 'admin_head', 'portfolio_portfolio_icons' );

function remove_taxonomy($taxonomy) {
	if (!$taxonomy->_builtin) {
		global $wp_taxonomies;
		$terms = get_terms($taxonomy);
        foreach ($terms as $term) {
			wp_delete_term( $term->term_id, $taxonomy );
		}
		unset($wp_taxonomies[$taxonomy]);
	}
}

register_deactivation_hook( __FILE__, 'deactivate_custom_taxes' );

// Custom field in taxonomy

function bg_custom_taxonomy_field_edit_form_fields($term, $taxonomy) {
    $value = get_option("_term_type_{$taxonomy}_{$term->term_id}");
    global $bg_custom_taxonomy_fields;
    $name = $bg_custom_taxonomy_fields[$taxonomy]['name'];
    $label = $bg_custom_taxonomy_fields[$taxonomy]['label'];
    $alt = $bg_custom_taxonomy_fields[$taxonomy]['alt'];
    $html =<<<HTML
<tr class="form-field">
    <th valign="top" scope="row"><label for="{$name}">{$label}</label></th>
    <td><input type="text" size="40" value="{$value}" id="{$name}" name="{$name}">
    <p class="description">{$alt}</p></td>
</tr>
HTML;
    echo $html;
}

function bg_custom_taxonomy_field_add_form_fields($taxonomy) {
    global $bg_custom_taxonomy_fields;
    $name = $bg_custom_taxonomy_fields[$taxonomy]['name'];
    $label = $bg_custom_taxonomy_fields[$taxonomy]['label'];
    $alt = $bg_custom_taxonomy_fields[$taxonomy]['alt'];
    $html =<<<HTML
<div class="form-field">
    <label for="tag-{$name}">{$label}</label>
	<input type="text" size="40" value="" id="tag-{$name}" name="tag-{$name}" />
	<p>{$alt}</p>
</div>
HTML;
    echo $html;
}

function bg_custom_taxonomy_field_update($term_id, $tt_id, $taxonomy) {
    global $bg_custom_taxonomy_fields;
    if (isset($_POST['tag-'.$bg_custom_taxonomy_fields[$taxonomy]['name']])) {
        bg_custom_taxonomy_field_option_update($taxonomy,$term_id,$_POST['tag-'.$bg_custom_taxonomy_fields[$taxonomy]['name']]);
    }
}

function bg_custom_taxonomy_field_option_update($taxonomy,$term_id,$value) {
    update_option("_term_type_{$taxonomy}_{$term_id}",$value);
}

function bg_custom_taxonomy_field_delete($term_id, $tt_id, $taxonomy) {
    delete_option("_term_type_{$taxonomy}_{$term_id}");
}

function bg_custom_taxonomy_field() {
     add_action('created_term','bg_custom_taxonomy_field_update',10,3);
     add_action('edit_term','bg_custom_taxonomy_field_update',10,3);
     add_action('delete_term','bg_custom_taxonomy_field_delete',10,3);

     global $bg_custom_taxonomy_fields;
     foreach(array_keys($bg_custom_taxonomy_fields) as $taxonomy) {
        add_action("{$taxonomy}_add_form_fields","bg_custom_taxonomy_field_add_form_fields");
        add_action("{$taxonomy}_edit_form_fields","bg_custom_taxonomy_field_edit_form_fields",10,2);
     }
}

// Image in taxonomy
require_once( trailingslashit( dirname( __FILE__ ) ) . 'taxonomy-images.php');

// Custom fields in portfolio

$bg_portfolio_boxes = array (
	'Portfolio-Info' => array (
		//array( '_bg_portfolio_date_compl', 'Date of completion', 'The date when the task was completed', '', '' ),
		array( '_bg_portfolio_link', 'Link', 'A link to the site', '', '' ),
		array( '_bg_portfolio_employer_link', 'Employer Link', 'Employer link write (label|url|project url)', '', '' ),
		//array( '_bg_portfolio_short_descr', 'Short description', 'A short description which you\'d like to be displayed on your portfolio page', '', '' ),
		)
);

// Initialization of all metaboxes on the 'Add Portfolio' and Edit Portfolio pages
function bg_portfolio_init_metaboxes_for_post() {
    add_meta_box( 'Portfolio-Info', 'Portfolio Info', 'bg_portfolio_post_custom_box', 'portfolio', 'normal', 'high' ); // Description metaboxe
}

// Create custom meta box for portfolio post type
function bg_portfolio_post_custom_box( $obj = '', $box = '' ) {
    global $bg_portfolio_boxes;
    static $sp_nonce_flag = false;
    // Run once
    if( ! $sp_nonce_flag ) {
        bg_portfolio_post_echo_nonce();
        $sp_nonce_flag = true;
    }
    // Generate box contents
    foreach( $bg_portfolio_boxes[ $box[ 'id' ] ] as $bg_portfolio_box ) {
        echo bg_portfolio_post_fields_html( $bg_portfolio_box );
    }
    echo "<script type=\"text/javascript\">
        var form = document.getElementById('post');
        form.encoding = 'multipart/form-data';
        form.setAttribute('enctype', 'multipart/form-data');
    </script>";
}

// This switch statement specifies different types of meta boxes
function bg_portfolio_post_fields_html ( $args ) {
    global $post;
    $description = $args[2];
    $args[2] = esc_html( get_post_meta($post->ID, $args[0], true));

    switch ($args[ 3 ]) {
        case 'textarea':
            $label_format =
                '<div class="portfolio_admin_box">'.
                '<p><label for="%1$s"><strong>%2$s</strong></label></p>'.
                '<p><textarea class="theEditor" id="theEditor" style="width: 90%%;color:#000;" name="%1$s">%3$s</textarea></p>'.
                '<p><em>'. $description .'</em></p>'.
                '</div>';
            echo "
            <style>
            #theEditor_tbl {background-color: #FFFFFF; border: 1px solid #CCCCCC;}
            </style>";
            break;
        default:
            $label_format =
                '<div class="portfolio_admin_box">'.
                '<p><label for="%1$s"><strong>%2$s</strong></label></p>'.
                '<p><input style="width: 80%%;" type="text" name="%1$s" id="%1$s" value="%3$s" /></p>'.
                '<p><em>'. $description .'</em></p>'.
                '</div>';
            if( '_bg_portfolio_date_compl' == $args[0] ) {
                echo '<script type="text/javascript">jQuery(document).ready(function(){jQuery("#_bg_portfolio_date_compl").simpleDatepicker({ startdate: 2008, enddate: new Date().getFullYear()+3 });});</script>';
            }
            break;
    }

    return vsprintf( $label_format, $args );
}

// Use nonce for verification ...
function bg_portfolio_post_echo_nonce() {
    echo sprintf(
        '<input type="hidden" name="%1$s" id="%1$s" value="%2$s" />',
        'prtf_nonce_name',
        wp_create_nonce( plugin_basename(__FILE__) )
    );
}

/* When the post is saved, saves our custom data */
function bg_portfolio_post_save( $post_id, $post ) {
    global $bg_portfolio_boxes;
    global $post;
    
    if( "portfolio" == $post->post_type ) {
        // verify this came from the our screen and with proper authorization,
        // because save_post can be triggered at other times
        if( ! current_user_can ( 'edit_page', $post->ID ) ) {
            return $post->ID;
        }
        // We'll put it into an array to make it easier to loop though.
        // The data is already in $prtf_boxes, but we need to flatten it out.
        foreach( $bg_portfolio_boxes as $bg_portfolio_box ) {
            foreach( $bg_portfolio_box as $fields ) {
                $my_data[ $fields[0] ] = $_POST[ $fields[0] ];
            }
        }
        
        // Add values of $my_data as custom fields
        // Let's cycle through the $my_data array!
        foreach( $my_data as $key => $value ) {
            if( 'revision' == $post->post_type  ) {
                // don't store custom data twice
                return;
            }

            // if $value is an array, make it a CSV (unlikely)
            $value = implode( ',', (array)$value );
            if( get_post_meta( $post->ID, $key, FALSE ) && $value ) {
                // Custom field has a value and this custom field exists in database
                update_post_meta( $post->ID, $key, $value );
            }
            elseif($value) {
                // Custom field has a value, but this custom field does not exist in database
                add_post_meta( $post->ID, $key, $value );
                
            }
            else {
                // Custom field does not have a value, but this custom field exists in database
                update_post_meta( $post->ID, $key, $value );
            }
        }
    }
}

add_action( 'save_post', 'bg_portfolio_post_save', 1, 2 ); // save custom data from admin

function bg_portfolio_plugin_activate() {
    bg_portfolio();
	flush_rewrite_rules();

    taxonomy_image_plugin_registr('portfolio_technology');
}
register_activation_hook( __FILE__, 'bg_portfolio_plugin_activate' );


