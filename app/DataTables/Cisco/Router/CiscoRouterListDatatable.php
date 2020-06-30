<?php

namespace App\DataTables\Cisco\Router;

use App\Router;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\QueryDataTable;

class CiscoRouterListDatatable extends DataTable
{
    public function dataTable($query)
    {
        return datatables($query)
            ->editColumn('created_at', function ($router) {

                return $router->created_at->toFormattedDateString();
            })
            ->addColumn('action', function ($router) {
                $btn = "";

                $btn .= '<a href="' . route('cisco::router::edit', ['router' => $router->id]) . '" data-toggle="tooltip" data-placement="top" data-original-title="Edit Router" class="btn btn-info btn-sm text-center ccbtn"><i class="fa fa-pencil"></i></a>';
                $btn .= "<a data-url=\"" . route('cisco::router::delete', ['router' => $router->id]) . "\"  data-toggle=\"modal\" data-target=\"#modal-confirm-danger\" data-id=\"$router->id\" class=\"btn modal-confirm-danger-btn btn-sm btn-danger ccbtn\"><span data-toggle ='tooltip' data-placement='top' data-original-title='Delete Router'><i class='fa fa-trash'></i></span></a>";

                return $btn;
            })
            ->rawColumns(['action']);
    }


    public function query( \App\RouterView $router )
    {
        // return ($router->select($this->getFields())->orderBy('id', 'desc'));
        return (new QueryDataTable(\DB::table('routers')))->toJson();
    }


    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax(route('cisco::router::list'))
            // ->ajax([
                // 'url' => route('cisco::router::list'),
            //     'data' => 'function(d){
            //             d.release_id=$("#release_id").val();d.date_from=$("#date_from").val();d.date_to=$("#date_to").val();
            //         }'
            // ])
            ->addAction(['width' => '80px'])
            ->parameters($this->getBuilderParameters());
    }


    protected function getBuilderParameters()
    {
        return [];
    }
    protected function getColumns()
    {
        return [
            ['data' => 'id', 'name' => 'id', 'title' => '#'],
            ['data' => 'sap_id', 'name' => 'sap_id', 'title' => 'SAPID#'],
            ['data' => 'type', 'name' => 'type', 'title' => 'Type'],
            ['data' => 'hostname', 'name' => 'hostname', 'title' => 'Hostname'],
            ['data' => 'loopback', 'name' => 'loopback', 'title' => 'Loopback'],
            ['data' => 'mac_address', 'name' => 'mac_address', 'title' => 'MAC Address'],
            ['data' => 'created_at', 'name' => 'created_at', 'title' => 'Created At'],
        ];
    }

    protected function getFields()
    {
        return [
            'id' ,
            'sap_id' ,
            'type' ,
            'hostname' ,
            'loopback' ,
            'mac_address' ,
            'created_at'
        ];
    }
}