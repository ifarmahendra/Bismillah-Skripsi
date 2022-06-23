@extends('template_admin.home')
@section('halaman','Mata Kuliah')
@section('content')
@section('model')
<!-- Start Content-->
<div class="container-fluid">

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <button class="btn btn-primary mb-4 mr-4" style="float:right;" data-toggle="modal"
                        data-target="#exampleModal">Tambah Matakuliah</button>
                    <p class="text-muted font-14 mb-3">
                        <!-- All Internship Users -->
                    </p>
                    @if (session('success'))
                    <br>
                    <div class="alert alert-success mt-4" role="alert" id="totop">
                        {!!session('success')!!}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="document.getElementById('totop').style.display = 'none';">
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
                    <div class="modal fade" tabindex="-1" role="dialog" id="exampleModal">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <form action="{{route('matakuliah.store')}}" method="post">
                                    @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title">Tambah Matakuliah</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <label class="mt-2">Nama Mata Kuliah</label>
                                        <input type="text" name='mata_kuliah' class="form-control">
                                    </div>
                                    <div class="modal-footer bg-whitesmoke br">
                                        <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                            </div>
                            </form>
                        </div>
                    </div>
                    <!-- Standard modal update -->
                    @foreach($matkul as $data )
                    <div class="modal fade" tabindex="-1" role="dialog" id="exampleModal1-{{$data->id}}">
                        <div class="modal-dialog" aria-labelledby="exampleModal" role="document">
                            <div class="modal-content">
                                <form method="post"
                                    action="{{route('matakuliah.update', ['matakuliah' => $data->id])}}">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModal">Update Matakuliah</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <label class="mt-2">Nama Mata Kuliah</label>
                                        <input type="text" name='mata_kuliah' value="{{$data->mata_kuliah}}"
                                            class="form-control" id="form-mata_kuliah">
                                    </div>
                                    <div class="modal-footer bg-whitesmoke br">
                                        <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                            </div>
                            </form>
                        </div>
                    </div><!-- /.modal -->
                    @endforeach
                    <!-- Standard modal update -->
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
                                                    <th>Task Name</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($matkul as $mk )
                                                <tr>
                                                    <td class="text-center">
                                                        <div class="custom-checkbox custom-control">
                                                            <input type="checkbox" data-checkboxes="mygroup"
                                                                class="custom-control-input" id="checkbox-1">
                                                            <label for="checkbox-1"
                                                                class="custom-control-label">&nbsp;</label>
                                                        </div>
                                                    </td>
                                                    <td>{{$mk->mata_kuliah}}</td>
                                                    <td>
                                                        <form action="{{route('matakuliah.destroy', ['matakuliah'=>$mk->id])}}" method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" onclick="return confirm('Apakah Ingin Menghapus Data ?');" class="btn btn-xs btn-danger">Delete</button>
                                                            <button type="button" class="btn btn-xs btn-primary" data-toggle="modal"
                                                            data-target="#exampleModal1-{{$mk->id}}">Update</button>
                                                        </form>  
                                                    </td>
                                                </tr>
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
    </div>
    <!-- end row -->
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
