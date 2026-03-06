import SplitType from 'split-type';
import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

const TextAnimations = () => {
    if (typeof window === 'undefined') return;

    const headings = document.querySelectorAll('h1, h2, h3');
    if (!headings.length) return;

    gsap.registerPlugin(ScrollTrigger);

    headings.forEach((heading) => {
        if (!heading.textContent || !heading.textContent.trim()) return;

        const offsetTop = heading.dataset.offsetTop || 80;

        // Opt-out: disattiva l'animazione se il titolo
        // o un suo genitore ha la classe js-text-anim-off
        if (
            heading.classList.contains('js-text-anim-off') ||
            heading.closest('.js-text-anim-off')
        ) {
            return;
        }

        if (heading.dataset.textAnimated === 'true') return;

        heading.dataset.textAnimated = 'true';

        const split = new SplitType(heading, {
            types: 'lines, words',
            tagName: 'span',
            lineClass: 'js-text-line',
            wordClass: 'js-text-word',
        });

        if (!split.lines || !split.lines.length) return;

        const lineInners = [];

        split.lines.forEach((line) => {
            const inner = document.createElement('span');
            inner.classList.add('js-text-line-inner');
            inner.style.display = 'inline-block';

            while (line.firstChild) {
                inner.appendChild(line.firstChild);
            }

            line.appendChild(inner);
            line.style.overflow = 'hidden';
            line.style.display = 'block';

            lineInners.push(inner);
        });

        gsap.from(lineInners, {
            yPercent: 100,
            opacity: 0,
            duration: 0.7,
            ease: 'power3.out',
            stagger: 0.18,
            scrollTrigger: {
                trigger: heading,
                start: 'top '+offsetTop+'%',
                end: 'bottom 20%',
                toggleActions: 'play none none none',
                once: true,
            },
        });
    });
};

export default TextAnimations;

