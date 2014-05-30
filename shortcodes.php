<?php
	/*----------------------------------------------------------------------------*/
	 /*
	 /*----------------------------------------------------------------------------*/
	 //add_filter( 'widget_text', 'do_shortcode' );
	/*----------------------------------------------------------------------------*/
	/* add ul
	/*----------------------------------------------------------------------------*/
	
	function cr_ul($attr,$text=null)
	{
		extract(shortcode_atts(array(), $attr));
		$out .= "<ul>" . $text . "</ul>";
		return do_shortcode(wptexturize($out));
	}
	
	/*----------------------------------------------------------------------------*/
	/* add column
	/*----------------------------------------------------------------------------*/
	
	function cr_column($attr,$text=null)
	{
		extract(shortcode_atts(array(
		'width' =>'30%',
		'position' =>''
		), $attr));
		$width = $width ? "width:$width" : '';
		$position = $position ? ' ' . $position : '';
		$out .= "<div class='cr-columns". $position ."' style=".$width. ">" . $text . "</div>";
		return do_shortcode(wptexturize($out));
	}
	
	/*----------------------------------------------------------------------------*/
	/* add li
	/*----------------------------------------------------------------------------*/
	
	function cr_li($attr,$text=null)
	{
		extract(shortcode_atts(array(
		'icon'=>'',
		), $attr));
		$icon = $icon ?'<span class="cr-menu-span"><img src="' . $icon . '"></span>' : '';
		$out .= $icon . "<li class='cr-menu-li'>" . $text . "</li>";
		return do_shortcode(wptexturize($out));
	}
	
	/*----------------------------------------------------------------------------*/
	/*add region select
	/*----------------------------------------------------------------------------*/
	
	function cr_region_select()
	{	
		wp_enqueue_script( 'cr-main-front-js' );
		wp_enqueue_style( 'form-styler-style' );
		$args = array('hide_empty' => false);
		$terms = get_terms('regions',$args);  
		$count = count($terms);  
		$out ='';
		if($count > 0){
		$out .='<form id="menu-region">';
			$out .="<select id='cr-region-select' name='cr-region-select'>";  
			foreach ($terms as $term) {  
			if ( (!empty( $_COOKIE["region"] ) ) && ( $_COOKIE["region"] == $term->slug ) ) { 
				$selected = 'selected';
			} else { 
				$selected = '';
			}
				$out .= "<option value='".$term->slug."' ".$selected.">".$term->name."</option>";  
			}  
			$out .= "</select>";
		} 
		$out .='</form>';
		return $out;
	}
	
	
	/*----------------------------------------------------------------------------*/
	/*add clear
	/*----------------------------------------------------------------------------*/
	
	function cr_clear()
	{
		$out = '<div class="cr-clear"></div>';
		return $out;
	}
	
	/*----------------------------------------------------------------------------*/
	 /* region menu
	 /*----------------------------------------------------------------------------*/
	function get_cr_region_menu()
	{  
	
		$args = array('hide_empty' => false);
		$terms = get_terms('regions',$args); 
		$cats = $_COOKIE["region"] ? $_COOKIE["region"] : $terms[0]->slug;
		$query = new WP_Query();
		$args = '';
		$args = wp_parse_args($args, array(
			'showposts' => 1,
			'ignore_sticky_posts' => 1,
			'post_type' => 'info',
			'meta_query' => array(
				array(
					'key' => 'cr_type_post',
					'value' => 'menus',
				)
			),
			'tax_query' => array(
				array(
					'taxonomy' => 'regions',
					'field' => 'slug',
					'terms' => $cats,
				)
			)
		));
		
		$query = new WP_Query($args);
		$out='';
		$out .='<div class="menu-region">';
		while ( $query->have_posts() ) {
			$query->the_post();
			$out .= get_the_content() ;
		}
		$out .='</div>';
		wp_reset_postdata();
		return $out;	
	}	
	
	/*----------------------------------------------------------------------------*/
	 /* region menu shortcod
	 /*----------------------------------------------------------------------------*/
	 
	function cr_region_menu($attr)
	{
		extract(shortcode_atts(array(
		//'cats'=>'',
		), $attr));
		$out = get_cr_region_menu();
		return do_shortcode(wptexturize($out));
	}
	
	/*----------------------------------------------------------------------------*/
	/* img url posts
	/*----------------------------------------------------------------------------*/
	function cr_thumb_related( $w,$h,$crop,$class=null )
	{
		global $post;
		$image_id = get_post_thumbnail_id();
		$out = $image_id;
		$image_url = wp_get_attachment_image_src($image_id,'full');
		$image_url = $image_url[0];
		$params = array( 'width' => $w, 'height' => $h, 'crop' => $crop );
		$image = bfi_thumb( $image_url, $params );
		$href = get_post_meta($post->ID, 'title', 1); ; 
		if ( strlen ( get_the_post_thumbnail() ) ) { 
		$out = '<a href="' . $href. '"><img class="' . $class . '" src="' . $image . '"  alt=""></a>';
		return $out;
		 }
	}
	/*----------------------------------------------------------------------------*/
	 /* region banner
	 /*----------------------------------------------------------------------------*/
	function get_cr_region_banner($tag,$w,$h,$crop,$class=null)
	{
		$query = new WP_Query();
		$args = array('hide_empty' => false);
		$terms = get_terms('regions',$args); 
		$cats = $_COOKIE["region"] ? $_COOKIE["region"] : $terms[0]->slug;
		$args = '';
		
		$args = wp_parse_args($args, array(
		'showposts' => 1,
		'ignore_sticky_posts' => 1,
		'post_type' => 'info',
			'meta_query' => array(
				array(
					'key' => 'cr_type_post',
					'value' => 'banner',
				),
				array(
					'key' => 'code',
					'value' =>$tag,
				),
			),
		
		'tax_query' => array(
		array(
		'taxonomy' => 'regions',
		'field' => 'slug',
		'terms' => $cats
		)
		)
		));
		
		$query = new WP_Query($args);
		$out='';
		$out .='<div class="banner-region">';
		while ( $query->have_posts() ) {
			$query->the_post();
			$out .= cr_thumb_related( $w,$h,$crop,$class=null );
		}
		$out .='</div>';
		return $out;
		
		wp_reset_postdata();
		wp_reset_query();
	}	
	
	/*----------------------------------------------------------------------------*/
	 /* region menu shortcod
	 /*----------------------------------------------------------------------------*/
	 
	function cr_region_banner($attr)
	{
		extract(shortcode_atts(array(
		//'cats'=>'',
		'tag'=>'',
		'w'=>'',
		'h'=>'',
		'crop'=>'',
		'class'=>''
		), $attr));
		$out = get_cr_region_banner($tag,$w,$h,$crop,$class=null);
		return do_shortcode(wptexturize($out));
	}
	
	/*----------------------------------------------------------------------------*/
	 /* region код
	 /*----------------------------------------------------------------------------*/
	function get_cr_region_codes($tag)
	{
		$query = new WP_Query();
		$args = array('hide_empty' => false);
		$terms = get_terms('regions',$args); 
		$cats = $_COOKIE["region"] ? $_COOKIE["region"] : $terms[0]->slug;
		$args = '';
		
		$args = wp_parse_args($args, array(
		'showposts' => 1,
		'ignore_sticky_posts' => 1,
		'post_type' => 'info',
			'meta_query' => array(
				array(
					'key' => 'cr_type_post',
					'value' => 'codes',
				),
				array(
					'key' => 'code',
					'value' =>$tag,
				),
			),
		
		'tax_query' => array(
		array(
		'taxonomy' => 'regions',
		'field' => 'slug',
		'terms' => $cats
		)
		)
		));
		
		$query = new WP_Query($args);
		$out='';
		$out .='<div class="codes-region">';
		while ( $query->have_posts() ) {
			$query->the_post();
			$out .= get_the_content();
		}
		$out .='</div>';
		return $out;
		
		wp_reset_postdata();
		wp_reset_query();
	}	
	
	/*----------------------------------------------------------------------------*/
	 /* region коде shortcod
	 /*----------------------------------------------------------------------------*/
	 
	function cr_region_code($attr)
	{
		extract(shortcode_atts(array(
		'tag'=>''
		), $attr));
		$out = get_cr_region_codes($tag);
		return do_shortcode(wptexturize($out));
	}
	
	/*----------------------------------------------------------------------------*/
	/* Activate Shortcodes
	/*----------------------------------------------------------------------------*/
	add_shortcode('cr_region_select', 'cr_region_select'); // выбор города
	add_shortcode('cr_li', 'cr_li'); // li
	add_shortcode('cr_ul', 'cr_ul'); // ul
	add_shortcode('cr_column', 'cr_column'); // колонка
	add_shortcode('cr_clear', 'cr_clear'); // очистка
	add_shortcode('cr_clear', 'cr_clear'); // очистка
	add_shortcode('cr_region_menu','cr_region_menu');// региональное меню
	add_shortcode('cr_region_banner','cr_region_banner');// региональный баннер
	add_shortcode('cr_region_code','cr_region_code');// региональный баннер