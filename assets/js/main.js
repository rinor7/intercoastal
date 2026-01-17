//Hamburger Menu
var Menu = {
    el: {
    ham: jQuery('.menu-m'),
    menuTop: jQuery('.menu-top'),
    menuMiddle: jQuery('.menu-middle'),
    menuBottom: jQuery('.menu-bottom')
    },
    init: function() {
    Menu.bindUIactions();
    },
    bindUIactions: function() {
    Menu.el.ham
    .on(
    'click',
    function(event) {
    Menu.activateMenu(event);
    event.preventDefault();
    }
    );
    },
    activateMenu: function() {
    Menu.el.menuTop.toggleClass('menu-top-click');
    Menu.el.menuMiddle.toggleClass('menu-middle-click');
    Menu.el.menuBottom.toggleClass('menu-bottom-click'); 
    }
    };
Menu.init();



//Calculate Header Height START ( variable --header-height )
function setHeaderHeightVar() {
    const header = document.getElementById('header-site');
    if (!header) return;

    const height = header.offsetHeight;
    document.documentElement.style.setProperty('--header-height', `${height}px`);
}
setHeaderHeightVar();
window.addEventListener('resize', setHeaderHeightVar);
//Calculate Header Height END


// Header change on scroll
// $(document).ready(function() {
//   $(window).scroll(function(){
//       if ($(this).scrollTop() > 70) {
//          $('.logo_header').addClass('logo-change-on-scroll'); 
//          $('.logo_site').addClass('logo-change-on-scroll'); 
//          $('.headerbar').addClass('reduce-header-height-on-scroll');
//         //  $('.navbar-toggler2').addClass('scroll-hamburger');
//          $('header').addClass('shadow-show-on-scroll');
//          $('body').addClass('body-on-scroll');
//       } else {
//          $('.logo_header').removeClass('logo-change-on-scroll');
//          $('.logo_site').removeClass('logo-change-on-scroll');
//          $('.headerbar').removeClass('reduce-header-height-on-scroll');
//         //  $('.navbar-toggler2').removeClass('scroll-hamburger');
//          $('header').removeClass('shadow-show-on-scroll');
//          $('body').removeClass('body-on-scroll');
//       }
//       if ($(this).scrollTop() > 30) {
//         $('body').addClass('body-on-scroll');
//      } else {
//         $('body').removeClass('body-on-scroll');
//      }
//   });
// });

// for rightmenu.php header
// $(document).ready(function() {
//   $('.navbar-toggler').click(function() {
//     $('.menu-menu-1-container').toggleClass('act');
//   });

//   $('li a').click(function() {
//     $('.menu-menu-1-container').removeClass('act');
//     $('.menu-bottom').removeClass('menu-bottom-click');
//     $('.menu-top').removeClass('menu-top-click');
//   });
// });
 
// Search Result
// $('.control').click( function(){
//   $('body').addClass('search-active');
//   $('.fa-search-loc').addClass('d-none');
//   $('.input-search').focus();
// });
// Search Result END

// $('.icon-close').click( function(){
//   $('body').removeClass('search-active');
//   $('.fa-search-loc').removeClass('d-none');
// });



// var prevScrollpos = window.pageYOffset;
// window.onscroll = function() {
// var currentScrollPos = window.pageYOffset;
//   if (prevScrollpos > currentScrollPos) {
//     document.getElementById("standard-header").style.cssText = "top: 0px; transition: .5s";
//   } else {
//     document.getElementById("standard-header").style.cssText = "top: -45px; transition: .5s;";
//   }
//   prevScrollpos = currentScrollPos;
// }

// $(document).ready(function() {
//   const navbarToggler = $('.navbar-toggler');
//   const site = $('.site-home, .site, .site-main, .page-all, .site-other');
//   const body = $('html');
//   navbarToggler.on('click', function() {
//     body.toggleClass('no-scroll');
//     site.toggleClass('filter-style');
//   });
//   });


// Menu for standard header with blur effect
$(document).ready(function() {
  const navbarToggler = $('.navbar-toggler-standard');
  const site = $('.site');
  const body = $('body');

  navbarToggler.on('click', function() {
    if (body.hasClass('no-scroll')) {
      body.removeClass('no-scroll');
      site.removeClass('filter-style');
      $(window).scrollTop(body.data('scroll-position')); // Restore previous scroll position
    } else {
      body.data('scroll-position', $(window).scrollTop()); // Save current scroll position
      body.addClass('no-scroll');
      site.addClass('filter-style');
    }
  });
});


