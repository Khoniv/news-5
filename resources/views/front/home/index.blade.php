@extends('front.layout.template')

@section('title', 'News5 - The Daily Insight')

@section('content')
<div class="container">
    <!-- Editorial Hero Headline Banner -->
    <header class="editorial-hero-banner" data-aos="fade-down">
        <div class="row align-items-end justify-content-between gy-3">
            <div class="col-lg-7">
                <span class="text-uppercase text-muted fw-bold d-block mb-1" style="font-size: 11px; letter-spacing: 0.15em;">Edition {{ date('F Y') }}</span>
                <h1 class="editorial-giant-title mb-0">The Daily Insight</h1>
            </div>
            <div class="col-lg-5 text-lg-end">
                <p class="editorial-tagline ms-lg-auto mb-3">
                    {{ $config['caption'] ?? 'Jurnalisme mendalam, kurasi gagasan masa depan, dan analisis teknologi terkini tanpa kebisingan informasi.' }}
                </p>
                <div class="d-inline-flex gap-2 align-items-center">
                    <a href="#breaking-news" class="subscribe-pill">
                        Explore Stories
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Top Featured Carousel / Auto-Rotating Stories (Lead Featured Banner) -->
    @if ($articles && count($articles) > 0)
    <section class="hero-trio-card position-relative" data-aos="fade-up" id="hero-feature-carousel">
        <!-- Progress Bar for Lead Story Rotation -->
        <div class="hero-carousel-progress" id="hero-carousel-progress"></div>

        <div class="hero-slides-viewport">
            @foreach ($articles->take(4) as $index => $lead)
            <div class="hero-feature-slide {{ $index === 0 ? 'active' : '' }}" data-slide="{{ $index }}">
                <div class="row align-items-center gy-4 w-100 m-0">
                    <!-- Left Info & Excerpt -->
                    <div class="col-lg-4 order-2 order-lg-1 ps-0">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            @if($lead->Category)
                                <a href="{{ url('category/' . $lead->Category->slug) }}" class="category-badge mb-0">
                                    {{ $lead->Category->name }}
                                </a>
                            @endif
                            <span class="badge bg-danger text-white rounded-pill px-2 py-1" style="font-size: 10px; letter-spacing: 0.05em;">HOT FEATURE</span>
                        </div>
                        <h2 class="editorial-heading hero-slide-title" style="font-size: clamp(1.45rem, 2.3vw, 2rem); line-height: 1.22; margin-bottom: 14px;">
                            <a href="{{ url('p/' . $lead->slug) }}">{{ $lead->title }}</a>
                        </h2>
                        <p class="text-secondary mb-4 hero-slide-desc" style="font-size: 14px; line-height: 1.6;">
                            {{ Str::limit(strip_tags($lead->desc), 160, '...') }}
                        </p>
                        <div class="d-flex align-items-center justify-content-between pt-3 border-top" style="border-color: var(--border-subtle) !important;">
                            <div class="author-pill">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($lead->User->name ?? 'Admin') }}&background=121417&color=fff&size=40" alt="{{ $lead->User->name ?? 'Admin' }}">
                                <span>{{ $lead->User->name ?? 'Staff Editor' }}</span>
                            </div>
                            <span class="text-muted small">{{ $lead->created_at ? $lead->created_at->format('M d, Y') : date('M d, Y') }}</span>
                        </div>
                    </div>

                    <!-- Center Big Image -->
                    <div class="col-lg-5 order-1 order-lg-2">
                        <div class="hero-media-wrapper" style="height: 330px;">
                            <a href="{{ url('p/' . $lead->slug) }}">
                                <img src="{{ asset('storage/back/' . $lead->img) }}" alt="{{ $lead->title }}">
                            </a>
                        </div>
                    </div>

                    <!-- Right Quick Mini Feature -->
                    <div class="col-lg-3 order-3 pe-0">
                        @php
                            $sideNext = $articles->get(($index + 1) % count($articles));
                        @endphp
                        @if($sideNext)
                            <div class="p-3 rounded" style="background: var(--bg-surface-elevated); border: 1px solid var(--border-subtle);">
                                <span class="text-uppercase text-muted fw-bold d-block mb-2" style="font-size: 10px; letter-spacing: 0.08em;">Next In Line</span>
                                <div class="hero-media-wrapper mb-3" style="height: 130px;">
                                    <a href="{{ url('p/' . $sideNext->slug) }}">
                                        <img src="{{ asset('storage/back/' . $sideNext->img) }}" alt="{{ $sideNext->title }}">
                                    </a>
                                </div>
                                <h4 style="font-size: 0.95rem; line-height: 1.35; margin-bottom: 6px;">
                                    <a href="{{ url('p/' . $sideNext->slug) }}">{{ $sideNext->title }}</a>
                                </h4>
                                <div class="text-muted" style="font-size: 11px;">
                                    {{ $sideNext->created_at ? $sideNext->created_at->format('M d, Y') : date('M d, Y') }} • {{ $sideNext->views }} views
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Carousel Indicators & Navigation -->
        <div class="hero-carousel-controls">
            <button type="button" class="carousel-arrow-btn" id="btn-hero-prev" aria-label="Previous story">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="15 18 9 12 15 6"></polyline></svg>
            </button>
            <div class="carousel-dots-container" id="hero-carousel-dots">
                @foreach ($articles->take(4) as $index => $lead)
                    <span class="carousel-dot {{ $index === 0 ? 'active' : '' }}" data-slide-target="{{ $index }}"></span>
                @endforeach
            </div>
            <button type="button" class="carousel-arrow-btn" id="btn-hero-next" aria-label="Next story">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"></polyline></svg>
            </button>
        </div>
    </section>
    @endif

    <!-- Main Content Section: Feed & Sidebar -->
    <div class="row" id="breaking-news">
        <!-- Main Column: List of Latest News Feed -->
        <div class="col-lg-8 pe-lg-4">
            <div class="section-headline-bar">
                <span class="bar-badge">FEED</span>
                <h3>Latest Articles & Reports</h3>
            </div>

            <div class="article-list-feed">
                @forelse ($articles as $item)
                <article class="article-item-card" data-aos="fade-up">
                    <div class="article-thumb-wrapper">
                        <a href="{{ url('p/' . $item->slug) }}">
                            <img src="{{ asset('storage/back/' . $item->img) }}" alt="{{ $item->title }}" loading="lazy">
                        </a>
                    </div>
                    <div class="article-item-content">
                        @if($item->Category)
                            <div>
                                <a href="{{ url('category/' . $item->Category->slug) }}" class="category-badge">
                                    {{ $item->Category->name }}
                                </a>
                            </div>
                        @endif
                        <h2 class="article-item-title">
                            <a href="{{ url('p/' . $item->slug) }}">{{ $item->title }}</a>
                        </h2>
                        <p class="article-item-excerpt">
                            {{ Str::limit(strip_tags($item->desc), 130, '...') }}
                        </p>
                        <div class="article-meta-row">
                            <div class="author-pill">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($item->User->name ?? 'Admin') }}&background=121417&color=fff&size=30" alt="">
                                <span>{{ $item->User->name ?? 'News5 Editor' }}</span>
                            </div>
                            <span>•</span>
                            <span>{{ $item->created_at ? $item->created_at->format('d M Y') : date('d M Y') }}</span>
                            <span>•</span>
                            <span>{{ $item->views ?? 0 }} views</span>
                        </div>
                    </div>
                </article>
                @empty
                    <div class="p-5 text-center bg-white rounded border my-4">
                        <h4 class="text-muted">No news articles found.</h4>
                    </div>
                @endforelse
            </div>

            <!-- Clean Modern Pagination with Custom Showing Counter -->
            <div class="d-flex justify-content-center my-5">
                {{ $articles->links() }}
            </div>
        </div>

        <!-- Right Column: Sidebar -->
        @include('front.layout.side-widget')
    </div>
