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
                                <input type="text" name="matkul" class="form-control" required>
                            </div>

                            <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-eye"></i>
                                Tampilkan</button>
                        </form>
                        <hr>
                    </section>
                    <div class="btn-group">
                        <a class="btn btn-sm btn-success" target="_blank" href="/formjawaban/cetak_pdf">
                            <i class="fa fa-print"> Cetak Nilai</i></a>
                    </div>
                    <div class="d-flex justify-content-end mb-5 " style="float:right;">
                        <a href="javascript:location.reload()" class="btn btn-sm btn-primary "><i class=""></i>Refresh
                            Hasil</a>
                    </div>
                    <h6 class="mt-4" size="3" color="red">Konversi Nilai : A = 81-100, AB = 76-80, B = 71-75, BC =
                        66-70, C = 56-65, D = 46-55, E = 0-45</h6>
                    <div class="table-responsive">

                        @if(count($filter) == 0)
                        <div class="alert alert-danger" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            Tidak ada data, silahkan pilih tanggal lain
                        </div>
                        @endif
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="table">
                                    <thead>
                                        <tr>
                                            <th class="text-center">
                                                <div class="custom-checkbox custom-control">
                                                    <input type="checkbox" data-checkboxes="mygroup"
                                                        data-checkbox-role="dad" class="custom-control-input"
                                                        id="checkbox-all">
                                                    <label for="checkbox-all"
                                                        class="custom-control-label">&nbsp;</label>
                                                </div>
                                            </th>
                                            <th>Nama Mahasiswa</th>
                                            <th>Golongan</th>
                                            <th>Tanggal Perkuliahan</th>
                                            <th>Nilai</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($filter as $dt )
                                        <tr>
                                            <td class="text-center">
                                                <div class="custom-checkbox custom-control">
                                                    <input type="checkbox" data-checkboxes="mygroup"
                                                        class="custom-control-input" id="checkbox-1">
                                                    <label for="checkbox-1"
                                                        class="custom-control-label">&nbsp;</label>
                                                </div>
                                            </td>
                                            <td id="nama-{{$dt->id}}">{{$dt->nama}}</td>
                                            <td id="golongan-{{$dt->id}}">{{$dt->golongan}}</td>
                                            <td id="tanggal-{{$dt->id}}">
                                                {{date_format(date_create($dt->tanggal), 'd-M-Y H:i T')}}</td>
                                            <td id="nilai-{{$dt->id}}">
                                                @php
                                                $nilai = round($new::where('formjawaban_id', $dt->id)->first()->nilai_cosine,2)*100
                                                @endphp
                                                @if ($nilai >= 81)
                                                A
                                                @elseif ($nilai >= 76 AND $nilai <= 80) 
                                                AB 
                                                @elseif ($nilai>= 71 AND $nilai <= 75) 
                                                B 
                                                @elseif ($nilai>= 66 AND $nilai <= 70) 
                                                BC 
                                                @elseif ($nilai>= 56 AND $nilai <= 65) 
                                                C 
                                                @elseif ($nilai>= 46 AND $nilai <= 55) 
                                                D 
                                                @elseif ($nilai>= 0 AND $nilai <= 45) 
                                                E
                                                @else Nilai Masih Diproses 
                                                @endif </td> 
                                            <td> 
                                                <a href="{{ route('filterjawaban.edit', ['filterjawaban' => $dt->id]) }}" class="btn btn-xs btn-primary">Detail</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end row -->
</div> <!-- container-fluid -->

@include('template_admin.footer')
    <script>
        // $(document).ready(function () {
        //     $('#table-1').DataTable();
        // });
        $("#table").dataTable({
            "columnDefs": [
                { "sortable": false, "targets": [2] }
            ],
            "pageLength":5
        });
    </script>
@endsection
@section('js-table')

@endsection
