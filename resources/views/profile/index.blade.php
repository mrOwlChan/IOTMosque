@extends('templates.mosqueNavbar')

{{-- Tambahan Link Library ke lain (umumnya css atau javascript library)--}}
@section('libsOnHeader')
@endsection

@section('contentHeader')
    <div class="container-fluid">
        <div class="row mb-2 mx-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Profil Saya</h1>
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
    {{-- Jika pada session ada message 'success' dari proses update profile di ProfileController::update()  --}}
    @if (session()->has('success'))
    <div class="row mx-2">
        <div class="col-md-6">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    </div>
    @endif

    <div class="row mx-2">
        <!-- Left col -->
        <section class="col-lg-8 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card" style="height:400px">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="far fa-address-card my-2 mr-2"></i>
                        Data Pribadi
                    </h3>
                    <div class="card-tools">
                        <ul class="nav nav-pills ml-auto">
                            <li class="nav-item my-2">
                                <a href="/profile/{{ $user->id }}/edit" class="btn btn-warning btn-sm"><i class="fas fa-user-edit"></i> Edit</a>
                            </li>
                            <li class="nav-item my-2 ml-3">
                                <button type="button" class="btn btn-outline-danger btn-sm" id="" data-toggle="modal" data-target="#delAccount">
                                    <i class="fas fa-user-times"></i> Hapus Akun
                                </button>
                            </li>
                        </ul>
                    </div>
                </div><!-- /.card-header -->
                <div class="card-body py-3 px-3">
                    <div class="row">
                        {{-- Left Col --}}
                        <div class="col-md-6 border-info border-right">
                            <strong><i class="fas fa-user"></i> Nama</strong>
                            <p class="text-muted">
                                {{ $user->name }}
                            </p>

                            <strong><i class="fas fa-envelope"></i> Email</strong>
                            <p class="text-muted">
                                {{ $user->email }}
                            </p>

                            <strong><i class="fas fa-phone-square-alt"></i> Telepon</strong>
                            <p class="text-muted text-danger">
                                @if ($user->userdetail->telp == '')
                                    <span class="text-danger">
                                        Nomor telepon belum terisi
                                        <i class="fas fa-exclamation-circle"></i>   
                                    </span>
                                @else
                                    {{ $user->userdetail->telp}}
                                @endif
                            </p>

                            <strong><i class="fas fa-star"></i> Status</strong>
                            <p class="text-muted text-danger">
                                {{ $user->userdetail->userlevel->level}}
                            </p>

                        </div>{{-- /. Left Col --}}
                        {{-- Right Col --}}
                        <div class="col-md-6">
                            <strong><i class="fas fa-birthday-cake"></i> Tanggal Lahir</strong>
                            <p class="text-muted">
                                @if ($user->userdetail->birth == '')
                                    <span class="text-danger">
                                        Alamat Anda belum terisi
                                        <i class="fas fa-exclamation-circle"></i>   
                                    </span>
                                @else
                                    {{ $user->userdetail->birth->format('d/m/Y')}}
                                @endif
                            </p>

                            <strong><i class="fas fa-map-marked-alt"></i> Alamat</strong>
                            <p class="text-muted">
                                @if ($user->userdetail->address == '')
                                    <span class="text-danger">
                                        Alamat Anda belum terisi
                                        <i class="fas fa-exclamation-circle"></i>   
                                    </span>
                                @else
                                    {{ $user->userdetail->address}}
                                @endif
                            </p>
                        </div>
                        {{-- /. Right Col --}}
                    </div>
                </div><!-- /.card-body -->
            </div>
        </section>
        <!-- /.Left col -->

        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        <section class="col-lg-4 connectedSortable">
            <div class="card" style="height:400px">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-camera-retro my-2 mr-2"></i>
                        Photo Profil
                    </h3>
                </div><!-- /.card-header -->
                <div class="card-body">
                    <div class="tab-content p-3">
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="text-center">
                                    @if ($user->userdetail->photo == '')
                                        <img class="profile-user-img img-fluid img-circle" src="{{ asset('assets/images/icons/user.png') }}" alt="User profile picture" style="width:150px;height:150px">
                                    @else
                                        <img class="profile-user-img img-fluid img-circle" src="{{ asset('storage/'.$user->userdetail->photo) }}" alt="User profile picture" style="width:150px;height:150px">
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8 p-1">
                                <span class="text-primary">
                                    <i class="fas fa-info-circle"></i> Info:
                                </span>
                                <ul style="font-size:11px">
                                    <li>Upload Photo ukuran 160x160</li>
                                    <li>Pilihlah Photo yang baik dan sopan</li>
                                </ul>
                            </div>
                            <div class="col-md-4 my-auto text-center">
                                <button type="button" class="btn btn btn-warning btn-sm" data-toggle="modal" data-target="#editPhoto">
                                    <i class="fas fa-camera-retro"></i> Edit
                                </button>
                            </div>
                        </div>
                    </div>
                </div><!-- /.card-body -->
            </div>
        </section>
        <!-- right col -->
    </div>
    <!-- /.row (main row) -->

    <!-- Modal Edit Photo Profile-->
    <div class="modal fade" id="editPhoto" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-camera-retro"></i> Edit Photo Profil</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/profile/{{ $user->id }}/photo" method="post" enctype="multipart/form-data">
                    @method('patch')
                    @csrf
                    <div class="modal-body">  
                        <div class="row mb-3">
                            <div class="col-md-12 text-center">
                                @if ($user->userdetail->photo == '')
                                    <img  class="profile-user-img img-fluid img-circle img-preview" src="{{ asset('assets/images/icons/user.png') }}" style="width:250px;height:250px">
                                @else
                                    {{-- Photo sebelumnya --}}
                                    <input class="form-control" type="hidden" value="{{ $user->userdetail->photo }}" name='prevPhoto' id='prevPhoto'>
                                    
                                    {{-- Photo yang diupload untuk diedit  --}}
                                    <img class="profile-user-img img-fluid img-circle img-preview" src="{{ asset('storage/'. $user->userdetail->photo) }}" style="width:250px;height:250px">
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-8 p-1">
                                    <span class="text-primary">
                                        <i class="fas fa-info-circle"></i> Info:
                                    </span>
                                    <ul style="font-size:14px">
                                        <li>Upload Photo ukuran 160x160</li>
                                        <li>Pilihlah Photo yang baik dan sopan</li>
                                    </ul>
                                </div>
                            </div>a
                        </div>
                
                        <div class="row">
                            <div class="col-md-6 offset-md-3">
                                <div class="form-group text-center">
                                    <label for="inputPhoto" style="font-size:12px"><i class="fas fa-camera"></i> Photo 160x160p </label>
                                    <input type="file" class="form-control-file form-control-sm" name="photo" id="photo" onchange="previewImage()">
                                </div>
                            </div>      
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-file-upload"></i> Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal Hapus Akun --}}
    <div class="modal fade" id="delAccount" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger" id="exampleModalLabel"><i class="fas fa-exclamation-triangle"></i> Hapus Akun</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/profile/{{ $user->id }}" method="post">
                    @method('delete')
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <p>
                                    Menghapus Akun akan menghilangkan seluruh data Anda secara permanen! Data Akun yang sudah dihapus, tidak dapat di-recovery kembali!
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-7 offset-md-3">
                                <label for="level"><i class="fas fa-key"></i> Password</label>
                                <div class="form-group input-group">
                                    <input type="password" class="form-control form-control-sm" id="passwordDelAccount" name="passwordDelAccount">
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-outline-primary btn-sm " id="seePassword"><i class="fas fa-eye"></i></button>
                                    </div>
                                </div> 
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // preview gambar sebelum di submit
        function previewImage(){
            const image = document.querySelector("#photo");
            const imgPreview = document.querySelector('.img-preview');

            imgPreview.style.display ='block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent){
                imgPreview.src = oFREvent.target.result;
            }
        }

        // preview password
        $(document).ready(function(){
            $('#seePassword').on("click", function(){
                // Dapatkan nilai attribute elemet dengan selector '#password'
                var typeInput = document.querySelector('#passwordDelAccount').getAttribute("type");
                
                // Jika nilainya adalah 'password', maka rubah menjadi 'text'
                if(typeInput == 'password'){
                    $('#passwordDelAccount').attr('type', 'text');
                }

                // Jika nilainya adalah 'password', maka rubah menjadi 'text'
                if(typeInput == 'text'){
                    $('#passwordDelAccount').attr('type', 'password');
                }
            });
        });

    </script>
@endsection

{{-- Tambahan Link Library ke lain (umumnya javascript library)--}}
@section('libsOnFooter')
@endsection