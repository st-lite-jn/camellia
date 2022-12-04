<?php
if(!function_exists("cmll_widgets_init")) {
	function cmll_widgets_init() {
		register_sidebar(
			array(
				'name' => __( '個別ページタイトル直下', 'tsubaki' ),
				'id' => 'singular-title-widget',
				'description' => __( '個別ページのタイトル下のウィジェットです。', 'tsubaki' ),
				'before_widget' => '',
				'after_widget'  => '',
			)
		);
		register_sidebar(
			array(
				'name' => __( '個別ページコンテンツ下部', 'tsubaki' ),
				'id' => 'singular-content-bottom-widget',
				'description' => __( '個別ページコンテンツ下部のウィジェットです。', 'tsubaki' ),
				'before_widget' => '',
				'after_widget'  => '',
			)
		);
		register_sidebar(
			array(
				'name' => __( 'サイドバーエリア', 'tsubaki' ),
				'id' => 'sidebar-widget',
				'description' => __( 'サイドバーエリアのウィジェットです。', 'tsubaki' ),
				'before_widget' => '',
				'after_widget'  => '',
			)
		);
	}
}

add_action( 'widgets_init', 'cmll_widgets_init' );
