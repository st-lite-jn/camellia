<?php
# -----------------------------------------------------------------
# ダッシュボードのカスタマイズ
# -----------------------------------------------------------------
/**
* ダッシュボードのウィジェットを削除
*/
// function cmll_remove_dashboard_meta() {
// 	remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
// 	remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );
// 	remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
// 	remove_meta_box( 'dashboard_secondary', 'dashboard', 'normal' );
// 	remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
// 	remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' );
// 	remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );
// 	remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );
// 	remove_meta_box( 'dashboard_activity', 'dashboard', 'normal');
// }
// add_action( 'admin_init', 'cmll_remove_dashboard_meta');

//
/**
* ダッシュボードに独自のウィジェットを追加
*/
// function cmll_custom_dashboard_widgets() {
// 	global $wp_meta_boxes;
// 	if (current_user_can( 'administrator' ) || current_user_can( 'editor' )  ) {
// 		wp_add_dashboard_widget('wpWidgetCustom_1', 'ショートカット', 'cmll_dashboard_widget_post');
// 	}
// }
// add_action('wp_dashboard_setup', 'cmll_custom_dashboard_widgets');
// //固定ページと投稿コンテンツ
// function cmll_dashboard_widget_post() {
// 	$posts_html="";
// 	$posts_html .=  <<< EOM
// 	<nav class="wp-custom-widget">
// 		<a class="wp-custom-widget__link" href="edit.php?post_type=page">固定ページ</a>
// 		<a class="wp-custom-widget__link" href="edit.php">Blog</a>
// 		<a class="wp-custom-widget__link" href="edit.php?post_type=news">News</a>
// 	</nav>
// EOM;
// 	echo $posts_html;
// }

