import { bgLayer } from "./_bg-layer";
import { uniqueEl } from "./_elements";

const searchToggle = () => {
	if(document.querySelector(".l-bg-layer")) {
		document.querySelector(".l-bg-layer").parentNode.removeChild(document.querySelector(".l-bg-layer"));
	}
	uniqueEl.searchBtn.addEventListener("click", (e) => {
		let $isOpenElements = document.querySelectorAll("is-opened");
		$isOpenElements.forEach((isOpenElement)=>{
			isOpenElement.classList.remove("is-opened");
		});
		bgLayer(e.currentTarget);
		if(uniqueEl.gnavBtn.textContent === "close"){ uniqueEl.gnavBtn.textContent = "menu";};
		e.currentTarget.textContent = e.currentTarget.textContent === "close" ? "search" : "close";
		e.currentTarget.classList.toggle("is-opened");
		uniqueEl.searchForm.classList.toggle("is-opened");
	});
}

/**
 * 検索フォームの位置
 */
const searchPosition = () => {
	//WordPressの管理バーが表示されている場合は高さを取得
	//表示されていない場合は0を代入
	const wpadminbarHeight = document.getElementById('wpadminbar') ? document.getElementById('wpadminbar').offsetHeight : 0 ;
	const headerHeight = uniqueEl.header.offsetHeight;
	uniqueEl.searchForm.style.top = `${ headerHeight } + ${ wpadminbarHeight }px`;
}
export {searchToggle , searchPosition};
