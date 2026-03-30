const toggleMenu = () => {
    const menuTrigger = document.querySelector('.site-header__menu-trigger');
    const menu = document.querySelector('.site-header__menu');
    const body = document.body;
    
    if (!menuTrigger || !menu) return;
    
    // Funzione per aprire il menu
    const openMenu = () => {
        menuTrigger.classList.add('active');
        menu.classList.add('active');
        body.classList.add('menu-open');
        menuTrigger.setAttribute('aria-expanded', 'true');
    };
    
    // Funzione per chiudere il menu
    const closeMenu = () => {
        menuTrigger.classList.remove('active');
        menu.classList.remove('active');
        body.classList.remove('menu-open');
        menuTrigger.setAttribute('aria-expanded', 'false');
    };
    
    // Funzione per verificare se il menu è aperto
    const isMenuOpen = () => {
        return menu.classList.contains('active');
    };
    
    // Event listener sul trigger
    menuTrigger.addEventListener('click', (e) => {
        e.preventDefault();
        e.stopPropagation();
        
        if (isMenuOpen()) {
            closeMenu();
        } else {
            openMenu();
        }
    });
    
    // Chiudi il menu quando si clicca su un link del menu (ma non sul chevron)
    const menuLinks = menu.querySelectorAll('a');
    menuLinks.forEach(link => {
        link.addEventListener('click', (e) => {
            // Non chiudere se si clicca sul chevron
            if (e.target.closest('.menu-item__chevron')) {
                return;
            }
            closeMenu();
        });
    });
    
    // Chiudi il menu quando si clicca fuori dal menu (opzionale)
    document.addEventListener('click', (e) => {
        if (isMenuOpen() && 
            !menu.contains(e.target) && 
            !menuTrigger.contains(e.target)) {
            closeMenu();
        }
    });
    
    // Chiudi il menu con ESC
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && isMenuOpen()) {
            closeMenu();
        }
    });
    
    // Gestione resize: chiudi il menu se si passa a desktop
    const handleResize = () => {
        if (window.matchMedia('(min-width: 96rem)').matches && isMenuOpen()) {
            closeMenu();
        }
    };
    
    window.addEventListener('resize', handleResize);
    
    // Inizializza aria-expanded
    menuTrigger.setAttribute('aria-expanded', 'false');
    menuTrigger.setAttribute('aria-controls', 'site-header-menu');
    menu.setAttribute('id', 'site-header-menu');
}

const initHeaderScrolledClass = () => {
    const header = document.querySelector('.site-header');
    if (!header) return;

    const threshold = 10;
    let ticking = false;

    const update = () => {
        const shouldBeScrolled = window.scrollY > threshold;
        header.classList.toggle('scrolled', shouldBeScrolled);
        ticking = false;
    };

    const onScroll = () => {
        if (ticking) return;
        ticking = true;
        window.requestAnimationFrame(update);
    };

    update();
    window.addEventListener('scroll', onScroll, { passive: true });
};


// Gestione accordion per menu mobile
const initMobileMenuAccordion = () => {
    const menuItems = document.querySelectorAll('.site-header__menu > ul > .menu-item');
    
    menuItems.forEach(menuItem => {
        const link = menuItem.querySelector(':scope > a');
        const subMenu = menuItem.querySelector(':scope > .sub-menu');
        
        if (!link) return;
        
        // Se ha sottomenu, crea un elemento chevron cliccabile
        if (subMenu) {
            // Crea il bottone chevron
            const chevronBtn = document.createElement('button');
            chevronBtn.className = 'menu-item__chevron';
            chevronBtn.setAttribute('aria-expanded', 'false');
            chevronBtn.setAttribute('aria-label', 'Espandi sottomenu');
            chevronBtn.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" width="1200pt" height="1200pt" version="1.1" viewBox="0 0 1200 1200">
                <path d="m30 375.6c0-31.199 12-61.199 34.801-85.199 46.801-46.801 123.6-46.801 170.4 0l364.8 363.6 364.8-364.8c46.801-46.801 123.6-46.801 170.4 0 46.801 46.801 46.801 123.6 0 170.4l-450 450c-22.801 22.801-52.801 34.801-85.199 34.801s-62.398-13.199-85.199-34.801l-450-448.8c-22.801-24-34.801-55.199-34.801-85.199z" fill="#F2C614"/>
            </svg>`;
            
            // Inserisci il chevron dopo il link
            link.appendChild(chevronBtn);
            
            // Gestisci il click sul chevron (solo su mobile)
            chevronBtn.addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation();
                
                if (!window.matchMedia('(max-width: calc(96rem - 1px))').matches) return;
                
                const isExpanded = menuItem.classList.contains('is-expanded');
                
                // Chiudi tutti gli altri menu aperti
                menuItems.forEach(otherItem => {
                    if (otherItem !== menuItem) {
                        otherItem.classList.remove('is-expanded');
                        const otherSubMenu = otherItem.querySelector(':scope > .sub-menu');
                        const otherChevron = otherItem.querySelector('.menu-item__chevron');
                        if (otherSubMenu) {
                            otherSubMenu.classList.remove('is-expanded');
                        }
                        if (otherChevron) {
                            otherChevron.setAttribute('aria-expanded', 'false');
                        }
                    }
                });
                
                // Toggle questo menu
                if (isExpanded) {
                    menuItem.classList.remove('is-expanded');
                    subMenu.classList.remove('is-expanded');
                    chevronBtn.setAttribute('aria-expanded', 'false');
                } else {
                    menuItem.classList.add('is-expanded');
                    subMenu.classList.add('is-expanded');
                    chevronBtn.setAttribute('aria-expanded', 'true');
                }
            });
        } else {
            // Se non ha sottomenu, aggiungi l'icona freccia
            const arrowIcon = document.createElement('span');
            arrowIcon.className = 'menu-item__arrow';
            arrowIcon.innerHTML = `<svg width="42" height="42" viewBox="0 0 42 42" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M27.4872 34.4853L39.7373 22.2353C40.0653 21.9071 40.2496 21.4621 40.2496 20.998C40.2496 20.534 40.0653 20.089 39.7373 19.7608L27.4872 7.51078C27.1572 7.192 26.7151 7.01561 26.2563 7.0196C25.7975 7.02358 25.3585 7.20763 25.0341 7.53209C24.7096 7.85656 24.5256 8.29548 24.5216 8.75433C24.5176 9.21317 24.694 9.65522 25.0128 9.98528L34.2755 19.248H3.5C3.03587 19.248 2.59075 19.4324 2.26256 19.7606C1.93437 20.0888 1.75 20.5339 1.75 20.998C1.75 21.4622 1.93437 21.9073 2.26256 22.2355C2.59075 22.5637 3.03587 22.748 3.5 22.748H34.2755L25.0128 32.0108C24.694 32.3408 24.5176 32.7829 24.5216 33.2417C24.5256 33.7006 24.7096 34.1395 25.0341 34.464C25.3585 34.7884 25.7975 34.9725 26.2563 34.9765C26.7151 34.9804 27.1572 34.8041 27.4872 34.4853Z" fill="#2B463A"/>
            </svg>`;
            link.appendChild(arrowIcon);
        }
    });
};

const Header = () => {
    initHeaderScrolledClass();

    if(document.querySelector('.site-header__menu-trigger')){
        toggleMenu();
        initMobileMenuAccordion();
    }
}

export default Header;