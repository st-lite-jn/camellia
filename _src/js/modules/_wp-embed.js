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
export {wpEmbedVideo};
