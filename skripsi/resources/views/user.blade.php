<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Halaman User</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="{{ asset ('assets2/fonts/material-icon/css/material-design-iconic-font.min.css') }}">
    <link rel="stylesheet" href="{{ asset ('assets2/vendor/jquery-ui/jquery-ui.min.css') }}">

    <!-- Main css -->
    <link rel="stylesheet" href="{{ asset ('assets2/css/style.css') }}">
</head>

<div class="container-fluid h-custom">
    <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="text-center">
            <div class="card-header" style="float:middle;">
                <h1>Selamat Datang Di Learning Journal TIF</h1>
            </div>
        </div>
        <div class="col-md-9 col-lg-6 col-xl-5">
            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp"
                class="img-fluid" alt="Sample image">
        </div>
        <div class="col-md-4 col-lg-6 col-xl-4 offset-xl-1">
            <form>
                <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start">
                    <blockquote class="blockquote mb-0">
                        <p>1. Isi dengan informasi identitas, matakuliah, dan apa yang sudah anda pelajari
                            saat
                            selesai mengikuti perkuliahan di setiap minggunya.
                            (maksimal 250 kata)</p>
                        <p>2. Ketika mengisi akan dianggap hadir dalam perkuliahan</p>
                        <p>3. Hanya diperbolehkan mengisi saat hari perkuliahan yang sama</p>
                        {{count($notification)}}
                        @if(count($notification) > 0)
                        <p>Silahkan mengisi Learning Journal <a href="{{route('forminput.index')}}"
                                class="btn btn-primary">Klik Disini</a></p>
                        @else
                        <p>Belum ada soal untuk saat ini</p>
                        @endif
                    </blockquote>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- JS -->
<script src="{{ asset ('assets2/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset ('assets2/vendor/jquery-ui/jquery-ui.min.js') }}"></script>
<script src="{{ asset ('assets2/vendor/jquery-validation/dist/jquery.validate.min.js') }}"></script>
<script src="{{ asset ('assets2/vendor/jquery-validation/dist/additional-methods.min.js') }}"></script>
<script src="{{ asset ('assets2/js/main.js') }}"></script>

</html>
