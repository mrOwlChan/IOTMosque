@extends('templates.mosqueNavbar')

{{-- Tambahan Link Library ke lain (umumnya css atau javascript library)--}}
@section('libsOnHeader')
    <!-- DataTables -->
    <link rel="stylesheet" href="assets/AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="assets/AdminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">

    <style>
        .table.dataTable th {
            font-family: Verdana;
            font-size: 12px;
        }
    </style>
@endsection

@section('contentHeader')
    <div class="container-fluid">
        <div class="row mb-2 mx-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Artikel Dakwah</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/article"><i class="fas fa-undo pt-2"></i></a></li>
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
                    <h3 class="card-title"><i class="far fa-newspaper mr-1"></i> Daftar Artikel</h3>
                    <div class="card-tools">
                        <ul class="nav nav-pills ml-auto">
                            <li class="nav-item mr-2">
                                <a class="btn btn-outline-primary btn-sm active" href="#resume_list" data-toggle="tab">Resume</a>
                            </li>
                            <li class="nav-item">
                                <a class="btn btn-outline-primary btn-sm" href="#detail_list" data-toggle="tab">Detail</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <div class="tab-content p-0">
                        {{-- resume artikel --}}
                        <div class="chart tab-pane active" id="resume_list" style="position: relative">
                            {{-- search --}}
                            <div class="row mb-4">
                                <div class="col-md-6 mx-auto">
                                    <form action="/article" method="get">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control form-control-sm" placeholder="Cari Judul, Kategori, dan Penulis Artikel" name="search" value="{{ request('search') }}">
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-primary btn-sm" type="submit" name="searchBtn"><i class="fas fa-search mr-1"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>{{-- /. search --}}
                            @if ($articles->count()) 
                                <div class="row">
                                    @foreach ($articles as $article)
                                        <div class="col-md-4">
                                            <div class="card" >
                                                <div class="position-absolute px-3 py-2" style="background-color: rgba(0, 0, 0, 0.7)"><a href="http://" class="text-white text-decoration-none">{{ $article->cat_name }}</a></div>
                                                @if ( $article->imagetitle == '')
                                                    <img src="{{ asset('assets/images/imagetitle.png') }}" class="card-img-top mb-2" alt="imagetitle.png" style="height: 250px">
                                                @else
                                                    <img src="{{ asset('storage/'. auth()->user()) }}" class="card-img-top mb-2" alt="imagetitle.png" style="height: 250px">    
                                                @endif
                                                <div class="card-body">
                                                    <h4 class="mb-3"><a href="/article/{{ $article->id }}">{{ $article->title }}</a></h1>
                                                    <p class="card-text mb-1">
                                                        {{ $article->excerpt }}
                                                    </p>
                                                    <p class="card-text">
                                                        <a href="/article/{{ $article->id }}" class="text-sm"><i class="fab fa-readme mr-1"></i>Baca Selanjutnya...</a>
                                                    </p>
                                                    <div class="text-sm mb-0">Penulis: {{ $article->writer }}</div>
                                                    <div class="text-sm mb-2">Publish: {{ Carbon\Carbon::parse($article->publish_at)->diffForHumans() }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center">
                                    <i class="fas fa-grin-beam-sweat fa-5x mx-auto mb-2"></i>
                                    <p class="text-center fs-4 mx-auto">Artikel Tidak Ada!!!</p>
                                </div>
                            @endif
                            {{-- Panel Pagination --}}
                            <div class="d-flex justify-content-center">
                                {{-- Untuk link pagination --}}
                                {{ $articles->links() }}
                            </div>{{-- /. Panel Pagination --}}
                        </div>
                        {{-- /.resume artikel --}}

                        {{-- detail artikel --}}
                        <div class="chart tab-pane" id="detail_list" style="position: relative">
                            <div class="table-responsive">
                                <table id="articleDetail_tb" class="table table-border table-hover" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Judul</th>
                                            <th style="width: 10%">Kategori</th>
                                            <th>Wkt Posting</th>
                                            <th>Penerbit</th>
                                            <th>Penulis</th>
                                            <th class="text-center" style="width: 10%"><i class="fas fa-cog"></i></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($articles as $article)
                                            <tr>
                                                <th scope="row">{{ $loop->iteration }}</td>
                                                <th scope="row"><a href="">{{ $article->title }}</a></td>
                                                <th scope="row"><a href="/article/search/{{ $article->id }}">{{ $article->cat_name }}</a></td>
                                                <th scope="row">{{ $article->publish_at }}</td>
                                                <th scope="row">{{ $article->admin_nm }}</td>
                                                <th scope="row">{{ $article->writer }}</td>
                                                <th scope="row">
                                                    <a href="/article/{{ $article->id }}" class="btn btn-outline-primary btn-xs"><i class="fab fa-readme"></i></a>
                                                    <button type="button" class="btn btn-outline-danger btn-xs"><i class="fas fa-exclamation-circle"></i></button>
                                                </td>
                                            </tr>                                    
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>{{-- /.detail artikel --}}
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
        // dataTable
        $(function () {
            $('#articleDetail_tb').DataTable({
                "paging": true,
                "lengthChange": true,
                "lengthMenu": [5, 10, 20, 50, 100, 200, 500],
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": false
                // "scrollY": 200,
                // "scrollX": true
            });
        });

    </script>
@endsection

{{-- Tambahan Link Library ke lain (umumnya javascript library)--}}
@section('libsOnFooter')
    <!-- DataTables -->
    <script src="assets/AdminLTE/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="assets/AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="assets/AdminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="assets/AdminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
@endsection