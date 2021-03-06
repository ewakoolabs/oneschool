@extends('templates/base')

@section('content')

<!-- Page-Level Plugin CSS - Tables -->
{{ HTML::style('assets/css/daterangepicker/daterangepicker-bs3.css') }}
{{ HTML::style('assets/css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}

<section class="content-header">
    <h1>
        Update Program Bimbingan
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ URL::to('/') }}"><i class="fa fa-desktop"></i> Home</a></li>
        <li><a href="#"> Manajemen</a></li>
        <li><a href="{{ URL::to('program') }}"><i class="active"></i> Program Bimbingan</a></li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <div class="box-title">
                        <button class="btn btn-primary" onclick="update()"><i class="fa fa-floppy-o"></i> Simpan</button>
                    </div>
                </div>

                <div class="box-body">
                    <form class="form-horizontal" role="form">
                        <div class="form-group">
                            <label class="col-lg-3 control-label" for="name">Nama Program</label>
                            <div class="col-lg-5">
                                <input type="hidden" name="id" value="{{ $program->id }}">
                                <input name="name" type="text" class="form-control" value="{{ $program->name }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label" for="daterange">Periode Program</label>
                            <div class="col-lg-4">
                                <input name="daterange" type="text" class="form-control" value="{{ date('Y/m/d', strtotime($program->start_date)) }} - {{ date('Y/m/d', strtotime($program->end_date)) }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label" for="description">Informasi/Penjelasan</label>
                            <div class="col-lg-8">
                                <textarea name="description" class="textarea form-control" placeholder="Tambahkan Informasi dan Penjelasan disini"style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ $program->description }}</textarea>
                            </div>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Page-Level Plugin Scripts -->
{{ HTML::script('assets/js/plugins/daterangepicker/daterangepicker.js') }}
{{ HTML::script('assets/js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}

<script type="text/javascript">
    $(document).ready(function() {
        $('input[name=daterange]').daterangepicker({
        	format:'YYYY/MM/DD',
        	startDate:"{{ $program->start_date }}",
        	endDate:"{{ $program->end_date }}"
        });
        $('.textarea').wysihtml5();
    });

    function update()
    {
        var id = $('input[name=id]').val();
        var name = $('input[name=name]').val();
        var range = $('input[name=daterange]').val();
        var description = $('textarea[name=description]').val();

        if(name != '' && range != '')
        {
            $.ajax({
                url:"{{ URL::to('program') }}/"+id,
                type:'PUT',
                data:{name : name, range : range, description : description},
                success:function(){
                    window.location = "{{ URL::to('program') }}";
                }
            });
        }
        else
        {
            window.alert('Mohon Lengkapi Inputan Anda!');
        }
    }
</script>
@stop