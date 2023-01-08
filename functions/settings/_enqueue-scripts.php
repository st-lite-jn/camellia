<?php
# -----------------------------------------------------------------
# JavaScriptの登録
# -----------------------------------------------------------------
/**
 * wp-login.php画面かどうかの判定する関数
 */
function cmll_is_login_page() {
	return in_array($GLOBALS['pagenow'], array('wp-login.php', 'wp-register.php'));
}

function cmll_enqueue_scripts() {

	//テーマのバージョンを取得
	$theme_version = wp_get_theme() -> get( 'Version' );

	/**
	 * animejs@3.2.1
	 */
	wp_enqueue_script( 'cmll-bundle' , 'https://cdn.jsdelivr.net/combine/npm/animejs@3.2.1', [] , $theme_version , true );

	/**
	 * main.jsの登録
	 */
	wp_enqueue_script( 'cmll-main' , get_template_directory_uri() . '/assets/js/main.js' , ['cmll-bundle'] , $theme_version , true);

}

add_action('wp_enqueue_scripts' , 'cmll_enqueue_scripts' );

/**
 * scriptの記述のリプレイス
 */
function cmll_script_replace($tag, $handle) {
	/**
	 * cmll-mainとwp-embedにdeferを追加
	 */

	if(	$handle !== 'cmll-bundle' && $handle !== 'cmll-main') return $tag;
	return str_replace(' src=', ' defer src=', $tag);
}
add_filter('script_loader_tag', 'cmll_script_replace', 10, 2);
