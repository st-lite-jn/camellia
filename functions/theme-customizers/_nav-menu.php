<?php
# -----------------------------------------------------------------
# ナビゲーションメニューの実装
# -----------------------------------------------------------------
/**
 * ナビメニューカスタマイズ
 */
register_nav_menus( array(
	'global_navigation' => 'グローバルナビゲーション',
	'footer_navigation' => 'フッターナビゲーション'
));

//メニューが空の場合はfalseを返す
function cmll_empty_menu(){
	return false;
}

/**
 * グローバルナビゲーションが生成するHTMLをカスタマイズするclass
 */
class cmll_Global_Nav_Menu extends Walker_Nav_Menu {
	function start_lvl( &$output, $depth = 0,$args = NULL) {
	  $output .= "";
	}
	function end_lvl( &$output, $depth = 0,$args = NULL) {
	  $output .= "";
	}
	//開始タグ
	function start_el( &$output, $item, $depth = 0, $args = NULL, $id = 0 ) {
		//子メニューがある場合
		if(in_array('menu-item-has-children', (array)$item->classes)) {
			//子メニューがメニューの中でも親メニューと子メニューで生成するHTMLを分ける
			if($item->menu_item_parent == 0) {
				$output .= '<li class="l-gnav-main__item '. $item->classes[0].'">';
			} else {
				$output .= '<li class="l-gnav-sub__item '. $item->classes[0].'">';
			}
			$output .= $this->create_a_tag($item, $depth, $args);
			$caption = $item->title;
			$output .= '<ul class="l-gnav-sub">';
		//子メニューがない場合
		} else {
			if($depth == 0) {
				$output .= '<li class="l-gnav-main__item ' . $item->classes[0] .'">';
			} else {
				$output .= '<li class="l-gnav-sub__item">';
			}
			$output .= $this -> create_a_tag($item, $depth, $args);
		}
	}
	//終了タグ
	function end_el( &$output, $item, $depth = 0, $args = NULL ) {
		//小メニューがある場合
		if (in_array('menu-item-has-children', (array)$item->classes)) {
		  $output .= '</ul></li>';
		}
		else {
		  // 子の場合
		  $output .= '</li>';
		}
	}
	//生成するタグのカスタマイズ
	private function create_a_tag($item, $depth, $args) {
		  // link attributes
		  $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		  $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		  $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		  $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
		  //$attributes .= ' class="menu-link ' . ( $depth > 0 ? 'sub-menu-link' : 'main-menu-link' ) . '"';

		  $item_output = sprintf( '%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s',
			  $args->before,
			  $attributes,
			  $args->link_before,
			  apply_filters( 'the_title', $item->title, $item->ID ),
			  $args->link_after,
			  $args->after
		  );
		  return apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}

/**
 * フッターナビゲーションが生成するHTMLをカスタマイズするCLASS
 */
class cmll_Footer_Nav_Menu extends Walker_Nav_Menu {
	//フッターナビゲーションは階層を持たない
	function start_lvl( &$output, $depth = 0,$args = NULL) {
	  $output .= "";
	}
	function end_lvl( &$output, $depth = 0,$args = NULL) {
	  $output .= "";
	}
	function start_el( &$output, $item, $depth = 0, $args = NULL, $id = 0 ) {
		$output .= $this->create_a_tag($item, $depth, $args);
	}
	function end_el( &$output, $item, $depth = 0, $args = NULL ) {
		$output .= '';
	}

	private function create_a_tag($item, $depth, $args) {
		// link attributes
		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
		$attributes .= ' class="l-fnav__item"';

		  $item_output = sprintf( '%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s',
			  $args->before,
			  $attributes,
			  $args->link_before,
			  apply_filters( 'the_title', $item->title, $item->ID ),
			  $args->link_after,
			  $args->after
		  );
		  return apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}




