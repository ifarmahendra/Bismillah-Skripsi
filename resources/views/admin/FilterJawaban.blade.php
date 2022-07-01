@extends('template_admin.home')
@section('halaman','Filter Data Jawaban')
@section('content')
@section('model')


<!-- Start Content-->
<div class="container-fluid">

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <p class="text-muted font-14 mb-3">
                        <!-- All Internship Users -->
                    </p>
                    <section class="section">
                        <form method="POST" action="{{route('filterjawaban.store')}}">
                        @csrf
                            <div class="form-group">
                                <label>Tanggal</label>
                                <input type="date" name="tanggal" class="form-control" required>

                            </div>
                            <div class="form-group">
                                <label>Mata Kuliah</label>
                                <input type="text" name="matkul" class="form-control"  required>
                            </div>

                            <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-eye"></i>
                                Tampilkan</button>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->

    
</div> <!-- container-fluid -->
@include('template_admin.footer')
@endsection
@section('js-table')



@endsection
