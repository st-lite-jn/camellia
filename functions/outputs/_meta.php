<?php
//======================================================================
// メタ要素生成し出力する関数
//======================================================================
if(!function_exists('cmll_output_meta')) {
	function cmll_output_meta() {

		//ディスクリプションとOGタイプはグローバル変数で取得
		global $cmll_description;
		global $cmll_ogtype;
		global $cmll_title;
		global $cmll_ogimg;

		$charset = get_bloginfo('charset');
		$site_name = get_bloginfo('name');
		$site_desc = get_bloginfo('description');
		$site_url = home_url();
		$site_icon = get_site_icon_url();

		//HTMLを初期化
		$code_html = "";
		
		$code_html .= "
			<meta charset=\"{$charset}\" />
			<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\" />
			<title>{$cmll_title['title-tag']}</title>
			<meta name=\"description\" content=\"{$cmll_description}\" />
		";
		//Jetpackを使用していない場合のみ出力
		if(!class_exists('jetpack')) {
			$code_html .= "
				<meta property=\"og:site_name\" content=\"{$site_name}\" />
				<meta property=\"og:title\" content=\"{$cmll_title['title-tag']}\" />
				<meta property=\"og:description\" content=\"{$cmll_description}\" />
				<meta property=\"og:type\" content=\"{$cmll_ogtype}\" />
				<meta property=\"og:image\" content=\"{$cmll_ogimg[0]}\" />
				<meta property=\"og:image:width\" content=\"{$cmll_ogimg[1]}\" />
				<meta property=\"og:image:heighgt\" content=\"{$cmll_ogimg[2]}\" />
				<meta name=\"twitter:description\" content=\"{$cmll_description}\" />
				<meta name=\"twitter:card\" content=\"summary_large_image\" />
			";
		}
		echo preg_replace('/(\t|\r\n|\r|\n)/s', '', $code_html);
	}
}
add_action( 'wp_head' , 'cmll_output_meta' , 1);
