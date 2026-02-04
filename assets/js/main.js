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
let tabsSwiper, contentSwiper;

// Desktop tabs
document.addEventListener("DOMContentLoaded", () => {
  document.querySelectorAll(".team-tab").forEach((tab) => {
    tab.addEventListener("click", () => {
      const index = tab.dataset.index;

      // activate tab button
      document.querySelectorAll(".team-tab").forEach((t) => t.classList.remove("is-active"));
      tab.classList.add("is-active");

      // activate correct panel
      document.querySelectorAll(".team-panel").forEach((panel) => {
        panel.classList.toggle("is-active", panel.dataset.index === index);
      });

      // recalc readmore for newly visible content
      initReadmore();
    });
  });

  // initial readmore for first visible tab (desktop)
  initReadmore();
});

// Mobile swipers
function initTeamSwiper() {
  if (window.innerWidth <= 768 && !tabsSwiper) {
    tabsSwiper = new Swiper(".js-team-tabs-swiper", {
      slidesPerView: "auto",
      centeredSlides: true,
      slideToClickedSlide: true,
    });

    contentSwiper = new Swiper(".js-team-content-swiper", {
      autoHeight: true,
      navigation: {
        nextEl: ".team-tabs-next",
        prevEl: ".team-tabs-prev",
      },
      pagination: {
        el: ".team-tabs-pagination",
        clickable: true,
      },
      on: {
        init: function () {
          initReadmore();
          this.updateAutoHeight(0);
          this.update();
        },
        slideChangeTransitionEnd: function () {
          initReadmore();
          this.updateAutoHeight(0);
          this.update();
        },
      },
    });

    tabsSwiper.controller.control = contentSwiper;
    contentSwiper.controller.control = tabsSwiper;
  }

  if (window.innerWidth > 768 && tabsSwiper) {
    // destroy safely
    if (tabsSwiper) tabsSwiper.destroy(true, true);
    if (contentSwiper) contentSwiper.destroy(true, true);
    tabsSwiper = null;
    contentSwiper = null;

    // back to desktop layout
    initReadmore();
  }
}

window.addEventListener("load", initTeamSwiper);
window.addEventListener("resize", initTeamSwiper);
// TEAM MEMBERS JS END




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


function initReadmore() {
  document.querySelectorAll(".js-readmore").forEach((wrap) => {
    const inner = wrap.querySelector(".js-readmore-inner");
    const btn = wrap.querySelector(".js-readmore-btn");
    if (!inner || !btn) return;

    const lines = parseInt(wrap.dataset.lines || "5", 10);

    // Don't run when hidden (inactive tab/slide)
    if (wrap.offsetParent === null) return;

    // Helper: apply collapsed styles
    const setCollapsed = () => {
      wrap.classList.remove("is-expanded");
      btn.setAttribute("aria-expanded", "false");
      btn.textContent = "Read more";

      inner.style.display = "-webkit-box";
      inner.style.webkitBoxOrient = "vertical";
      inner.style.overflow = "hidden";
      inner.style.webkitLineClamp = String(lines);
    };

    // Helper: apply expanded styles
    const setExpanded = () => {
      wrap.classList.add("is-expanded");
      btn.setAttribute("aria-expanded", "true");
      btn.textContent = "Read less";

      inner.style.display = "block";
      inner.style.overflow = "visible";
      inner.style.webkitLineClamp = "unset";
    };

    // Always start collapsed on init (so measurement is correct)
    setCollapsed();

    // Decide if button needed (compare collapsed vs expanded height)
    const collapsedH = inner.getBoundingClientRect().height;
    setExpanded();
    const fullH = inner.getBoundingClientRect().height;

    // restore collapsed default
    setCollapsed();

    const needsToggle = fullH > collapsedH + 2;
    btn.style.display = needsToggle ? "inline-flex" : "none";

    // Bind once
    if (!btn.dataset.bound) {
      btn.dataset.bound = "1";
      btn.addEventListener("click", () => {
        const expandedNow = wrap.classList.contains("is-expanded");

        if (expandedNow) {
          setCollapsed();
        } else {
          setExpanded();
        }

        // ✅ Swiper height update (mobile)
        if (typeof contentSwiper !== "undefined" && contentSwiper) {
          contentSwiper.updateAutoHeight(300);
          contentSwiper.update();
        }
      });
    }
  });
}

document.addEventListener("DOMContentLoaded", initReadmore);
window.addEventListener("load", initReadmore);


document.addEventListener("DOMContentLoaded", initReadmore);
window.addEventListener("load", initReadmore);


document.addEventListener("DOMContentLoaded", () => {
  // run once for first visible tab
  initReadmore();

  // DESKTOP tabs click
  document.querySelectorAll(".team-tab").forEach((tab) => {
    tab.addEventListener("click", () => {
      const index = tab.getAttribute("data-index");

      // 1) activate tab button
      document.querySelectorAll(".team-tab").forEach((t) => t.classList.remove("is-active"));
      tab.classList.add("is-active");

      // 2) activate correct panel
      document.querySelectorAll(".team-panel").forEach((panel) => {
        panel.classList.toggle("is-active", panel.getAttribute("data-index") === index);
      });

      // 3) IMPORTANT: recalc readmore in the now-visible panel
      initReadmore();
    });
  });
});
