<?php
	/*----------------------------------------------------------------------------*/
	 /*register taxonomy
	 /*----------------------------------------------------------------------------*/
	add_action( 'init', 'register_regions_info' );  
	
	function register_regions_info() {
		
		$labels = array(
		'name' =>__('Информация','wp_panda'),
		'singular_name' =>__('Информация','wp_panda'),
		);
		
		$args = array(
		'labels' => $labels,
		'public' => true,
		'menu_position' => 15,
		'capability_type' => 'post',
		'hierarchical' => false,
		'query_var' => true,
		'supports' => array( 'title', 'editor', 'comments', 'thumbnail', 'custom-fields' ),
		'taxonomies' => array( '' ),
		'menu_icon' => 'dashicons-location-alt',
		'has_archive' => true,
		'capability_type' => 'post'
		);
		
		register_post_type( 'info', $args );
	}
	
	add_action( 'init', 'create_regions' );  
	
	function create_regions() {  
		
		register_taxonomy('regions','info',
		
		array(  
		'hierarchical' => true,  
		'label' => __('Регионы','wp_panda'),
		"singular_label" => __('Регион','wp_panda'),
		"rewrite" => true,
		"query_var" => true
		)
		);  
		
		register_taxonomy('info_tag', 'info',
		
		array(
		'hierarchical' => false, 
		'label' => __('Метка Информации','wp_panda'), 
		'query_var' => true, 
		'rewrite' => true
		)
		);
		
	} 
	
	
	/*----------------------------------------------------------------------------*/
	/*add metabox
	/*----------------------------------------------------------------------------*/
	add_action('add_meta_boxes', 'my_extra_fields', 1);
	
	function my_extra_fields() {
		add_meta_box( 'extra_fields', __('Тип записи','wp_panda'), 'extra_fields_box_func', 'info', 'side', 'high'  );
	}
	global $post;
	function extra_fields_box_func( $post ){
	?>
	
	<p>
		<select name="extra[cr_type_post]" />
			<?php $sel_v = get_post_meta($post->ID, 'cr_type_post', 1); ?>
			<option value="banner" <?php selected( $sel_v, 'banner' )?> ><?php _e('Баннер','wp_panda') ?></option>
			<option value="menus" <?php selected( $sel_v, 'menus' )?> ><?php _e('Меню','wp_panda') ?></option>
			<option value="codes" <?php selected( $sel_v, 'codes' )?> ><?php _e('Контент','wp_panda') ?></option>
		</select>
	</p>
	<p><label>Ссылка с баннера<br><input type="text" name="extra[title]" value="<?php echo get_post_meta($post->ID, 'title', 1); ?>" /> </label></p>
	<p><label>Koд баннера<br><input type="text" name="extra[code]" value="<?php echo get_post_meta($post->ID, 'code', 1); ?>" /> </label></p>
	<input type="hidden" name="extra_fields_nonce" value="<?php echo wp_create_nonce(__FILE__); ?>" />
	<?php
	}
	
	add_action('save_post', 'my_extra_fields_update', 0);
	
	function my_extra_fields_update( $post_id ){
		if ( !wp_verify_nonce($_POST['extra_fields_nonce'], __FILE__) ) return false;
		if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE  ) return false;
		if ( !current_user_can('edit_post', $post_id) ) return false;
		
		if( !isset($_POST['extra']) ) return false;	
		
		$_POST['extra'] = array_map('trim', $_POST['extra']);
		foreach( $_POST['extra'] as $key=>$value ){
			if( empty($value) ){
				delete_post_meta($post_id, $key);
				continue;
			}
			
			update_post_meta($post_id, $key, $value);
		}
		return $post_id;
	}	