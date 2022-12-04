<?php
//======================================================================
// 構造化データ（JSON-LD）を生成する関する
//======================================================================
if(!function_exists('cmll_schema_website')):
function cmll_schema_website () {
	$site_url = home_url();
	$site_name = get_bloginfo('name');
	$site_desc = get_bloginfo('description');
	$schema_array = array (
		"@context" => "https://schema.org",
		"@type" => "WebSite",
		"url" => $site_url,
		"name" => $site_name,
		"description" => $site_desc,
		"potentialAction" => array(
			"@type" => "SearchAction",
			"target" => "{$site_url}/?s={search_term_string}",
			"query-input" => "required name=search_term_string"
		)
	);
	$schema_json = json_encode($schema_array);
	$schema_output = "<script type=\"application/ld+json\">$schema_json</script>";
	echo preg_replace('/(\t|\r\n|\r|\n)/s', '', $schema_output);
}
endif;
add_action( 'wp_head' , 'cmll_schema_website' , 2 , 1);

if(!function_exists('cmll_schema_blogposting')):
function cmll_schema_blogposting () {
	if( !is_page() && !is_single() ) return false;

	$permalink = get_permalink( get_the_ID() );
	$title = get_the_title( get_the_ID() );

	$featured_array = wp_get_attachment_image_src(get_post_thumbnail_id( get_the_ID() , 'large' ) );

	$img_obj = $featured_array
		? array(
			"@type" => "ImageObject",
			"url" => $featured_array[0],
			"width" => $featured_array[1],
			"height" => $featured_array[2]
			)
		: false;

	$post = get_post( get_the_ID() );
	$author = get_userdata($post->post_author);
	$schema_array = array (
		"@context" => "https://schema.org",
		"@type" => "BlogPosting",
		"mainEntityOfPage" => array (
			"@type"=> "WebPage",
			"@id"=> $permalink
		),
		"headline" => $title,
		"image" => $img_obj,
		"author" => array (
			"@type" => "Person",
			"name" => $author->display_name,
			"url" => $author->user_url,
		),
		"datePublished" => get_the_time( "Y-m-d" , get_the_ID() ),
		"dateModified" => get_the_modified_date( "Y-m-d" , get_the_ID() )
	);
	$schema_json = json_encode($schema_array);
	$schema_output = "<script type=\"application/ld+json\">$schema_json</script>";
	echo preg_replace('/(\t|\r\n|\r|\n)/s', '', $schema_output);
}
endif;
add_action( 'wp_head' , 'cmll_schema_blogposting' , 2 , 1);
