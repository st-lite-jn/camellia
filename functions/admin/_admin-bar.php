<?php
# -----------------------------------------------------------------
# ツールバー（管理バー）のカスタマイズ
# -----------------------------------------------------------------
/**
* ツールバー内の項目非表示化
*/
// function cmll_remove_adminbar_item( $wp_admin_bar ) {
// 	var_dump($wp_admin_bar);
// 	$wp_admin_bar->remove_node('new-content'); //新規作成
// 	$wp_admin_bar->remove_node('comments');//コメント
// 	$wp_admin_bar->remove_node('customize');//外観
// 	$wp_admin_bar->remove_node('updates');//アップデート
// }
// add_action( 'admin_bar_menu', 'cmll_remove_adminbar_item', 1000 );

/**
* ツールバー内のコンテンツの複製を非表示化
*/
// function cmll_show_adminbar_css() {
// 	echo <<< EOM
// <style>
// #wpadminbar #wp-admin-bar-new_draft {display:none;}
// </style>
// EOM;
// }
// add_action( 'admin_bar_menu', 'cmll_show_adminbar_css', 1000 );
