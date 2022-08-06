@extends('template_admin.home')
@php
$title = "[ADMIN] Skripsi";
@endphp
@section('content')
@section('model')


<!-- Start Content-->
<div class="container-fluid">

    <div class="row">
        <div class="col-12">
            <div class="card">
                <form class="needs-validation" novalidate="">
                    <div class="card-header">
                        <h4>Detail Jawaban</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" name="nama_mahasiswa" class="form-control" value="{{$filter->nama}}"
                                readonly>
                        </div>
                        <div class="form-group">
                            <label>Golongan</label>
                            <input type="text" class="form-control" value="{{$filter->golongan}}" readonly>
                        </div>
                        <div class="form-group">
                            <label>Mata Kuliah</label>
                            <input type="text" class="form-control" value="{{$filter->matkul_id}}" readonly>
                        </div>
                        <div class="form-group">
                            <label>Tanggal Perkuliahan</label>
                            <input type="text" class="form-control"
                                value="{{date_format(date_create($filter->tanggal), 'd-M-Y H:i T')}}" readonly>
                        </div>
                        <div class="form-group mb-0">
                            <label>Jawaban</label>
                            <textarea class="form-input" aria-label="With textarea" cols="127" rows="10" style="width:100%"
                                readonly> {{$new::where('formjawaban_id', $filter->id)->first()->hasil_processing ?? '-' }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Nilai Angka</label>
                            <input type="text" class="form-control" value="{{round($new::where('formjawaban_id', $filter->id)->first()->nilai_cosine ?? 0,2)*100}}" readonly>
                        </div>
                        <div class="form-group">
                            <label>Nilai Huruf</label>
                            <input type="text" class="form-control" value=" @php $nilai =  round($new::where('formjawaban_id', $filter->id)->first()->nilai_cosine ?? 0,2)*100 @endphp @if ($nilai >= 81) A 
                            @elseif ($nilai >= 76 AND $nilai <= 80) AB 
                            @elseif ($nilai >= 71 AND $nilai <= 75) B
                            @elseif ($nilai >= 66 AND $nilai <= 70) BC 
                            @elseif ($nilai >= 56 AND $nilai <= 65) C 
                            @elseif ($nilai >= 46 AND $nilai <= 55) D 
                            @elseif ($nilai >= 0 AND $nilai <= 45) E
                            @else Nilai Masih Diproses @endif" readonly>
                        </div>
                    </div>
                    <!-- <div class="card-footer text-right">
                    <a href="{{ redirect()->back() }}" class="btn btn-xs btn-primary">Kembali</a>
                    </div> -->
                </form>
            </div>
        </div>
    </div>
</div> <!-- container-fluid -->

@include('template_admin.footer')
@endsection
@section('js-table')



@endsection
