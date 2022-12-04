/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./_src/js/modules/_animations.js":
/*!****************************************!*\
  !*** ./_src/js/modules/_animations.js ***!
  \****************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "animations": () => (/* binding */ animations)
/* harmony export */ });

const elementsObserver = new IntersectionObserver( entries => {
		entries.forEach(entry => {
			if (entry.intersectionRatio > 0) {
				entry.target.classList.add("is-ignition");
				elementsObserver.unobserve(entry.target);
			}
		});
	}, {
	rootMargin: '-100px 0px'
});

const animations = {
	observeIgnition (targets) {
		targets.forEach(target => {
			elementsObserver.observe(target);
		})
	}
}



/***/ }),

/***/ "./_src/js/modules/_bg-layer.js":
/*!**************************************!*\
  !*** ./_src/js/modules/_bg-layer.js ***!
  \**************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "bgLayer": () => (/* binding */ bgLayer)
/* harmony export */ });
const bgLayer = (e) => {
	if(e) {
		let $bgLayer = document.createElement('div');
		$bgLayer.className ="l-bg-layer";
		anime({
			targets: $bgLayer,
			keyframes:[
				{opacity:0},
				{opacity:.4},
				{opacity:1}
			],
			duration: 300,
			easing: 'linear'
		})
		if(!e.classList.contains("is-opened")) {
			document.getElementById("wrapper").insertBefore($bgLayer , document.getElementById("header"));
		} else {
			if(document.querySelector(".l-bg-layer")) {
				document.querySelector(".l-bg-layer").parentNode.removeChild(document.querySelector(".l-bg-layer"));
			}
		}
	}
}



/***/ }),

/***/ "./_src/js/modules/_elements.js":
/*!**************************************!*\
  !*** ./_src/js/modules/_elements.js ***!
  \**************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "uniqueEl": () => (/* binding */ uniqueEl)
/* harmony export */ });
/**
 * 一意の要素を取得
 */
const uniqueEl = {
	wrapper : document.getElementById("wrapper"),
	header : document.getElementById("header"),
	gnavBtn : document.getElementById("gnavBtn"),
	gnav : document.getElementById("gnav"),
	searchBtn : document.getElementById("searchBtn"),
	searchForm : document.getElementById("searchForm")
}


/***/ }),

/***/ "./_src/js/modules/_gnav.js":
/*!**********************************!*\
  !*** ./_src/js/modules/_gnav.js ***!
  \**********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "gnavToggle": () => (/* binding */ gnavToggle),
/* harmony export */   "gnavPosition": () => (/* binding */ gnavPosition)
/* harmony export */ });
/* harmony import */ var _screen_fixed__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./_screen-fixed */ "./_src/js/modules/_screen-fixed.js");
/* harmony import */ var _header__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./_header */ "./_src/js/modules/_header.js");
/* harmony import */ var _bg_layer__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./_bg-layer */ "./_src/js/modules/_bg-layer.js");
/* harmony import */ var _elements__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./_elements */ "./_src/js/modules/_elements.js");





