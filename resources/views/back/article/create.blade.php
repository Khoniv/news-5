@extends('back.layout.template')

@section('title', 'Create Articles - Admin')

@section('content')
{{-- Content --}}
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Create Articles</h1>

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

        <form action="{{ url('article') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-6">
                    <div class="mb-3">
                        <label for="title">Title</label>
                        <input type="text" name="title" id="title" class="form-control"
                            value="{{ old('title') }}">
                    </div>
                </div>
                <div class="col-6">
                    <div class="mb-3">
                        <label for="category_id">Category</label>
                        <select name="category_id" id="category_id" class="form-control">
                            <option value="" hidden>-- choose --</option>
                            @foreach ($categories as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="desc">Description</label>
                <textarea name="desc" id="desc" cols="30" rows="10" class="form-control"></textarea>
            </div>

            <div class="mb-3">
                <label for="desc">Image (Max 2MB)</label>
                <input type="file" name="img" id="img" class="form-control">

                <div class="mt-1">
                    <img src="" class="img-thumbnail img-preview" width="100px">
                </div>
            </div>

            <div class="row">
                <div class="col-6">
                    <div class="mb-3">
                        <label for="status">Status</label>
                        @if (auth()->user()->role == 1)
                        <select name="status" id="status" class="form-control">
                            <option value="" hidden>-- choose --</option>
                            <option value="1">Publish</option>
                            <option value="0">Draft</option>
                        </select>
                        @else
                        <select name="status" id="status" class="form-control" disabled>
                            <option value="0" selected>Draft</option>
                        </select>
                        <!-- Hidden input untuk memastikan nilai 'Draft' tetap terkirim -->
                        <input type="hidden" name="status" value="0">
                        @endif
                    </div>
                </div>


                <div class="col-6">
                    <div class="mb-3">
                        <label for="publish_date">
                            {{ auth()->user()->role == 1 ? 'Publish Date' : 'Upload Date' }}
                        </label>
                        <input type="text" class="form-control" value="{{ date('Y-m-d') }}" disabled>
                        <!-- Hidden input supaya data tanggal tetap tersimpan -->
                        <input type="hidden" name="publish_date" value="{{ date('Y-m-d') }}">
                    </div>
                </div>

            </div>

            <div class="float-end">
                <button type="submit" class="btn btn-success">Save</button>
            </div>
        </form>
    </div>
</main>
@endsection

@push('js')
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>

<script>
    // img preview
    $("#img").change(function() {
        previewImage(this);
    });

    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('.img-preview').attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

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
@endpush