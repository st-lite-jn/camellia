<?php
# -----------------------------------------------------------------
# 記事投稿画面のカスタマイズ
# -----------------------------------------------------------------
/**
 * ブロックエディタ上のスタイルシートの読み込み
 */
function cmll_enqueue_block_editor_style() {
	// ブロックエディタ用スタイル機能をテーマに追加
	add_theme_support( 'editor-styles' );
	add_editor_style( [
		'//fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100;300;400;500;700;900&display=swap'
		//,'assets/css/editor.css'
	]);
};

add_action( "after_setup_theme" , "cmll_enqueue_block_editor_style");
