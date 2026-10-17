@extends('back.layout.template')

@section('title', 'Update Articles - Admin')

@section('content')
{{-- Content --}}
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Update Articles</h1>
    </div>

    <div class="mt-3">

        @if ($errors->any())
        <div class="my-3">
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif

        <form action="{{ url('article/' . $article->id) }}" method="post" enctype="multipart/form-data">
            @method('PUT')
            @csrf

            <input type="hidden" name="oldImg" value="{{ $article->img }}">

            <div class="row">
                <div class="col-6">
                    <div class="mb-3">
                        <label for="title">Title</label>
                        <input type="text" name="title" id="title" class="form-control"
                            value="{{ old('title', $article->title) }}" {{ auth()->user()->role == 1 ? 'readonly' : '' }}>
                        <!-- Hidden input agar data tetap terkirim jika field disabled -->
                        @if(auth()->user()->role == 1)
                        <input type="hidden" name="title" value="{{ $article->title }}">
                        @endif
                    </div>
                </div>
                <div class="col-6">
                    <div class="mb-3">
                        <label for="category_id">Category</label>
                        <select name="category_id" id="category_id" class="form-control"
                            {{ auth()->user()->role == 1 ? 'disabled' : '' }}>
                            @foreach ($categories as $item)
                            <option value="{{ $item->id }}"
                                {{ $item->id == $article->category_id ? 'selected' : '' }}>
                                {{ $item->name }}
                            </option>
                            @endforeach
                        </select>
                        <!-- Hidden input agar data tetap terkirim jika field disabled -->
                        @if(auth()->user()->role == 1)
                        <input type="hidden" name="category_id" value="{{ $article->category_id }}">
                        @endif
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="desc">Description</label>
                @if (auth()->user()->role == 1)
                <!-- Hapus tag HTML untuk admin -->
                <textarea name="desc" id="desc" cols="30" rows="10" class="form-control" readonly>{{ strip_tags($article->desc) }}</textarea>
                <!-- Hidden input agar data tetap terkirim -->
                <input type="hidden" name="desc" value="{{ $article->desc }}">
                @else
                <!-- CKEditor hanya aktif untuk role user -->
                <textarea name="desc" id="desc" cols="30" rows="10" class="form-control">{{ old('desc', $article->desc) }}</textarea>
                @endif
            </div>

            <div class="mb-3">
                <label for="img">Image (Max 2MB)</label>
                @if(auth()->user()->role == 1)
                <!-- Admin hanya melihat gambar, tidak bisa mengunggah -->
                <div class="mt-1">
                    <small>Gambar Sebelumnya</small><br>
                    <img src="{{ asset('storage/back/' . $article->img) }}" class="img-thumbnail img-preview" width="100px">
                </div>
                <input type="hidden" name="oldImg" value="{{ $article->img }}">

                @else
                <!-- User dapat mengunggah gambar -->
                <input type="file" name="img" id="img" class="form-control">
                <div class="mt-1">
                    <small>Gambar Sebelumnya</small><br>
                    <img src="{{ asset('storage/back/' . $article->img) }}" class="img-thumbnail img-preview" width="100px">
                </div>
                @endif
            </div>

            <div class="row">
                <div class="col-6">
                    <div class="mb-3">
                        <label for="status">Status</label>
                        @if (auth()->user()->role == 1)
                        <!-- Admin hanya bisa mengubah status -->
                        <select name="status" id="status" class="form-control">
                            <option value="" hidden>-- choose --</option>
                            <option value="0" {{ $article->status == 0 ? 'selected' : null }}>Draft</option>
                            <option value="1" {{ $article->status == 1 ? 'selected' : null }}>Publish</option>
                            <option value="2" {{ $article->status == 2 ? 'selected' : null }}>Revisi</option>
                            <option value="3" {{ $article->status == 3 ? 'selected' : null }}>Ditolak</option>
                        </select>
                        @else
                        <!-- User tetap bisa melihat status, tapi tidak bisa mengubah -->
                        <select name="status" id="status" class="form-control" disabled>
                            <option value="0" {{ $article->status == 0 ? 'selected' : null }}>Draft</option>
                            <option value="1" {{ $article->status == 1 ? 'selected' : null }}>Publish</option>
                            <option value="2" {{ $article->status == 2 ? 'selected' : null }}>Revisi</option>
                            <option value="3" {{ $article->status == 3 ? 'selected' : null }}>Ditolak</option>
                        </select>
                        <!-- Hidden input supaya status tetap terkirim -->
                        <input type="hidden" name="status" value="4">
                        @endif
                    </div>
                </div>

                <div class="col-6">
                    <div class="mb-3">
                        <label for="publish_date">
                            {{ auth()->user()->role == 1 ? 'Publish Date' : 'Upload Date' }}
                        </label>
                        <input type="text" class="form-control"
                            value="{{ old('publish_date', $article->publish_date ?? date('Y-m-d')) }}" disabled>
                        <!-- Hidden input agar data tetap terkirim -->
                        <input type="hidden" name="publish_date"
                            value="{{ old('publish_date', $article->publish_date ?? date('Y-m-d')) }}">
                    </div>
                </div>
            </div>

            <div class="float-end">
                <button type="submit" class="btn btn-success" {{ auth()->user()->role == 1 || auth()->user()->role == 2 ? '' : 'disabled' }}>Save</button>
            </div>

        </form>

    </div>
</main>
@endsection

@push('js')
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>
@if (auth()->user()->role != 1)
<script>
    ClassicEditor
        .create(document.querySelector('#desc'))
        .then(editor => {
            console.log(editor);
        })
        .catch(error => {
            console.error(error);
        });
</script>
@endif
@endpush