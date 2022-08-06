@extends('template_admin.home')
@section('halaman','Learning Journal')
@section('content')
@section('model')
<!-- Start Content-->
<div class="container-fluid">

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <button class="btn btn-primary mb-4 mr-4" style="float:right;" data-toggle="modal"
                        data-target="#exampleModal">Tambah Data</button>
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
                    <br>
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
                                <form action="{{route('learningjurnal.store')}}" method="post">
                                    @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title">Tambah Data</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <!-- <div class="modal-body">
                                        <label class="mt-2">Soal</label> -->
                                        <input type="hidden" name="soal" value="{{uniqid()}}">
                                        <!-- <textarea type="text" name='soal' class="form-control" id="reschedule-form-soal"
                                            cols="30" rows="10" required></textarea>
                                    </div> -->
                                    <div class="modal-body">
                                        <label class="mt-2">Kunci Jawaban</label>
                                        <textarea type="text" name='kunci_jawaban' class="form-control"
                                            id="reschedule-form-soal" cols="30" rows="10" required></textarea>
                                    </div>
                                    <div class="modal-body">
                                        <label class="mt-2">Mata Kuliah</label>
                                        <select class="form-control" name="matkul_Id" id="" required>
                                            <option value="">Pilih Mata Kuliah</option>
                                            @foreach ($matkul as $mk)
                                            <option value="{{ $mk->id }}">{{ $mk->mata_kuliah }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="modal-body">
                                        <label class="mt-2">Start Date</label>
                                        <input type="datetime-local" name='start_date' class="form-control" required>
                                    </div>
                                    <div class="modal-body">
                                        <label class="mt-2">End Date</label>
                                        <input type="datetime-local" name='end_date' class="form-control" required>
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
                    @foreach($learning as $data )
                    <div class="modal fade" tabindex="-1" role="dialog" id="exampleModal1-{{$data->id}}">
                        <div class="modal-dialog" aria-labelledby="exampleModal" role="document">
                            <div class="modal-content">
                                <form method="post"
                                    action="{{route('learningjurnal.update', ['learningjurnal' => $data->id])}}">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModal">Update Learning Jurnal</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                        <label class="mt-2">Soal</label>
                                        <textarea name="soal" id="soal" cols="58" rows="10">{{$data->soal}}</textarea>

                                        <label class="mt-2">Kunci Jawaban</label>
                                        <textarea name="kunci_jawaban" id="kunci_jawaban" cols="58"
                                            rows="10">{{$data->kunci_jawaban}}</textarea>

                                        <label class="mt-2">Mata Kuliah</label>
                                        <select class="form-control" name="matkul_Id" id="" required>
                                            <option value="">Pilih Mata Kuliah</option>
                                            @foreach ($matkul as $mk)
                                            <option value="{{$mk->id}}" @if($mk->id == $data->matkul_Id)
                                                selected
                                                @endif
                                                >{{$mk->mata_kuliah}}</option>
                                            @endforeach
                                        </select>

                                        <label class="mt-2">Start Date</label>
                                        <input type="datetime-local" name='start_date' class="form-control"
                                            value="{{$data->start_date}}" required>

                                        <label class="mt-2">End Date</label>
                                        <input type="datetime-local" name='end_date' class="form-control"
                                            value="{{$data->end_date}}" required>
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
                                        <th>Soal</th>
                                        <th>Kunci Jawaban</th>
                                        <th>Mata Kuliah</th>
                                        <th>Start date</th>
                                        <th>End date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($learning as $lr)
                                    <tr>
                                        <td class="text-center">
                                            <div class="custom-checkbox custom-control">
                                                <input type="checkbox" data-checkboxes="mygroup"
                                                    class="custom-control-input" id="checkbox-1">
                                                <label for="checkbox-1" class="custom-control-label">&nbsp;</label>
                                            </div>
                                        </td>
                                        <td id="soal-{{$lr->id}}">{{$lr->soal}}</td>
                                        <td id="kunci_jawaban-{{$lr->id}}">{{$lr->kunci_jawaban}}</td>
                                        <td id="matkul_Id-{{$lr->id}}">
                                            {{$matkulClass::where('id',$lr->matkul_Id)->first()->mata_kuliah ?? 'null'}}
                                        </td>
                                        <td>{{date_format(date_create($lr->start_date), 'd-M-Y H:i T')}}</td>
                                        <td>{{date_format(date_create($lr->end_date), 'd-M-Y H:i T')}}</td>
                                        <td>
                                            <form
                                                action="{{route('learningjurnal.destroy', ['learningjurnal'=>$lr->id])}}"
                                                method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    onclick="return confirm('Apakah Ingin Menghapus Data ?');"
                                                    class="btn btn-xs btn-danger">Delete</button>
                                                <button type="button" class="btn btn-xs btn-primary" data-toggle="modal"
                                                    data-target="#exampleModal1-{{$lr->id}}">Update</button>
                                            </form>
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
