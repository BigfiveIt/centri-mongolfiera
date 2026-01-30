import Header from "./components/header";
import Common from "./components/common";
import CountUpInit from "./components/countup.js";
import 'fslightbox';
import AOS from 'aos';
import Swipers from "./components/swipers.js";
import Rellax from 'rellax';


document.addEventListener("DOMContentLoaded", function() {
    Header();
    Common();
    CountUpInit();
    if(document.querySelector('.rellax')) {
        new Rellax('.rellax');
    }
});

AOS.init();
Swipers();