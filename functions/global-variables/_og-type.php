<?php
# -----------------------------------------------------------------
# OG TYPEを返す関数
# -----------------------------------------------------------------
function cmll_global_var_ogtype(){
	global $cmll_ogtype;
	if(is_front_page()){
		$cmll_ogtype = "website";
	} else {
		$cmll_ogtype = "article";
	}
}
add_action( 'template_redirect' , 'cmll_global_var_ogtype' , 10 , 1 );
