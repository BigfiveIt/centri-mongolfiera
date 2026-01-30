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

const Common = () => {
    if(document.querySelector('[data-scrollto]')){

        const scrollBtns = document.querySelectorAll('[data-scrollto]');

        scrollBtns.forEach(scrollBtn => {
            const target = scrollBtn.getAttribute('data-scrollto') ? scrollBtn.getAttribute('data-scrollto') : null;
            scrollBtn.addEventListener("click", (event) => {
                scrollToSection(event, target);
            });
        });
        
   
    }

}

export default Common;