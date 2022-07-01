@extends('template_admin.home')
@php
$title = "[ADMIN] Skripsi";
@endphp
@section('content')
@section('model')


<!-- Main Content -->
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                    <i class="fas fa-book-open-reader"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Mata Kuliah</h4>
                        </div>
                        <div class="card-body">
                            {{$matkul->count()}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="fas fa-book"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Learning Jurnal</h4>
                        </div>
                        <div class="card-body">
                        {{$learning->count()}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                    <i class="fas fa-file"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Data Jawaban</h4>
                        </div>
                        <div class="card-body">
                        {{$jawaban->count()}}
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>





@include('template_admin.footer')
@endsection
@endsection
