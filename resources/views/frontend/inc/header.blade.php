<header>
    <div class="container p-2">
        <div class="row">
            <div class="col-2 d-flex align-items-center justify-content-center d-md-none">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" width="30" height="30" focusable="false">
                    <title>Menu</title>
                    <path stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-miterlimit="10"
                        d="M4 7h22M4 15h22M4 23h22"></path>
                </svg>
            </div>
            <div class="col-10 col-md-12">
                <div class="header-right-main d-flex align-items-center justify-content-between">
                    <div class="header-right d-flex align-items-center">
                        <div class="header-logo">
                            <a href="">
                                <img src="{{ asset('frontend_assets/image/logo.png') }}" alt=""></a>
                        </div>
                        <ul class="header-ul d-none d-md-flex align-items-center mb-0">
                            <li><a href="#">Home</a></li>
                            <li class="parent-menu">
                                <a href="#">Categories</a>
                                <ul class="submenu">
                                    @foreach ($categories as $cat)
                                        <li><a href="/{{$cat->slug}}">{{$cat->name}}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                            <li><a href="#">About us</a></li>
                            <li><a href="#">Services</a></li>
                            <li><a href="#">Contact</a></li>
                        </ul>
                    </div>
                    <div class="d-none d-lg-block">
                        <div class="header-social">
                            <a href=""><i class="fa fa-facebook" aria-hidden="true"></i></a>
                            <a href=""><i class="fa fa-twitter" aria-hidden="true"></i></a>
                            <a href=""><i class="fa fa-instagram" aria-hidden="true"></i></a>
                            <a href=""><i class="fa fa-google-plus" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