//グローバルナビゲーションの開閉処理
const gnavToggle = () => {
	const screenFixed = new _screen_fixed__WEBPACK_IMPORTED_MODULE_0__.ScreenFixed();
	_elements__WEBPACK_IMPORTED_MODULE_3__.uniqueEl.gnavBtn.addEventListener('click', (e) => {
		let $bgLayer = document.querySelector(".l-bg-layer");
		if($bgLayer) {
			$bgLayer.parentNode.removeChild(document.querySelector(".l-bg-layer"));
		}
		(0,_bg_layer__WEBPACK_IMPORTED_MODULE_2__.bgLayer)(e.currentTarget);
		e.currentTarget.textContent;
		if(!e.currentTarget.classList.contains("is-opened")) {
			let $targets = document.querySelectorAll(".is-opened");
			$targets.forEach(($target) => {
				$target.classList.remove("is-opened");
			});
		}
		if(document.getElementById("searchBtn").textContent === "close"){document.getElementById("searchBtn").textContent = "search";};
		e.currentTarget.textContent = e.currentTarget.textContent === "close" ? "menu ": "close";
		e.currentTarget.classList.toggle("is-opened");
		_elements__WEBPACK_IMPORTED_MODULE_3__.uniqueEl.gnav.classList.toggle("is-opened");
		if(_elements__WEBPACK_IMPORTED_MODULE_3__.uniqueEl.gnav.classList.contains("is-opened")) {
			screenFixed.fixed();
			(0,_header__WEBPACK_IMPORTED_MODULE_1__.headerFixed)();
		} else {
			screenFixed.reset();
			(0,_header__WEBPACK_IMPORTED_MODULE_1__.headerFixed)();
		}
	});
}
const gnavPosition = () => {
	const headerHeight = _elements__WEBPACK_IMPORTED_MODULE_3__.uniqueEl.header.offsetHeight;
	//WordPressの管理バーが表示されている場合は高さを取得
	//表示されていない場合は0を代入
	const wpadminbarHeight = document.getElementById('wpadminbar') ? document.getElementById('wpadminbar').offsetHeight : 0 ;
	_elements__WEBPACK_IMPORTED_MODULE_3__.uniqueEl.gnav.style.paddingTop = `${headerHeight + wpadminbarHeight}px`;
}



/***/ }),

/***/ "./_src/js/modules/_header.js":
/*!************************************!*\
  !*** ./_src/js/modules/_header.js ***!
  \************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "headerFixed": () => (/* binding */ headerFixed)
/* harmony export */ });
/* harmony import */ var _elements__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./_elements */ "./_src/js/modules/_elements.js");


//ヘッダー固定
const headerFixed = () => {
	//WordPressの管理バーが表示されている場合は高さを取得
	//表示されていない場合は0を代入
	const wpadminbarHeight = document.getElementById('wpadminbar') ? document.getElementById('wpadminbar').offsetHeight : 0 ;

	let headerHeight = _elements__WEBPACK_IMPORTED_MODULE_0__.uniqueEl.header.offsetHeight;
	let scrollPosition = document.documentElement.scrollTop || document.body.scrollTop;

	if(!_elements__WEBPACK_IMPORTED_MODULE_0__.uniqueEl.gnav.classList.contains("is-opened")) {
		if( scrollPosition >= headerHeight) {
			_elements__WEBPACK_IMPORTED_MODULE_0__.uniqueEl.header.classList.add("is-scrolled");
			_elements__WEBPACK_IMPORTED_MODULE_0__.uniqueEl.header.style.top = wpadminbarHeight + "px";
			_elements__WEBPACK_IMPORTED_MODULE_0__.uniqueEl.wrapper.style.paddingTop = headerHeight + "px";
		} else {
			_elements__WEBPACK_IMPORTED_MODULE_0__.uniqueEl.header.classList.remove("is-scrolled");
			_elements__WEBPACK_IMPORTED_MODULE_0__.uniqueEl.header.style.top = null;
			_elements__WEBPACK_IMPORTED_MODULE_0__.uniqueEl.wrapper.style.paddingTop = null;
		}
	}
}



/***/ }),

/***/ "./_src/js/modules/_screen-fixed.js":
/*!******************************************!*\
  !*** ./_src/js/modules/_screen-fixed.js ***!
  \******************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "ScreenFixed": () => (/* binding */ ScreenFixed)
