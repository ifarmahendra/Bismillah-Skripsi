@extends('template_admin.home')
@section('halaman','Data Jawaban')
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
                    @if (session('success'))
                    <br>
                    <div class="alert alert-success mt-4" role="alert" id="hilang">
                        {!!session('success')!!}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"
                            onclick="document.getElementById('hilang').style.display = 'none';">
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
                    <!-- Standard modal add -->

                    <!-- Standard modal update -->
                    <!-- /.modal -->
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
                                                <label for="checkbox-all" class="custom-control-label">&nbsp;</label>
                                            </div>
                                        </th>
                                        <th>Nama Mahasiswa</th>
                                        <th>Email</th>
                                        <th>NIM</th>
                                        <th>Golongan</th>
                                        <th>Mata Kuliah</th>
                                        <th>Tanggal Perkuliahan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $dt )
                                    <tr>
                                        <td class="text-center">
                                            <div class="custom-checkbox custom-control">
                                                <input type="checkbox" data-checkboxes="mygroup"
                                                    class="custom-control-input" id="checkbox-1">
                                                <label for="checkbox-1" class="custom-control-label">&nbsp;</label>
                                            </div>
                                        </td>
                                        <td id="nama-{{$dt->id}}">{{$dt->nama}}</td>
                                        <td id="email-{{$dt->id}}">{{$dt->email}}</td>
                                        <td id="nim-{{$dt->id}}">{{$dt->nim}}</td>
                                        <td id="golongan-{{$dt->id}}">{{$dt->golongan}}</td>
                                        <td id="matkul_id-{{$dt->id}}">{{$dt->matkul_id}}</td>
                                        <td>{{date_format(date_create($dt->tanggal), 'd-M-Y H:i T')}}</td>

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
        "columnDefs": [{
            "sortable": false,
            "targets": [2]
        }],
        "pageLength": 5
    });

</script>
@endsection
@section('js-table')

@endsection
