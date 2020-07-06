<?php

namespace App\DataTables\Cisco\Router;

use App\Router;
use Illuminate\Auth\Access\Gate;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\QueryDataTable;
use Yajra\DataTables\Services\DataTable;
use App\Repository\CiscoRouterRepository;

class CiscoRouterListDatatable extends DataTable {
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable( $query )
    {

        return datatables($query);
            // ->editColumn('created_at' , function ( $router ) {

            //     return $router->created_at->toFormattedDateString();
            // })
            // ->addColumn('action' , function ( $router ) {
            //     $btn = "";

            //     // $btn .= '<a href="' . route('cisco::router::edit', ['router' => $router->id]) . '" data-toggle="tooltip" data-placement="top" data-original-title="Edit Router" class="btn btn-info btn-sm text-center ccbtn"><i class="fa fa-pencil"></i></a>';
            //     // $btn .= "<a data-url=\"" . route('cisco::router::delete', ['router' => $router->id]) . "\"  data-toggle=\"modal\" data-target=\"#modal-confirm-danger\" data-id=\"$router->id\" class=\"btn modal-confirm-danger-btn btn-sm btn-danger ccbtn\"><span data-toggle ='tooltip' data-placement='top' data-original-title='Delete Router'><i class='fa fa-trash'></i></span></a>";

            //     return $btn;
            // })->rawColumns(['action']);
    }

    /**
     * @param CiscoRouterRepository $router
     * @return mixed
     */
    public function query( )
    {
        return $router = ( new CiscoRouterRepository())->getList();

    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax(route('cisco::router::list'))
            //  ->ajax([
            //         'url'  => route('cisco::router::list') ,
            //         'data' => 'function(d){}',
            //         'success'   => 'console.log(d)'
            // ])
            ->addAction(['width' => '80px'])
            ->parameters($this->getBuilderParameters());
    }

    protected function getBuilderParameters()
    {

        return [
            //
        ];
    }

    /**
     * Get columns.
     *
     * @return array
     */
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

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'routerdatatable_' . time();
    }
}