<?php
//======================================================================
// クエリーに応じてパンくずリストを生成する関数
//======================================================================
if(!function_exists('cmll_output_breadcrumb')) {
	function cmll_output_breadcrumb($wp_obj = null) {

	global $cmll_title;
	global $cmll_post_type;

	// トップページと404エラーページでは何も出力しない
	if ( is_front_page() || is_404()) return false;

	// ウェブサイトのURL
	$home_url = home_url();

	//共通のclass要素
	$dom_class_wrapper = "p-breadcrumb-wrapper";
	$dom_class_parent = "p-breadcrumb c-container";
	$dom_class_child = "p-breadcrumb__list";
	$dom_class_item = "p-breadcrumb__item";

	//ポジションの初期値
	$position = 1;
	//HTML
	$breadcrumb = null;

	//そのページのWPオブジェクトを取得
	$wp_obj = $wp_obj ?: get_queried_object();

	$breadcrumb .= "
			<div class='{$dom_class_wrapper}'>
				<ul class='{$dom_class_parent}' itemscope itemtype='https://schema.org/BreadcrumbList'>
					<li class='{$dom_class_child}' itemprop='itemListElement' itemscope itemtype='https://schema.org/ListItem'>
						<a class='{$dom_class_item}' itemprop='item' href='{$home_url}'>
							<span itemprop='name'>Home</span>
						</a>
						<meta itemprop='position' content='{$position}' />
					</li>
	";
	if(is_home()) {
		$position ++;
		/**
		* 投稿のアーカイブ
		* $wp_obj : WP_Post
		*/
		$breadcrumb .= "
			<li class='{$dom_class_child}' itemprop='itemListElement' itemscope itemtype='https://schema.org/ListItem'>
				<span class='{$dom_class_item}' itemprop='name'>$wp_obj->post_title</span>
				<meta itemprop='position' content='{$position}' />
			</li>
		";
	} elseif ( is_attachment() ) {
		/**
		* 添付ファイルページ ( $wp_obj : WP_Post )
		* ※ 添付ファイルページでは is_single() も true になるので先に分岐
		*/
		$position ++;
		$breadcrumb .= "
			<li class='{$dom_class_child}' itemprop='itemListElement' itemscope itemtype='https://schema.org/ListItem'>
				<span class='{$dom_class_item}' itemprop='name' >$wp_obj->post_title</span>
				<meta itemprop='position' content='{$position}' />
			</li>
		";
	} elseif ( is_single() ) {
		/**
		* 投稿ページ
		* $wp_obj : WP_Post
		*/
		$post_id    = $wp_obj->ID;

		$post_type  = $wp_obj->post_type;
		$post_title = $wp_obj->post_title;

		$post_archive_link = get_post_type_archive_link( $post_type ); //アーカイブトップURL

		if($post_type === "post" && get_option( 'page_for_posts' ) ) {
			$home_id = get_option( 'page_for_posts' );
			$post_archive_label = get_the_title( $home_id );
		} else {
			$post_archive_label = get_post_type_object( $post_type ) -> label; //投稿タイプのラベル
		}
		$position ++;
		$breadcrumb .= "
			<li class='{$dom_class_child}' itemprop='itemListElement' itemscope itemtype='https://schema.org/ListItem'>
				<a class='{$dom_class_item}' itemprop='item' href='$post_archive_link'>
					<span itemprop='name'>$post_archive_label</span>
				</a>
				<meta itemprop='position' content='{$position}' />
			</li>
		";
		// カスタム投稿タイプかどうか
		if ( $post_type !== 'post' ) {
			$the_tax = "";  //そのサイトに合わせ、投稿タイプごとに分岐させて明示的に指定してもよい
			// 投稿タイプに紐づいたタクソノミーを取得 (投稿フォーマットは除く)
			$tax_array = get_object_taxonomies( $post_type, 'names');
			foreach ($tax_array as $tax_name) {
				if ( $tax_name !== 'post_format' ) {
					$the_tax = $tax_name;
					break;
				}
			}
		} else {
			$the_tax = 'category';  //通常の投稿の場合、カテゴリーを表示
		}
		// タクソノミーが紐づいていれば表示
		if ( $the_tax !== "" ) {
			$child_terms = array();   // 子を持たないタームだけを集める配列
			$parents_list = array();  // 子を持つタームだけを集める配列
			// 投稿に紐づくタームを全て取得
			$terms = get_the_terms( $post_id, $the_tax );
			if ( !empty( $terms ) ) {
				//全タームの親IDを取得
				foreach ( $terms as $term ) {
					$taxnomony_name = $term->taxonomy; //タクソノミー名を取得
					if ( $term->parent !== 0 ) $parents_list[] = $term->parent;
				}
				$tax = get_taxonomy($taxnomony_name);
				$tax_hierarchical = $tax->hierarchical;

				//親リストに含まれないタームのみ取得
				foreach ( $terms as $term ) {
					if ( ! in_array( $term->term_id, $parents_list ) ) $child_terms[] = $term;
				}
				if($tax_hierarchical): //タクソノミーが階層有りだったら表示
					// 最下層のターム配列から一つだけ取得
					$term = $child_terms[0];
					if ( $term->parent !== 0 ) {
						// 親タームのIDリストを取得
						$parent_array = array_reverse( get_ancestors( $term->term_id, $the_tax ) );

						foreach ( $parent_array as $parent_id ) {
							$parent_term = get_term( $parent_id, $the_tax );
							$parent_term_link = get_term_link( $parent_id, $the_tax );
							$parent_term_label = $parent_term -> name;
							$position ++;
							$breadcrumb .= "
							<li class='{$dom_class_child}' itemprop='itemListElement' itemscope itemtype='https://schema.org/ListItem'>
								<a class='{$dom_class_item}' itemprop='item' href='{$parent_term_link}'>
									<span itemprop='name'>{$parent_term_label}</span>
								</a>
								<meta itemprop='position' content='{$position}' />
							</li>
							";
						}
					}
					// 最下層のタームを表示
					$term_link = get_term_link( $term->term_id, $the_tax );
					$term_label = $term->name;
					$position ++;
					$breadcrumb .= "
					<li class='{$dom_class_child}' itemprop='itemListElement' itemscope itemtype='https://schema.org/ListItem'>
						<a class='{$dom_class_item}' itemprop='item' href='{$term_link}'>
							<span itemprop='name'>{$term_label}</span>
						</a>
						<meta itemprop='position' content='{$position}' />
					</li>
					";
				endif;
			}
		}
		// 投稿自身の表示
		$position ++;
		$breadcrumb .= "
			<li class='{$dom_class_child}' itemprop='itemListElement' itemscope itemtype='https://schema.org/ListItem'>
				<span class='{$dom_class_item}' itemprop='name'>{$post_title}</span>
				<meta itemprop='position' content='{$position}' />
			</li>
		";
	} elseif ( is_page() ) {
		/**
		 * 固定ページ
		 * $wp_obj : WP_Post
		 */

		// 親ページがあれば順番に表示
		if ( $wp_obj->post_parent !== 0 ) {
			$parent_array = array_reverse( get_post_ancestors( $wp_obj->ID) );
			foreach( $parent_array as $parent_id ) {
				$parent_page_link = get_permalink( $parent_id );
				$paretn_page_label = get_the_title( $parent_id );
				$position ++;
				$breadcrumb .= "
					<li class='{$dom_class_child}' itemprop='itemListElement' itemscope itemtype='https://schema.org/ListItem'>
						<a class='{$dom_class_item}' itemprop='item' href='{$parent_page_link}'>
							<span itemprop='name'>{$paretn_page_label}</span>
						</a>
						<meta itemprop='position' content='{$position}' />
					</li>
				";
			}
		}
		// 投稿自身の表示
		$position ++;
		$breadcrumb .= "
		<li class='{$dom_class_child}' itemprop='itemListElement' itemscope itemtype='https://schema.org/ListItem'>
			<span class='{$dom_class_item}' itemprop='name'>{$wp_obj->post_title}</span>
			<meta itemprop='position' content='{$position}' />
		</li>
	";
	} elseif ( is_date() ) {
		/**
		 * 日付アーカイブ
		 * $wp_obj : WP_Post_Type
		 */

		$post_archive_link = get_post_type_archive_link( $cmll_post_type );
		if($cmll_post_type === "post" && get_option( 'page_for_posts' ) ) {
			$home_id = get_option( 'page_for_posts' );
			$post_archive_label = get_the_title( $home_id );
		} else {
			$post_archive_label = get_post_type_object($cmll_post_type) -> label; //投稿タイプのラベル
		}


		$position ++;
		$breadcrumb .= "
			<li class='{$dom_class_child}' itemprop='itemListElement' itemscope itemtype='https://schema.org/ListItem'>
				<a class='{$dom_class_item}' itemprop='item' href='{$post_archive_link}'>
					<span itemprop='name'>{$post_archive_label}</span>
				</a>
				<meta itemprop='position' content='{$position}' />
			</li>
		";

		$year  = get_query_var('year');
		$month = get_query_var('monthnum');
		$day   = get_query_var('day');

		$year_link = get_year_link( $year );

		$month_link = get_year_link( $month );
		if ( $day !== 0 ) {
			//日別アーカイブ
			$position ++;
			$breadcrumb .= "
				<li class='{$dom_class_child}' itemprop='itemListElement' itemscope itemtype='https://schema.org/ListItem'>
					<a class='{$dom_class_item}' itemprop='item' href='$year_link'>
						<span itemprop='name'>{$year}年</span>
					</a>
					<meta itemprop='position' content='{$position}' />
				</li>";
			$position ++;
			$breadcrumb .= "
				<li class='{$dom_class_child}' itemprop='itemListElement' itemscope itemtype='https://schema.org/ListItem'>
					<a class='{$dom_class_item}' itemprop='item' href='$month_link'>
						<span itemprop='name'>{$month}年</span>
					</a>
					<meta itemprop='position' content='{$position}' />
				</li>";
			$position ++;
			$breadcrumb .= "
				<li class='{$dom_class_child}' itemprop='itemListElement' itemscope itemtype='https://schema.org/ListItem'>
					<span class='{$dom_class_item}' itemprop='name'>{$day}日</span>
					<meta itemprop='position' content='{$position}' />
				</li>
			";
		} elseif ( $month !== 0 ) {
			//月別アーカイブ
			$position ++;
			$breadcrumb .= "
			<li class='{$dom_class_child}' itemprop='itemListElement' itemscope itemtype='https://schema.org/ListItem'>
				<span class='{$dom_class_item}' itemprop='name'>{$year}年{$month}月</span>
				<meta itemprop='position' content='{$position}' />
			</li>
		";
		} else {
			//年別アーカイブ
			$position ++;
			$breadcrumb .= "
			<li class='{$dom_class_child}' itemprop='itemListElement' itemscope itemtype='https://schema.org/ListItem'>
				<span class='{$dom_class_item}' itemprop='name' >{$year}年</span>
				<meta itemprop='position' content='{$position}' />
			</li>
		";
		}
	} elseif ( is_author() ) {
		/**
		 * 投稿者アーカイブ
		 * $wp_obj : WP_User
		 */
		$position ++;
		$breadcrumb .= "
		<li class='{$dom_class_child}' itemprop='itemListElement' itemscope itemtype='https://schema.org/ListItem'>
			<span class='{$dom_class_item}' itemprop='name' >{$wp_obj->display_name}</span>
			<meta itemprop='position' content='{$position}' />
		</li>
	";
	} elseif ( is_tax() || is_category() || is_tag()) {
		/**
		 * カテゴリーアーカイブ・タクソノミーアーカイブ・タグアーカイブ
		 * $wp_obj : WP_Term
		 */
		$term_id   = $wp_obj->term_id;
		$term_label = $wp_obj->name;
		$tax_name  = $wp_obj->taxonomy;

		$post_archive_link = get_post_type_archive_link( $cmll_post_type );
		if($cmll_post_type === "post" && get_option( 'page_for_posts' ) ) {
			$home_id = get_option( 'page_for_posts' );
			$post_archive_label = get_the_title( $home_id );
		} else {
			$post_archive_label = get_post_type_object($cmll_post_type) -> label; //投稿タイプのラベル
		}

		$position ++;
		$breadcrumb .= "
			<li class='{$dom_class_child}' itemprop='itemListElement' itemscope itemtype='https://schema.org/ListItem'>
				<a class='{$dom_class_item}' itemprop='item' href='$post_archive_link'>
					<span itemprop='name'>{$post_archive_label}</span>
				</a>
				<meta itemprop='position' content='{$position}' />
			</li>
		";
		// 親ターム（カテゴリー）があれば順番に表示
		if ( $wp_obj->parent !== 0 ) {
			$parent_array = array_reverse( get_ancestors( $term_id, $tax_name ) );
			foreach( $parent_array as $parent_id ) {
				$parent_term = get_term( $parent_id, $tax_name );
				$paretn_term_link = get_term_link( $parent_id, $tax_name );
				$paretn_term_label = $parent_term -> name;
				$position ++;
				$breadcrumb .= "
					<li class='{$dom_class_child}' itemprop='itemListElement' itemscope itemtype='https://schema.org/ListItem'>
						<a class='{$dom_class_item}' itemprop='item' href='{$paretn_term_link}'>
							<span itemprop='name'>{$paretn_term_label}</span>
						</a>
						<meta itemprop='position' content='{$position}' />
					</li>
				";
			}
		}
		// ターム自身の表示
		$position ++;
		$breadcrumb .= "
			<li class='{$dom_class_child}' itemprop='itemListElement' itemscope itemtype='https://schema.org/ListItem'>
				<span class='{$dom_class_item}' itemprop='name'>{$term_label}</span>
				<meta itemprop='position' content='{$position}' />
			</li>
		";

	} elseif ( is_archive() ) {
		/**
		 * アーカイブ ( $wp_obj : WP_Term )
		 */
		$position ++;
		$breadcrumb .= "
			<li class='{$dom_class_child}' itemprop='itemListElement' itemscope itemtype='https://schema.org/ListItem'>
				<span class='{$dom_class_item}' itemprop='name' >$wp_obj->label</span>
				<meta itemprop='position' content='{$position}' />
			</li>
		";
	} elseif ( is_search() ) {
		/**
		 * 検索結果ページ
		 */
		$search_query = get_search_query();
		$position ++;
		$breadcrumb .= "
			<li class='{$dom_class_child}' itemprop='itemListElement' itemscope itemtype='https://schema.org/ListItem'>
				<span class='{$dom_class_item}' itemprop='name' >検索結果 : $search_query</span>
				<meta itemprop='position' content='{$position}' />
			</li>
		";
	} elseif ( is_404() ) {
		/**
		 * 404ページ
		 */
		$position ++;
		$breadcrumb .= "
			<li class='{$dom_class_child}' itemprop='itemListElement' itemscope itemtype='https://schema.org/ListItem'>
				<span class='{$dom_class_item}' itemprop='name'>404 Not Found</span>
				<meta itemprop='position' content='{$position}' />
			</li>
		";
	} else {
		/**
		 * その他のページ（無いと思うが一応）
		 */
		$label = get_the_title();
		$position ++;
		$breadcrumb .= "
			<li class='{$dom_class_child}' itemprop='itemListElement' itemscope itemtype='https://schema.org/ListItem'>
				<span class='{$dom_class_item}' itemprop='name'>$label</span>
				<meta itemprop='position' content='{$position}' />
			</li>
		";
	}
	$breadcrumb .= "</ul></div>";
	echo preg_replace('/(\t|\r\n|\r|\n)/s', '', $breadcrumb);
	}
}
add_action( "block_template_part", "cmll_output_breadcrumb", 10, 1 );