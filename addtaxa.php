<?php

function custom_taxonomy_init() {
	$custom_post_type_slug = "enter your custom post type slug";
	$taxonomy_names = [
	['slug'=>'custom_taxonomy1', 'nicename'=> 'Custom Taxonomy 1'],
	['slug'=>'custom_taxonomy2', 'nicename'=> 'Custom Taxonomy 2']
	];

	foreach($taxonomy_names as $taxonomy_name){
		register_taxonomy(
			$taxonomy_name['slug'],
			$custom_post_type_slug,
			array(
				'labels' => array(
					'name' => $taxonomy_name['nicename'].'s',
					'singular_name'=> $taxonomy_name['nicename'],
					'menu_name'=> $taxonomy_name['nicename'].'s',
					),
				'public' => true,
				'sort' =>true,
				'hierarchical' => true,
				)
			);

	}
}

add_action( 'init', 'custom_taxonomy_init' );

function add_terms($terms,$taxonomy){
	foreach ($terms as $term) {
		wp_insert_term( $term, $taxonomy);
	}
}

function set_meta_to_terms(){
	$custom_post_type_slug = "enter your custom post type slug";
	$the_query = new WP_Query( array('post_type' =>$custom_post_type_slug,
		'posts_per_page' => -1 //returns all posts
		));

	$taxandmetatoset = [
	['taxonomy'=> 'custom_taxonomy1', 'meta_key' =>'custom_meta1_key'],
	['taxonomy'=> 'custom_taxonomy2', 'meta_key' =>'custom_meta2_key']
	];

	$append_terms_without_replacing = false; 
	while ( $the_query->have_posts() ){
		global $post;
		$the_query->the_post();
		$post_id= $post->ID;

		foreach ($taxandmetatoset as $taxandmeta){
			$taxonomy= $taxandmeta['taxonomy'];
			$terms = get_post_meta($post_id,$taxandmeta['meta_key'],true);
			wp_set_object_terms( $post_id, 
				$terms, 
				$taxonomy,
				$append_terms_without_replacing );
		}
	}
}

//if you bundle it with a plugin use 'register_activation_hook' 
add_action( 'after_switch_theme', 'set_meta_to_terms' );

function save_meta_as_terms($post_id){
	$taxandmetatoset = [
	['taxonomy'=> 'custom_taxonomy1', 'meta_key' =>'custom_meta1_key'],
	['taxonomy'=> 'custom_taxonomy2', 'meta_key' =>'custom_meta2_key']
	];
	$append_terms_without_replacing = false; 

	foreach ($taxandmetatoset as $taxandmeta){
		$taxonomy= $taxandmeta['taxonomy'];
		$terms = get_post_meta($post_id,$taxandmeta['meta_key'],true);
		
		wp_set_object_terms( $post_id, 
			$terms, 
			$taxonomy,
			$append_terms_without_replacing 
			);
	}
}


$custom_post_type_slug = "enter your custom post type slug";
add_action('publish_'.$custom_post_type_slug, 'save_meta_as_terms',10, 1 );