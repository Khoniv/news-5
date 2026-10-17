@extends('front.layout.template')

@section('title', 'Category: ' . $category . ' - News5')

@section('content')
<div class="container py-4">
    <div class="editorial-hero-banner py-4" data-aos="fade-down">
        <span class="category-badge mb-2">Category Filter</span>
        <h1 class="editorial-heading display-5 mb-2">{{ $category }}</h1>
        <p class="text-secondary small mb-0">Showing stories and dispatches categorized under <strong>{{ $category }}</strong>.</p>
    </div>

    <div class="row mt-4">
        <div class="col-lg-8 pe-lg-4">
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
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($item->User->name ?? 'Admin') }}&background=121417&color=fff&size=24" alt="">
                                    <span>{{ $item->User->name ?? 'News5' }}</span>
                                </div>
                                <span>•</span>
                                <span>{{ $item->created_at ? $item->created_at->format('M d, Y') : date('M d, Y') }}</span>
                                <span>•</span>
                                <span>{{ $item->views ?? 0 }} views</span>
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="text-center py-5 bg-white border rounded">
                        <h4 class="text-muted">No articles found in this category.</h4>
                    </div>
                @endforelse
            </div>

            <div class="d-flex justify-content-center my-5">
                {{ $articles->links() }}
            </div>
        </div>

        @include('front.layout.side-widget')
    </div>
</div>
@endsection
