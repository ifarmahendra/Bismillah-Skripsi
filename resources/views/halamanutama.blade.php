<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- ===============================================-->
    <!--    Document Title-->
    <!-- ===============================================-->
    <title>Halaman User </title>
    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset ('https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css') }}" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset ('https://use.fontawesome.com/releases/v5.7.2/css/all.css') }}" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">


    <!-- ===============================================-->
    <!--    Favicons-->
    <!-- ===============================================-->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset ('assets3/assets/img/favicons/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset ('assets3/assets/img/favicons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset ('assets3/assets/img/favicons/favicon-16x16.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset ('assets3/assets/img/favicons/favicon.ico') }}">
    <link rel="manifest" href="{{ asset ('assets3/assets/img/favicons/manifest.json') }}">
    <meta name="msapplication-TileImage" content="{{ asset ('assets3/assets/img/favicons/mstile-150x150.png') }}">
    <meta name="theme-color" content="#ffffff">


    <!-- ===============================================-->
    <!--    Stylesheets-->
    <!-- ===============================================-->
    <link href="{{ asset ('assets3/assets/css/theme.css') }}" rel="stylesheet" />

</head>


<body>

    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main" id="top">
        <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" data-navbar-on-scroll="data-navbar-on-scroll">
            <div class="container"><a class="navbar-brand" href="#"><img class="img-fluid" src="{{ asset ('assets3/assets/img/icons/logo.png') }}" alt="" /></a>
                <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation"><span
                        class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto ms-lg-4 ms-xl-7 border-bottom border-lg-bottom-0 pt-2 pt-lg-0">
                    </ul>
                    <form class="d-flex py-3 py-lg-0"><a class="btn btn-light rounded-pill shadow fw-bold" href="{{ route('login') }}"
                            role="button">Login Admin
                            <svg class="bi bi-arrow-right" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                fill="#9C69E2" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z">
                                </path>
                            </svg></a></form>
                </div>
            </div>
        </nav>

        <!-- ============================================-->
        <!-- <section> begin ============================-->
        <section class="py-5">

            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-5 col-lg-7 order-md-1 pt-8"><img class="img-fluid" src="{{ asset ('assets3/assets/img/illustrations/hero-header.png') }}" alt="" /></div>
                    <div class="col-md-7 col-lg-5 text-center text-md-start pt-5 pt-md-9">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {!!session('success')!!}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif
                            @if (session('error'))
                            <div class="alert alert-danger" role="alert">
                                {!!session('error')!!}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif
                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <h1 class="mb-4 display-2 fw-bold">Hai<br
                                class="d-block d-lg-none d-xl-block" />Selamat Datang</h1>
                        <p class="mt-3 mb-4">1. Silahkan mengisi Learning Journal sesuai dengan identitas diri dan silahkan menjawab pertanyaan yang ada
                            (maksimal 250 kata) 
                            <br />2. Ketika mengisi akan dianggap hadir dalam perkuliahan
                            <br />3. Silahkan klik button Lanjut ketika Learning Journal sudah tersedia
                            @if(count($notification) > 0)
                            <h4 class="mb-2 ">Silahkan mengisi Learning Journal</h4>
                        </p><a class="btn btn-lg btn-info rounded-pill" href="{{route('forminput.index')}}" role="button">Lanjut</a>
                            @else
                            <h4 class="mb-2 ">Learning Journal Belum Tersedia Saat Ini</h4>
                            @endif
                    </div>
                </div>
            </div>
            <!-- end of .container-->

        </section>


    </main>
    <!-- ===============================================-->
    <!--    End of Main Content-->
    <!-- ===============================================-->




    <!-- ===============================================-->
    <!--    JavaScripts-->
    <!-- ===============================================-->
    <script src="{{ asset ('assets3/vendors/@popperjs/popper.min.js') }}"></script>
    <script src="{{ asset ('assets3/vendors/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset ('assets3/vendors/is/is.min.js') }}"></script>
    <script src="{{ asset ('assets3/https://polyfill.io/v3/polyfill.min.js?features=window.scroll') }}"></script>
    <script src="{{ asset ('assets3/assets/js/theme.js') }}"></script>

    <link
        href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,300;0,400;0,700;0,900;1,300;1,700;1,900&amp;display=swap"
        rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
