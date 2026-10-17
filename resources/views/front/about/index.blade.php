@extends('front.layout.template')

@section('title', 'About Us - News5')

@section('content')
<div class="container py-4">
    <!-- Header -->
    <header class="editorial-hero-banner py-4 text-center" data-aos="fade-down">
        <span class="category-badge mb-2">Our Mission</span>
        <h1 class="editorial-giant-title mb-3">About News5</h1>
        <p class="editorial-tagline mx-auto">
            Membangun ekosistem informasi yang mencerahkan, kritis, dan berorientasi pada kemajuan ilmu pengetahuan serta teknologi masa depan.
        </p>
    </header>

    <div class="row justify-content-center">
        <div class="col-lg-8" data-aos="fade-up">
            <!-- Manifesto Card -->
            <div class="editorial-widget p-4 p-md-5 mb-4">
                <h3 class="editorial-heading mb-4">Journalism Without Noise</h3>
                @forelse($aboutContents as $content)
                    <div class="single-post-body text-secondary" style="font-size: 1.05rem; line-height: 1.8;">
                        <p>{{ $content->content }}</p>
                    </div>
                @empty
                    <p class="text-secondary" style="line-height: 1.8;">
                        News5 didirikan dengan komitmen untuk menyajikan laporan faktual, berbasis data, dan mendalam. Di tengah banjir informasi dan clickbait digital, kami berfokus pada substansi: perkembangan kecerdasan buatan, eksplorasi sains, transformasi infrastruktur internet, dan transisi teknologi hijau.
                    </p>
                @endforelse
            </div>

            <!-- Newsroom Contact Card -->
            <div class="editorial-widget p-4 p-md-5 mb-4" data-aos="fade-up" data-aos-delay="100">
                <h4 class="editorial-heading mb-4">Editorial Newsroom & Inquiries</h4>
                <div class="row gy-3">
                    @forelse($aboutContents as $content)
                        <div class="col-sm-6">
                            <div class="text-muted small text-uppercase fw-bold" style="letter-spacing: 0.05em;">Phone / Mobile</div>
                            <div class="fw-semibold text-dark mt-1">{{ $content->phone }} / {{ $content->mobile }}</div>
                        </div>
                        <div class="col-sm-6">
                            <div class="text-muted small text-uppercase fw-bold" style="letter-spacing: 0.05em;">Official Email</div>
                            <div class="fw-semibold text-dark mt-1">{{ $content->email }}</div>
                        </div>
                        <div class="col-12 mt-3 pt-3 border-top">
                            <div class="text-muted small text-uppercase fw-bold" style="letter-spacing: 0.05em;">Headquarters</div>
                            <div class="fw-semibold text-dark mt-1">{{ $content->address }}</div>
                        </div>
                    @empty
                        <div class="col-sm-6">
                            <div class="text-muted small text-uppercase fw-bold">Official Email</div>
                            <div class="fw-semibold text-dark mt-1">redaksi@news5.id</div>
                        </div>
                        <div class="col-sm-6">
                            <div class="text-muted small text-uppercase fw-bold">Location</div>
                            <div class="fw-semibold text-dark mt-1">Jakarta Digital Center, Indonesia</div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection