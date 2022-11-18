<?php

function cmll_rbp_query() {
    register_block_pattern(
		'tsubaki/query/custom-query-loop',
		array(
			"title" => "カスタムクエリーループ",
			"categories" => array('query'),
			'description' => 'サムネイル画像付きのクエリーループ',
			'content' => '
			<!-- wp:query {"queryId":1,"query":{"perPage":"4","pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false},"displayLayout":{"type":"list","columns":3},"className":"wp-cmll-query"} -->
<div class="wp-block-query wp-cmll-query"><!-- wp:post-template -->
<!-- wp:columns {"align":"wide"} -->
<div class="wp-block-columns alignwide"><!-- wp:column {"width":"25%","className":"is-thumbnail"} -->
<div class="wp-block-column is-thumbnail" style="flex-basis:25%"><!-- wp:post-featured-image {"isLink":true} /--></div>
<!-- /wp:column -->

<!-- wp:column {"width":"75%"} -->
<div class="wp-block-column" style="flex-basis:75%"><!-- wp:group -->
<div class="wp-block-group"><!-- wp:post-date /-->

<!-- wp:post-title {"isLink":true} /-->

<!-- wp:post-excerpt {"moreText":"続きを読む"} /-->

<!-- wp:post-terms {"term":"category","className":"is-cat"} /-->

<!-- wp:post-terms {"term":"post_tag","className":"is-tag"} /--></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->
<!-- /wp:post-template -->

<!-- wp:query-pagination {"paginationArrow":"chevron","layout":{"type":"flex","justifyContent":"center","flexWrap":"nowrap"}} -->
<!-- wp:query-pagination-previous /-->

<!-- wp:query-pagination-numbers /-->

<!-- wp:query-pagination-next /-->
<!-- /wp:query-pagination -->

<!-- wp:query-no-results -->
<!-- wp:paragraph {"placeholder":"クエリが結果を返さない場合に表示するテキスト、またはブロックを追加してください。"} -->
<p></p>
<!-- /wp:paragraph -->
<!-- /wp:query-no-results --></div>
<!-- /wp:query -->
'
		)
	);
}
add_action( 'init', 'cmll_rbp_query' );
