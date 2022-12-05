<?php
# -----------------------------------------------------------------
# 表示しているページのurl
# -----------------------------------------------------------------
function cmll_global_var_current_url() {
	//グローバル変数を定義
	global $cmll_current_url;

	//ポストタイプを呼び出し
	global $cmll_post_type;


	$wp_obj = get_queried_object();

	
	//フロントページ
	if( is_front_page() ) {
		$cmll_current_url = home_url();
	//固定ページ・個別ページ
	} elseif( is_page() || is_single() ) {
		$cmll_current_url = get_the_permalink( get_the_ID());
	//カテゴリー・タグ・カスタムタクソノミー
	} elseif( is_category() || is_tag() || is_tax() ) {
		$obj = get_queried_object();
		$cmll_description = $obj->description
						  ? preg_replace( '/(\t|\r\n|\r|\n)/s' , '' , $obj->description )
						  : null;
	} elseif(is_date()){
		$year  = get_query_var('year');
		$month = get_query_var('monthnum');
		$day   = get_query_var('day');

		$year_link = get_year_link( $year );
		$month_link = get_year_link( $month );
		
	//それ以外のアーカイブ
	} elseif ( is_archive() ) {
		$obj = get_post_type_object( $cmll_post_type );
		$cmll_description = get_the_post_type_description($obj->description);
	}
}
add_action( 'template_redirect' , 'cmll_global_var_current_url' );
