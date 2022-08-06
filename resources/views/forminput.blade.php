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

<body>

    <div class="main">
        <section class="signup">
            <!-- <img src="images/signup-bg.jpg" alt=""> -->
            <div class="container">
                <div class="signup-content">
                    <form action="{{route('forminput.store')}}" method="POST" id="signup-form" class="signup-form" >
                        @csrf
                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <input type="text" class="form-input" name="email" id="email" required="required" />
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama Mahasiswa</label>
                            <input type="text" class="form-input" name="nama" id="nama" required="required" />
                        </div>
                        <div class="form-group">
                            <label for="nim">NIM</label>
                            <input type="text" class="form-input" name="nim" id="nim" required="required" />
                        </div>
                        <div class="form-group">
                            <label for="golongan">Golongan</label>
                            <input type="text" class="form-input" name="golongan" id="golongan" required="required" />
                        </div>
                        <div class="form-group">
                            <label for="matkul_id">Mata Kuliah</label>
                            @foreach($learning as $lr )
                            <input type="text" class="form-input" name="matkul_id"
                                value="{{ $learningclass::where('id',$lr->matkul_Id)->first()->mata_kuliah }}"
                                id="matkul_id" required="required" readonly>
                            @endforeach
                        </div>
                        <div class="form-group">
                            <label for="tanggal">Tanggal Perkuliahan</label>
                            <input type="datetime-local" class="form-input" name="tanggal" id="tanggal" required="required" />
                        </div>
                            @foreach($learning as $lr )
                            <input type="hidden" class="form-input" name="matkul_id"
                                value="{{$lr->id}}"
                                id="matkul_id" required="required" readonly>
                            @endforeach
                        <div class="form-group form-group-textarea mb-md-0">
                            <label for="jawaban">Jawaban</label>
                            <textarea type="text" class="form-input" aria-label="With textarea" name="jawaban"
                                id="jawaban" cols="75" rows="10" style="width:100%" placeholder="Masukkan Jawaban" required="required" ></textarea>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit" id="submit" class="form-submit" value="Kirim" />
                        </div>
                    </form>
                </div>
            </div>
        </section>

    </div>

    <!-- JS -->
    <script src="{{ asset ('assets2/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset ('assets2/vendor/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset ('assets2/vendor/jquery-validation/dist/jquery.validate.min.js') }}"></script>
    <script src="{{ asset ('assets2/vendor/jquery-validation/dist/additional-methods.min.js') }}"></script>
    <script src="{{ asset ('assets2/js/main.js') }}"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
