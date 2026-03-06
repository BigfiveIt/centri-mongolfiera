import Header from "./components/header";
import Common from "./components/common";
import CountUpInit from "./components/countup.js";
import Marquee from "./components/marquee.js";
import 'fslightbox';
import AOS from 'aos';
import Swipers from "./components/swipers.js";
import Rellax from 'rellax';
import TextAnimations from "./components/text-animations.js";
import GridAnimations from "./components/grid-animations.js";

GridAnimations();

document.addEventListener("DOMContentLoaded", function() {
    Header();
    Common();
    CountUpInit();
    Marquee();
    TextAnimations();
    if (document.querySelector('.rellax')) {
        new Rellax('.rellax');
    }
    AOS.init();
    
    Swipers();
});