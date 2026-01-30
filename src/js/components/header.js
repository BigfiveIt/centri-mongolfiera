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
    
    // Chiudi il menu quando si clicca su un link del menu
    const menuLinks = menu.querySelectorAll('a');
    menuLinks.forEach(link => {
        link.addEventListener('click', () => {
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
        if (window.matchMedia('(min-width: 1280px)').matches && isMenuOpen()) {
            closeMenu();
        }
    };
    
    window.addEventListener('resize', handleResize);
    
    // Inizializza aria-expanded
    menuTrigger.setAttribute('aria-expanded', 'false');
    menuTrigger.setAttribute('aria-controls', 'site-header-menu');
    menu.setAttribute('id', 'site-header-menu');
}


const Header = () => {
    if(document.querySelector('.site-header__menu-trigger')){
        toggleMenu();
    }
}

export default Header;