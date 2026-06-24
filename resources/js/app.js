import Swiper from 'swiper';
import { Autoplay, EffectCreative, Navigation, Pagination } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';
import 'swiper/css/effect-creative';

const menuButton = document.querySelector('[data-menu-button]');
const mobileMenu = document.querySelector('[data-mobile-menu]');
const siteHeaderShell = document.querySelector('[data-site-header-shell]');
const siteHeader = document.querySelector('[data-site-header]');
let setHeaderVisibility = () => {};
let closeMobileMenu = () => {};

const initializeSwipers = () => {
    document.querySelectorAll('[data-sophdata-swiper]').forEach((container) => {
        const swiperElement = container.querySelector('.swiper');
        const nextButton = container.querySelector('[data-swiper-next]');
        const prevButton = container.querySelector('[data-swiper-prev]');
        const pagination = container.querySelector('[data-swiper-pagination]');
        const type = container.dataset.swiperType;

        if (!swiperElement || swiperElement.swiper) {
            return;
        }

        if (type === 'hero') {
            new Swiper(swiperElement, {
                modules: [Autoplay, EffectCreative, Navigation, Pagination],
                grabCursor: true,
                rewind: true,
                effect: 'creative',
                spaceBetween: 0,
                speed: 900,
                pagination: {
                    el: pagination,
                    dynamicBullets: true,
                },
                navigation: {
                    nextEl: nextButton,
                    prevEl: prevButton,
                },
                autoplay: {
                    delay: 2500,
                    disableOnInteraction: true,
                },
                creativeEffect: {
                    prev: {
                        shadow: true,
                        translate: ['-120%', 0, -500],
                    },
                    next: {
                        shadow: true,
                        translate: ['120%', 0, -500],
                    },
                },
            });

            return;
        }

        new Swiper(swiperElement, {
            modules: [Navigation, Pagination],
            slidesPerView: 1.1,
            spaceBetween: 10,
            grabCursor: true,
            pagination: {
                el: pagination,
                clickable: true,
            },
            navigation: {
                nextEl: nextButton,
                prevEl: prevButton,
            },
            breakpoints: {
                540: {
                    slidesPerView: 2.1,
                    spaceBetween: 15,
                },
                768: {
                    slidesPerView: 3.1,
                    spaceBetween: 15,
                },
                1024: {
                    slidesPerView: 4.1,
                    spaceBetween: 20,
                },
            },
        });
    });
};

const initializeProfileGate = () => {
    const storageKey = 'sophdata_profile_selected';
    const profileGate = document.querySelector('[data-profile-gate]');

    if (!profileGate || window.localStorage?.getItem(storageKey)) {
        return;
    }

    const choices = [...profileGate.querySelectorAll('[data-profile-choice]')];
    const firstChoice = choices[0];

    profileGate.classList.remove('hidden');
    profileGate.classList.add('flex');
    document.documentElement.classList.add('profile-gate-open');

    window.requestAnimationFrame(() => firstChoice?.focus());

    choices.forEach((choice) => {
        choice.addEventListener('click', () => {
            window.localStorage?.setItem(storageKey, choice.dataset.profileChoice);
            window.location.href = choice.dataset.profileUrl;
        });
    });
};

const initializeFounderPhotoFallback = () => {
    document.querySelectorAll('[data-founder-photo]').forEach((image) => {
        image.addEventListener('error', () => {
            image.classList.add('hidden');
            image.nextElementSibling?.classList.remove('hidden');
        });
    });
};

initializeSwipers();
initializeProfileGate();
initializeFounderPhotoFallback();

if (menuButton && mobileMenu) {
    const menuOpenIcon = menuButton.querySelector('[data-menu-open-icon]');
    const menuCloseIcon = menuButton.querySelector('[data-menu-close-icon]');

    const syncMenuIcon = (isOpen) => {
        menuOpenIcon?.classList.toggle('hidden', isOpen);
        menuCloseIcon?.classList.toggle('hidden', !isOpen);
    };

    closeMobileMenu = () => {
        menuButton.setAttribute('aria-expanded', 'false');
        menuButton.setAttribute('aria-label', 'Abrir menu');
        mobileMenu.classList.add('hidden');
        document.documentElement.classList.remove('menu-open');
        syncMenuIcon(false);
    };

    menuButton.addEventListener('click', () => {
        const isOpen = menuButton.getAttribute('aria-expanded') === 'true';
        const nextIsOpen = !isOpen;

        if (nextIsOpen) {
            setHeaderVisibility(true);
        }

        menuButton.setAttribute('aria-expanded', String(nextIsOpen));
        menuButton.setAttribute('aria-label', isOpen ? 'Abrir menu' : 'Fechar menu');
        mobileMenu.classList.toggle('hidden', isOpen);
        document.documentElement.classList.toggle('menu-open', nextIsOpen);
        syncMenuIcon(nextIsOpen);
    });

    mobileMenu.querySelectorAll('a').forEach((link) => {
        link.addEventListener('click', closeMobileMenu);
    });

    document.addEventListener('click', (event) => {
        const isOpen = menuButton.getAttribute('aria-expanded') === 'true';

        if (isOpen && !mobileMenu.contains(event.target) && !menuButton.contains(event.target)) {
            closeMobileMenu();
        }
    });

    window.addEventListener('resize', () => {
        if (window.innerWidth >= 1024) {
            closeMobileMenu();
        }
    });
}

