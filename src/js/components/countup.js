import { CountUp } from 'countup.js';

/**
 * Inizializza CountUp su tutti gli elementi .number-count.
 * Usa enableScrollSpy per avviare l'animazione quando l'elemento entra in viewport.
 */
const CountUpInit = () => {
    const elements = document.querySelectorAll('.number-count');
    if (!elements.length) return;

    elements.forEach((el) => {
        const endVal = parseEndVal(el);
        if (endVal === null) return;

        new CountUp(el, endVal, {
            duration: 2,
            useGrouping: true,
            separator: '.',
            decimal: ',',
            enableScrollSpy: true,
            scrollSpyOnce: true,
        });
        // Con enableScrollSpy l'IntersectionObserver è configurato nel costruttore, nessuna chiamata aggiuntiva necessaria
    });
};

/**
 * Legge il valore finale da data-end o dal testo dell'elemento.
 * Gestisce formato italiano (1.500 = 1500).
 */
function parseEndVal(el) {
    const raw = el.getAttribute('data-end') || el.textContent.trim();
    if (!raw) return null;
    const normalized = raw.replace(/\./g, '').replace(',', '.');
    const val = parseFloat(normalized);
    return isNaN(val) ? null : val;
}

export default CountUpInit;
