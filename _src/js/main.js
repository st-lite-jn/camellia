import {gnavToggle , gnavPosition} from "./modules/_gnav";
import {searchToggle , searchPosition} from "./modules/_search";
import {headerFixed} from "./modules/_header";
import {animations} from "./modules/_animations";
import {wpEmbedVideo} from "./modules/_wp-embed";
import {wpQueryThumnail} from "./modules/_wp-query";

/**
 * 関数の発火処理
 */
//最初の HTML 文書の読み込みと解析が完了したとき、スタイルシート、画像、サブフレームの読み込みが完了するのを待たずに発火
window.addEventListener('DOMContentLoaded', () => {
    gnavPosition();
    searchPosition();
    gnavToggle();
    searchToggle();
    headerFixed();
    wpEmbedVideo();
	wpQueryThumnail();
	const $targets = document.querySelectorAll('.is-target');
	animations.observeIgnition($targets);
});


//画面をリサイズしたときに発火
let queue = null,
    wait = 100;
window.addEventListener( 'resize', () => {
    clearTimeout( queue );
    queue = setTimeout(() => {
        gnavPosition();
        searchPosition();
        wpEmbedVideo();
    }, wait);
},false);

//画面をスクロール時に実行
window.addEventListener( 'scroll' , () => {
    headerFixed();
});

