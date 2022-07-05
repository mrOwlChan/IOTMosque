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
                            <div class="table-responsive">
                                <table id="article_tb" class="table table table-borderless table-hover">
                                    <thead style="width:100%">
                                        <tr class="text-right" style="width:100%">
                                            <th>Urutan Artikel</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($articles as $article)
                                            <tr>
                                                <td>
                                                    <div class="post">
                                                        <h4 class="mb-1"><a href="#">{{ $article->title }}</a></h1>
                                                        @if ($article->subtitle != '')
                                                            <h6>{{ $article->subtitle }}</h6>
                                                        @endif
                                                        <p class="text-sm mb-2">Kategori Artikel: <a href="#">{{ $article->category }}</a></p>
                                                        <p>
                                                            {{ $article->excerpt }}
                                                            <a href="#" class="text-sm ml-2"><i class="fab fa-readme mr-1"></i> Baca Selanjutnya...</a>
                                                        </p>
                                                        <div class="text-sm mb-0">Penulis: {{ $article->writer }}</div>
                                                        <div class="text-sm mb-2">Publish: {{ $article->publish_at }}</div>
                                                    </div>
                                                    <hr>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>{{-- /.resume artikel --}}
                        {{-- detail artikel --}}
                        <div class="chart tab-pane" id="detail_list" style="position: relative">
                            <div class="table-responsive">
                                <table id="articleDetail_tb" class="table table-border table-hover" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Judul</th>
                                            <th>Subjudul</th>
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
                                                <th scope="row"><a href="">{{ $article->subtitle }}</a></td>
                                                <th scope="row"><a href="">{{ $article->category }}</a></td>
                                                <th scope="row">{{ $article->publish_at }}</td>
                                                <th scope="row">{{ $article->admin_nm }}</td>
                                                <th scope="row">{{ $article->writer }}</td>
                                                <th scope="row">
                                                    <button type="button" class="btn btn-outline-primary btn-xs"><i class="fab fa-readme"></i></button>
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
            $('#article_tb').DataTable({
                "paging": true,
                "lengthChange": true,
                "lengthMenu": [5, 10, 20, 50, 100, 200, 500],
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": true,
                "responsive": false
                // "scrollY": 200,
                // "scrollX": true
            });
        });

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