@extends('templates.mosqueNavbar')

{{-- Tambahan Link Library lain pada head (umumnya css atau javascript library)--}}
@section('libsOnHeader')
    {{-- Trix Editior--}}
    <link rel="stylesheet" href="{{ asset('/assets/AdminLTE/plugins/trix-main/dist/trix.css') }}">
    <script type="text/javascript" src="{{ asset('/assets/AdminLTE/plugins/trix-main/dist/trix.js') }}"></script>

    {{-- Trix ToolBar CSS --}}
    <style>
        /* Menghilangkan button upload file pada text editor Trix */
        trix-toolbar [data-trix-button-group="file-tools"]{
            display:none;
        }
    </style>
@endsection

@section('contentHeader')
    <div class="container-fluid">
        <div class="row mb-2 mx-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Buat Artikel</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    {{-- <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard v1</li> --}}
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
@endsection

@section('mainContent')
    <!-- Main row -->
    <div class="row mx-2">
        <section class="col-lg-12 connectedSortable">
            <form action="/article" method="post">
                @csrf
                <div class="row">
                    <!-- Left col -->
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="title">Judul</label>
                                    <input type="text" class="form-control form-control-sm @error('title') is-invalid @enderror" id="title" name="title" value={{ old('title') }}>
                                
                                    {{-- Pesan Error --}}
                                    @error('title')
                                        <div id="" class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="slug">Slug</label>
                                    <input type="text" class="form-control form-control-sm" id="slug" name="slug" readonly value="{{ old('slug')}}" >
                                    <p style="font-size: 11px">Slug dibuat otomatis sesuai dengan Judul Artikel<p>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-0">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="categories">Kategori</label>
                                    <select class="custom-select custom-select-sm" id="category_id" name="category_id">
                                        @foreach ($categories as $cat)
                                            @if (old('category_id') == $cat->id)
                                                <option value="{{ $cat->id }}" selected>{{ $cat->category }}</option>                                                
                                            @else
                                                <option value="{{ $cat->id }}">{{ $cat->category }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Buat Artikel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.Left col -->

                    <!-- Right col -->
                    <div class="col-md-7 ml-4">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="body">Konten Artikel</label>
                                    <input id="body" type="hidden"  name="body" value="{{ old('body') }}">
                                    <trix-editor input="body"></trix-editor>

                                    {{-- Pesan Error --}}
                                    @error('body')
                                        <p class="text-danger" style="font-size: 13px">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.Right col -->
                </div>
            </form>
        </section>

    </div>
    <!-- /.row (main row) -->

    <script>
        // Proses membuat slug
        const title = document.getElementById('title');
        const slug  = document.getElementById('slug');

        title.addEventListener('change', function(){
            fetch('/article/create/checkSlug?title=' + title.value)
            .then(response=>response.json())
            .then(data=>slug.value = data.slug)
        });

        // Menonaktifkan tombol upload file pada text editor Trix
        document.addEventListener('trix-file-accept', function(e){
            e.preventDefault();
        });
    </script>
@endsection

{{-- Tambahan Link Library ke lain (umumnya javascript library)--}}
@section('libsOnFooter')

@endsection