// Close navbar when click on link ( used for Landingpages )
function closeNavbar() {
  $(".navbar-toggler").attr("aria-expanded", "false");
  $(".navbar-collapse").removeClass("show");
  $(".menu-top").removeClass("menu-top-click");
  $(".menu-middle").removeClass("menu-middle-click");
  $(".menu-bottom").removeClass("menu-bottom-click");
  $("body").removeClass("no-scroll");
  $(".site").removeClass("filter-style");
  $(".menu-menu-1-container").removeClass("act");
  toggleScroll();
}
$(".navbar-collapse li a").on("click", function() {
  closeNavbar();
});


//For all navigation, add menu-open class on body
document.addEventListener('DOMContentLoaded', function () {
  var navbar = document.getElementById('navbarNav');

  navbar.addEventListener('show.bs.collapse', function () {
    document.body.classList.add('menu-open');
  });

  navbar.addEventListener('hide.bs.collapse', function () {
    document.body.classList.remove('menu-open');
  });
});


// var swiper = new Swiper(".mySwiper", {
//   pagination: {
//     el: ".swiper-pagination",
//   },
// });

var swiper = new Swiper(".mySwiper-boxes-section", {
  slidesPerView: 1,
  spaceBetween: 15,
  loop: true,
  autoHeight: true,
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
  breakpoints: {
    640: {
      slidesPerView: 2,
      spaceBetween: 15,
    },
    768: {
      slidesPerView: 3,
      spaceBetween: 16,
    },
    1024: {
      slidesPerView: 4,
      spaceBetween: 16,
    },
  },
});

var swiper = new Swiper(".testimonial-slider", {
  slidesPerView: 1,
    spaceBetween: 30,
    loop: true,
    pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
});

//Calculate Header Height and set Page Offset
// jQuery(document).ready(function($) {
//     function adjustPageOffset() {
//         var headerHeight = $('header').outerHeight(); // measure <header> height
//         $('#page').css('top', headerHeight + 'px');
//     }

//     // Run on load
//     adjustPageOffset();

//     // Run again on resize (in case header height changes)
//     $(window).on('resize', function() {
//         adjustPageOffset();
//     });
// });

// Calculate Header Height
jQuery(document).ready(function($) {
    function adjustPageOffset() {
        var headerHeight = $('header').outerHeight(); // Measure <header> height

        // Set the header height as a global CSS variable
        document.documentElement.style.setProperty('--header-height', headerHeight + 'px');
    }

    // Run on load
    adjustPageOffset();

    // Run again on resize (in case header height changes)
    $(window).on('resize', function() {
        adjustPageOffset();
    });
});



// TEAM MEMBERS JS START
document.querySelectorAll('.team-tab').forEach(tab => {
    tab.addEventListener('click', () => {
        const index = tab.dataset.index;
        document.querySelectorAll('.team-tab, .team-panel')
            .forEach(el => el.classList.remove('is-active'));
        tab.classList.add('is-active');
        document.querySelector(`.team-panel[data-index="${index}"]`)
            .classList.add('is-active');
    });
});
let tabsSwiper, contentSwiper;

function initTeamSwiper() {
    if (window.innerWidth <= 768 && !tabsSwiper) {
        tabsSwiper = new Swiper('.js-team-tabs-swiper', {
            slidesPerView: 'auto',
            centeredSlides: true,
            slideToClickedSlide: true,
        });
        contentSwiper = new Swiper('.js-team-content-swiper', {
            autoHeight: true,
            navigation: {
              nextEl: '.team-tabs-next',
              prevEl: '.team-tabs-prev',
            },
            pagination: {
              el: '.team-tabs-pagination',
              clickable: true,
            },
        });
        tabsSwiper.controller.control = contentSwiper;
        contentSwiper.controller.control = tabsSwiper;
    }
    if (window.innerWidth > 768 && tabsSwiper) {
        tabsSwiper.destroy(true, true);
        contentSwiper.destroy(true, true);
        tabsSwiper = contentSwiper = null;
    }
}
window.addEventListener('load', initTeamSwiper);
window.addEventListener('resize', initTeamSwiper);

// Function to split text into two lines 
function splitTextTwoLines(selector) {
    document.querySelectorAll(selector).forEach(el => {
        const text = el.textContent.trim();
        const words = text.split(' ');

        if (words.length > 1) {
            const half = Math.ceil(words.length / 2);
            el.innerHTML = words.slice(0, half).join(' ') + '<br>' + words.slice(half).join(' ');
        }
    });
}
// Apply to mobile swiper slides
splitTextTwoLines('.team-tabs-swiper .swiper-slide');
// Apply to desktop tabs
splitTextTwoLines('.team-tabs .team-tab');
// TEAM MEMBERS JS END
