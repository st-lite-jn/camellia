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
export {bgLayer};
