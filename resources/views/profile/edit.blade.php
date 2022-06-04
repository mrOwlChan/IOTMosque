@extends('templates.mosqueNavbar')

{{-- Tambahan Link Library ke lain (umumnya css atau javascript library)--}}
@section('libsOnHeader')
@endsection

@section('contentHeader')
    <div class="container-fluid">
        <div class="row mb-2 mx-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Edit Profil</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/profile"><i class="fas fa-undo"></i> Home</a></li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
@endsection

@section('mainContent')
    <!-- Main row -->
    <div class="row mx-2">
        <!-- Left col -->
        <section class="col-lg-11 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card" >
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="far fa-address-card my-2 mr-2"></i>
                        Data Pribadi
                    </h3>
                    <div class="card-tools">
                        <ul class="nav nav-pills ml-auto">
                            <li class="nav-item my-2">

                            </li>
                        </ul>
                    </div>
                </div><!-- /.card-header -->
                <div class="card-body py-3 px-3">
                    <form action="/profile/{{ $user->id }}" method="post">
                        @method('patch')
                        @csrf
                        <div class="row">
                            {{-- Left Col --}}
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="name"><i class="fas fa-user"></i> Name</label>
                                            <input type="text" class="form-control form-control-sm @error('name') is-invalid @enderror" id="name" name="name" value="{{ $user->name, old('name') }}">
                                            @error('name')
                                                <div id="" class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
    
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="email"><i class="fas fa-envelope"></i> Email</label>
                                            <input type="email" class="form-control form-control-sm @error('email') is-invalid @enderror" id="email" name="email" value="{{ $user->email, old('email') }}" aria-describedby="emailHelp">
                                            @error('email')
                                                <div id="" class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
    
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="telp"><i class="fas fa-phone-square-alt"></i> Telepon</label>
                                            <input type="text" class="form-control form-control-sm @error('telp') is-nvalid @enderror" id="telp" name="telp" value="{{ $user->userdetail->telp, old('telp') }}">
                                            @error('telp')
                                                <div id="" class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
    
                                <div class="row">
                                    <div class="col-md-8">
                                        <label for="level"><i class="fas fa-key"></i> Password</label>
                                        <div class="form-group input-group">
                                            <input type="password" class="form-control form-control-sm" id="password" name="password">
                                            <div class="input-group-append">
                                                <button type="button" class="btn btn-outline-primary btn-sm " id="seePassword"><i class="fas fa-eye"></i></button>
                                            </div>
                                        </div>                           
                                    </div>
                                </div>
                            </div>{{-- /. Left Col --}}
                            {{-- Right Col --}}
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="birth"><i class="fas fa-birthday-cake"></i> Tanggal Lahir</label>
                                            <input type="date" class="form-control form-control-sm @error('birth') is-invalid @enderror" id="birth" name="birth" value="{{ $user->userdetail->birth->format('Y-m-d'), old('birth') }}">
                                            @error('birth')
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
                                            <label for="address"><i class="fas fa-map-marked-alt"></i> Alamat</label>
                                            <textarea type="text" class="form-control form-control-sm @error('address') is-invalid @enderror" id="address" name="address" rows="5">{{ $user->userdetail->address, old('address') }}</textarea>
                                            @error('address')
                                                <div id="" class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- /. Right Col --}}
                        </div>
                        <div class="row">
                            <div class="col-md-2  offset-md-10 mt-3 text-right">
                                <button type="reset" class="btn btn-danger btn-sm">Batal</button>
                                <button type="submit" class="btn btn-success btn-sm">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div><!-- /.card-body -->
            </div>
        </section>
        <!-- /.Left col -->
    </div>
    <!-- /.row (main row) -->

    {{--  --}}
    <script>
        $(document).ready(function(){
            $('#seePassword').on("click", function(){
                // Dapatkan nilai attribute elemet dengan selector '#password'
                var typeInput = document.querySelector('#password').getAttribute("type");
                
                // Jika nilainya adalah 'password', maka rubah menjadi 'text'
                if(typeInput == 'password'){
                    $('#password').attr('type', 'text');
                }

                // Jika nilainya adalah 'password', maka rubah menjadi 'text'
                if(typeInput == 'text'){
                    $('#password').attr('type', 'password');
                }
            });
        });
    </script>
@endsection

{{-- Tambahan Link Library ke lain (umumnya javascript library)--}}
@section('libsOnFooter')
@endsection