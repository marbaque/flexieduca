/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


//var menu = document.getElementById('primary-menu');
//var head = document.getElementById('masthead');
//
//var menuPosition = head.getBoundingClientRect().bottom;
//window.addEventListener('scroll', function() {
//    if (window.pageYOffset >= menuPosition) {
//        menu.style.position = 'fixed';
//        menu.style.top = '0px';
//    } else {
//        menu.style.position = 'absolute';
//        menu.style.top = '80px';
//    }
//});

var menu = document.getElementById('primary-menu');
var head = document.getElementById('site-navigation');

var menuPosition = head.getBoundingClientRect();

var placeholder = document.createElement('div');
placeholder.style.width = menuPosition.width + 'px';
placeholder.style.height = menuPosition.height + 'px';
var isAdded = false;

window.addEventListener('scroll', function() {
    if (window.pageYOffset >= menuPosition.bottom && !isAdded) {
        menu.classList.add('fixed');
        menu.parentNode.insertBefore(placeholder, menu);
        isAdded = true;
    } else if (window.pageYOffset < menuPosition.bottom && isAdded) {
        menu.classList.remove('fixed');
        menu.parentNode.removeChild(placeholder);
        isAdded = false;
    }
});


jQuery(function($) {
    $('.accordion').on('click', '.accordion-control', function(e){ // When clicked
    e.preventDefault();                    // Prevent default action of button
    $(this)                                // Get the element the user clicked on
      .next('.accordion-panel')            // Select following panel 
      .not(':animated')                    // If it is not currently animating
      .slideToggle();                      // Use slide toggle to show or hide it
  }); 
});

jQuery(document).ready(function () {
 
    jQuery(document).keydown(function(e) {
        var url = false;
        if (e.which == 37) {  // Left arrow key code
            url = jQuery('.nav-prev a').attr('href');
        }
        else if (e.which == 39) {  // Right arrow key code
            url = jQuery('.nav-next a').attr('href');
        }
        if (url) {
            window.location = url;
        }
    });
 });