/* harmony export */ });
/* harmony import */ var _elements__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./_elements */ "./_src/js/modules/_elements.js");

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
		_elements__WEBPACK_IMPORTED_MODULE_0__.uniqueEl.wrapper.style.position = "fixed";
		_elements__WEBPACK_IMPORTED_MODULE_0__.uniqueEl.wrapper.style.width = "100%";
		_elements__WEBPACK_IMPORTED_MODULE_0__.uniqueEl.wrapper.style.zIndex = `1`;
		_elements__WEBPACK_IMPORTED_MODULE_0__.uniqueEl.wrapper.style.top = `-${this.scrollPosition - wpadminbarHeight}px`;
	}
	reset () {
		//スタイルシートを削除
		_elements__WEBPACK_IMPORTED_MODULE_0__.uniqueEl.wrapper.style.position = null;
		_elements__WEBPACK_IMPORTED_MODULE_0__.uniqueEl.wrapper.style.width = null;
		_elements__WEBPACK_IMPORTED_MODULE_0__.uniqueEl.wrapper.style.zIndex = null;
		_elements__WEBPACK_IMPORTED_MODULE_0__.uniqueEl.wrapper.style.top = null;
		//記憶したスクロール位置に移動
		document.scrollingElement.scrollTop = this.scrollPosition;
	}
}



/***/ }),

/***/ "./_src/js/modules/_search.js":
/*!************************************!*\
  !*** ./_src/js/modules/_search.js ***!
  \************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "searchToggle": () => (/* binding */ searchToggle),
/* harmony export */   "searchPosition": () => (/* binding */ searchPosition)
/* harmony export */ });
/* harmony import */ var _bg_layer__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./_bg-layer */ "./_src/js/modules/_bg-layer.js");
/* harmony import */ var _elements__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./_elements */ "./_src/js/modules/_elements.js");



const searchToggle = () => {
	if(document.querySelector(".l-bg-layer")) {
		document.querySelector(".l-bg-layer").parentNode.removeChild(document.querySelector(".l-bg-layer"));
	}
	_elements__WEBPACK_IMPORTED_MODULE_1__.uniqueEl.searchBtn.addEventListener("click", (e) => {
		let $isOpenElements = document.querySelectorAll("is-opened");
		$isOpenElements.forEach((isOpenElement)=>{
			isOpenElement.classList.remove("is-opened");
		});
		(0,_bg_layer__WEBPACK_IMPORTED_MODULE_0__.bgLayer)(e.currentTarget);
		if(_elements__WEBPACK_IMPORTED_MODULE_1__.uniqueEl.gnavBtn.textContent === "close"){ _elements__WEBPACK_IMPORTED_MODULE_1__.uniqueEl.gnavBtn.textContent = "menu";};
		e.currentTarget.textContent = e.currentTarget.textContent === "close" ? "search" : "close";
		e.currentTarget.classList.toggle("is-opened");
		_elements__WEBPACK_IMPORTED_MODULE_1__.uniqueEl.searchForm.classList.toggle("is-opened");
	});
}

/**
 * 検索フォームの位置
 */
const searchPosition = () => {
	//WordPressの管理バーが表示されている場合は高さを取得
	//表示されていない場合は0を代入
	const wpadminbarHeight = document.getElementById('wpadminbar') ? document.getElementById('wpadminbar').offsetHeight : 0 ;
	const headerHeight = _elements__WEBPACK_IMPORTED_MODULE_1__.uniqueEl.header.offsetHeight;
	_elements__WEBPACK_IMPORTED_MODULE_1__.uniqueEl.searchForm.style.top = `${ headerHeight } + ${ wpadminbarHeight }px`;
}



/***/ }),

/***/ "./_src/js/modules/_wp-embed.js":
/*!**************************************!*\
  !*** ./_src/js/modules/_wp-embed.js ***!
  \**************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "wpEmbedVideo": () => (/* binding */ wpEmbedVideo)
/* harmony export */ });
/**
 * 埋め込み動画のサイズに応じて
 * 自動的に高さを変える処理
 */
const wpEmbedVideo = () => {
	const $embedVideos = document.querySelectorAll(".is-type-video iframe");
	$embedVideos.forEach(($embedVideo)=>{
		let embedWidth =  $embedVideo.clientWidth;
		let embedAttrWidth =  $embedVideo.getAttribute('width');
		let embedAttrHeight =  $embedVideo.getAttribute('height');
		$embedVideo.style.height = embedWidth / embedAttrWidth * embedAttrHeight + "px";
	});
}



