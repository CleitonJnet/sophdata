const menuButton = document.querySelector('[data-menu-button]');
const mobileMenu = document.querySelector('[data-mobile-menu]');

if (menuButton && mobileMenu) {
    const closeMobileMenu = () => {
        menuButton.setAttribute('aria-expanded', 'false');
        menuButton.setAttribute('aria-label', 'Abrir menu');
        mobileMenu.classList.add('hidden');
        document.documentElement.classList.remove('menu-open');
    };

    menuButton.addEventListener('click', () => {
        const isOpen = menuButton.getAttribute('aria-expanded') === 'true';

        menuButton.setAttribute('aria-expanded', String(!isOpen));
        menuButton.setAttribute('aria-label', isOpen ? 'Abrir menu' : 'Fechar menu');
        mobileMenu.classList.toggle('hidden', isOpen);
        document.documentElement.classList.toggle('menu-open', !isOpen);
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

document.addEventListener('keydown', (event) => {
    if (event.key === 'Escape') {
        const openMegaTrigger = document.querySelector('[data-mega-trigger][aria-expanded="true"]');
        const isMobileMenuOpen = menuButton?.getAttribute('aria-expanded') === 'true';

        closeAllMegaMenus();

        if (isMobileMenuOpen && menuButton && mobileMenu) {
            document.documentElement.classList.remove('menu-open');
            menuButton.setAttribute('aria-expanded', 'false');
            menuButton.setAttribute('aria-label', 'Abrir menu');
            mobileMenu.classList.add('hidden');
            menuButton.focus();
        } else {
            openMegaTrigger?.focus();
        }
    }
});
