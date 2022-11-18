<?php
//======================================================================
// ページネーション
//======================================================================

//-----------------------------------------------------
// 1ページあたりの表示件数のカスタマイズする関数
//-----------------------------------------------------
function cmll_change_posts_per_page( $query ) {
	if( is_admin() || ! $query->is_main_query())return;
	/**
	 * 現在ページを取得
	 * ページ数ごとに表示件数を変更する場合に使用する
	 */
	$paged = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
	if (
		$query->is_post_type_archive('post') ||
		$query->is_post_type_archive('news')
	){
		$query->set( 'posts_per_page', 12); //1ページ目に表示する記事数
	}
}
add_action( 'pre_get_posts', 'cmll_change_posts_per_page' );


//-----------------------------------------------------
// ページネーション出力する関数
//-----------------------------------------------------
/**
* $paged : 現在のページ
* $pages : 全ページ数
* $range : 左右に何ページ表示するか
* $show_only : 1ページしかない時に表示するかどうか
*/
if ( ! class_exists( 'cmll_Output_Pagenation' ) ) {
	class cmll_Output_Pagenation {
		public static function pagination_method( $pages, $paged, $range = 2, $show_only = false ) {
			$pagenation = "";
			$pages = intval($pages);    //float型で渡ってくるので明示的に int型 へ
			$paged = $paged ?: 1;       //get_query_var('paged')をそのまま投げても大丈夫なように
			$last_range = $pages - $range;
			//表示テキスト
			$text_first   = "最新";
			$text_before  = "&lt; 前へ";
			$text_next    = "次へ &gt;";
			$text_last    = "最後";
			if ( $show_only && $pages === 1 ):
				// 1ページのみで表示設定が true の時
				echo '<div class="p-pagination"><span class="button is-outlined">1</span></div>';
				return;
			endif;
			// 1ページのみで表示設定もない場合
			if ( $pages === 1 ) return;

			//2ページ以上の時
			if ( 1 !== $pages ) {
				$pagenation .= "
					<div class='p-pagination'>
				";
				if ( $paged > 1 ) {
					$before_page_link = get_pagenum_link( $paged - 1 );
					// 「最初」 の表示
					$first_page_link = get_pagenum_link(1);
					$pagenation .= "<div class='p-pagination__navigation'>";
					$pagenation .= "
						<a href='{$first_page_link}' class='button is-wide'>{$text_first}</a>
					";
					$pagenation .= "
						<a href='{$before_page_link}' class='button is-wide'>{$text_before}</a>
					";
					$pagenation .= "</div>";
			}
				for ( $i = 1; $i <= $pages; $i++ ) {
					if ( $i <= $paged + $range && $i >= $paged - $range ) {
						// $paged +- $range 以内であればページ番号を出力
						if ( $paged === $i ) {
							$pagenation .= "
								<span class='button is-outlined'>{$i}</span>
							";
						} else {
							$number_page_link = get_pagenum_link( $i );
							$pagenation .= "
							<a href='{$number_page_link}' class='button'>{$i}</a>
							";
						}
					}
				}
				if ( $paged != $pages ) {
					$pagenation .= "<div class='p-pagination__navigation'>";
					if ( $paged < $pages ) {
						// 「次へ」 のリンクを表示
						$next_page_link = get_pagenum_link( $paged + 1 );
						$pagenation .= "
							<a href='{$next_page_link}' class='button is-wide'>{$text_next}</a>
						";
					}
					// 「最後」のリンクを表示
					$last_page_link = get_pagenum_link( $pages );
					$pagenation .= "
						<a href='{$last_page_link}' class='button is-wide'>{$text_last}</a>
					";
					$pagenation .= "</div>";
				}
				$pagenation .= "</div>";
			}
			echo preg_replace('/(\t|\r\n|\r|\n)/s', '', $pagenation);
		}
	}
}
