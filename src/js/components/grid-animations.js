const setupGridDelays = (gridSelector) => {
    const grids = document.querySelectorAll(gridSelector);
    if (!grids.length) return;

    grids.forEach((grid) => {
        const items = grid.querySelectorAll('[data-aos="fade-up"]');
        if (!items.length) return;

        const applyDelays = () => {
            const style = window.getComputedStyle(grid);
            const templateColumns = style.gridTemplateColumns;
            const cols = templateColumns ? templateColumns.split(' ').length : 1;

            items.forEach((item, index) => {
                const colIndex = cols > 0 ? index % cols : index;
                const delay = colIndex * 100;
                item.setAttribute('data-aos-delay', String(delay));
            });
        };

        applyDelays();

        let resizeTimer;
        window.addEventListener('resize', () => {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(applyDelays, 150);
        });
    });
};

const GridAnimations = () => {
    if (typeof window === 'undefined') return;

    // Griglia negozi (taxonomy)
    setupGridDelays('.taxonomy-negozi-grid');

    // Griglie generiche con classe animate-grid (es. fascia servizi, promozioni, ecc.)
    setupGridDelays('.animate-grid');
};

export default GridAnimations;

