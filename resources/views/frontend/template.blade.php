<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
    integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/style.css') }}">
</head>

<body>
    <!-- header -->
    <header>
        <div class="container p-2">
            <div class="row">
                <div class="col-2 d-flex align-items-center justify-content-center d-md-none">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" width="30" height="30" focusable="false"><title>Menu</title><path stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-miterlimit="10" d="M4 7h22M4 15h22M4 23h22"></path></svg>
                </div>
                <div class="col-10 col-md-12">
                    <div class="header-right-main d-flex align-items-center justify-content-between">
                        <div class="header-right d-flex align-items-center">
                            <div class="header-logo">
                                <a href="">
                                    <img src="{{ asset('frontend_assets/image/logo.png') }}"
                                    alt=""></a>
                                </div>
                                <ul class="header-ul d-none d-md-flex align-items-center mb-0">
                                    <li><a href="">Home</a></li>
                                    <li><a href="">Categories</a></li>
                                    <li><a href="">About us</a></li>
                                    <li><a href="">Services</a></li>
                                    <li><a href="">Contact</a></li>
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


        <!-- banner -->

        <div id="banner" class="p-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 banner">
                        <div class="banner1">inspiring better health</div>
                        <div class="banner2">
                            <span><b>healthy heart</b><br>healthy family</span>
                            <p>Globally harness multimedia based collaboration and idea-sharing with backend products. Continually whiteboard superior opportunities via covalent scenarios.</p>
                        </div>
                        <div class="banner3">
                            <a class="btn-hkt" href="">discover more</a>
                            <a class="btn-hkt" href="">view our services</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- gioi thieu -->

        <div id="gioithieu" class="pt-3 pb-3">
            <div class="container gioithieu">
                <div class="row">
                    <div class="p-0 col-md-6 col-lg-3">
                        <div class="card">
                          <img src="{{ asset('frontend_assets/image/img-box-01.jpg') }}" class="card-img-top">
                          <div class="card-body hkt-bg-1">
                            <span class="style1">b better life</span>
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">
                                Some quick example text to build on the card title and make up the bulk of the card's content.
                            </p>
                            <a class="btn-hkt" href="">discover more</a>
                        </div>
                    </div>
                </div>


                <div class="p-0 col-md-6 col-lg-3">
                        <div class="card">
                          <img src="{{ asset('frontend_assets/image/img-box-02.jpg') }}" class="card-img-top">
                          <div class="card-body hkt-bg-2">
                            <span class="style1">b better life</span>
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">
                                Some quick example text to build on the card title and make up the bulk of the card's content.
                            </p>
                            <a class="btn-hkt" href="">discover more</a>
                        </div>
                    </div>
                </div>

                <div class="p-0 col-md-6 col-lg-3">
                        <div class="card">
                          <img src="{{ asset('frontend_assets/image/img-box-03.jpg') }}" class="card-img-top">
                          <div class="card-body hkt-bg-3">
                            <span class="style1">b better life</span>
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">
                                Some quick example text to build on the card title and make up the bulk of the card's content.
                            </p>
                            <a class="btn-hkt" href="">discover more</a>
                        </div>
                    </div>
                </div>

                <div class="p-0 col-md-6 col-lg-3">
                        <div class="card">
                          <img src="{{ asset('frontend_assets/image/img-box-04.jpg') }}" class="card-img-top">
                          <div class="card-body hkt-bg-4">
                            <span class="style1">b better life</span>
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">
                                Some quick example text to build on the card title and make up the bulk of the card's content.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- passion -->

    <div id="passion" class="pt-5 pb-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-3"></div>
                <div class="col-lg-9 passion-right">
                    <div class="hkt-style-1">
                        introducing our team
                    </div>
                    <div class="hkt-style-2">
                        <p><b>Great passion</b><br>for healing</p>
                    </div>
                    <p>
                        Some up and coming trends are healthcare consolidation for independent healthcare centers that see a cut in unforeseen payouts. High deductible health plans are also expected to transpire along with a growth of independent practices.
                    </p>
                    <div class="passion-sign d-flex justify-content-end align-items-center">
                        <div class="passion-sign-left">
                            <b>chase franklin</b><br>
                            <span>Fonder & CEO</span>
                        </div>
                        <div class="passion-sign-img ml-2">
                            <img src="{{ asset('frontend_assets/image/sign.png') }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
</script>

</html>
