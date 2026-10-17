@extends('front.layout.template')

@section('title', $article->title . ' - News5')

@push('css')
    @livewireStyles()
@endpush

@push('js')
    @livewireScripts()
@endpush

@section('content')
<div class="container py-4">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4" data-aos="fade-down">
        <ol class="breadcrumb small text-muted">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            @if($article->Category)
                <li class="breadcrumb-item"><a href="{{ url('category/' . $article->Category->slug) }}">{{ $article->Category->name }}</a></li>
            @endif
            <li class="breadcrumb-item active text-truncate" style="max-width: 300px;" aria-current="page">{{ $article->title }}</li>
        </ol>
    </nav>

    <div class="row">
        <!-- Main Article Container -->
        <div class="col-lg-8 pe-lg-4">
            <article class="single-post-container" data-aos="fade-up">
                <!-- Header -->
                <header class="single-post-header">
                    @if($article->Category)
                        <a href="{{ url('category/' . $article->Category->slug) }}" class="category-badge mb-3">
                            {{ $article->Category->name }}
                        </a>
                    @endif
                    <h1 class="single-post-title">{{ $article->title }}</h1>
                    
                    <div class="d-flex align-items-center justify-content-between py-3 border-top border-bottom my-3" style="border-color: var(--border-color) !important;">
                        <div class="d-flex align-items-center gap-3">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($article->User->name ?? 'Admin') }}&background=121417&color=fff&size=48" class="rounded-circle" width="42" height="42" alt="Author">
                            <div>
                                <div class="fw-bold text-dark">{{ $article->User->name ?? 'News5 Editorial Staff' }}</div>
                                <div class="text-muted small">
                                    Published on {{ $article->created_at ? $article->created_at->format('F d, Y') : date('F d, Y') }}
                                </div>
                            </div>
                        </div>
                        <div class="text-muted small d-flex align-items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                            <span>{{ $article->views }} views</span>
                        </div>
                    </div>
                </header>

                <!-- Hero Image -->
                <div class="single-post-hero-wrapper">
                    <img class="single-post-hero-img" src="{{ asset('storage/back/' . $article->img) }}" alt="{{ $article->title }}">
                </div>

                <!-- Body Content -->
                <div class="single-post-body py-2">
                    {!! $article->desc !!}
                </div>

                <!-- Mid-Article In-Content Ad -->
                <div class="my-5 p-4 rounded-3 text-center" style="background: var(--bg-surface-elevated); border: 1px dashed var(--border-color);">
                    <span class="text-uppercase text-muted d-block small mb-2 fw-semibold" style="letter-spacing: 0.1em; font-size: 11px;">SPONSORED ANNOUNCEMENT</span>
                    <h5 class="fw-bold mb-1" style="font-family: var(--font-heading);">Accelerate Your Engineering Pipeline</h5>
                    <p class="text-muted small mb-3">Enterprise-grade observability, telemetry, and automated CI/CD for cloud-native teams.</p>
                    <a href="https://github.com" target="_blank" rel="noopener" class="btn btn-dark btn-sm rounded-pill px-4 fw-semibold">Discover Solutions</a>
                </div>

                <!-- Interactive Comment Section -->
                <section class="comments-container" id="comments">
                    @livewire('articels.comment', ['id' => $article->id])
                </section>
            </article>
        </div>

        <!-- Sidebar -->
        @include('front.layout.side-widget')
    </div>
</div>
@endsection
