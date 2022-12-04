<?php

/**
 * 出力するタイトルをカスタマイズ
 */
if(!function_exists( "cmll_custom_title" ) ):

function cmll_custom_title($title) {
	if( is_admin() ) return false;

	$post_obj = get_post_type_object( get_post_type() );

	//カスタム投稿タイプの個別ページの場合、タイトルにカスタム投稿タイプのラベルを追加する
	if(( is_single() ) && ( $post_obj->name !== "post" && $post_obj->name !== "page" ) ) {
		$title = $title + array("site-post-label" => $post_obj->label);
		krsort($title);
	}
	//テンプレートの種類ごとにタイトルを修正
	if ( is_home() || is_front_page() ) {
		$title['tagline'] = null;
	}
	return $title;
}

endif;
add_filter( 'document_title_parts' , 'cmll_custom_title' );

/*
タイトルのセパレーターを修正
*/
if(!function_exists( "cmll_custom_title_separator" ) ):
function cmll_custom_title_separator( $sep ) {
	$sep = ' | ';
	return $sep;
}
endif;
add_filter( 'document_title_separator', 'cmll_custom_title_separator' );


/**
 * get_the_archive_titleで表示するタイトルをカスタマイズ
 */
if(!function_exists('cmll_custom_archive_title')):
function cmll_custom_archive_title ($title) {
	if (is_category()) {
		$title = single_cat_title('',false);
	} elseif (is_tag()) {
		$title = single_tag_title('',false);
	} elseif (is_tax()) {
		$title = single_term_title('',false);
	} elseif (is_post_type_archive() ){
		$title = post_type_archive_title('',false);
	} elseif (is_date()) {
		$title = get_the_time('Y年n月');
	} elseif (is_search()) {
		$title = '検索結果 : '.esc_html( get_search_query(false) );
	} elseif (is_404() ) {
		$title = '404エラー : ページが見つかりませんでした';
	} else {

	}
	return $title;
}
endif;
add_filter( 'get_the_archive_title', 'cmll_custom_archive_title');