</div>
@endsection

@push('js')
<script>
    // Lead Featured Carousel Rotation with Progress Loader (Changes every 4 seconds)
    document.addEventListener('DOMContentLoaded', function () {
        const slides = document.querySelectorAll('.hero-feature-slide');
        const dots = document.querySelectorAll('.carousel-dot');
        const progressBar = document.getElementById('hero-carousel-progress');
        const prevBtn = document.getElementById('btn-hero-prev');
        const nextBtn = document.getElementById('btn-hero-next');

        if (!slides.length) return;

        let currentIndex = 0;
        const totalSlides = slides.length;
        const slideDuration = 4500; // 4.5 seconds per slide
        let progressStart = Date.now();
        let loopInterval = null;

        function goToSlide(index) {
            slides.forEach(s => s.classList.remove('active'));
            dots.forEach(d => d.classList.remove('active'));

            slides[index].classList.add('active');
            if (dots[index]) dots[index].classList.add('active');
            progressStart = Date.now();
            if (progressBar) progressBar.style.width = '0%';
        }

        function nextHeroSlide() {
            currentIndex = (currentIndex + 1) % totalSlides;
            goToSlide(currentIndex);
        }

        function prevHeroSlide() {
            currentIndex = (currentIndex - 1 + totalSlides) % totalSlides;
            goToSlide(currentIndex);
        }

        // Timer loop for progress line
        loopInterval = setInterval(() => {
            const elapsed = Date.now() - progressStart;
            const pct = Math.min((elapsed / slideDuration) * 100, 100);
            if (progressBar) progressBar.style.width = pct + '%';

            if (elapsed >= slideDuration) {
                nextHeroSlide();
            }
        }, 50);

        if (nextBtn) nextBtn.addEventListener('click', nextHeroSlide);
        if (prevBtn) prevBtn.addEventListener('click', prevHeroSlide);

        dots.forEach((dot, idx) => {
            dot.addEventListener('click', () => {
                currentIndex = idx;
                goToSlide(currentIndex);
            });
        });
    });
</script>
@endpush