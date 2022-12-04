/**
 *
 * サムネイル画像付きのクエリループブロックを設置した際に、
 * アイキャッチ画像が設定していない記事については変わりの画像を表示するためのスクリプト
 */
export const wpQueryThumnail = () => {
	const $queryThumbnails = document.querySelectorAll(".wp-block-column.is-thumbnail");
	if( $queryThumbnails ) {
		$queryThumbnails.forEach( ( $queryThumbnail) => {
			if( !$queryThumbnail.hasChildNodes() ) {
				$queryThumbnail.innerHTML = `<div class="is-noimage"><span class="material-icons-outlined">image</span></div>`
			}
		});
	}
}

