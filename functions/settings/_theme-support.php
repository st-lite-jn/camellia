<?php
# -----------------------------------------------------------------
# WordPressのデフォルトの機能の制御
# -----------------------------------------------------------------

/*
* Gutenbergを無効化
*/
// add_filter( 'use_block_editor_for_post', '__return_false' );

/**
 * コアのブロックパターンをすべて無効化
 */
add_action( 'init', function() {
	remove_theme_support( 'core-block-patterns' );
}, 9 );

/*
* アイキャッチ画像を有効化
*/
function cmll_twpp_setup_theme() {
	add_theme_support( 'post-thumbnails' );
}
add_action( 'after_setup_theme', 'cmll_twpp_setup_theme' );

/*
* 固定ページの抜粋を有効化
*/
add_post_type_support( 'page', 'excerpt' );

/*
* テーマカスタマイザーのカスタムロゴ機能を有効化
*/
add_theme_support('custom-logo');

/*
* 「投稿」の「カテゴリー」と「タグ」の非表示化
*/
// function cmll_unregister_taxonomies() {
// 	global $wp_taxonomies;

// 	//カテゴリーの非表示化
// 	if (!empty($wp_taxonomies['category']->object_type)) {
// 		foreach ($wp_taxonomies['category']->object_type as $i => $object_type) {
// 			if ($object_type == 'post') {
// 				unset($wp_taxonomies['category']->object_type[$i]);
// 			}
// 		}
// 	}

// 	//タグの非表示化
// 	if (!empty($wp_taxonomies['post_tag']->object_type)) {
// 		foreach ($wp_taxonomies['post_tag']->object_type as $i => $object_type) {
// 			if ($object_type == 'post') {
// 				unset($wp_taxonomies['post_tag']->object_type[$i]);
// 			}
// 		}
// 	}
// 	return true;
// }
// add_action('init', 'cmll_unregister_taxonomies');
