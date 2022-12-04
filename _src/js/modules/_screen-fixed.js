import { uniqueEl } from "./_elements";
/**
 * 画面の高さを固定化する処理
 */
class ScreenFixed {
	constructor(scrollPosition) {
		this.scrollPosition = scrollPosition;
	}
	fixed () {
		//WordPressの管理バーが表示されている場合は高さを取得
		const wpadminbarHeight = document.getElementById('wpadminbar') ? document.getElementById('wpadminbar').offsetHeight : 0 ;
		this.scrollPosition = document.documentElement.scrollTop || document.body.scrollTop;
		uniqueEl.wrapper.style.position = "fixed";
		uniqueEl.wrapper.style.width = "100%";
		uniqueEl.wrapper.style.zIndex = `1`;
		uniqueEl.wrapper.style.top = `-${this.scrollPosition - wpadminbarHeight}px`;
	}
	reset () {
		//スタイルシートを削除
		uniqueEl.wrapper.style.position = null;
		uniqueEl.wrapper.style.width = null;
		uniqueEl.wrapper.style.zIndex = null;
		uniqueEl.wrapper.style.top = null;
		//記憶したスクロール位置に移動
		document.scrollingElement.scrollTop = this.scrollPosition;
	}
}
export {ScreenFixed};
