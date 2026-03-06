import AOS from 'aos';

const setupGridDelays = (gridSelector) => {
    const grids = document.querySelectorAll(gridSelector);
    if (!grids.length) return;

    grids.forEach((grid) => {
        const effect = grid.getAttribute('data-aos-children-effect') || 'fade-up';
        const items = Array.from(grid.children);
        if (!items.length) return;

        const applyDelays = () => {
            const style = window.getComputedStyle(grid);
            const templateColumns = style.gridTemplateColumns;
            const cols = templateColumns ? templateColumns.split(' ').length : 1;

            items.forEach((item, index) => {
                item.setAttribute('data-aos', effect);
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

    setupGridDelays('.taxonomy-negozi-grid');
    setupGridDelays('.animate-grid');

    // Doppio rAF: il browser dipinge un frame con gli elementi nello stato "nascosto"
    // (data-aos applicato via CSS), poi AOS li riscansiona e aggiunge aos-animate,
    // facendo partire la transizione CSS anche per elementi già in viewport.
    requestAnimationFrame(() => {
        requestAnimationFrame(() => {
            AOS.refreshHard();
        });
    });
};

export default GridAnimations;
