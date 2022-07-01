<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Bismillah &mdash; Skripsi</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset ('https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css') }}" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset ('https://use.fontawesome.com/releases/v5.7.2/css/all.css') }}" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset ('/assets/fontawesome/css/all.css') }}" />

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="{{ asset ('/assets/modules/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset ('/assets/modules/fontawesome/css/all.min.css') }}">

 
    <!-- CSS Libraries -->
    <!-- <link rel="stylesheet" href="{{ asset ('/node_modules/prismjs/themes/prism.css') }}">
    <link rel="stylesheet" href="{{ asset ('/node_modules/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset ('/node_modules/weathericons/css/weather-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset ('/node_modules/weathericons/css/weather-icons-wind.min.css') }}">
    <link rel="stylesheet" href="{{ asset ('/node_modules/summernote/dist/summernote-bs4.css') }}"> -->

      <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset ('/assets/modules/datatables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset ('/assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset ('/assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css') }}">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset ('/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset ('/assets/css/components.css') }}">
    <!-- General CSS Files -->
<link rel="stylesheet" href="/assets/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="/assets/modules/fontawesome/css/all.min.css">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="/assets/modules/datatables/datatables.min.css">
  <link rel="stylesheet" href="/assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="/assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css">

  <!-- Template CSS -->
  <link rel="stylesheet" href="/assets/css/style.css">
  <link rel="stylesheet" href="/assets/css/components.css">

    
</head>

<body>
    <div id="app">
        <div class="main-wrapper">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <form class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i
                                    class="fas fa-bars"></i></a></li>
                        <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i
                                    class="fas fa-search"></i></a></li>
                    </ul>
                </form>
                <ul class="navbar-nav navbar-right">
                    <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link  nav-link-lg nav-link-user">
                            <div class="d-sm-none d-lg-inline-block">Hi, {{ Auth::user()->name }}</div>
                        </a>
                    </li>
                </ul>
            </nav>
            @include('template_admin.sidebar')
            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="section-header">
                        <h1>@yield('halaman')</h1>
                    </div>
                    @yield('content')
                    <div class="section-body">
                    </div>
                </section>
                @yield('model')
            </div>
