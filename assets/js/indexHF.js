/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you require will output into a single css file (app.css in this case)
require('../scss/indexHF.scss');

// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
const $ = require('jquery');
// this "modifies" the jquery module: adding behavior to it
// the bootstrap module doesn't export/return anything
require('bootstrap');


$(document).ready(function () {
    $('[data-toggle="popover"]').popover();
});

console.log('Hello Webpack Encore! Edit me in assets/js/app.js');


function scrollAppear1()
{
    let block1 = document.querySelector(".blocktext-1");
    let block2 = document.querySelector(".blocktext-2");
    let block3 = document.querySelector(".blocktext-3");

    let PositionBlock1 = block1.getBoundingClientRect().top;
    let PositionBlock2 = block2.getBoundingClientRect().top;
    let PositionBlock3 = block3.getBoundingClientRect().top;

    let screenPosition = window.innerHeight / 1.55;

    if (PositionBlock1 < screenPosition) {
        block1.classList.add("appear");
    }
    if (PositionBlock2 < screenPosition) {
        block2.classList.add("appear");
    }
    if (PositionBlock3 < screenPosition) {
        block3.classList.add("appear");
    }
}

window.addEventListener("scroll", scrollAppear1);

