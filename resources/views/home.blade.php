<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>The Sunnah Store</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600&family=Inter:wght@300;400;500&display=swap');

    body { font-family: 'Inter', sans-serif; background: #fafaf8; color: #1a1a1a; }

    .logo-font { font-family: 'Cormorant Garamond', serif; }

    /* Top bar */
    .topbar {
      background: #f0ede6;
      text-align: center;
      padding: 9px 16px;
      font-size: 14px;
      letter-spacing: 0.12em;
      font-weight: 800;
      color: #000000;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
      text-transform: uppercase;
    }
    .topbar-btn {
      background: #000000;
      color: #ffffff;
      border-radius: 50%;
      width: 22px; height: 22px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      font-size: 12px;
      flex-shrink: 0;
    }

    /* Navbar */
    .navbar {
      background: #ffffff;
      border-bottom: 1px solid #e8e4dc;
      position: sticky;
      top: 0;
      z-index: 100;
    }
    .nav-inner {
      max-width: 1200px;
      margin: 0 auto;
      padding: 16px 32px;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }
    .logo { display: flex; align-items: center; gap: 12px; flex-shrink: 0; }
    .logo-text {
      font-family: 'Cormorant Garamond', serif;
      font-size: 15px;
      font-weight: 600;
      letter-spacing: 0.18em;
      line-height: 1.3;
      color: #1a1a1a;
    }

    nav { flex: 1; display: flex; justify-content: center; }
    nav ul { display: flex; gap: 0; list-style: none; }
    nav ul > li { position: relative; }
    nav ul > li > a {
      font-size: 13px;
      font-weight: 700;
      letter-spacing: 0.13em;
      color: #010101;
      text-decoration: none;
      transition: color 0.2s;
      padding: 6px 16px;
      display: block;
    }
    nav ul > li > a:hover { color: #000000; }
    nav ul > li:hover > a { color: #1a1a1a; }

    nav.search-mode ul { display: none; }
    nav.search-mode .nav-search-bar { display: flex; }
    
    .nav-search-bar {
      display: none;
      align-items: center;
      background: #fff;
      border: 1px solid #ddd;
      border-radius: 40px;
      padding: 8px 20px;
      gap: 12px;
      width: 100%;
      max-width: 500px;
      margin: 0 auto;
      box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }
    .nav-search-bar input {
      flex: 1;
      border: none;
      outline: none;
      font-size: 14px;
      padding: 8px 0;
      background: transparent;
      font-family: 'Inter', sans-serif;
    }
    .nav-search-bar input::placeholder { color: #aaa; }
    .close-search-nav {
      cursor: pointer;
      color: #999;
      font-size: 20px;
      line-height: 1;
      transition: color 0.2s;
    }
    .close-search-nav:hover { color: #c9a96e; }

    /* Mega Menu */
    .mega-menu {
      display: none;
      position: absolute;
      top: calc(100% + 17px);
      left: 50%;
      transform: translateX(-50%);
      background: #fff;
      border: 1px solid #e8e4dc;
      border-top: 2px solid #2d6a4f;
      padding: 28px 32px;
      min-width: 600px;
      box-shadow: 0 8px 32px rgba(0,0,0,0.08);
      z-index: 200;
      gap: 40px;
      grid-template-columns: repeat(4, 1fr);
    }
    nav ul > li:hover .mega-menu { display: grid; }
    .mega-col h4 {
      font-size: 11px;
      font-weight: 600;
      letter-spacing: 0.12em;
      color: #1a1a1a;
      margin-bottom: 14px;
      padding-bottom: 8px;
      border-bottom: 1px solid #e8e4dc;
    }
    .mega-col ul { list-style: none; display: flex; flex-direction: column; gap: 9px; }
    .mega-col ul li a {
      font-size: 12px;
      color: #666;
      text-decoration: none;
      letter-spacing: 0.04em;
      font-weight: 400;
      transition: color 0.2s;
      padding: 0;
    }
    .mega-col ul li a:hover { color: #2d6a4f; }

    .nav-icons { display: flex; gap: 18px; align-items: center; flex-shrink: 0; }
    .icon-btn {
      width: 22px; height: 22px;
      display: flex; align-items: center; justify-content: center;
      color: #333; cursor: pointer;
    }

    .hamburger { display: none; flex-direction: column; gap: 5px; cursor: pointer; }
    .hamburger span { display: block; width: 22px; height: 1.5px; background: #333; border-radius: 2px; transition: 0.3s; }

    .mobile-search {
      display: none;
      padding: 10px 16px;
      background: #fafaf8;
      border-bottom: 1px solid #e8e4dc;
    }
    .mobile-search-inner {
      display: flex;
      align-items: center;
      border: 1px solid #ddd;
      border-radius: 4px;
      padding: 9px 14px;
      gap: 10px;
      background: #fff;
    }
    .mobile-search input {
      border: none;
      outline: none;
      font-size: 13px;
      color: #555;
      background: transparent;
      width: 100%;
      font-family: 'Inter', sans-serif;
    }
    .mobile-search input::placeholder { color: #aaa; }

    .mobile-menu {
      display: none;
      flex-direction: column;
      background: #fafaf8;
      border-top: 1px solid #e8e4dc;
      overflow: hidden;
    }
    .mobile-menu.open { display: flex; }
    .mobile-menu-item {
      border-bottom: 1px solid #f0ede6;
    }
    .mobile-menu-item > a {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 15px 20px;
      font-size: 12px;
      font-weight: 500;
      letter-spacing: 0.1em;
      color: #333;
      text-decoration: none;
    }
    .mobile-menu-item > a .arrow {
      font-size: 10px;
      color: #aaa;
      transition: transform 0.2s;
    }
    .mobile-menu-item > a.active .arrow { transform: rotate(90deg); }
    .mobile-submenu {
      display: none;
      background: #f5f2eb;
      padding: 10px 0;
    }
    .mobile-submenu.open { display: block; }
    .mobile-submenu a {
      display: block;
      padding: 10px 32px;
      font-size: 12px;
      color: #666;
      text-decoration: none;
    }
    .mobile-submenu a:hover { color: #2d6a4f; }
    .mobile-submenu-title {
      padding: 10px 20px 4px;
      font-size: 10px;
      letter-spacing: 0.1em;
      font-weight: 600;
      color: #999;
    }

    .mobile-nav-bar {
      display: none;
      align-items: center;
      justify-content: space-between;
      padding: 14px 20px;
    }
    .mobile-logo-center {
      position: absolute;
      left: 50%;
      transform: translateX(-50%);
      text-align: center;
    }
    .mobile-logo-name {
      font-family: 'Cormorant Garamond', serif;
      font-size: 16px;
      font-weight: 500;
      letter-spacing: 0.12em;
      color: #1a1a1a;
      display: block;
    }
    .mobile-logo-sub {
      font-size: 9px;
      letter-spacing: 0.18em;
      color: #999;
      display: block;
    }

    @media (max-width: 768px) {
      nav ul { display: none; }
      .hamburger { display: flex; }
      .nav-inner { display: none; }
      .mobile-nav-bar { display: flex; position: relative; }
      .mobile-search { display: block; }
    }

    /* ========== HERO ========== */
    .hero {
      position: relative;
      width: 100%;
      min-height: 100vh;
      background-size: cover;
      background-position: center center;
      background-repeat: no-repeat;
      background-color: #e8e0d0;
      overflow: hidden;
    }

    .hero .video-overlay-content {
      position: absolute;
      bottom: 32px;
      left: 32px;
      right: auto;
      z-index: 10;
      max-width: 500px;
      background: none;
      padding: 0;
    }

    @media (min-width: 1200px) { .hero { min-height: 100vh; } }
    @media (min-width: 992px) and (max-width: 1199px) { .hero { min-height: 100vh; } }
    @media (min-width: 768px) and (max-width: 991px) { .hero { min-height: 85vh; } }
    @media (min-width: 576px) and (max-width: 767px) { .hero { min-height: 75vh; } }
    @media (max-width: 575px) { .hero { min-height: 65vh; } }
    
    @media (max-width: 768px) {
      .hero .video-overlay-content { bottom: 22px; left: 20px; max-width: 340px; }
    }
    @media (max-width: 480px) {
      .hero .video-overlay-content { bottom: 16px; left: 16px; max-width: 260px; }
    }

    /* ========== VIDEO SECTION ========== */
    .video-section {
      position: relative;
      width: 100%;
      margin: 20px 0 0 0;
      background-color: #0a0a0a;
    }

    .video-container {
      position: relative;
      width: 100%;
      overflow: hidden;
    }

    .video-container video {
      width: 100%;
      height: auto;
      display: block;
      object-fit: cover;
      max-height: 600px;
    }

    .video-overlay-content {
      position: absolute;
      bottom: 32px;
      left: 32px;
      right: auto;
      text-align: left;
      z-index: 10;
      max-width: 500px;
      background: none;
      padding: 0;
      backdrop-filter: none;
    }

    .overlay-title {
      font-family: 'Inter', sans-serif;
      font-size: 36px;
      font-weight: 800;
      color: #ffffff;
      margin: 0 0 6px 0;
      letter-spacing: -0.02em;
      line-height: 1.1;
      text-shadow: 0 2px 16px rgba(0,0,0,0.25);
    }

    .overlay-text {
      font-size: 15px;
      font-style: italic;
      color: rgba(255,255,255,0.95);
      margin: 0 0 18px 0;
      line-height: 1.4;
      font-weight: 400;
      text-shadow: 0 1px 8px rgba(0,0,0,0.25);
    }

    .overlay-btn {
      background: #ffffff;
      color: #1a1a1a;
      padding: 12px 30px;
      font-size: 13px;
      letter-spacing: 0.03em;
      font-weight: 700;
      border: none;
      cursor: pointer;
      transition: all 0.3s ease;
      text-transform: none;
      border-radius: 50px;
      display: inline-block;
    }

    .overlay-btn:hover {
      background: #2d6a4f;
      color: #ffffff;
      transform: translateX(3px);
    }

    @media (max-width: 768px) {
      .video-container video { max-height: 360px; }
      .video-overlay-content { bottom: 22px; left: 20px; right: auto; max-width: 340px; }
      .overlay-title { font-size: 26px; }
      .overlay-text { font-size: 13px; margin-bottom: 14px; }
      .overlay-btn { padding: 10px 22px; font-size: 12px; }
    }

    @media (max-width: 480px) {
      .video-container video { max-height: 280px; }
      .video-overlay-content { bottom: 16px; left: 16px; right: auto; max-width: 260px; }
      .overlay-title { font-size: 20px; }
      .overlay-text { font-size: 11px; margin-bottom: 10px; }
      .overlay-btn { padding: 8px 18px; font-size: 11px; }
    }

    /* Sections */
    .section { max-width: 1200px; margin: 0 auto; padding: 64px 32px; }
    .section-title {
      font-family: 'Cormorant Garamond', serif;
      font-size: 28px;
      font-weight: 500;
      text-align: center;
      margin-bottom: 8px;
      color: #1a1a1a;
    }
    .section-sub {
      text-align: center;
      font-size: 12px;
      letter-spacing: 0.1em;
      color: #888;
      margin-bottom: 40px;
    }

    /* Category pills */
    .categories {
      background: #f5f2eb;
      padding: 40px 32px;
    }
    .categories-inner { max-width: 1200px; margin: 0 auto; }
    .cat-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
      gap: 12px;
      margin-top: 28px;
    }
    .cat-item {
      background: #fafaf8;
      border: 1px solid #e0dbd0;
      padding: 20px 12px;
      text-align: center;
      cursor: pointer;
      transition: all 0.2s;
    }
    .cat-item:hover { border-color: #2d6a4f; }
    .cat-item:hover .cat-name { color: #2d6a4f; }
    .cat-icon { font-size: 22px; margin-bottom: 8px; }
    .cat-name { font-size: 10.5px; letter-spacing: 0.12em; font-weight: 500; color: #444; }

    .nav-icons .icon-btn {
      width: 32px;
      height: 32px;
      transition: 0.2s;
    }

    .nav-icons .icon-btn svg {
      width: 24px;
      height: 24px;
    }

    /* ✅ CHANGE 3: Search + nav icons golden hover */
    .nav-icons .icon-btn:hover {
      transform: scale(1.1);
      color: #c9a96e;
    }

    /* Product grid */
    .product-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
      gap: 24px;
    }
    .product-card {
      background: #fff;
      border: 1px solid #e8e4dc;
      cursor: pointer;
      transition: all 0.2s;
      position: relative;
      overflow: hidden;
    }
    .product-card:hover { border-color: #b0c8bb; box-shadow: 0 4px 20px rgba(0,0,0,0.06); }
    .product-card:hover .product-img { transform: scale(1.03); }
    .product-img-wrap { overflow: hidden; background: #f5f2eb; aspect-ratio: 1; display: flex; align-items: center; justify-content: center; }
    .product-img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.4s ease; }
    .product-placeholder {
      width: 100%; aspect-ratio: 1;
      background: #f0ede6;
      display: flex; align-items: center; justify-content: center;
      font-size: 40px;
    }
    .product-info { padding: 16px; }
    .product-tag { font-size: 10px; letter-spacing: 0.1em; color: #2d6a4f; font-weight: 500; margin-bottom: 4px; }
    .product-name { font-family: 'Cormorant Garamond', serif; font-size: 16px; font-weight: 500; color: #1a1a1a; margin-bottom: 8px; line-height: 1.3; }
    .product-price { font-size: 13px; color: #444; font-weight: 500; }
    .product-badge {
      position: absolute;
      top: 12px; left: 12px;
      background: #2d6a4f;
      color: #fff;
      font-size: 9px;
      letter-spacing: 0.1em;
      padding: 3px 8px;
      font-weight: 500;
    }

    /* Gift box banner */
    .gift-banner {
      background: #1a1a1a;
      color: #fff;
      padding: 56px 32px;
      text-align: center;
    }
    .gift-banner h2 {
      font-family: 'Cormorant Garamond', serif;
      font-size: clamp(24px, 4vw, 40px);
      font-weight: 400;
      margin-bottom: 12px;
      letter-spacing: 0.05em;
    }
    .gift-banner p { font-size: 13px; color: #aaa; margin-bottom: 28px; }
    .btn-light {
      background: #fff;
      color: #1a1a1a;
      padding: 12px 32px;
      font-size: 11px;
      letter-spacing: 0.15em;
      font-weight: 500;
      border: none;
      cursor: pointer;
    }
    .btn-light:hover { background: #f0ede6; }

    /* Footer */
    footer {
      background: #111;
      color: #aaa;
      padding: 48px 32px 28px;
    }
    /* ========== NEW FOOTER ========== */
    footer {
      background: #0f0f0f;
      color: #ccc;
      padding: 60px 40px 0;
      font-family: 'Inter', sans-serif;
    }

    .footer-main {
      max-width: 1300px;
      margin: 0 auto;
      display: grid;
      grid-template-columns: 1.2fr 1fr 1fr 1fr 1.2fr;
      gap: 40px;
      padding-bottom: 48px;
    }

    /* Brand column */
    .footer-brand-new img {
      height: 52px;
      width: auto;
      margin-bottom: 20px;
      display: block;
    }

    .footer-brand-new p {
      font-size: 13px;
      font-weight: 800;
      color: #ffffff;
      margin: 0 0 18px 0;
      letter-spacing: 0.02em;
    }

    .footer-email-form {
      display: flex;
      align-items: center;
      border: 1px solid #444;
      border-radius: 6px;
      overflow: hidden;
      background: transparent;
      max-width: 260px;
    }

    .footer-email-form input {
      flex: 1;
      background: transparent;
      border: none;
      outline: none;
      padding: 12px 14px;
      font-size: 13px;
      color: #ccc;
      font-family: 'Inter', sans-serif;
    }

    .footer-email-form input::placeholder { color: #666; }

    .footer-email-form button {
      background: transparent;
      border: none;
      border-left: 1px solid #444;
      padding: 12px 14px;
      cursor: pointer;
      color: #888;
      font-size: 16px;
      transition: color 0.2s;
      display: flex;
      align-items: center;
    }

    .footer-email-form button:hover { color: #c9a96e; }

    /* Nav columns */
    .footer-nav-col h4 {
      font-size: 16px;
      font-weight: 900;
      color: #ffffff;
      margin: 0 0 20px 0;
      letter-spacing: 0.01em;
    }

    .footer-nav-col ul {
      list-style: none;
      display: flex;
      flex-direction: column;
      gap: 13px;
    }

    .footer-nav-col ul li a {
      font-size: 13px;
      color: #cccccc;
      text-decoration: none;
      font-weight: 700;
      transition: color 0.2s;
      letter-spacing: 0.01em;
    }

    .footer-nav-col ul li a:hover { color: #c9a96e; }

    /* Social column */
    .footer-social-col h4 {
      font-size: 22px;
      font-weight: 900;
      color: #ffffff;
      margin: 0 0 24px 0;
      letter-spacing: -0.01em;
    }

    .footer-social-icons {
      display: flex;
      gap: 14px;
      flex-wrap: nowrap;
      align-items: center;
    }

    .footer-social-icon {
      width: 38px;
      height: 38px;
      border-radius: 50%;
      border: 1px solid #333;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #aaa;
      text-decoration: none;
      transition: all 0.2s;
      font-size: 16px;
    }

    .footer-social-icon:hover {
      border-color: #c9a96e;
      color: #c9a96e;
    }

    .footer-social-icon svg {
      width: 17px;
      height: 17px;
      fill: currentColor;
    }

    /* Bottom bar */
    .footer-bottom-bar {
      max-width: 1300px;
      margin: 0 auto;
      border-top: 1px solid #222;
      padding: 18px 0;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 12px;
      color: while;
      gap: 8px;
    }

    .footer-bottom-bar a {
      color: rgba(242, 227, 227, 0);
      text-decoration: none;
      transition: color 0.2s;
    }

    .footer-bottom-bar a:hover { color: #c9a96e; }

    @media (max-width: 1024px) {
      .footer-main { grid-template-columns: 1fr 1fr 1fr; gap: 32px; }
      .footer-social-col { grid-column: span 3; display: flex; align-items: flex-start; gap: 40px; }
      .footer-social-col h4 { margin-bottom: 0; white-space: nowrap; }
    }

    @media (max-width: 640px) {
      footer { padding: 40px 20px 0; }
      .footer-main { grid-template-columns: 1fr 1fr; gap: 28px; }
      .footer-social-col { grid-column: span 2; flex-direction: column; gap: 16px; }
      .footer-brand-new { grid-column: span 2; }
    }

    @media (max-width: 400px) {
      .footer-main { grid-template-columns: 1fr; }
      .footer-brand-new, .footer-social-col { grid-column: span 1; }
    }

    /* ========== BEST SELLER SLIDER ========== */
    .bestseller-section {
      width: 100%;
      padding: 48px 0 48px 0;
      background: #f7f6f3;
      overflow: hidden;
    }

    .bestseller-header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 40px;
      margin-bottom: 32px;
    }

    .bestseller-title {
      font-family: 'Inter', sans-serif;
      font-size: 32px;
      font-weight: 900;
      color: #111;
      letter-spacing: -0.02em;
    }

    .slider-arrows {
      display: flex;
      gap: 10px;
    }

    .slider-arrow {
      width: 44px;
      height: 44px;
      border-radius: 50%;
      border: 1.5px solid #ccc;
      background: #fff;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      transition: all 0.2s;
      flex-shrink: 0;
      color: #333;
    }

    /* ✅ CHANGE 2: Slider arrows golden hover */
    .slider-arrow:hover {
      border-color: #c9a96e;
      background: #c9a96e;
      color: #fff;
    }

    .slider-arrow svg {
      width: 18px;
      height: 18px;
      stroke: currentColor;
    }

    .slider-track-wrapper {
      overflow: hidden;
      width: 100%;
    }

    .slider-track {
      display: flex;
      gap: 0;
      transition: transform 0.45s cubic-bezier(0.4, 0, 0.2, 1);
      will-change: transform;
    }

    .slider-card {
      flex: 0 0 calc(25%);
      position: relative;
      cursor: pointer;
      overflow: hidden;
    }

    .slider-card-img {
      width: 100%;
      aspect-ratio: 3/4;
      object-fit: cover;
      display: block;
      background: #e8e4dc;
      transition: transform 0.4s ease;
    }

    .slider-card:hover .slider-card-img {
      transform: scale(1.03);
    }

    .slider-card-placeholder {
      width: 100%;
      aspect-ratio: 3/4;
      background: #f0ede6;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 60px;
      transition: transform 0.4s ease;
    }

    .slider-card:hover .slider-card-placeholder {
      transform: scale(1.03);
    }

    .slider-card-label {
      position: absolute;
      bottom: 18px;
      left: 16px;
      background: #ffffff;
      color: #1a1a1a;
      font-size: 13px;
      font-weight: 700;
      padding: 8px 18px;
      border-radius: 50px;
      letter-spacing: 0.01em;
      box-shadow: 0 2px 12px rgba(0,0,0,0.10);
      white-space: nowrap;
    }

    @media (max-width: 992px) {
      .slider-card { flex: 0 0 calc(33.333%); }
      .bestseller-title { font-size: 24px; }
      .bestseller-header { padding: 0 24px; }
    }

    @media (max-width: 640px) {
      .slider-card { flex: 0 0 calc(80%); }
      .bestseller-header { padding: 0 20px; }
      .bestseller-title { font-size: 22px; }
    }

    /* ========== SWIPE SLIDER (NO BUTTONS) ========== */
    .swipe-section {
      width: 100%;
      padding: 40px 0;
      overflow: hidden;
      background: #ffffff;
    }

    .swipe-track-wrapper {
      overflow: hidden;
      width: 100%;
      cursor: grab;
      user-select: none;
    }

    .swipe-track-wrapper:active {
      cursor: grabbing;
    }

    .swipe-track {
      display: flex;
      gap: 0;
      transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
      will-change: transform;
    }

    .swipe-card {
      flex: 0 0 calc(25%);
      position: relative;
      overflow: visible;
      padding: 0 8px;
      box-sizing: border-box;
    }

    .swipe-card-inner {
      width: 100%;
    }

    .swipe-card-img {
      width: 100%;
      aspect-ratio: 4/5;
      object-fit: cover;
      display: block;
      background: #e8e4dc;
      pointer-events: none;
    }

    .swipe-card-name {
      font-family: 'Inter', sans-serif;
      font-size: 15px;
      font-weight: 700;
      color: #111;
      margin-top: 14px;
      padding: 0 2px;
      letter-spacing: -0.01em;
    }

    @media (max-width: 992px) {
      .swipe-card { flex: 0 0 calc(33.333%); }
    }

    @media (max-width: 640px) {
      .swipe-card { flex: 0 0 calc(80%); }
    }

    /* ========== BLOG SECTION ========== */
    .blog-section {
      width: 100%;
      background: #2a2a2a;
      padding: 56px 40px;
      box-sizing: border-box;
    }

    .blog-header {
      text-align: center;
      margin-bottom: 40px;
    }

    .blog-main-title {
      font-family: 'Cormorant Garamond', serif;
      font-size: 42px;
      font-weight: 500;
      letter-spacing: 0.18em;
      color: #c9a96e;
      margin: 0 0 8px 0;
    }

    .blog-subtitle {
      font-size: 14px;
      font-style: italic;
      color: #aaa;
      letter-spacing: 0.08em;
      margin: 0 0 28px 0;
    }

    .blog-search-bar {
      display: flex;
      align-items: center;
      max-width: 600px;
      margin: 0 auto;
      background: #3a3a3a;
      border: 1.5px solid #c9a96e;
      border-radius: 50px;
      padding: 10px 16px 10px 24px;
      gap: 10px;
    }

    .blog-search-bar input {
      flex: 1;
      background: transparent;
      border: none;
      outline: none;
      font-size: 14px;
      color: #ccc;
      font-family: 'Inter', sans-serif;
    }

    .blog-search-bar input::placeholder { color: #888; }

    .blog-search-btn {
      width: 36px;
      height: 36px;
      background: #c9a96e;
      border: none;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      flex-shrink: 0;
      transition: background 0.2s, transform 0.2s;
    }

    /* ✅ Search button click golden glow */
    .blog-search-btn:hover {
      background: #b8924f;
      transform: scale(1.08);
    }

    .blog-search-btn:active {
      background: #a07c3a;
      transform: scale(0.97);
    }

    .blog-search-btn svg {
      width: 16px;
      height: 16px;
      stroke: #fff;
    }

    .blog-grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 20px;
      margin-top: 40px;
    }

    .blog-card {
      background: #1e1e1e;
      border-radius: 4px;
      overflow: hidden;
      display: flex;
      flex-direction: column;
    }

    .blog-card-img-wrap {
      position: relative;
      width: 100%;
    }

    .blog-card-img {
      width: 100%;
      aspect-ratio: 4/3;
      object-fit: cover;
      display: block;
    }

    .blog-card-quote {
      position: absolute;
      bottom: 0;
      left: 0;
      right: 0;
      background: linear-gradient(transparent, rgba(0,0,0,0.75));
      padding: 20px 14px 10px;
      font-size: 12px;
      color: #fff;
      line-height: 1.4;
    }

    .blog-card-quote span {
      color: #c9a96e;
      font-weight: 600;
    }

    .blog-card-body {
      padding: 16px;
      display: flex;
      flex-direction: column;
      flex: 1;
    }

    .blog-card-tags {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 12px;
    }

    .blog-tag {
      background: #c9a96e;
      color: #1a1a1a;
      font-size: 11px;
      font-weight: 700;
      padding: 5px 14px;
      border-radius: 50px;
      letter-spacing: 0.04em;
    }

    .blog-time {
      background: #c9a96e;
      color: #1a1a1a;
      font-size: 11px;
      font-weight: 600;
      padding: 5px 12px;
      border-radius: 50px;
      display: flex;
      align-items: center;
      gap: 5px;
    }

    .blog-card-text {
      font-size: 12.5px;
      color: #bbb;
      line-height: 1.7;
      flex: 1;
      margin-bottom: 16px;
    }

    .blog-card-read {
      border-top: 1px solid #333;
      padding-top: 14px;
      font-size: 13px;
      color: #c9a96e;
      font-weight: 500;
      text-decoration: none;
      display: block;
      text-align: center;
      letter-spacing: 0.04em;
      transition: opacity 0.2s;
    }

    .blog-card-read:hover { opacity: 0.75; }

    /* ✅ CHANGE 1: View All Articles Button */
    .blog-view-all-wrap {
      text-align: center;
      margin-top: 48px;
    }

    .blog-view-all-btn {
      display: inline-block;
      background: transparent;
      color: #c9a96e;
      border: 1.5px solid #c9a96e;
      padding: 14px 44px;
      font-size: 13px;
      font-weight: 600;
      letter-spacing: 0.16em;
      text-transform: uppercase;
      border-radius: 50px;
      cursor: pointer;
      text-decoration: none;
      transition: all 0.3s ease;
      font-family: 'Inter', sans-serif;
    }

    .blog-view-all-btn:hover {
      background: #c9a96e;
      color: #1a1a1a;
      transform: translateY(-2px);
      box-shadow: 0 6px 24px rgba(201, 169, 110, 0.3);
    }

    @media (max-width: 992px) {
      .blog-grid { grid-template-columns: repeat(2, 1fr); }
      .blog-section { padding: 40px 24px; }
    }

    @media (max-width: 580px) {
      .blog-grid { grid-template-columns: 1fr; }
      .blog-main-title { font-size: 28px; }
      .blog-section { padding: 36px 16px; }
    }

    /* ✅ Blog card hover — golden border + image zoom */
    .blog-card {
      border: 1.5px solid transparent;
      transition: border-color 0.3s ease, transform 0.3s ease;
      cursor: pointer;
    }

    .blog-card:hover {
      border-color: #c9a96e;
      transform: translateY(-4px);
    }

    .blog-card-img {
      transition: transform 0.4s ease;
    }

    .blog-card:hover .blog-card-img {
      transform: scale(1.05);
    }

    .blog-card:hover .blog-card-read {
      color: #e8c080;
      letter-spacing: 0.08em;
      transition: color 0.2s, letter-spacing 0.2s;
    }

    .blog-card:hover .blog-card-quote {
      background: linear-gradient(transparent, rgba(201,169,110,0.22));
    }
  </style>
</head>
<body>

<!-- Top Bar -->
<div class="topbar">
  <svg width="14" height="14" viewBox="0 0 24 24" fill="none">
    <rect x="3" y="10" width="18" height="11" rx="1" fill="#e07b39"/>
    <path d="M8 10V7a4 4 0 018 0v3" stroke="#b85c22" stroke-width="1.5" fill="none"/>
    <rect x="9" y="14" width="6" height="4" rx="0.5" fill="#b85c22"/>
  </svg>
  CREATE YOUR OWN GIFT BOX
  <span class="topbar-btn">→</span>
</div>

<!-- Navbar -->
<header class="navbar">
  <div class="nav-inner">
    <div class="logo">
      <div class="logo-text">
  <img src="{{ asset('images/logo.jpg') }}" 
     style="height:45px; filter: invert(36%) sepia(24%) saturate(600%) hue-rotate(100deg);">
</div>
    </div>

    <nav id="mainNav">
      <ul id="navLinks">
        <li>
          <a href="#">STATIONERIES</a>
          <div class="mega-menu">
            <div class="mega-col">
              <h4>Notebooks</h4>
              <ul>
                <li><a href="#">Coloured</a></li>
                <li><a href="#">Gold Foiled</a></li>
                <li><a href="#">Monochromed</a></li>
              </ul>
            </div>
            <div class="mega-col">
              <h4>Journals</h4>
              <ul>
                <li><a href="#">Journaling</a></li>
                <li><a href="#">Planner</a></li>
                <li><a href="#">Holy Book</a></li>
              </ul>
            </div>
            <div class="mega-col">
              <h4>Cards</h4>
              <ul>
                <li><a href="#">Ramadan Cards</a></li>
                <li><a href="#">Eid Cards</a></li>
                <li><a href="#">Dua Cards</a></li>
              </ul>
            </div>
            <div class="mega-col">
              <h4>Accessories</h4>
              <ul>
                <li><a href="#">Prayer Mat</a></li>
                <li><a href="#">Clips</a></li>
                <li><a href="#">Tasbeeh</a></li>
              </ul>
            </div>
          </div>
        </li>
        <li>
          <a href="#">HOME DECOR</a>
          <div class="mega-menu">
            <div class="mega-col">
              <h4>Wall Art</h4>
              <ul>
                <li><a href="#">Calligraphy Frames</a></li>
                <li><a href="#">Canvas Prints</a></li>
                <li><a href="#">Posters</a></li>
              </ul>
            </div>
            <div class="mega-col">
              <h4>Lighting</h4>
              <ul>
                <li><a href="#">Lanterns</a></li>
                <li><a href="#">Moon Lamps</a></li>
                <li><a href="#">Candles</a></li>
              </ul>
            </div>
            <div class="mega-col">
              <h4>Table Decor</h4>
              <ul>
                <li><a href="#">Incense Holders</a></li>
                <li><a href="#">Figurines</a></li>
                <li><a href="#">Trays</a></li>
              </ul>
            </div>
            <div class="mega-col">
              <h4>Rugs & Mats</h4>
              <ul>
                <li><a href="#">Prayer Rugs</a></li>
                <li><a href="#">Decorative Rugs</a></li>
              </ul>
            </div>
          </div>
        </li>
        <li>
          <a href="#">GIFTS</a>
          <div class="mega-menu" style="min-width:400px; grid-template-columns: repeat(3,1fr);">
            <div class="mega-col">
              <h4>Gift Sets</h4>
              <ul>
                <li><a href="#">Eid Gift Box</a></li>
                <li><a href="#">Ramadan Set</a></li>
                <li><a href="#">Wedding Gift</a></li>
              </ul>
            </div>
            <div class="mega-col">
              <h4>Occasion</h4>
              <ul>
                <li><a href="#">Birthday</a></li>
                <li><a href="#">New Baby</a></li>
                <li><a href="#">Hajj Gift</a></li>
              </ul>
            </div>
            <div class="mega-col">
              <h4>Build Your Own</h4>
              <ul>
                <li><a href="#">Custom Gift Box</a></li>
                <li><a href="#">Add a Card</a></li>
              </ul>
            </div>
          </div>
        </li>
        <li>
          <a href="#">LIFESTYLE</a>
          <div class="mega-menu" style="min-width:400px; grid-template-columns: repeat(3,1fr);">
            <div class="mega-col">
              <h4>Fragrance</h4>
              <ul>
                <li><a href="#">Attar / Oud</a></li>
                <li><a href="#">Bakhoor</a></li>
                <li><a href="#">Room Spray</a></li>
              </ul>
            </div>
            <div class="mega-col">
              <h4>Wellness</h4>
              <ul>
                <li><a href="#">Miswak</a></li>
                <li><a href="#">Black Seed Oil</a></li>
                <li><a href="#">Honey</a></li>
              </ul>
            </div>
            <div class="mega-col">
              <h4>Prayer</h4>
              <ul>
                <li><a href="#">Tasbeeh</a></li>
                <li><a href="#">Prayer Mat</a></li>
                <li><a href="#">Hijab Pins</a></li>
              </ul>
            </div>
          </div>
        </li>
        <li>
          <a href="#">ACADEMIC</a>
          <div class="mega-menu" style="min-width:300px; grid-template-columns: repeat(2,1fr);">
            <div class="mega-col">
              <h4>Books</h4>
              <ul>
                <li><a href="#">Islamic Books</a></li>
                <li><a href="#">Children's Books</a></li>
                <li><a href="#">Quran</a></li>
              </ul>
            </div>
            <div class="mega-col">
              <h4>Planners</h4>
              <ul>
                <li><a href="#">Study Planner</a></li>
                <li><a href="#">Ramadan Planner</a></li>
                <li><a href="#">Daily Journal</a></li>
              </ul>
            </div>
          </div>
        </li>
        <li>
          <a href="#">HAJJ</a>
          <div class="mega-menu" style="min-width:300px; grid-template-columns: repeat(2,1fr);">
            <div class="mega-col">
              <h4>Hajj Essentials</h4>
              <ul>
                <li><a href="#">Ihram Clothing</a></li>
                <li><a href="#">Hajj Bag</a></li>
                <li><a href="#">Dua Book</a></li>
              </ul>
            </div>
            <div class="mega-col">
              <h4>Umrah</h4>
              <ul>
                <li><a href="#">Umrah Kit</a></li>
                <li><a href="#">Travel Prayer Mat</a></li>
                <li><a href="#">Zamzam Bottle</a></li>
              </ul>
            </div>
          </div>
        </li>
      </ul>
      
      <div class="nav-search-bar" id="navSearchBar">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#555" stroke-width="1.8">
          <circle cx="11" cy="11" r="7"/><line x1="16.5" y1="16.5" x2="22" y2="22"/>
        </svg>
        <input type="text" id="searchInput" placeholder="Search products..." autocomplete="off">
        <span class="close-search-nav" id="closeSearchNav">✕</span>
      </div>
    </nav>

    <div class="nav-icons">
      <div class="icon-btn" id="searchIconBtn">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
          <circle cx="11" cy="11" r="7"/><line x1="16.5" y1="16.5" x2="22" y2="22"/>
        </svg>
      </div>
      <div class="icon-btn">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
          <circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/>
        </svg>
      </div>
      <div class="icon-btn">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
          <path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/>
          <line x1="3" y1="6" x2="21" y2="6"/>
          <path d="M16 10a4 4 0 01-8 0"/>
        </svg>
      </div>
      <div class="hamburger" id="burger">
        <span></span><span></span><span></span>
      </div>
    </div>
  </div>

  <div class="mobile-nav-bar">
    <div class="hamburger" id="burgerMobile">
      <span></span><span></span><span></span>
    </div>
    <div class="mobile-logo-center">
      <span class="mobile-logo-name">the sunnah store</span>
      <span class="mobile-logo-sub">est : 1438</span>
    </div>
    <div class="icon-btn" style="color:#333;" id="mobileSearchIcon">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
        <circle cx="11" cy="11" r="7"/><line x1="16.5" y1="16.5" x2="22" y2="22"/>
      </svg>
    </div>
  </div>

  <div class="mobile-search">
    <div class="mobile-search-inner">
      <input type="text" id="mobileSearchInput" placeholder="Search...">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#aaa" stroke-width="2">
        <circle cx="11" cy="11" r="7"/><line x1="16.5" y1="16.5" x2="22" y2="22"/>
      </svg>
    </div>
  </div>

  <div class="mobile-menu" id="mobileMenu">
    <div class="mobile-menu-item">
      <a href="#" onclick="toggleSub(event,'sub1')">STATIONERIES <span class="arrow">›</span></a>
      <div class="mobile-submenu" id="sub1">
        <div class="mobile-submenu-title">NOTEBOOKS</div>
        <a href="#">Coloured</a>
        <a href="#">Gold Foiled</a>
        <a href="#">Monochromed</a>
        <div class="mobile-submenu-title">JOURNALS</div>
        <a href="#">Journaling</a>
        <a href="#">Planner</a>
        <a href="#">Holy Book</a>
        <div class="mobile-submenu-title">CARDS</div>
        <a href="#">Ramadan Cards</a>
        <a href="#">Eid Cards</a>
        <a href="#">Dua Cards</a>
      </div>
    </div>
    <div class="mobile-menu-item">
      <a href="#" onclick="toggleSub(event,'sub2')">HOME DECOR <span class="arrow">›</span></a>
      <div class="mobile-submenu" id="sub2">
        <div class="mobile-submenu-title">WALL ART</div>
        <a href="#">Calligraphy Frames</a>
        <a href="#">Canvas Prints</a>
        <div class="mobile-submenu-title">LIGHTING</div>
        <a href="#">Lanterns</a>
        <a href="#">Moon Lamps</a>
        <a href="#">Candles</a>
      </div>
    </div>
    <div class="mobile-menu-item">
      <a href="#" onclick="toggleSub(event,'sub3')">GIFTS <span class="arrow">›</span></a>
      <div class="mobile-submenu" id="sub3">
        <a href="#">Eid Gift Box</a>
        <a href="#">Ramadan Set</a>
        <a href="#">Custom Gift Box</a>
      </div>
    </div>
    <div class="mobile-menu-item">
      <a href="#" onclick="toggleSub(event,'sub4')">LIFESTYLE <span class="arrow">›</span></a>
      <div class="mobile-submenu" id="sub4">
        <a href="#">Attar / Oud</a>
        <a href="#">Miswak</a>
        <a href="#">Prayer Mat</a>
      </div>
    </div>
    <div class="mobile-menu-item">
      <a href="#" onclick="toggleSub(event,'sub5')">ACADEMIC <span class="arrow">›</span></a>
      <div class="mobile-submenu" id="sub5">
        <a href="#">Islamic Books</a>
        <a href="#">Quran</a>
        <a href="#">Study Planner</a>
      </div>
    </div>
    <div class="mobile-menu-item">
      <a href="#" onclick="toggleSub(event,'sub6')">HAJJ <span class="arrow">›</span></a>
      <div class="mobile-submenu" id="sub6">
        <a href="#">Ihram Clothing</a>
        <a href="#">Hajj Bag</a>
        <a href="#">Umrah Kit</a>
      </div>
    </div>
  </div>
</header>

<!-- FIRST HERO SECTION -->
<section class="hero" style="background-image: url('{{ asset('images/sunnah-hero-bg.jpg') }}');"></section>

<!-- VIDEO SECTION -->
<section class="video-section">
  <div class="video-container">
    <video autoplay loop muted playsinline>
      <source src="{{ asset('videos/sunnah-video.mp4') }}" type="video/mp4">
      Your browser does not support the video tag.
    </video>
    <div class="video-overlay-content">
      <h1 class="overlay-title">Personalized Prayer Mat</h1>
      <p class="overlay-text">Pray Side by Side, Forever Engraved</p>
      <button class="overlay-btn">Customize Yours →</button>
    </div>
  </div>
</section>

<!-- THIRD SECTION -->
<section class="hero" style="background-image: url('{{ asset('images/sunnah-hero-bg-2.jpg') }}'); margin: 40px 0;">
  <div class="video-overlay-content">
    <h1 class="overlay-title">Personalized Prayer Mat</h1>
    <p class="overlay-text">Pray Side by Side, Forever Engraved</p>
    <button class="overlay-btn">Explore →</button>
  </div>
</section>

<!-- BEST SELLER SLIDER -->
<div class="bestseller-section">
  <div class="bestseller-header">
    <h2 class="bestseller-title">BEST SELLER</h2>
    <div class="slider-arrows">
      <button class="slider-arrow" id="sliderPrev" aria-label="Previous">
        <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <polyline points="15 18 9 12 15 6"/>
        </svg>
      </button>
      <button class="slider-arrow" id="sliderNext" aria-label="Next">
        <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <polyline points="9 18 15 12 9 6"/>
        </svg>
      </button>
    </div>
  </div>

  <div class="slider-track-wrapper">
    <div class="slider-track" id="sliderTrack">
      <div class="slider-card">
        <img class="slider-card-img" src="{{ asset('images/img.jpg') }}" alt="Rabbana Dua">
        <span class="slider-card-label">Rabbana Dua</span>
      </div>
      <div class="slider-card">
        <img class="slider-card-img" src="{{ asset('images/img-2.jpg') }}" alt="Wallet">
        <span class="slider-card-label">Wallet</span>
      </div>
      <div class="slider-card">
        <img class="slider-card-img" src="{{ asset('images/img-3.jpg') }}" alt="Hajj Dua Card">
        <span class="slider-card-label">Hajj Dua Card</span>
      </div>
      <div class="slider-card">
        <img class="slider-card-img" src="{{ asset('images/img-4.jpg') }}" alt="Hajj Daily Reminder">
        <span class="slider-card-label">Hajj Daily Reminder</span>
      </div>
      <div class="slider-card">
        <img class="slider-card-img" src="{{ asset('images/img-5.jpg') }}" alt="Attar Perfume Oil">
        <span class="slider-card-label">Attar Perfume Oil</span>
      </div>
      <div class="slider-card">
        <img class="slider-card-img" src="{{ asset('images/img-6.jpg') }}" alt="Velvet Prayer Mat">
        <span class="slider-card-label">Velvet Prayer Mat</span>
      </div>
      <div class="slider-card">
        <img class="slider-card-img" src="{{ asset('images/img-7.jpg') }}" alt="Arabic Frame">
        <span class="slider-card-label">Arabic Frame</span>
      </div>
      <div class="slider-card">
        <img class="slider-card-img" src="{{ asset('images/img-8.jpg') }}" alt="Sunnah Gift Box">
        <span class="slider-card-label">Sunnah Gift Box</span>
      </div>
    </div>
  </div>
</div>

<!-- FOURTH SECTION -->
<section class="hero" style="background-image: url('{{ asset('images/sunnah-hero-bg-3.jpg') }}'); margin: 40px 0;">
  <div class="video-overlay-content">
    <h1 class="overlay-title">Personalized Prayer Mat</h1>
    <p class="overlay-text">Pray Side by Side, Forever Engraved</p>
    <button class="overlay-btn">Order Now →</button>
  </div>
</section>

<!-- SWIPE SLIDER -->
<div class="swipe-section">
  <div class="swipe-track-wrapper" id="swipeWrapper">
    <div class="swipe-track" id="swipeTrack">
      <div class="swipe-card">
        <div class="swipe-card-inner">
          <img class="swipe-card-img" src="{{ asset('images/store.jpg') }}" alt="Explore Mugs">
          <p class="swipe-card-name">Explore Mugs</p>
        </div>
      </div>
      <div class="swipe-card">
        <div class="swipe-card-inner">
          <img class="swipe-card-img" src="{{ asset('images/store-2.jpg') }}" alt="Shop Hajj Dua Card">
          <p class="swipe-card-name">Shop Hajj Dua Card</p>
        </div>
      </div>
      <div class="swipe-card">
        <div class="swipe-card-inner">
          <img class="swipe-card-img" src="{{ asset('images/store-3.jpg') }}" alt="Start Writing">
          <p class="swipe-card-name">Start Writing</p>
        </div>
      </div>
      <div class="swipe-card">
        <div class="swipe-card-inner">
          <img class="swipe-card-img" src="{{ asset('images/store-4.jpg') }}" alt="Browse Frames">
          <p class="swipe-card-name">Browse Frames</p>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- FIFTH SECTION - Hero Style Image Below Slider -->
<section class="hero" style="background-image: url('{{ asset('images/sunnah-hero-bg-4.jpg') }}'); margin: 40px 0;">
  <div class="video-overlay-content">
    <h1 class="overlay-title">A Mug With A Message</h1>
    <p class="overlay-text">
A premium mug gift box that brings beauty, faith, and warmth together.</p>
    <button class="overlay-btn">Explore →</button>
  </div>
</section>

<!-- BLOG SECTION -->
<div class="blog-section">
  <div class="blog-header">
    <h2 class="blog-main-title">SOULFUL LATTE</h2>
    <p class="blog-subtitle">faith &amp; self-growth journal</p>
    <div class="blog-search-bar">
      <input type="text" placeholder="Search for wisdom, reflection, growth...">
      <button class="blog-search-btn">
        <svg viewBox="0 0 24 24" fill="none" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="11" cy="11" r="7"/><line x1="16.5" y1="16.5" x2="22" y2="22"/>
        </svg>
      </button>
    </div>
  </div>

  <div class="blog-grid">
    <div class="blog-card">
      <div class="blog-card-img-wrap">
        <img class="blog-card-img" src="{{ asset('images/store-5.jpg') }}" alt="Blog 1">
        <div class="blog-card-quote">| যার অন্তরে কেবল <span>আপনারই নাম</span></div>
      </div>
      <div class="blog-card-body">
        <div class="blog-card-tags">
          <span class="blog-tag">Dua</span>
          <span class="blog-time">6 Min ⏱</span>
        </div>
        <p class="blog-card-text">আমি শুধু আপনারই বান্দা (হেজের দু'আ ০২) ইয়া আল্লাহ, কখনো রাতের আঁধার ভয় দেখায়, কখনো নিজের গুনাহ। আপনি তো আন-নাসীর—আম...</p>
        <a href="#" class="blog-card-read">Read more →</a>
      </div>
    </div>

    <div class="blog-card">
      <div class="blog-card-img-wrap">
        <img class="blog-card-img" src="{{ asset('images/store-6.jpg') }}" alt="Blog 2">
        <div class="blog-card-quote">| তোমার সন্তুষ্টিই <span>আমার জান্নাত</span></div>
      </div>
      <div class="blog-card-body">
        <div class="blog-card-tags">
          <span class="blog-tag">Dua</span>
          <span class="blog-time">8 Min ⏱</span>
        </div>
        <p class="blog-card-text">শান্তির ছায়ায় দয়ার প্রার্থনা (হেজের দু'আ ০৩) আমার মালিক, আমার রব-আল্লাহ, আমার মা-বাবার দিকে আপনি দয়াভরা দৃষ্টি দিন...</p>
        <a href="#" class="blog-card-read">Read more →</a>
      </div>
    </div>

    <div class="blog-card">
      <div class="blog-card-img-wrap">
        <img class="blog-card-img" src="{{ asset('images/store-7.jpg') }}" alt="Blog 3">
        <div class="blog-card-quote">| আপনার রহমতই <span>আমার ভরসা</span></div>
      </div>
      <div class="blog-card-body">
        <div class="blog-card-tags">
          <span class="blog-tag">Hajj</span>
          <span class="blog-time">7 Min ⏱</span>
        </div>
        <p class="blog-card-text">আপনি না থাকলে, আমি কোথায় যাবো? (হেজের দু'আ ০৪) ইয়া আল্লাহ, আপনি যদি আমাকে ভালো না বাসেন, আমাকে দূরে সরিয়ে দেন, আমি...</p>
        <a href="#" class="blog-card-read">Read more →</a>
      </div>
    </div>

    <div class="blog-card">
      <div class="blog-card-img-wrap">
        <img class="blog-card-img" src="{{ asset('images/store-8.jpg') }}" alt="Blog 4">
        <div class="blog-card-quote">| আমি তুচ্ছ, <span>আপনি মহান</span></div>
      </div>
      <div class="blog-card-body">
        <div class="blog-card-tags">
          <span class="blog-tag">Hajj</span>
          <span class="blog-time">4 Min ⏱</span>
        </div>
        <p class="blog-card-text">আমি কিছুই না, কিন্তু আপনিই সব কিছু ইয়া আল্লাহ, আমার অন্তরকে- আমার কলবকে আপনি পবিত্র করে দিন। আপনি তো কুদ্দুস—প...</p>
        <a href="#" class="blog-card-read">Read more →</a>
      </div>
    </div>
  </div>

  <!-- ✅ CHANGE 1: View All Articles Button -->
  <div class="blog-view-all-wrap">
    <a href="#" class="blog-view-all-btn">VIEW ALL ARTICLES</a>
  </div>

</div>

<!-- Footer -->
<footer>
  <div class="footer-main">

    <!-- Brand + Email -->
    <div class="footer-brand-new">
      <img src="{{ asset('images/logo.jpg') }}" alt="The Sunnah Store">
      <p>For your weekly soulful coffee ↓</p>
      <div class="footer-email-form">
        <input type="email" placeholder="Email">
        <button type="button" aria-label="Subscribe">→</button>
      </div>
    </div>

    <!-- Shop -->
    <div class="footer-nav-col">
      <h4>Shop</h4>
      <ul>
        <li><a href="#">Gift Cards</a></li>
        <li><a href="#">Stationeries</a></li>
        <li><a href="#">Home Decor</a></li>
        <li><a href="#">Gifts</a></li>
        <li><a href="#">Lifestyle</a></li>
        <li><a href="#">Academic</a></li>
        <li><a href="#">Sale</a></li>
        <li><a href="#">Shop All</a></li>
      </ul>
    </div>

    <!-- Privacy -->
    <div class="footer-nav-col">
      <h4>Privacy</h4>
      <ul>
        <li><a href="#">Blog</a></li>
        <li><a href="#">Contact</a></li>
        <li><a href="#">Terms & Conditions</a></li>
        <li><a href="#">Privacy Policy</a></li>
        <li><a href="#">Return & Refund</a></li>
      </ul>
    </div>

    <!-- Information -->
    <div class="footer-nav-col">
      <h4>Information</h4>
      <ul>
        <li><a href="#">About Us</a></li>
        <li><a href="#">FAQs</a></li>
        <li><a href="#">Feedback</a></li>
        <li><a href="#">Reviews</a></li>
        <li><a href="#">Profile</a></li>
      </ul>
    </div>

    <!-- Social -->
    <div class="footer-social-col">
      <h4>Follow us here</h4>
      <div class="footer-social-icons">
        <!-- Facebook -->
        <a href="#" class="footer-social-icon" aria-label="Facebook">
          <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"/></svg>
        </a>
        <!-- Instagram -->
        <a href="#" class="footer-social-icon" aria-label="Instagram">
          <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><rect x="2" y="2" width="20" height="20" rx="5" ry="5" fill="none" stroke="currentColor" stroke-width="2"/><circle cx="12" cy="12" r="4" fill="none" stroke="currentColor" stroke-width="2"/><circle cx="17.5" cy="6.5" r="1" fill="currentColor"/></svg>
        </a>
        <!-- TikTok -->
        <a href="#" class="footer-social-icon" aria-label="TikTok">
          <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M19.59 6.69a4.83 4.83 0 01-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 01-2.88 2.5 2.89 2.89 0 01-2.89-2.89 2.89 2.89 0 012.89-2.89c.28 0 .54.04.79.1V9.01a6.33 6.33 0 00-.79-.05 6.34 6.34 0 00-6.34 6.34 6.34 6.34 0 006.34 6.34 6.34 6.34 0 006.33-6.34V8.75a8.19 8.19 0 004.79 1.53V6.79a4.85 4.85 0 01-1.02-.1z"/></svg>
        </a>
        <!-- X/Twitter -->
        <a href="#" class="footer-social-icon" aria-label="X">
          <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
        </a>
        <!-- Pinterest -->
        <a href="#" class="footer-social-icon" aria-label="Pinterest">
          <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M12 0C5.373 0 0 5.373 0 12c0 5.084 3.163 9.426 7.627 11.174-.105-.949-.2-2.405.042-3.441.218-.937 1.407-5.965 1.407-5.965s-.359-.719-.359-1.782c0-1.668.967-2.914 2.171-2.914 1.023 0 1.518.769 1.518 1.69 0 1.029-.655 2.568-.994 3.995-.283 1.194.599 2.169 1.777 2.169 2.133 0 3.772-2.249 3.772-5.495 0-2.873-2.064-4.882-5.012-4.882-3.414 0-5.418 2.561-5.418 5.207 0 1.031.397 2.138.893 2.738a.36.36 0 01.083.345l-.333 1.36c-.053.22-.174.267-.402.161-1.499-.698-2.436-2.889-2.436-4.649 0-3.785 2.75-7.262 7.929-7.262 4.163 0 7.398 2.967 7.398 6.931 0 4.136-2.607 7.464-6.227 7.464-1.216 0-2.359-.632-2.75-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146C9.57 23.812 10.763 24 12 24c6.627 0 12-5.373 12-12S18.627 0 12 0z"/></svg>
        </a>
      </div>
    </div>

  </div>

  <!-- Bottom bar -->
  <div class="footer-bottom-bar">
    <span>© 2026, The Sunnah Store Powered by Shopify</span>
    <span>·</span>
    <a href="#">Privacy policy</a>
  </div>
</footer>



<script>
  const productCards = document.querySelectorAll('.product-card');

  function filterProducts(searchText) {
    const query = searchText.toLowerCase().trim();
    productCards.forEach(card => {
      const name = card.querySelector('.product-name')?.innerText.toLowerCase() || '';
      const tag = card.querySelector('.product-tag')?.innerText.toLowerCase() || '';
      card.style.display = (query === '' || name.includes(query) || tag.includes(query)) ? '' : 'none';
    });
  }

  const nav = document.getElementById('mainNav');
  const searchIconBtn = document.getElementById('searchIconBtn');
  const closeSearchNav = document.getElementById('closeSearchNav');
  const searchInput = document.getElementById('searchInput');
  const mobileSearchInput = document.getElementById('mobileSearchInput');
  const mobileSearchIcon = document.getElementById('mobileSearchIcon');

  function enableSearchMode() {
    nav.classList.add('search-mode');
    searchInput.focus();
  }

  function disableSearchMode() {
    nav.classList.remove('search-mode');
    searchInput.value = '';
    filterProducts('');
    if(mobileSearchInput) mobileSearchInput.value = '';
  }

  if(searchIconBtn) searchIconBtn.addEventListener('click', enableSearchMode);
  if(closeSearchNav) closeSearchNav.addEventListener('click', disableSearchMode);
  
  if(searchInput) {
    searchInput.addEventListener('input', (e) => filterProducts(e.target.value));
    searchInput.addEventListener('keypress', (e) => { if(e.key === 'Enter') disableSearchMode(); });
  }
  
  document.addEventListener('keydown', (e) => {
    if(e.key === 'Escape' && nav.classList.contains('search-mode')) disableSearchMode();
  });

  if(mobileSearchInput) mobileSearchInput.addEventListener('input', (e) => filterProducts(e.target.value));
  if(mobileSearchIcon) {
    mobileSearchIcon.addEventListener('click', () => {
      const mobileSearchDiv = document.querySelector('.mobile-search');
      if(mobileSearchDiv) mobileSearchDiv.style.display = 'block';
      mobileSearchInput?.focus();
    });
  }

  document.querySelectorAll('#burger, #burgerMobile').forEach(btn => {
    btn.addEventListener('click', () => document.getElementById('mobileMenu').classList.toggle('open'));
  });

  function toggleSub(e, id) {
    e.preventDefault();
    var sub = document.getElementById(id);
    var link = e.currentTarget;
    var isOpen = sub.classList.contains('open');
    document.querySelectorAll('.mobile-submenu').forEach(el => el.classList.remove('open'));
    document.querySelectorAll('.mobile-menu-item > a').forEach(el => el.classList.remove('active'));
    if (!isOpen) { sub.classList.add('open'); link.classList.add('active'); }
  }
  window.toggleSub = toggleSub;

  // SWIPE SLIDER
  (function() {
    const wrapper = document.getElementById('swipeWrapper');
    const track = document.getElementById('swipeTrack');
    if (!wrapper || !track) return;
    const cards = track.querySelectorAll('.swipe-card');
    let currentIndex = 0, startX = 0, isDragging = false, dragOffset = 0;

    function getVisibleCount() {
      if (window.innerWidth <= 640) return 1;
      if (window.innerWidth <= 992) return 3;
      return 4;
    }
    function getCardWidth() { return cards[0].getBoundingClientRect().width; }
    function maxIndex() { return Math.max(0, cards.length - getVisibleCount()); }
    function updateTrack(extraOffset = 0) {
      const offset = currentIndex * getCardWidth() - extraOffset;
      track.style.transition = extraOffset !== 0 ? 'none' : 'transform 0.4s cubic-bezier(0.4,0,0.2,1)';
      track.style.transform = 'translateX(-' + offset + 'px)';
    }

    wrapper.addEventListener('touchstart', e => { startX = e.touches[0].clientX; isDragging = true; track.style.transition = 'none'; }, { passive: true });
    wrapper.addEventListener('touchmove', e => { if (!isDragging) return; dragOffset = startX - e.touches[0].clientX; updateTrack(-dragOffset); }, { passive: true });
    wrapper.addEventListener('touchend', () => {
      isDragging = false;
      const threshold = getCardWidth() * 0.25;
      if (dragOffset > threshold && currentIndex < maxIndex()) currentIndex++;
      else if (dragOffset < -threshold && currentIndex > 0) currentIndex--;
      dragOffset = 0; updateTrack();
    });
    wrapper.addEventListener('mousedown', e => { startX = e.clientX; isDragging = true; track.style.transition = 'none'; e.preventDefault(); });
    window.addEventListener('mousemove', e => { if (!isDragging) return; dragOffset = startX - e.clientX; updateTrack(-dragOffset); });
    window.addEventListener('mouseup', () => {
      if (!isDragging) return;
      isDragging = false;
      const threshold = getCardWidth() * 0.25;
      if (dragOffset > threshold && currentIndex < maxIndex()) currentIndex++;
      else if (dragOffset < -threshold && currentIndex > 0) currentIndex--;
      dragOffset = 0; updateTrack();
    });
    window.addEventListener('resize', () => { currentIndex = Math.min(currentIndex, maxIndex()); updateTrack(); });
    updateTrack();
  })();

  // BEST SELLER SLIDER
  (function() {
    const track = document.getElementById('sliderTrack');
    const prevBtn = document.getElementById('sliderPrev');
    const nextBtn = document.getElementById('sliderNext');
    if (!track || !prevBtn || !nextBtn) return;
    const cards = track.querySelectorAll('.slider-card');
    let currentIndex = 0;

    function getVisibleCount() {
      if (window.innerWidth <= 640) return 1;
      if (window.innerWidth <= 992) return 3;
      return 4;
    }
    function getCardWidth() { return cards[0].getBoundingClientRect().width; }
    function maxIndex() { return Math.max(0, cards.length - getVisibleCount()); }
    function updateSlider() {
      track.style.transform = 'translateX(-' + (currentIndex * getCardWidth()) + 'px)';
      prevBtn.style.opacity = currentIndex === 0 ? '0.4' : '1';
      nextBtn.style.opacity = currentIndex >= maxIndex() ? '0.4' : '1';
    }

    prevBtn.addEventListener('click', () => { if (currentIndex > 0) { currentIndex--; updateSlider(); } });
    nextBtn.addEventListener('click', () => { if (currentIndex < maxIndex()) { currentIndex++; updateSlider(); } });
    window.addEventListener('resize', () => { currentIndex = Math.min(currentIndex, maxIndex()); updateSlider(); });
    updateSlider();
  })();
</script>
</body>
</html>