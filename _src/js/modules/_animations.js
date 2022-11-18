
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
export {animations};
