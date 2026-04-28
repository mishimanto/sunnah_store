@php
    use App\Support\Media;
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', $siteSettings->site_name ?? 'The Sunnah Store')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600&family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background: #fafaf8; color: #1a1a1a; }
        .logo-font { font-family: 'Cormorant Garamond', serif; }
        .topbar { background: #f0ede6; text-align: center; padding: 9px 16px; font-size: 14px; letter-spacing: 0.12em; font-weight: 800; color: #000; display: flex; align-items: center; justify-content: center; gap: 10px; text-transform: uppercase; }
        .topbar-btn { background: #000; color: #fff; border-radius: 999px; min-width: 22px; min-height: 22px; display: inline-flex; align-items: center; justify-content: center; padding: 0 8px; font-size: 11px; flex-shrink: 0; }
        .navbar { background: #fff; border-bottom: 1px solid #e8e4dc; position: sticky; top: 0; z-index: 100; }
        .nav-inner { max-width: 1200px; margin: 0 auto; padding: 16px 32px; display: flex; align-items: center; justify-content: space-between; }
        .logo { display: flex; align-items: center; gap: 12px; flex-shrink: 0; }
        .logo img { height: 45px; width: auto; }
        .logo-text { font-family: 'Cormorant Garamond', serif; font-size: 15px; font-weight: 600; letter-spacing: 0.18em; line-height: 1.3; color: #1a1a1a; }
        nav { flex: 1; display: flex; justify-content: center; }
        nav ul { display: flex; gap: 0; list-style: none; }
        nav ul > li { position: relative; }
        nav ul > li > a { font-size: 13px; font-weight: 700; letter-spacing: 0.13em; color: #010101; text-decoration: none; transition: color 0.2s; padding: 6px 16px; display: block; text-transform: uppercase; }
        nav ul > li:hover > a { color: #1a1a1a; }
        .nav-search-bar { display: flex; align-items: center; background: #fff; border: 1px solid #ddd; border-radius: 40px; padding: 8px 20px; gap: 12px; width: 100%; max-width: 500px; margin: 0 auto; box-shadow: 0 2px 8px rgba(0,0,0,0.05); }
        .nav-search-bar input { flex: 1; border: none; outline: none; font-size: 14px; padding: 8px 0; background: transparent; }
        .mega-menu { display: none; position: absolute; top: calc(100% + 17px); left: 50%; transform: translateX(-50%); background: #fff; border: 1px solid #e8e4dc; border-top: 2px solid #2d6a4f; padding: 28px 32px; min-width: 520px; box-shadow: 0 8px 32px rgba(0,0,0,0.08); z-index: 200; gap: 24px; grid-template-columns: repeat(3, minmax(0, 1fr)); }
        nav ul > li:hover .mega-menu { display: grid; }
        .mega-col h4 { font-size: 11px; font-weight: 600; letter-spacing: 0.12em; color: #1a1a1a; margin-bottom: 14px; padding-bottom: 8px; border-bottom: 1px solid #e8e4dc; text-transform: uppercase; }
        .mega-col ul { list-style: none; display: flex; flex-direction: column; gap: 9px; }
        .mega-col ul li a { font-size: 12px; color: #666; text-decoration: none; letter-spacing: 0.04em; font-weight: 400; transition: color 0.2s; padding: 0; text-transform: none; }
        .mega-col ul li a:hover { color: #2d6a4f; }
        .nav-icons { display: flex; gap: 18px; align-items: center; flex-shrink: 0; }
        .icon-btn { width: 32px; height: 32px; display: inline-flex; align-items: center; justify-content: center; color: #333; cursor: pointer; transition: 0.2s; }
        .icon-btn:hover { transform: scale(1.08); color: #c9a96e; }
        .hamburger { display: none; flex-direction: column; gap: 5px; cursor: pointer; }
        .hamburger span { display: block; width: 22px; height: 1.5px; background: #333; border-radius: 2px; }
        .mobile-nav-bar, .mobile-search, .mobile-menu { display: none; }
        .page-shell { max-width: 1200px; margin: 0 auto; padding: 64px 32px; }
        .page-eyebrow { font-size: 11px; letter-spacing: 0.18em; text-transform: uppercase; color: #2d6a4f; margin-bottom: 12px; font-weight: 700; }
        .page-title { font-family: 'Cormorant Garamond', serif; font-size: clamp(34px, 5vw, 60px); line-height: 1.05; margin-bottom: 16px; }
        .page-copy { font-size: 15px; color: #5b5b5b; line-height: 1.8; max-width: 760px; }
        .footer { background: #0f0f0f; color: #ccc; padding: 60px 40px 0; }
        .footer-main { max-width: 1300px; margin: 0 auto; display: grid; grid-template-columns: 1.2fr 1fr 1fr 1fr 1.2fr; gap: 40px; padding-bottom: 48px; }
        .footer-brand img { height: 52px; width: auto; margin-bottom: 20px; display: block; }
        .footer-brand p { font-size: 13px; font-weight: 800; color: #fff; margin: 0 0 18px 0; }
        .footer-form { display: flex; align-items: center; border: 1px solid #444; border-radius: 6px; overflow: hidden; background: transparent; max-width: 260px; }
        .footer-form input { flex: 1; background: transparent; border: none; outline: none; padding: 12px 14px; font-size: 13px; color: #ccc; }
        .footer-form button { background: transparent; border: none; border-left: 1px solid #444; padding: 12px 14px; cursor: pointer; color: #888; display: flex; align-items: center; }
        .footer-nav-col h4, .footer-social-col h4 { font-size: 16px; font-weight: 900; color: #fff; margin: 0 0 20px 0; }
        .footer-nav-col ul { list-style: none; display: flex; flex-direction: column; gap: 13px; }
        .footer-nav-col ul li a { font-size: 13px; color: #ccc; text-decoration: none; font-weight: 700; transition: color 0.2s; }
        .footer-nav-col ul li a:hover, .footer-form button:hover { color: #c9a96e; }
        .footer-social-icons { display: flex; gap: 14px; align-items: center; }
        .footer-social-icon { width: 38px; height: 38px; border-radius: 50%; border: 1px solid #333; display: inline-flex; align-items: center; justify-content: center; color: #aaa; text-decoration: none; transition: all 0.2s; }
        .footer-social-icon:hover { border-color: #c9a96e; color: #c9a96e; }
        .footer-bottom-bar { max-width: 1300px; margin: 0 auto; border-top: 1px solid #222; padding: 18px 0; display: flex; align-items: center; justify-content: center; font-size: 12px; color: #d2d2d2; gap: 8px; }
        .footer-bottom-bar a { color: #d2d2d2; text-decoration: none; }
        .footer-bottom-bar a:hover { color: #c9a96e; }
        @media (max-width: 768px) {
            .nav-inner { display: none; }
            .mobile-nav-bar { display: flex; position: relative; align-items: center; justify-content: space-between; padding: 14px 20px; }
            .mobile-search { display: block; padding: 10px 16px; background: #fafaf8; border-bottom: 1px solid #e8e4dc; }
            .mobile-search-inner { display: flex; align-items: center; border: 1px solid #ddd; border-radius: 4px; padding: 9px 14px; gap: 10px; background: #fff; }
            .mobile-search input { border: none; outline: none; font-size: 13px; color: #555; background: transparent; width: 100%; }
            .mobile-menu { display: block; background: #fafaf8; border-top: 1px solid #e8e4dc; }
            .mobile-menu-item { border-bottom: 1px solid #f0ede6; }
            .mobile-menu-item > a { display: flex; align-items: center; justify-content: space-between; padding: 15px 20px; font-size: 12px; font-weight: 500; letter-spacing: 0.1em; color: #333; text-decoration: none; text-transform: uppercase; }
            .mobile-submenu { background: #f5f2eb; padding: 10px 0 14px; }
            .mobile-submenu-title { padding: 10px 20px 4px; font-size: 10px; letter-spacing: 0.1em; font-weight: 600; color: #999; text-transform: uppercase; }
            .mobile-submenu a { display: block; padding: 10px 32px; font-size: 12px; color: #666; text-decoration: none; }
            .mobile-logo-center { position: absolute; left: 50%; transform: translateX(-50%); text-align: center; }
            .mobile-logo-name { font-family: 'Cormorant Garamond', serif; font-size: 16px; font-weight: 500; letter-spacing: 0.12em; color: #1a1a1a; display: block; text-transform: lowercase; }
            .mobile-logo-sub { font-size: 9px; letter-spacing: 0.18em; color: #999; display: block; text-transform: uppercase; }
            .hamburger { display: flex; }
            .footer { padding: 40px 20px 0; }
            .footer-main { grid-template-columns: 1fr 1fr; gap: 28px; }
            .footer-brand, .footer-social-col { grid-column: span 2; }
            .page-shell { padding: 48px 20px; }
        }
        @media (max-width: 480px) {
            .footer-main { grid-template-columns: 1fr; }
            .footer-brand, .footer-social-col { grid-column: span 1; }
        }
        @stack('styles')
    </style>
</head>
<body x-data="siteHeader()">
    @if(($siteSettings->topbar_text ?? null) || ($siteSettings->topbar_button_label ?? null))
        <div class="topbar">
            <i data-lucide="gift" class="w-4 h-4"></i>
            <span>{{ $siteSettings->topbar_text }}</span>
            @if($siteSettings->topbar_button_label)
                <a href="{{ $siteSettings->topbar_button_url ?: route('products.index') }}" class="topbar-btn">{{ $siteSettings->topbar_button_label }}</a>
            @endif
        </div>
    @endif

    <header class="navbar">
        <div class="nav-inner">
            <a href="{{ route('home') }}" class="logo">
                <img src="{{ Media::url($siteSettings->logo_path) }}" alt="{{ $siteSettings->site_name }}">
            </a>

            <nav>
                <ul x-show="!searchOpen">
                    @foreach($navigationCategories as $category)
                        <li>
                            <a href="{{ route('categories.show', $category->slug) }}">{{ $category->name }}</a>
                            @if($category->children->isNotEmpty())
                                <div class="mega-menu" style="grid-template-columns: repeat({{ max(1, min(4, $category->children->count())) }}, minmax(0, 1fr));">
                                    @foreach($category->children as $group)
                                        <div class="mega-col">
                                            <h4>{{ $group->name }}</h4>
                                            <ul>
                                                @forelse($group->children as $item)
                                                    <li><a href="{{ route('categories.show', $item->slug) }}">{{ $item->name }}</a></li>
                                                @empty
                                                    <li><a href="{{ route('categories.show', $group->slug) }}">Explore {{ $group->name }}</a></li>
                                                @endforelse
                                            </ul>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </li>
                    @endforeach
                </ul>

                <form x-show="searchOpen" action="{{ route('products.index') }}" method="GET" class="nav-search-bar">
                    <i data-lucide="search" class="w-4 h-4 text-[#555]"></i>
                    <input type="text" name="q" placeholder="Search products..." value="{{ request('q') }}" x-ref="desktopSearch">
                    <button type="button" @click="searchOpen = false" class="text-[#999] text-xl leading-none">&times;</button>
                </form>
            </nav>

            <div class="nav-icons">
                <button type="button" class="icon-btn" @click="toggleSearch()"><i data-lucide="search" class="w-5 h-5"></i></button>
                <a href="{{ route('posts.index') }}" class="icon-btn"><i data-lucide="book-open-text" class="w-5 h-5"></i></a>
                <a href="{{ route('products.index') }}" class="icon-btn"><i data-lucide="shopping-bag" class="w-5 h-5"></i></a>
            </div>
        </div>

        <div class="mobile-nav-bar">
            <button type="button" class="hamburger" @click="mobileMenu = !mobileMenu">
                <span></span><span></span><span></span>
            </button>
            <div class="mobile-logo-center">
                <span class="mobile-logo-name">{{ strtolower($siteSettings->site_name ?? 'the sunnah store') }}</span>
                <span class="mobile-logo-sub">dynamic storefront</span>
            </div>
            <button type="button" class="icon-btn" @click="mobileSearch = !mobileSearch"><i data-lucide="search" class="w-5 h-5"></i></button>
        </div>

        <div class="mobile-search" x-show="mobileSearch" x-transition>
            <form action="{{ route('products.index') }}" method="GET" class="mobile-search-inner">
                <input type="text" name="q" placeholder="Search...">
                <button type="submit"><i data-lucide="search" class="w-4 h-4 text-[#aaa]"></i></button>
            </form>
        </div>

        <div class="mobile-menu" x-show="mobileMenu" x-transition>
            @foreach($navigationCategories as $category)
                <div class="mobile-menu-item">
                    <a href="{{ route('categories.show', $category->slug) }}" @click.prevent="activeSubmenu = activeSubmenu === '{{ $category->slug }}' ? null : '{{ $category->slug }}'">
                        <span>{{ $category->name }}</span>
                        <i data-lucide="chevron-right" class="w-4 h-4"></i>
                    </a>
                    <div class="mobile-submenu" x-show="activeSubmenu === '{{ $category->slug }}'" x-transition>
                        @foreach($category->children as $group)
                            <div class="mobile-submenu-title">{{ $group->name }}</div>
                            @forelse($group->children as $item)
                                <a href="{{ route('categories.show', $item->slug) }}">{{ $item->name }}</a>
                            @empty
                                <a href="{{ route('categories.show', $group->slug) }}">Explore {{ $group->name }}</a>
                            @endforelse
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="footer">
        <div class="footer-main">
            <div class="footer-brand">
                <img src="{{ Media::url($siteSettings->logo_path) }}" alt="{{ $siteSettings->site_name }}">
                <p>{{ $siteSettings->footer_newsletter_text }}</p>
                <form action="{{ route('newsletter.store') }}" method="POST" class="footer-form">
                    @csrf
                    <input type="email" name="email" placeholder="Email" required>
                    <button type="submit" aria-label="Subscribe"><i data-lucide="arrow-right" class="w-4 h-4"></i></button>
                </form>
            </div>

            <div class="footer-nav-col">
                <h4>Shop</h4>
                <ul>
                    @foreach($footerCategories as $category)
                        <li><a href="{{ route('categories.show', $category->slug) }}">{{ $category->name }}</a></li>
                    @endforeach
                    <li><a href="{{ route('products.index') }}">Shop All</a></li>
                </ul>
            </div>

            <div class="footer-nav-col">
                <h4>Privacy</h4>
                <ul>
                    @foreach($footerPageGroups->get('privacy', collect()) as $page)
                        <li><a href="{{ $page->slug === 'journal' ? route('posts.index') : route('pages.show', $page->slug) }}">{{ $page->title }}</a></li>
                    @endforeach
                </ul>
            </div>

            <div class="footer-nav-col">
                <h4>Information</h4>
                <ul>
                    @foreach($footerPageGroups->get('information', collect()) as $page)
                        <li><a href="{{ route('pages.show', $page->slug) }}">{{ $page->title }}</a></li>
                    @endforeach
                </ul>
            </div>

            <div class="footer-social-col">
                <h4>Follow us here</h4>
                <div class="footer-social-icons">
                    @foreach(($siteSettings->social_links ?? []) as $icon => $url)
                        <a href="{{ $url ?: '#' }}" class="footer-social-icon" aria-label="{{ $icon }}">
                            <i data-lucide="{{ $icon }}" class="w-4 h-4"></i>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="footer-bottom-bar">
            <span>{{ $siteSettings->footer_copyright_text }}</span>
            <span>&middot;</span>
            <a href="{{ $siteSettings->footer_privacy_url ?: route('pages.show', 'privacy-policy') }}">{{ $siteSettings->footer_privacy_label ?: 'Privacy policy' }}</a>
        </div>
    </footer>

    <script>
        function siteHeader() {
            return {
                searchOpen: false,
                mobileMenu: false,
                mobileSearch: false,
                activeSubmenu: null,
                toggleSearch() {
                    this.searchOpen = !this.searchOpen;
                    this.$nextTick(() => this.$refs.desktopSearch && this.$refs.desktopSearch.focus());
                },
            };
        }

        document.addEventListener('DOMContentLoaded', () => {
            if (window.lucide) {
                window.lucide.createIcons();
            }

            document.querySelectorAll('form[data-confirm]').forEach((form) => {
                form.addEventListener('submit', async (event) => {
                    event.preventDefault();
                    const result = await Swal.fire({
                        title: form.dataset.confirmTitle || 'Are you sure?',
                        text: form.dataset.confirm || 'This action cannot be undone.',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, continue',
                        confirmButtonColor: '#1f2937',
                    });

                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });

            @if(session('success'))
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    title: @json(session('success')),
                    showConfirmButton: false,
                    timer: 2600,
                    timerProgressBar: true,
                });
            @endif

            @if($errors->any())
                Swal.fire({
                    icon: 'error',
                    title: 'Please review the form',
                    text: @json($errors->first()),
                    confirmButtonColor: '#1f2937',
                });
            @endif
        });
    </script>
    @stack('scripts')
</body>
</html>
