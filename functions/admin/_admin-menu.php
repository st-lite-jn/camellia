<?php
# -----------------------------------------------------------------
# 管理メニューのカスタマイズ
# -----------------------------------------------------------------
/**
* 編集権限に設定へのアクセス権限を追加
*/
// function cmll_after_switch_theme () {
//     $role = get_role( 'editor' );
//     $role->add_cap( 'manage_options' );
// }
// add_action('admin_menu', 'cmll_after_switch_theme',10);

/**
* 管理メニュー内の項目ごとの非表示化
*/
// function cmll_remove_menus () {
// 	global $menu;
	//remove_menu_page( 'index.php' );							// ダッシュボード
	//remove_menu_page( 'edit.php' );							// 投稿
	//remove_menu_page( 'upload.php' );							// メディア
	//remove_menu_page( 'edit.php?post_type=page' );			// 固定ページ
	//remove_menu_page( 'edit-comments.php' );					// コメント
	//remove_menu_page( 'themes.php' );							// 外観
	//remove_menu_page( 'plugins.php' );						// プラグイン
	//remove_menu_page( 'users.php' );							// ユーザー
	//remove_menu_page( 'options-general.php' );				// 設定
	//remove_menu_page( 'edit.php?post_type=acf-field-group');	// Advanced Custom Field

	/**
	* 管理者権限のユーザー以外は非表示する項目
	*/
// 	if( !current_user_can( 'administrator' ) ){
// 		remove_menu_page( 'tools.php' ); 					 		// ツール
// 		remove_menu_page( 'options-general.php');				 	// 設定
// 		remove_menu_page( 'edit.php?post_type=acf-field-group'); 	// Advanced Custom Field
// 		remove_menu_page( 'admin.php?page=meowapps-main-menu'); 	// Meow Apps
// 		remove_submenu_page('options-general.php','options-writing.php');
// 		remove_submenu_page('options-general.php','options-reading.php');
// 		remove_submenu_page('options-general.php','options-discussion.php');
// 		remove_submenu_page('options-general.php','options-media.php');
// 		remove_submenu_page('options-general.php','options-permalink.php');
// 		remove_submenu_page('options-general.php','privacy.php');
// 		remove_submenu_page('options-general.php','duplicatepost');
// 		remove_submenu_page('options-general.php','hicpo-settings');
// 		remove_submenu_page('options-general.php','tinymce-advanced');
// 		remove_submenu_page('options-general.php','wpsupercache'); 	// Wordpress Suer Cashe
// 	}
// }
// add_action('admin_menu', 'cmll_remove_menus',11);

/**
* 管理メニュー内の順番を並び替え
*/
// function cmll_custom_menu_order($menu_ord) {
// 	if (!$menu_ord) return true;
// 		return array(
// 		'index.php', // ダッシュボード
// 		'separator1', // 仕切り
// 		'edit.php?post_type=page', // 固定ページ
// 		'edit.php', // Blog
// 		'separator2', // 仕切り
// 		'themes.php', // 外観
// 		'upload.php', // メディア
// 		'separator-last', // 仕切り
// 	);
// }
// add_filter('custom_menu_order', 'cmll_custom_menu_order');
// add_filter('menu_order', 'cmll_custom_menu_order');
