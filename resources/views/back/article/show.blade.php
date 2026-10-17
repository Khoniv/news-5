@extends('back.layout.template')

@section('title', 'Detail Articles - Admin')

@section('content')
{{-- Content --}}
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Detail Articles</h1>
    </div>

    <div class="mt-3">

        <table class="table table-striped table-bordered">
            <tr>
                <th>Title</th>
                <td>: {{ $article->title }}</td>
            </tr>
            <tr>
                <th>Category</th>
                <td>: {{ $article->Category->name }}</td>
            </tr>
            <tr>
                <th>Description</th>
                <td>{!! $article->desc !!}</td>
            </tr>
            <tr>
                <th>Image</th>
                <td>
                    <a href="{{ asset('storage/back/' . $article->img) }}" target="_blank" rel="noopener noreferrer">
                        <img src="{{ asset('storage/back/' . $article->img) }}" alt="" width="300px"></a>
                </td>
            </tr>
            <tr>
                <th>Views</th>
                <td>: {{ $article->views }}</td>
            </tr>
            <tr>
                <th>Status</th>
                
                <td>
                    @if ($article->status == 0)
                    <span class="badge bg-secondary">Draft</span>
                    @elseif ($article->status == 1)
                    <span class="badge bg-success">Publish</span>
                    @elseif ($article->status == 2)
                    <span class="badge bg-warning">Revisi</span>
                    @elseif ($article->status == 3)
                    <span class="badge bg-danger">Ditolak</span>
                    @elseif ($article->status == 4)
                    <span class="badge bg-info">Direvisi</span>
                    @else
                    <span class="badge bg-dark">Unknown</span>
                    @endif
                </td>
            </tr>
            <tr>
                <th>Publish Date</th>
                <td>: {{ $article->publish_date }}</td>
            </tr>
            <tr>
                <th>Writer</th>
                <td>: {{ $article->user->name }}</td>
            </tr>
            <tbody>

            </tbody>
        </table>
        <div class="float-end">
            <a href="{{ url('article') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>
</main>
@endsection