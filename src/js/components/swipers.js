import Swiper from 'swiper';
import { Navigation, Pagination, Autoplay } from 'swiper/modules';

const Swipers = () => {
	if(document.querySelector('.hero-slider')){
		const heroNextBtns = document.querySelectorAll('.hero-slider-navigation .swiper-button-next');
		const heroPrevBtns = document.querySelectorAll('.hero-slider-navigation .swiper-button-prev');

		const heroSlider = new Swiper('.hero-slider', {
			modules: [Navigation, Pagination],
			spaceBetween: 35,
			freeMode: false,
			slidesPerView: "auto",
			watchSlidesProgress : true,
			pagination: {
				el: '.hero-slider .swiper-pagination',
				type: 'bullets',
				clickable: true
			},
			navigation: {
				nextEl: Array.from(heroNextBtns),
				prevEl: Array.from(heroPrevBtns),
			},
			/* Nascondi paginazione e navigazione se ho 1 bullet solo */
			on: {
				init: function(e){
					const bulletNumber = document.querySelectorAll('.hero-slider  .swiper-pagination-bullet');
					/* Hide pagination and navigation */
					if(bulletNumber.length == 1){
						document.querySelector('.hero-slider .swiper-pagination')?.classList.add('hidden');
						document.querySelectorAll('.hero-slider-navigation').forEach(el => el.classList.add('hidden'));
					}
				}
			}
		});
	}
	if(document.querySelector('.brand-carousel')){

		/* carosello brand, 6 slide su desktop e poi a scalare, 2 su mobile */
		new Swiper('.brand-carousel', {
			modules: [Navigation, Pagination, Autoplay],
			spaceBetween: 35,
			freeMode: false,
			slidesPerView: 2,
			watchSlidesProgress : true,
			autoplay: {
				delay: 3000,
				disableOnInteraction: false,
				pauseOnMouseEnter: true
			},
			breakpoints: {
				768: {
					slidesPerView: 4
				},
				1024: {
					slidesPerView: 6
				}
			}
		});
	}
	if(document.querySelector('.divertimento-carousel')){
		new Swiper('.divertimento-carousel', {
			modules: [Navigation, Autoplay],
			spaceBetween: 35,
			freeMode: false,
			slidesPerView: 1.2,
			navigation: {
				nextEl: '.divertimento-carousel .swiper-button-next',
				prevEl: '.divertimento-carousel .swiper-button-prev',
			},
			breakpoints: {
				768: {
					slidesPerView: 2
				},
				1280: {
					slidesPerView: 3
				}
			}
		});
	}
	if(document.querySelector('.news-carousel')){
		new Swiper('.news-carousel', {
			modules: [Pagination],
			spaceBetween: 24,
			freeMode: false,
			slidesPerView: 1,
			pagination: {
				el: '.news-carousel .swiper-pagination',
				type: 'bullets',
				clickable: true
			},
			breakpoints: {
				768: {
					slidesPerView: 2,
					spaceBetween: 24
				},
				1024: {
					slidesPerView: 3,
					spaceBetween: 24
				}
			},
			on: {
				init: function(e){
					const bulletNumber = document.querySelectorAll('.news-carousel .swiper-pagination-bullet');
					// Nascondi paginazione se ci sono 3 o meno bullet
					if(bulletNumber.length <= 3){
						document.querySelector('.news-carousel .swiper-pagination').classList.add('hidden');
					}
				}
			}
		});
	}
	if(document.querySelector('.negozio-gallery__carousel')){
		new Swiper('.negozio-gallery__carousel', {
			modules: [ Pagination],
			spaceBetween: 24,
			freeMode: false,
			slidesPerView: 1,
			pagination: {
				el: '.negozio-gallery__carousel .swiper-pagination',
				type: 'bullets',
				clickable: true
			},
			on: {
				init: function(e){
					const bulletNumber = document.querySelectorAll('.negozio-gallery__carousel .swiper-pagination-bullet');
					/* Hide pagination */
					if(bulletNumber.length == 1){
						document.querySelector('.negozio-gallery__carousel .swiper-pagination').classList.add('hidden');
					}
				}
			}
		});
	}
	if(document.querySelector('.related-negozi__carousel')){
		new Swiper('.related-negozi__carousel', {
			modules: [Pagination],
			spaceBetween: 24,
			freeMode: false,
			slidesPerView: 2,
			breakpoints: {
				768: {
					slidesPerView: 3
				},
				1024: {
					slidesPerView: 5
				}
			},
			pagination: {
				el: '.related-negozi__carousel .swiper-pagination',
				type: 'bullets',
				clickable: true
			},
			on: {
				init: function(e){
					const bulletNumber = document.querySelectorAll('.related-negozi__carousel .swiper-pagination-bullet');
					/* Hide pagination */
					if(bulletNumber.length == 1){
						document.querySelector('.related-negozi__carousel .swiper-pagination').classList.add('hidden');
					}
				}
			}
		});
	}
	if(document.querySelector('.altre-promozioni__carousel')){
		new Swiper('.altre-promozioni__carousel', {
			modules: [Pagination],
			spaceBetween: 24,
			freeMode: false,
			slidesPerView: 1.2,
			breakpoints: {
				768: {
					slidesPerView: 2.2
				},
				1024: {
					slidesPerView: 3
				}
			},
			pagination: {
				el: '.altre-promozioni__carousel .swiper-pagination',
				type: 'bullets',
				clickable: true
			},
			on: {
				init: function(e){
					const bulletNumber = document.querySelectorAll('.altre-promozioni__carousel .swiper-pagination-bullet');
					if(bulletNumber.length == 1){
						document.querySelector('.altre-promozioni__carousel .swiper-pagination').classList.add('hidden');
					}
				}
			}
		});
	}
	if(document.querySelector('.altre-eventi__carousel')){
		new Swiper('.altre-eventi__carousel', {
			modules: [Pagination],
			spaceBetween: 24,
			freeMode: false,
			slidesPerView: 1.2,
			breakpoints: {
				768: {
					slidesPerView: 2.2
				},
				1024: {
					slidesPerView: 3
				}
			},
			pagination: {
				el: '.altre-eventi__carousel .swiper-pagination',
				type: 'bullets',
				clickable: true
			},
			on: {
				init: function(e){
					const bulletNumber = document.querySelectorAll('.altre-eventi__carousel .swiper-pagination-bullet');
					if(bulletNumber.length == 1){
						document.querySelector('.altre-eventi__carousel .swiper-pagination').classList.add('hidden');
					}
				}
			}
		});
	}
}

export default Swipers;

