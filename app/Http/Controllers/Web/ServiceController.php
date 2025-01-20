<?php

namespace App\Http\Controllers\Web;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Services\ServiceService;
use App\Http\Controllers\Controller;
use App\DataTables\ServicesDataTable;

class ServiceController extends Controller
{
    public function __construct(public ServiceService $serviceService){

    }
    /**
     * Display a listing of the resource.
     */
    public function index(ServicesDataTable $dataTable, Request $request)
    {
        $filters = array_filter($request->get('filters', []), function ($value) {
            return ($value !== null && $value !== false && $value !== '');
        });
        $withRelations = []; // Define any relationships you need to load

        return $dataTable->with([
            'filters' => $filters,
            'withRelations' => $withRelations
        ])->render('layouts.dashboard.industry.index');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('layouts.dashboard.service.create');
    }

    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
