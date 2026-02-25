/**
 * Marquee: scritta scorrevole continua gestita in JS.
 * Duplica il contenuto e anima con requestAnimationFrame per un loop infinito fluido senza salti.
 */
const Marquee = () => {
	const wrap = document.querySelector('.centro-marquee .marquee-inner');
	if (!wrap) return;

	const children = Array.from(wrap.children);
	if (children.length === 0) return;

	// Duplica il contenuto per avere 2 copie identiche → loop seamless
	const desiredCopies = 2;
	let currentCopies = wrap.children.length / children.length;
	if (currentCopies < desiredCopies) {
		const toAdd = (desiredCopies - currentCopies) * children.length;
		for (let i = 0; i < toAdd; i++) {
			const clone = children[i % children.length].cloneNode(true);
			clone.setAttribute('aria-hidden', 'true');
			wrap.appendChild(clone);
		}
	}

	const loopWidth = wrap.scrollWidth / 2;
	const speedPxPerSec = 60;
	let position = 0;
	let lastTime = null;

	const tick = (now) => {
		if (lastTime == null) lastTime = now;
		const delta = (now - lastTime) / 1000;
		lastTime = now;
		position += speedPxPerSec * delta;
		if (position >= loopWidth) position -= loopWidth;
		wrap.style.transform = `translate3d(${-position}px, 0, 0)`;
		requestAnimationFrame(tick);
	};
	requestAnimationFrame(tick);
};

export default Marquee;