const megaMenus = [...document.querySelectorAll('[data-mega-menu]')];

const closeMegaMenu = (menu) => {
    const trigger = menu.querySelector('[data-mega-trigger]');
    const panel = menu.querySelector('[data-mega-panel]');
    const chevron = menu.querySelector('[data-mega-chevron]');

    trigger?.setAttribute('aria-expanded', 'false');
    panel?.classList.add('hidden');
    chevron?.classList.remove('rotate-180');
};

const closeAllMegaMenus = (except = null) => {
    megaMenus.forEach((menu) => {
        if (menu !== except) {
            closeMegaMenu(menu);
        }
    });
};

megaMenus.forEach((menu) => {
    const trigger = menu.querySelector('[data-mega-trigger]');
    const panel = menu.querySelector('[data-mega-panel]');
    const chevron = menu.querySelector('[data-mega-chevron]');

    if (!trigger || !panel) {
        return;
    }

    const openMenu = () => {
        closeAllMegaMenus(menu);
        trigger.setAttribute('aria-expanded', 'true');
        panel.classList.remove('hidden');
        chevron?.classList.add('rotate-180');
    };

    trigger.addEventListener('click', () => {
        if (trigger.getAttribute('aria-expanded') === 'true') {
            closeMegaMenu(menu);
        } else {
            openMenu();
        }
    });

    menu.addEventListener('mouseenter', openMenu);
    menu.addEventListener('mouseleave', () => closeMegaMenu(menu));
    menu.addEventListener('focusin', openMenu);
    menu.addEventListener('focusout', (event) => {
        if (!menu.contains(event.relatedTarget)) {
            closeMegaMenu(menu);
        }
    });
});

document.addEventListener('click', (event) => {
    if (!event.target.closest('[data-mega-menu]')) {
        closeAllMegaMenus();
    }
});

if (siteHeaderShell && siteHeader) {
    let lastScrollY = window.scrollY;
    let ticking = false;
    let headerHeight = Math.ceil(siteHeader.getBoundingClientRect().height);
    let isHeaderVisible = true;

    setHeaderVisibility = (isVisible) => {
        isHeaderVisible = isVisible;
        const offset = isVisible ? 0 : -headerHeight;

        siteHeaderShell.style.transform = isVisible ? '' : `translateY(${offset}px)`;
    };

    const syncHeaderHeight = () => {
        headerHeight = Math.ceil(siteHeader.getBoundingClientRect().height);
        document.documentElement.style.setProperty('--site-mobile-menu-top', `${headerHeight}px`);
        setHeaderVisibility(isHeaderVisible || window.scrollY <= 8);
    };

    const updateHeaderOnScroll = () => {
        const currentScrollY = Math.max(window.scrollY, 0);
        const scrollDelta = currentScrollY - lastScrollY;
        const isMobileMenuOpen = menuButton?.getAttribute('aria-expanded') === 'true';

        if (isMobileMenuOpen || currentScrollY <= 8) {
            setHeaderVisibility(true);
        } else if (Math.abs(scrollDelta) > 6) {
            setHeaderVisibility(scrollDelta < 0);
        }

        lastScrollY = currentScrollY;
        ticking = false;
    };

    syncHeaderHeight();

    window.addEventListener(
        'scroll',
        () => {
            if (!ticking) {
                window.requestAnimationFrame(updateHeaderOnScroll);
                ticking = true;
            }
        },
        { passive: true },
    );

    window.addEventListener('resize', syncHeaderHeight);
}

document.addEventListener('keydown', (event) => {
    if (event.key === 'Escape') {
        const openMegaTrigger = document.querySelector('[data-mega-trigger][aria-expanded="true"]');
        const isMobileMenuOpen = menuButton?.getAttribute('aria-expanded') === 'true';

        closeAllMegaMenus();

        if (isMobileMenuOpen && menuButton && mobileMenu) {
            closeMobileMenu();
            menuButton.focus();
        } else {
            openMegaTrigger?.focus();
        }
    }
});
