//Hamburger Menu
var Menu = {
    el: {
        menuTop: jQuery('.menu-top'),
        menuMiddle: jQuery('.menu-middle'),
        menuBottom: jQuery('.menu-bottom')
    },

    init: function () {
        jQuery('#navbarNav')
            .on('show.bs.collapse', Menu.open)
            .on('hide.bs.collapse', Menu.close);
    },

    open: function () {
        Menu.el.menuTop.addClass('menu-top-click');
        Menu.el.menuMiddle.addClass('menu-middle-click');
        Menu.el.menuBottom.addClass('menu-bottom-click');
    },

    close: function () {
        Menu.el.menuTop.removeClass('menu-top-click');
        Menu.el.menuMiddle.removeClass('menu-middle-click');
        Menu.el.menuBottom.removeClass('menu-bottom-click');
    }
};

Menu.init();

jQuery('.menu-close').on('click', function () {
    jQuery('#navbarNav').collapse('hide');
});

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

// Function to split text into two lines ( used for team members )
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

// Disable first option in select
document.addEventListener('DOMContentLoaded', function () {
  document.querySelectorAll('select[name="inquiry-topic"]').forEach(select => {
    // Disable placeholder
    if (select.options.length) {
      select.options[0].disabled = true;
    }
    select.addEventListener('change', function () {
      // remove invalid class from select only
      select.classList.remove('wpcf7-not-valid');
      select.setAttribute('aria-invalid', 'false');
      // remove error message
      const wrap = select.closest('.wpcf7-form-control-wrap');
      if (wrap) {
        const tip = wrap.querySelector('.wpcf7-not-valid-tip');
        if (tip) tip.remove();
      }

    });
  });
});
