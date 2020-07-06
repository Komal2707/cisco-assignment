@extends('layouts.master')

@section('content')
<div>

    {{-- <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Advance Search</h3>
                <div class="box-tools pull-right">
                    <button type="button" data-widget="collapse" class="btn btn-box-tool"><i class="fa fa-minus"></i></button>
                </div>
            </div>
            <div class="box-body" style="">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group col-md-6">
                            <label>From</label>
                            <div class="input-group date">
                                <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                <input type="text" id="date_from" class="form-control pull-right datepicker" />
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label>To</label>
                            <div class="input-group date">
                                <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                <input type="text" id="date_to" class="form-control pull-right datepicker" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6" style="padding:30px;">
                        <a id="resetfilter" class="btn bg-red margin pull-right">
                            <i aria-hidden="true" class="fa fa-refresh">Reset</i>
                        </a>
                        <a id="dosearch" class="btn bg-olive margin pull-right">
                            <i aria-hidden="true" class="fa fa-search">Search</i>
                        </a>
                    </div>
                </div>
            </div>
        </div> --}}


        <div class="box">
            <div class="box-header">
                <div class="row">
                    <div class="col-md-12" style="padding:10px">
                        {{-- @can('packing pre customer order' ) --}}
                        <a class="btn btn-success margin pull-right" style="float:right" href="{{route("cisco::router::create")}}"><span
                            class="glyphicon glyphicon-plus"></span> Create New Router</a>
                        {{-- @endcan --}}
                    </div>
                </div>
            </div>
            <div class="box-body table-responsive">
                {!! $builder->table(['style' => 'width:100%'], true) !!}
            </div>
        </div>

</div>

    @component('layouts.confirm-danger-pop',['title' => "Warning !" , 'message'=> 'Are you sure want to confirm this router?'])
        @slot('callBack')
            window.LaravelDataTables["dataTableBuilder"].draw('page');
        @endslot
    @endcomponent

@endsection


@push('scripts')
    <script type="text/javascript">

        $('.datepicker').datepicker();

        $("#dosearch").click(function (e) {
            e.preventDefault();
            window.LaravelDataTables["dataTableBuilder"].page(0).draw('page');

        });

        $("#reloaddata").click(function (e) {
            e.preventDefault();
            window.LaravelDataTables["dataTableBuilder"].draw('page');


        });

        $("#resetfilter").click(function (e) {
            e.preventDefault();
            // $("#date_to").val("");
            // $("#date_from").val("");

            window.LaravelDataTables["dataTableBuilder"].page(0).draw('page');


        });

    </script>
    {!! $builder->scripts() !!}
@endpush