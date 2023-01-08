import { uniqueEl } from "./_elements";

//ヘッダー固定
const headerFixed = () => {
	//WordPressの管理バーが表示されている場合は高さを取得
	//表示されていない場合は0を代入
	const wpadminbarHeight = document.getElementById('wpadminbar') ? document.getElementById('wpadminbar').offsetHeight : 0 ;

	let headerHeight = uniqueEl.header.offsetHeight;
	let scrollPosition = document.documentElement.scrollTop || document.body.scrollTop;

	if( scrollPosition >= headerHeight) {
		uniqueEl.header.classList.add("is-scrolled");
		uniqueEl.header.style.top = wpadminbarHeight + "px";
		uniqueEl.wrapper.style.paddingTop = headerHeight + "px";
	} else {
		uniqueEl.header.classList.remove("is-scrolled");
		uniqueEl.header.style.top = null;
		uniqueEl.wrapper.style.paddingTop = null;
	}

}
export {headerFixed};