/***/ }),

/***/ "./_src/js/modules/_wp-query.js":
/*!**************************************!*\
  !*** ./_src/js/modules/_wp-query.js ***!
  \**************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "wpQueryThumnail": () => (/* binding */ wpQueryThumnail)
/* harmony export */ });
/**
 *
 * サムネイル画像付きのクエリループブロックを設置した際に、
 * アイキャッチ画像が設定していない記事については変わりの画像を表示するためのスクリプト
 */
const wpQueryThumnail = () => {
	const $queryThumbnails = document.querySelectorAll(".wp-block-column.is-thumbnail");
	if( $queryThumbnails ) {
		$queryThumbnails.forEach( ( $queryThumbnail) => {
			if( !$queryThumbnail.hasChildNodes() ) {
				$queryThumbnail.innerHTML = `<div class="is-noimage"><span class="material-icons-outlined">image</span></div>`
			}
		});
	}
}



/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be isolated against other modules in the chunk.
(() => {
/*!*************************!*\
  !*** ./_src/js/main.js ***!
  \*************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _modules_gnav__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./modules/_gnav */ "./_src/js/modules/_gnav.js");
/* harmony import */ var _modules_search__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./modules/_search */ "./_src/js/modules/_search.js");
/* harmony import */ var _modules_header__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./modules/_header */ "./_src/js/modules/_header.js");
/* harmony import */ var _modules_animations__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./modules/_animations */ "./_src/js/modules/_animations.js");
/* harmony import */ var _modules_wp_embed__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./modules/_wp-embed */ "./_src/js/modules/_wp-embed.js");
/* harmony import */ var _modules_wp_query__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./modules/_wp-query */ "./_src/js/modules/_wp-query.js");







/**
 * 関数の発火処理
 */
//最初の HTML 文書の読み込みと解析が完了したとき、スタイルシート、画像、サブフレームの読み込みが完了するのを待たずに発火
window.addEventListener('DOMContentLoaded', () => {
    (0,_modules_gnav__WEBPACK_IMPORTED_MODULE_0__.gnavPosition)();
    (0,_modules_search__WEBPACK_IMPORTED_MODULE_1__.searchPosition)();
    (0,_modules_gnav__WEBPACK_IMPORTED_MODULE_0__.gnavToggle)();
    (0,_modules_search__WEBPACK_IMPORTED_MODULE_1__.searchToggle)();
    (0,_modules_header__WEBPACK_IMPORTED_MODULE_2__.headerFixed)();
    (0,_modules_wp_embed__WEBPACK_IMPORTED_MODULE_4__.wpEmbedVideo)();
	(0,_modules_wp_query__WEBPACK_IMPORTED_MODULE_5__.wpQueryThumnail)();
	const $targets = document.querySelectorAll('.is-target');
	_modules_animations__WEBPACK_IMPORTED_MODULE_3__.animations.observeIgnition($targets);
});


//画面をリサイズしたときに発火
let queue = null,
    wait = 100;
window.addEventListener( 'resize', () => {
    clearTimeout( queue );
    queue = setTimeout(() => {
        (0,_modules_gnav__WEBPACK_IMPORTED_MODULE_0__.gnavPosition)();
        (0,_modules_search__WEBPACK_IMPORTED_MODULE_1__.searchPosition)();
        (0,_modules_wp_embed__WEBPACK_IMPORTED_MODULE_4__.wpEmbedVideo)();
    }, wait);
},false);

//画面をスクロール時に実行
window.addEventListener( 'scroll' , () => {
    (0,_modules_header__WEBPACK_IMPORTED_MODULE_2__.headerFixed)();
});


})();

/******/ })()
;
//# sourceMappingURL=main.js.map