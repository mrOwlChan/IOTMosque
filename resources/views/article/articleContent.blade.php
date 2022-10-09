@extends('templates.mosqueNavbar')

{{-- Tambahan Link Library ke lain (umumnya css atau javascript library)--}}
@section('libsOnHeader')
@endsection

@section('contentHeader')
    <div class="container-fluid">
        <div class="row mb-2 mx-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">{{ $article->title }}</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item my-1"><a href="/article"><i class="fas fa-undo mr-2"></i></a></li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
@endsection

@section('mainContent')
    <!-- Main row -->
    <div class="row mx-2">
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"><i class="far fa-newspaper mr-1"></i> Kategori:<a href="http://" class="ml-1">{{ $article->category->name }}</a></h4>
                    <div class="card-tools">
                        <ul class="nav nav-pills ml-auto">
                            <li class="nav-item mr-2">
                                <a class="btn btn-outline-primary btn-sm active" href="#article" data-toggle="tab"><i class="fas fa-book-reader mr-2"></i>Artikel</a>
                            </li>
                            <li class="nav-item mr-2">
                                <a class="btn btn-outline-primary btn-sm" href="#detail" data-toggle="tab"><i class="fas fa-info-circle"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <div class="tab-content p-0">
                        {{-- Artikel --}}
                        <div class="chart tab-pane active" id="article" style="position: relative">
                            <div class="mb-4">
                                @if ( $article->imagetitle == '')
                                    <img src="{{ asset('assets/images/imagetitle.png') }}" class="card-img-top mb-2" alt="imagetitle.png" style="height: 250px">
                                @else
                                    <img src="{{ asset('storage/'. auth()->user()) }}" class="card-img-top mb-2" alt="imagetitle.png" style="height: 250px">    
                                @endif
                            </div>
                            <div style="position: relative">
                                {!! $article->body !!}
                            </div>
                        </div>
                        {{-- /. Artikel --}}

                        {{-- Artikel --}}
                        <div class="chart tab-pane" id="detail" style="position: relative">

                        </div>
                        {{-- /. Artikel --}}                        
                    </div>
                </div>
                <!-- /.card-body -->
                {{-- <div class="card-footer">
                    Footer
                </div> --}}
                <!-- /.card-footer-->
            </div>
        </section>
        <!-- /.Left col -->
    </div>
    <!-- /.row (main row) -->

    <script>

    </script>
@endsection

{{-- Tambahan Link Library ke lain (umumnya javascript library)--}}
@section('libsOnFooter')
@endsection

