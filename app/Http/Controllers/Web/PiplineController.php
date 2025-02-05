<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Services\PiplineService;
use App\Http\Controllers\Controller;
use App\DataTables\PiplinesDataTable;
use App\Http\Requests\Pipline\PiplineStoreRequest;

class PiplineController extends Controller
{
    public function __construct(public PiplineService $piplineService) {
        // $this->middleware('permission:view piplines', ['only' => ['index','show']]);
        // $this->middleware('permission:edit piplines', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:create piplines', ['only' => ['create', 'store']]);
        // $this->middleware('permission:delete piplines', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(PiplinesDataTable $dataTable,Request $request)
    {
        $filters = array_filter($request->get('filters', []), function ($value) {
            return ($value !== null && $value !== false && $value !== '');
        });
        $withRelations = [];
        return $dataTable->with(['filters' => $filters, 'withRelations' => $withRelations])->render('layouts.dashboard.pipline.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('layouts.dashboard.pipline.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PiplineStoreRequest $request)
    {
        $dto = $request->toPiplineDTO();
        $pipline = $this->piplineService->store($dto);

        return redirect()->route('piplines.index')->with('success', 'Pipeline created successfully.');
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
