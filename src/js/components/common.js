const scrollToSection = (event, target) => {  
    
    let dest;
    if(target){
        const headerHeight = document.querySelector('.site-header').offsetHeight;
        const targetEl = document.querySelector(target);
        const targetPosition = targetEl.offsetTop; 
        dest = targetPosition - headerHeight;
    } else {
        const currentSection = event.target.closest('section');
        let sectionHeight = currentSection.offsetHeight;
        dest = sectionHeight;
    }

    window.scrollTo({
        top: dest,
        behavior: 'smooth'
    });

}

// Calcola la larghezza della scrollbar e la imposta come variabile CSS
const calculateScrollbarWidth = () => {
    // Crea un elemento temporaneo per misurare la scrollbar
    const outer = document.createElement('div');
    outer.style.visibility = 'hidden';
    outer.style.overflow = 'scroll';
    outer.style.msOverflowStyle = 'scrollbar'; // necessario per IE
    document.body.appendChild(outer);
    
    // Crea un elemento interno
    const inner = document.createElement('div');
    outer.appendChild(inner);
    
    // Calcola la differenza tra le larghezze
    const scrollbarWidth = outer.offsetWidth - inner.offsetWidth;
    
    // Rimuovi l'elemento temporaneo
    outer.parentNode.removeChild(outer);
    
    // Imposta la variabile CSS
    document.documentElement.style.setProperty('--scrollbar-width', `${scrollbarWidth}px`);
    
    return scrollbarWidth;
};

const Common = () => {
    // Calcola e imposta la larghezza della scrollbar
    calculateScrollbarWidth();
    
    // Ricalcola su resize per gestire cambiamenti dinamici
    let resizeTimer;
    window.addEventListener('resize', () => {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(() => {
            calculateScrollbarWidth();
        }, 100);
    });
    
    if(document.querySelector('[data-scrollto]')){

        const scrollBtns = document.querySelectorAll('[data-scrollto]');

        scrollBtns.forEach(scrollBtn => {
            const target = scrollBtn.getAttribute('data-scrollto') ? scrollBtn.getAttribute('data-scrollto') : null;
            scrollBtn.addEventListener("click", (event) => {
                scrollToSection(event, target);
            });
        });
        
   
    }

    // Gestione select custom per filtri categorie su mobile
    const taxonomySelects = document.querySelectorAll('.custom-taxonomy-select[data-taxonomy-filter]');
    
    taxonomySelects.forEach(selectContainer => {
        const button = selectContainer.querySelector('.custom-taxonomy-select__button');
        const dropdown = selectContainer.querySelector('.custom-taxonomy-select__dropdown');
        const options = selectContainer.querySelectorAll('.custom-taxonomy-select__option');
        const selectedText = selectContainer.querySelector('.custom-taxonomy-select__selected-text');
        const archiveUrl = selectContainer.getAttribute('data-archive-url');
        
        if (!button || !dropdown || !selectedText) return;
        
        // Funzione per aggiornare lo stile del bottone in base alla selezione
        function updateButtonStyle(selectedOption) {
            const isArchive = selectedOption && selectedOption.getAttribute('data-value') === archiveUrl;
            
            if (isArchive) {
                button.classList.remove('bg-primary-400', 'text-white');
                button.classList.add('bg-gray-200');
            } else {
                button.classList.add('bg-primary-400', 'text-white');
                button.classList.remove('bg-gray-200');
            }
        }
        
        // Toggle dropdown
        button.addEventListener('click', function(e) {
            e.stopPropagation();
            const isOpen = selectContainer.classList.contains('is-open');
            
            // Chiudi tutti gli altri dropdown
            taxonomySelects.forEach(otherSelect => {
                if (otherSelect !== selectContainer) {
                    otherSelect.classList.remove('is-open');
                    otherSelect.querySelector('.custom-taxonomy-select__dropdown')?.classList.add('hidden');
                }
            });
            
            // Toggle questo dropdown
            if (isOpen) {
                selectContainer.classList.remove('is-open');
                dropdown.classList.add('hidden');
                button.setAttribute('aria-expanded', 'false');
            } else {
                selectContainer.classList.add('is-open');
                dropdown.classList.remove('hidden');
                button.setAttribute('aria-expanded', 'true');
            }
        });
        
        // Gestione click sulle opzioni
        options.forEach(option => {
            option.addEventListener('click', function(e) {
                e.preventDefault();
                const url = this.getAttribute('data-value');
                const text = this.textContent.trim();
                
                // Aggiorna testo e stile del bottone
                selectedText.textContent = text;
                updateButtonStyle(this);
                
                // Rimuovi evidenziazione da tutte le opzioni
                options.forEach(opt => {
                    opt.classList.remove('bg-primary-400', 'text-white');
                    opt.classList.add('text-gray-700');
                });
                
                // Evidenzia l'opzione selezionata
                this.classList.add('bg-primary-400', 'text-white');
                this.classList.remove('text-gray-700');
                
                // Chiudi dropdown
                selectContainer.classList.remove('is-open');
                dropdown.classList.add('hidden');
                button.setAttribute('aria-expanded', 'false');
                
                // Naviga alla pagina selezionata
                if (url) {
                    window.location.href = url;
                }
            });
        });
        
        // Chiudi dropdown quando si clicca fuori
        document.addEventListener('click', function(e) {
            if (!selectContainer.contains(e.target)) {
                selectContainer.classList.remove('is-open');
                dropdown.classList.add('hidden');
                button.setAttribute('aria-expanded', 'false');
            }
        });
        
        // Aggiorna stile iniziale del bottone
        const activeOption = selectContainer.querySelector('.custom-taxonomy-select__option.bg-primary-400');
        if (activeOption) {
            updateButtonStyle(activeOption);
        }
    });

}

export default Common;