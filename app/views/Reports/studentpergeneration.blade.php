@extends('templates/base')

@section('content')

<!-- Page-Level Plugin CSS - Tables -->
{{ HTML::style('assets/css/datatables/dataTables.bootstrap.css') }}

<section class="content-header">
    <h1>
        Laporan
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ URL::to('/') }}"><i class="fa fa-desktop"></i> Home</a></li>
        <li><a href="{{ URL::to('laporan') }}"> Laporan</a></li>
        <li><a href="{{ URL::to('laporan/siswa-per-tingkatan') }}"><i class="active"></i> Siswa per Tingkatan</a></li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="box">
                <div class="box-header">
                    <h2 class="box-title">Siswa Tingkatan {{ $generation->name }}</h2>
                </div>
                <div class="box-body table-responsive">
                    <button class="btn btn-warning" onclick="showFormFilter()"><i class="fa fa-filter"></i> Filter</button>

                    <div class="clear-fix"><br/></div>
                    
                    <table class="table table-bordered table-hover table-condensed" id="data-table">
                        <small>
                            <thead>
                                <tr>
                                    <th>Siswa</th>
                                    <th>Tgl Lahir</th>
                                    <th>Ayah</th>
                                    <th>Ibu</th>
                                    <th>Alamat</th>
                                    <th>Telepon</th>
                                    <th>Email</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($issues as $issue)
                                    <tr>
                                        <td>{{ $issue->issue }} / {{ $issue->student->name }}</td>
                                        <td>{{ date('d-m-Y', strtotime($issue->student->birthdate)) }}</td>
                                        <td>{{ $issue->student->father_name }}</td>
                                        <td>{{ $issue->student->mother_name }}</td>
                                        <td>{{ $issue->student->address }}</td>
                                        <td>{{ $issue->student->contact }}</td>
                                        <td>{{ $issue->student->email }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </small>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Form Filter Earnings [modal]
===================================== -->
<div id="formFilter" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 id="myModalLabel">Form Filter</h3>
            </div>

            <div class="modal-body">
                <form class="form-horizontal" role="modal">
                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="generations">Tingkatan</label>
                        <div class="col-lg-4">
                            <select class="form-control" name="generations">
                                @foreach($generations as $generation)
                                    <option value="{{ $generation->id }}">{{ $generation->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Batal</button>
                <button class="btn btn-primary" onClick="filter()" data-dismiss="modal" aria-hidden="true">Filter</button>
            </div>
        </div>
    </div>
</div>
<!-- End of Form Filter Earnings [modal] -->

<!-- Page-Level Plugin Scripts - Tables -->
{{ HTML::script('assets/js/plugins/datatables/jquery.dataTables.js') }}
{{ HTML::script('assets/js/plugins/datatables/dataTables.bootstrap.js') }}

<script type="text/javascript">
    $(document).ready(function() {
        $('.table').dataTable();
        $('.mytooltip').tooltip({
            selector: "[data-toggle=tooltip]",
            container: "body"
        });
    });

    function showFormFilter()
    {
        $('#formFilter').modal('show');
    }

    function filter()
    {
        var generation_id = $('[name=generations]').val();

        window.location = "{{ URL::to('laporan/siswa-per-tingkatan/filter') }}/"+generation_id;
    }
</script>
@stop