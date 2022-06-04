@auth
    {{-- User telah sign-in / ter-authentifikasi --}}
    <ul class="navbar-nav ml-auto">
        {{-- Notifications Dropdown Menu --}}
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
                <span class="badge badge-danger navbar-badge">15</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header">15 Notifications</span>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-envelope mr-2"></i> 4 new messages
                    <span class="float-right text-muted text-sm">3 mins</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-users mr-2"></i> 8 friend requests
                    <span class="float-right text-muted text-sm">12 hours</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-file mr-2"></i> 3 new reports
                    <span class="float-right text-muted text-sm">2 days</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
            </div>
        </li>
        {{-- /Notifications Dropdown Menu --}}

        {{-- Menu User --}}
        <li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                <span class="d-none d-md-inline"><i class="far fa-user-circle fa-lg"></i> {{ auth()->user()->name}}</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <!-- User image -->
                <li class="user-header bg-primary">
                    @if (auth()->user()->userdetail->photo == '')
                        {{-- Jika user belum upload photo profil--}}
                        <img src="{{ asset('assets/images/icons/user.png')}}" class="img-circle elevation-2" alt="User Image">
                    @else
                        {{-- Jika user telah upload photo profil --}}
                        <img src="{{ asset('storage/'. auth()->user()->userdetail->photo) }}" class="img-circle elevation-2" alt="User Image">
                    @endif
                    <p>
                        {{ auth()->user()->name}} 
                        <small>{{ auth()->user()->email }}</small>
                    </p>
                </li>
                <!-- Menu Body -->
                <li class="user-body">
                    <div class="row">
                        {{-- Jika request selain url: /user --}}
                        @if (!(Request::is('user*')))
                            <div class="col-6 text-center">
                                <a href="/profile" class="btn btn-borderless btn-sm p-0 m-0">Profilku</a>
                            </div> 
                            <div class="col-6 text-center">
                                <a href="#" class="btn btn-borderless btn-sm p-0 m-0">Aktivitas</a>
                            </div>
                        
                        {{-- Jika url:/user --}}
                        @else
                            <div class="col-6 text-center">
                                <a href="/myprofile" class="btn btn-borderless btn-sm disabled p-0 m-0">My Profile</a>
                            </div> 
                            <div class="col-6 text-center">
                                <a href="#" class="btn btn-borderless btn-sm p-0 m-0">Performance</a>
                            </div>
                        @endif
                    </div><!-- /.row -->
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                    @if (Request::is('home*') || Request::is('/*'))
                        <a href="/dashboard" class="btn btn-outline-primary btn-sm "><span class="fas fa-bars"></span> Fasilitas Masjid</a>
                    @else
                        <a href="/dashboard" class="btn btn-outline-primary btn-sm disabled"><span class="fas fa-bars"></span> Fasilitas Masjid</a>
                    @endif
                    <form action="/signout" method="post" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger btn-sm float-right"><span class="fas fa-sign-out-alt"></span> Sign Out</button>
                    </form> 
                </li>
            </ul>
        </li>
        {{-- /Menu User --}}
    </ul>
    {{-- /User telah sign-in / ter-authentifikasi --}}
@else
    {{-- User belum sign-in atau guest --}}
    <ul class="navbar-nav ml-auto">
        <a class="btn btn-outline-success btn-sm" href="/signup"><span class="fas fa-user-plus"></span> Sign-Up</a>
        <a class="btn btn-outline-primary btn-sm ml-2" href="/signin"><span class="fas fa-sign-in-alt"></span> Sign-In</a>
    </ul>
    {{-- /User belum sign-in atau guest --}}
@endauth