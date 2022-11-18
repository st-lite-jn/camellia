<?php
# -----------------------------------------------------------------
# リダイレクト処理の制御
# -----------------------------------------------------------------

/**
 *　意図しないリダイレクトを行わなくする
 */
remove_action( 'template_redirect', 'wp_redirect_admin_locations', 1000 );

/**
 *　投稿者アーカイブ非表示リダイレクト
 */
// function cmll_author_archive_redirect() {
// 	if( is_author() ) {
// 		wp_redirect( home_url());
// 		exit;
// 	}
//  }
//  add_action( 'template_redirect', 'cmll_author_archive_redirect' );

/**
 *　存在しないURLを自動的に補完する処理を無効化
 */
function cmll_disable_complement( $redirect_url ) {
	if( is_404() ) {
		return false;
	}
	return $redirect_url;
}
add_filter( 'redirect_canonical', 'cmll_disable_complement' );


/**
 * ログイン画面にアクセスした際、
 * URLにLOGIN_CODEが含まれてないければ404にリダイレクトさせる
 */

// define("LOGIN_CODE" , "hogehoge");
// if( !function_exists('cmll_redirect_login') ) {
// 	function cmll_redirect_login() {
// 		$uri = getenv('REQUEST_URI');
// 		if( !strpos( $uri , LOGIN_CODE ) && !is_user_logged_in() ){
// 			wp_safe_redirect( home_url() );
// 			exit;
// 		}
// 	}
// }
// add_action( 'login_form_login', 'cmll_redirect_login' );

/**
 * パスワード再発行の画面に
 * URLにLOGIN_CODEが含まれてないければ404にリダイレクトさせる
 */
// function cmll_redirect_lostpassword(){
// 	if(!isset($_SERVER["HTTP_REFERER"])) {
// 		header("HTTP/1.0 404 Not Found");
// 		header("Location: /404.php");
// 	} else {
// 		$ref = $_SERVER["HTTP_REFERER"];
// 		if(!strpos($ref, LOGIN_CODE) && !is_user_logged_in() ){
// 			header("HTTP/1.0 404 Not Found");
// 			header("Location: /404.php");
// 		}
// 	}
// }
// add_action( 'lost_password', 'cmll_redirect_lostpassword' );
