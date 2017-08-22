<?php

namespace App\DataTables;

use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Query\Builder;
use Yajra\Datatables\Datatables;
use Yajra\Datatables\Engines\BaseEngine;
use Yajra\Datatables\Services\DataTable;

class DataTableBase extends DataTable
{
  /*
    * The reason why this class exists is that Yajra/Datatables requires this service class for export methods to work
    * properly.
    */

   /** @var Builder The query that will be used to get the data from the db. */
   private $mQuery;

   /** @var array An array of columns */
   private $mColumns;

   /** @var BaseEngine The DataTable */
   private $mDataTable;

   /**
    * @param            $query
    * @param BaseEngine $dataTable
    * @param array      $columns
    */
   public function __construct($query, BaseEngine $dataTable, $columns) {
       parent::__construct(app(Datatables::class), app(Factory::class));

       $this->mQuery = $query;
       $this->mColumns = $columns;
       $this->mDataTable = $dataTable;
   }
    /**
     * Display ajax response.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax()
    {
      return $this->mDataTable->make(true);

    }

    /**
     * Get the query object to be processed by dataTables.
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection
     */
    public function query()
    {
      return $this->mQuery;
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\Datatables\Html\Builder
     */
    public function html()
    {
         return $this->builder()->columns($this->mColumns);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    // protected function getColumns()
    // {
    //     return [
    //         'id',
    //         // add your columns
    //         'created_at',
    //         'updated_at',
    //     ];
    // }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'datatablebases_' . time();
    }
}
