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
                <div class="card-body">
                    <h4 class="mt-0 header-title">Penilaian</h4>
                    <p class="text-muted font-14 mb-3">
                        <!-- All Internship Users -->
                    </p>
                    <div class="table-responsive">
                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap">
                            <thead>
                                <tr>
                                    <th>Nama Mahasiswa</th>
                                    <th>Golongan</th>
                                    <th>Mata Kuliah</th>
                                    <th>Kunci Jawaban</th>
                                    <th>Jawaban Mahasiswa</th>
                                </tr>
                            </thead>
                            <tbody>
                            @php
                            $count = 0;
                            @endphp
                                @foreach($nama as $nama)
                                <tr style="">
                                <td>
                                    {{$nama}}
                                </td>
                                <td>
                                    {{$kelas[$count]}}
                                </td>
                                <td>
                                    {{$matkul[$count]}}
                                </td>
                                    <td>
                                        @foreach($dataJawabanKunci[$count] as $jknc)
                                        {{$jknc}},
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach($dataJawabanMhs[$count] as $jmhs)
                                        {{$jmhs}},
                                        @endforeach
                                    </td>
                                </tr>
                                @php
                                $count + 1;
                                @endphp
                                @endforeach
                            </tbody>
                    </div>
                    </table>
                </div>
            </div>
            <div class="d-flex justify-content-end mb-3 mr-3" >
                <a href="#" class="btn btn-sm btn-primary " ><i class=""></i>Lanjut Penilaian</a>
            </div>
        </div>
    </div>
</div> <!-- container-fluid -->
@endsection
@section('js-table')














@endsection
