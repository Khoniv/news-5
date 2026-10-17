<!-- Side Widgets (Refined Minimal Editorial Style) -->
<div class="col-lg-4">
    <!-- Flash News / Trending Posts -->
    <div class="editorial-widget" data-aos="fade-up" data-aos-delay="100">
        <div class="widget-title">
            <span>Flash News</span>
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon></svg>
        </div>
        
        @if(isset($popular_posts) && count($popular_posts) > 0)
            @foreach($popular_posts as $item)
                <div class="flash-item">
                    <div class="flash-item-content flex-grow-1">
                        <div class="flash-item-title">
                            <a href="{{ url('p/' . $item->slug) }}">{{ $item->title }}</a>
                        </div>
                        <div class="flash-item-meta">
                            <span>{{ $item->created_at ? $item->created_at->format('M d, Y') : date('M d, Y') }}</span>
                            <span class="mx-1">•</span>
                            <span>{{ $item->views ?? 0 }} views</span>
                        </div>
                    </div>
                    <div class="flash-item-thumb">
                        <a href="{{ url('p/' . $item->slug) }}">
                            <img src="{{ asset('storage/back/' . $item->img) }}" alt="{{ $item->title }}">
                        </a>
                    </div>
                </div>
            @endforeach
        @endif
    </div>



    <!-- Search Widget -->
    <div class="editorial-widget" data-aos="fade-up" data-aos-delay="200">
        <div class="widget-title">
            <span>Search Articles</span>
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
        </div>
        <form action="{{ route('search') }}" method="post">
            @csrf
            <div class="input-group">
                <input class="form-control" type="text" name="keyword" placeholder="Keywords..." style="background: var(--bg-surface-elevated); border: 1px solid var(--border-color); font-size: 13.5px;" />
                <button class="btn btn-dark" id="button-search" type="submit" style="font-size: 13px; font-weight: 600;">Search</button>
            </div>
        </form>
    </div>

    <!-- Categories Filter Widget -->
    <div class="editorial-widget" data-aos="fade-up" data-aos-delay="250">
        <div class="widget-title">
            <span>Explore Topics</span>
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path></svg>
        </div>
        <div class="d-flex flex-wrap gap-2">
            @if(isset($categories))
                @foreach ($categories as $item)
                    <a href="{{ url('category/' . $item->slug) }}" class="category-badge mb-0">
                        {{ $item->name }}
                    </a>
                @endforeach
            @endif
        </div>
    </div>

    <!-- Second Ads Widget (Banner 300x250 format matching layout) -->
    <div class="editorial-widget text-center p-3" data-aos="fade-up" data-aos-delay="300" style="background: var(--bg-surface-elevated); border-style: dashed;">
        <span class="text-uppercase text-muted d-block mb-2" style="font-size: 10px; letter-spacing: 0.1em; font-weight: 700;">Advertisement Space</span>
        <div class="py-4">
            <h5 class="fw-bold mb-1" style="font-family: var(--font-heading);">Your Banner Here</h5>
            <p class="text-muted small mb-3">300 x 250 Premium Placement</p>
            <a href="mailto:contact@news5.com" class="btn btn-sm btn-outline-dark rounded-pill px-3 fw-semibold">Contact Partner</a>
        </div>
    </div>
</div>