@extends('layouts.public')

@php
    use App\Support\Media;
    use Illuminate\Support\Str;

    $heroPrimary = $sections->get('hero_primary');
    $heroVideo = $sections->get('hero_video');
    $heroSecondary = $sections->get('hero_secondary');
    $heroTertiary = $sections->get('hero_tertiary');
    $heroQuaternary = $sections->get('hero_quaternary');
@endphp

@section('title', $settings->site_name)

@push('styles')
    <style>
        .hero { position: relative; width: 100%; min-height: 100vh; background-size: cover; background-position: center center; background-repeat: no-repeat; background-color: #e8e0d0; overflow: hidden; }
        .hero .video-overlay-content { position: absolute; bottom: 32px; left: 32px; z-index: 10; max-width: 500px; }
        .video-section { position: relative; width: 100%; margin: 20px 0 0 0; background-color: #0a0a0a; }
        .video-container { position: relative; width: 100%; overflow: hidden; }
        .video-container video { width: 100%; height: auto; display: block; object-fit: cover; max-height: 600px; }
        .video-overlay-content { position: absolute; bottom: 32px; left: 32px; text-align: left; z-index: 10; max-width: 500px; }
        .overlay-title { font-size: 36px; font-weight: 800; color: #fff; margin: 0 0 6px 0; letter-spacing: -0.02em; line-height: 1.1; text-shadow: 0 2px 16px rgba(0,0,0,0.25); }
        .overlay-text { font-size: 15px; font-style: italic; color: rgba(255,255,255,0.95); margin: 0 0 18px 0; line-height: 1.4; text-shadow: 0 1px 8px rgba(0,0,0,0.25); }
        .overlay-btn { background: #fff; color: #1a1a1a; padding: 12px 30px; font-size: 13px; letter-spacing: 0.03em; font-weight: 700; border: none; border-radius: 50px; display: inline-block; transition: all 0.3s ease; text-decoration: none; }
        .overlay-btn:hover { background: #2d6a4f; color: #fff; transform: translateX(3px); }
        .bestseller-section { width: 100%; padding: 48px 0; background: #f7f6f3; overflow: hidden; }
        .bestseller-header { display: flex; align-items: center; justify-content: space-between; padding: 0 40px; margin-bottom: 32px; }
        .bestseller-title { font-size: 32px; font-weight: 900; color: #111; letter-spacing: -0.02em; }
        .slider-arrows { display: flex; gap: 10px; }
        .slider-arrow { width: 44px; height: 44px; border-radius: 50%; border: 1.5px solid #ccc; background: #fff; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: all 0.2s; color: #333; }
        .slider-arrow:hover { border-color: #c9a96e; background: #c9a96e; color: #fff; }
        .slider-track-wrapper, .swipe-track-wrapper { overflow: hidden; width: 100%; }
        .slider-track, .swipe-track { display: flex; gap: 0; transition: transform 0.45s cubic-bezier(0.4, 0, 0.2, 1); will-change: transform; }
        .slider-card { flex: 0 0 25%; position: relative; cursor: pointer; overflow: hidden; }
        .slider-card-img { width: 100%; aspect-ratio: 3/4; object-fit: cover; display: block; background: #e8e4dc; transition: transform 0.4s ease; }
        .slider-card:hover .slider-card-img { transform: scale(1.03); }
        .slider-card-label { position: absolute; bottom: 18px; left: 16px; background: #fff; color: #1a1a1a; font-size: 13px; font-weight: 700; padding: 8px 18px; border-radius: 50px; box-shadow: 0 2px 12px rgba(0,0,0,0.10); white-space: nowrap; }
        .swipe-section { width: 100%; padding: 40px 0; overflow: hidden; background: #fff; }
        .swipe-track-wrapper { cursor: grab; user-select: none; }
        .swipe-card { flex: 0 0 25%; position: relative; overflow: visible; padding: 0 8px; box-sizing: border-box; }
        .swipe-card-img { width: 100%; aspect-ratio: 4/5; object-fit: cover; display: block; background: #e8e4dc; }
        .swipe-card-name { font-size: 15px; font-weight: 700; color: #111; margin-top: 14px; padding: 0 2px; letter-spacing: -0.01em; }
        .blog-section { width: 100%; background: #2a2a2a; padding: 56px 40px; box-sizing: border-box; }
        .blog-header { text-align: center; margin-bottom: 40px; }
        .blog-main-title { font-family: 'Cormorant Garamond', serif; font-size: 42px; font-weight: 500; letter-spacing: 0.18em; color: #c9a96e; margin: 0 0 8px 0; }
        .blog-subtitle { font-size: 14px; font-style: italic; color: #aaa; letter-spacing: 0.08em; margin: 0 0 28px 0; }
        .blog-search-bar { display: flex; align-items: center; max-width: 600px; margin: 0 auto; background: #3a3a3a; border: 1.5px solid #c9a96e; border-radius: 50px; padding: 10px 16px 10px 24px; gap: 10px; }
        .blog-search-bar input { flex: 1; background: transparent; border: none; outline: none; font-size: 14px; color: #ccc; }
        .blog-search-btn { width: 36px; height: 36px; background: #c9a96e; border: none; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #fff; }
        .blog-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-top: 40px; }
        .blog-card { background: #1e1e1e; border-radius: 4px; overflow: hidden; display: flex; flex-direction: column; border: 1.5px solid transparent; transition: border-color 0.3s ease, transform 0.3s ease; }
        .blog-card:hover { border-color: #c9a96e; transform: translateY(-4px); }
        .blog-card-img-wrap { position: relative; width: 100%; }
        .blog-card-img { width: 100%; aspect-ratio: 4/3; object-fit: cover; display: block; transition: transform 0.4s ease; }
        .blog-card:hover .blog-card-img { transform: scale(1.05); }
        .blog-card-quote { position: absolute; bottom: 0; left: 0; right: 0; background: linear-gradient(transparent, rgba(0,0,0,0.75)); padding: 20px 14px 10px; font-size: 12px; color: #fff; line-height: 1.4; }
        .blog-card-quote span { color: #c9a96e; font-weight: 600; }
        .blog-card-body { padding: 16px; display: flex; flex-direction: column; flex: 1; }
        .blog-card-tags { display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px; }
        .blog-tag, .blog-time { background: #c9a96e; color: #1a1a1a; font-size: 11px; font-weight: 700; padding: 5px 14px; border-radius: 50px; }
        .blog-card-text { font-size: 12.5px; color: #bbb; line-height: 1.7; flex: 1; margin-bottom: 16px; }
        .blog-card-read { border-top: 1px solid #333; padding-top: 14px; font-size: 13px; color: #c9a96e; font-weight: 500; text-decoration: none; display: block; text-align: center; letter-spacing: 0.04em; }
        .blog-view-all-wrap { text-align: center; margin-top: 48px; }
        .blog-view-all-btn { display: inline-block; background: transparent; color: #c9a96e; border: 1.5px solid #c9a96e; padding: 14px 44px; font-size: 13px; font-weight: 600; letter-spacing: 0.16em; text-transform: uppercase; border-radius: 50px; text-decoration: none; }
        @media (max-width: 992px) { .slider-card, .swipe-card { flex: 0 0 33.333%; } .blog-grid { grid-template-columns: repeat(2, 1fr); } }
        @media (max-width: 768px) { .overlay-title { font-size: 26px; } .video-overlay-content, .hero .video-overlay-content { left: 20px; bottom: 22px; max-width: 340px; } .bestseller-header { padding: 0 24px; } }
        @media (max-width: 640px) { .slider-card, .swipe-card { flex: 0 0 80%; } .blog-grid { grid-template-columns: 1fr; } .blog-section { padding: 36px 16px; } .bestseller-header { padding: 0 20px; } }
    </style>
@endpush

@section('content')
    @if($heroPrimary)
        <section class="hero" style="background-image: url('{{ Media::url($heroPrimary->image_path) }}');">
            @if($heroPrimary->title)
                <div class="video-overlay-content">
                    <h1 class="overlay-title">{{ $heroPrimary->title }}</h1>
                    <p class="overlay-text">{{ $heroPrimary->subtitle }}</p>
                    @if($heroPrimary->button_label)
                        <a href="{{ $heroPrimary->button_url ?: route('products.index') }}" class="overlay-btn">{{ $heroPrimary->button_label }} &rarr;</a>
                    @endif
                </div>
            @endif
        </section>
    @endif

    @if($heroVideo)
        <section class="video-section">
            <div class="video-container">
                <video autoplay loop muted playsinline>
                    <source src="{{ Media::url($heroVideo->video_path) }}" type="video/mp4">
                </video>
                <div class="video-overlay-content">
                    <h1 class="overlay-title">{{ $heroVideo->title }}</h1>
                    <p class="overlay-text">{{ $heroVideo->subtitle }}</p>
                    @if($heroVideo->button_label)
                        <a href="{{ $heroVideo->button_url ?: route('products.index') }}" class="overlay-btn">{{ $heroVideo->button_label }} &rarr;</a>
                    @endif
                </div>
            </div>
        </section>
    @endif

    @foreach([$heroSecondary, $heroTertiary] as $hero)
        @if($hero)
            <section class="hero" style="background-image: url('{{ Media::url($hero->image_path) }}'); margin: 40px 0;">
                <div class="video-overlay-content">
                    <h1 class="overlay-title">{{ $hero->title }}</h1>
                    <p class="overlay-text">{{ $hero->subtitle }}</p>
                    @if($hero->button_label)
                        <a href="{{ $hero->button_url ?: route('products.index') }}" class="overlay-btn">{{ $hero->button_label }} &rarr;</a>
                    @endif
                </div>
            </section>
        @endif
    @endforeach

    <div class="bestseller-section">
        <div class="bestseller-header">
            <h2 class="bestseller-title">BEST SELLER</h2>
            <div class="slider-arrows">
                <button class="slider-arrow" id="sliderPrev" aria-label="Previous"><i data-lucide="chevron-left" class="w-5 h-5"></i></button>
                <button class="slider-arrow" id="sliderNext" aria-label="Next"><i data-lucide="chevron-right" class="w-5 h-5"></i></button>
            </div>
        </div>
        <div class="slider-track-wrapper">
            <div class="slider-track" id="sliderTrack">
                @foreach($bestSellers as $product)
                    <a href="{{ route('products.show', $product->slug) }}" class="slider-card">
                        <img class="slider-card-img" src="{{ Media::url($product->image_path) }}" alt="{{ $product->name }}">
                        <span class="slider-card-label">{{ $product->name }}</span>
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    <div class="swipe-section">
        <div class="swipe-track-wrapper" id="swipeWrapper">
            <div class="swipe-track" id="swipeTrack">
                @foreach($swipeProducts as $product)
                    <a href="{{ route('products.show', $product->slug) }}" class="swipe-card">
                        <div class="swipe-card-inner">
                            <img class="swipe-card-img" src="{{ Media::url($product->image_path) }}" alt="{{ $product->name }}">
                            <p class="swipe-card-name">{{ $product->name }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    @if($heroQuaternary)
        <section class="hero" style="background-image: url('{{ Media::url($heroQuaternary->image_path) }}'); margin: 40px 0;">
            <div class="video-overlay-content">
                <h1 class="overlay-title">{{ $heroQuaternary->title }}</h1>
                <p class="overlay-text">{{ $heroQuaternary->subtitle }}</p>
                @if($heroQuaternary->button_label)
                    <a href="{{ $heroQuaternary->button_url ?: route('products.index') }}" class="overlay-btn">{{ $heroQuaternary->button_label }} &rarr;</a>
                @endif
            </div>
        </section>
    @endif

    <div class="blog-section">
        <div class="blog-header">
            <h2 class="blog-main-title">{{ $settings->blog_section_title }}</h2>
            <p class="blog-subtitle">{{ $settings->blog_section_subtitle }}</p>
            <form action="{{ route('posts.index') }}" method="GET" class="blog-search-bar">
                <input type="text" name="q" placeholder="{{ $settings->blog_search_placeholder }}">
                <button class="blog-search-btn" type="submit"><i data-lucide="search" class="w-4 h-4"></i></button>
            </form>
        </div>

        <div class="blog-grid">
            @foreach($featuredPosts as $post)
                <a href="{{ route('posts.show', $post->slug) }}" class="blog-card">
                    <div class="blog-card-img-wrap">
                        <img class="blog-card-img" src="{{ Media::url($post->image_path) }}" alt="{{ $post->title }}">
                        <div class="blog-card-quote">| {{ $post->quote }} <span>{{ $post->quote_highlight }}</span></div>
                    </div>
                    <div class="blog-card-body">
                        <div class="blog-card-tags">
                            <span class="blog-tag">{{ $post->category_label }}</span>
                            <span class="blog-time">{{ $post->reading_time }}</span>
                        </div>
                        <p class="blog-card-text">{{ Str::limit($post->body, 180) }}</p>
                        <span class="blog-card-read">Read more &rarr;</span>
                    </div>
                </a>
            @endforeach
        </div>

        <div class="blog-view-all-wrap">
            <a href="{{ route('posts.index') }}" class="blog-view-all-btn">View All Articles</a>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        (() => {
            const sliderTrack = document.getElementById('sliderTrack');
            const sliderPrev = document.getElementById('sliderPrev');
            const sliderNext = document.getElementById('sliderNext');
            const swipeWrapper = document.getElementById('swipeWrapper');
            const swipeTrack = document.getElementById('swipeTrack');

            if (sliderTrack && sliderPrev && sliderNext) {
                const cards = sliderTrack.querySelectorAll('.slider-card');
                let currentIndex = 0;
                const visibleCount = () => window.innerWidth <= 640 ? 1 : window.innerWidth <= 992 ? 3 : 4;
                const cardWidth = () => cards[0]?.getBoundingClientRect().width || 0;
                const maxIndex = () => Math.max(0, cards.length - visibleCount());
                const update = () => {
                    sliderTrack.style.transform = `translateX(-${currentIndex * cardWidth()}px)`;
                    sliderPrev.style.opacity = currentIndex === 0 ? '0.4' : '1';
                    sliderNext.style.opacity = currentIndex >= maxIndex() ? '0.4' : '1';
                };
                sliderPrev.addEventListener('click', () => { if (currentIndex > 0) currentIndex--; update(); });
                sliderNext.addEventListener('click', () => { if (currentIndex < maxIndex()) currentIndex++; update(); });
                window.addEventListener('resize', () => { currentIndex = Math.min(currentIndex, maxIndex()); update(); });
                update();
            }

            if (swipeWrapper && swipeTrack) {
                const cards = swipeTrack.querySelectorAll('.swipe-card');
                let currentIndex = 0;
                let startX = 0;
                let isDragging = false;
                let dragOffset = 0;
                const visibleCount = () => window.innerWidth <= 640 ? 1 : window.innerWidth <= 992 ? 3 : 4;
                const cardWidth = () => cards[0]?.getBoundingClientRect().width || 0;
                const maxIndex = () => Math.max(0, cards.length - visibleCount());
                const update = (offset = 0) => {
                    const distance = currentIndex * cardWidth() - offset;
                    swipeTrack.style.transition = offset ? 'none' : 'transform 0.4s cubic-bezier(0.4, 0, 0.2, 1)';
                    swipeTrack.style.transform = `translateX(-${distance}px)`;
                };
                const endDrag = () => {
                    if (!isDragging) return;
                    isDragging = false;
                    const threshold = cardWidth() * 0.25;
                    if (dragOffset > threshold && currentIndex < maxIndex()) currentIndex++;
                    if (dragOffset < -threshold && currentIndex > 0) currentIndex--;
                    dragOffset = 0;
                    update();
                };
                swipeWrapper.addEventListener('touchstart', (event) => { startX = event.touches[0].clientX; isDragging = true; }, { passive: true });
                swipeWrapper.addEventListener('touchmove', (event) => { if (!isDragging) return; dragOffset = startX - event.touches[0].clientX; update(-dragOffset); }, { passive: true });
                swipeWrapper.addEventListener('touchend', endDrag);
                swipeWrapper.addEventListener('mousedown', (event) => { startX = event.clientX; isDragging = true; event.preventDefault(); });
                window.addEventListener('mousemove', (event) => { if (!isDragging) return; dragOffset = startX - event.clientX; update(-dragOffset); });
                window.addEventListener('mouseup', endDrag);
                window.addEventListener('resize', () => { currentIndex = Math.min(currentIndex, maxIndex()); update(); });
                update();
            }
        })();
    </script>
@endpush
