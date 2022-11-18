<?php
# -----------------------------------------------------------------
# wp_head関数が生成するメタ情報の制御やカスタマイズ
# -----------------------------------------------------------------

/*
* 絵文字のDNS Prefetchを削除
*/
add_filter( 'emoji_svg_url', '__return_false');

/*
* 不要なhead要素を削除
*/
remove_action('wp_head', 'wp_generator');// WordPressのバージョン
remove_action('wp_head', 'wp_shortlink_wp_head');// 短縮URLのlink
remove_action('wp_head', 'wlwmanifest_link');// ブログエディターのマニフェストファイル
remove_action('wp_head', 'rsd_link');// 外部から編集するためのAPI（XML-RPC)へのパス
remove_action('wp_head', 'feed_links_extra', 3);// フィードへのリンク
remove_action('wp_head', 'print_emoji_detection_script', 7);// 絵文字に関するJavaScript
remove_action('wp_head', 'rest_output_link_wp_head'); //REST API のパス
remove_action('wp_head', 'wp_oembed_add_discovery_links');//引用表示（埋め込み）関連のコード
remove_action('wp_print_styles', 'print_emoji_styles');// 絵文字に関するCSS
remove_action('admin_print_scripts', 'print_emoji_detection_script');// 絵文字に関するJavaScript(管理画面)
remove_action('admin_print_styles', 'print_emoji_styles');// 絵文字に関するCSS(管理画面)

/**
 * headに要素を追記
 */
function cmll_add_wp_head () {

	//インクルードディレクトリのURI
	$includes_url = includes_url();

	//テーマディレクトリのURI
	$theme_file_url = get_template_directory_uri();

	//テーマのバージョンを取得
	$theme_version = wp_get_theme() -> get( 'Version' );

	//WordPressのバージョンを取得
	$wp_version = get_bloginfo('version');

	echo "
<link rel='preload' href='{$theme_file_url}/assets/js/main.js?ver={$theme_version}' as='script' />
<link rel='preload' href='{$theme_file_url}/assets/css/style.css?ver={$theme_version}' as='style' />
<link rel='preload' href='{$includes_url}css/dist/block-library/style.min.css?ver={$wp_version}' as='style' />
<link rel='preconnect' href='https://fonts.googleapis.com' />
<link rel='preconnect' href='https://fonts.gstatic.com' crossorigin />
	";
}
add_action ( 'wp_head' ,'cmll_add_wp_head', 1 );


/**
 * JetpackのCSSを無効化
 */
add_filter('jetpack_implode_frontend_css','__return_false' );
