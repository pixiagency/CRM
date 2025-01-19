<?php

namespace App\Http\Controllers\Web;


use App\DTO\Awb\AwbDTO;
use Illuminate\Http\Request;
use App\DataTables\IndustriesDataTable;
use Illuminate\Support\Facades\DB;
use App\Exceptions\NotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Awb\AwbUpdateRequest;
use App\Http\Requests\Industrys\IndustryStoreRequest;
use App\Services\IndustryService;

class IndustryController extends Controller
{
    public function __construct(public IndustryService $industryService)
    {
        // $this->middleware('permission:view_shipment', ['only' => ['index']]);
        // $this->middleware('permission:edit_shipment', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:create_shipment', ['only' => ['create', 'store']]);
    }

    public function index(IndustriesDataTable $dataTable, Request $request)
    {
        $filters = array_filter($request->get('filters', []), function ($value) {
            return ($value !== null && $value !== false && $value !== '');
        });
        $withRelations = [];
        return $dataTable->with(['filters' => $filters, 'withRelations' => $withRelations])->render('layouts.dashboard.industry.index');
    }

    public function create()
    {
        return view('layouts.dashboard.industry.create');
    }

    public function show(int $id)
    {
        try {
            $withRelations = [];
            $industry = $this->industryService->findById(id: $id, withRelations: $withRelations);
            return view('layouts.dashboard.industry.show', ['industry' => $industry]);
        } catch (NotFoundException $exception) {
            $toast = [
                'type' => 'error',
                'title' => 'Error',
                'message' => $exception->getMessage()
            ];
            return to_route('industries.index')->with('toast', $toast);
        }
    }

    public function store(IndustryStoreRequest $request)
    {
        // try {
        $awbDTO = AwbDTO::fromRequest($request);
        DB::beginTransaction();
        //logic
        $awb = $this->awbService->store($awbDTO);
        $toast = [
            'type' => 'success',
            'title' => 'success',
            'message' => "$awb->code " . trans('app.awb_created_successfully')
        ];
        DB::commit();
        return to_route('awbs.index')->with('toast', $toast);
        // } catch (\Exception $exception) {
        //     DB::rollBack();
        //     $toast = [
        //         'type' => 'error',
        //         'title' => 'error',
        //         'message' => trans('app.there_is_an_error')
        //     ];
        //     DB::commit();
        //     return back()->with('toast', $toast);
        // }
    }

    public function edit($id)
    {
        try {
            $status = 1;
            $awb = $this->awbService->findById(id: $id);
            $authUser = getAuthUser();
            return view('layouts.dashboard.awb.edit', compact('awb', 'authUser', 'status'));
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }

    public function update(AwbUpdateRequest $request, $id)
    {
        try {
            $AwbDTO = $request->toAwbDTO();
            $this->awbService->update($AwbDTO, $id);
            $toast = [
                'type' => 'success',
                'title' => 'success',
                'message' => trans('app.user_updated_successfully')
            ];
            return to_route('awbs.index')->with('toast', $toast);
        } catch (\Exception $e) {
            $toast = [
                'type' => 'error',
                'title' => 'error',
                'message' => trans('app.there_is_an_error')
            ];
            return back()->with('toast', $toast);
        }
    }

    public function destroy(int $id)
    {
        try {
            $this->awbService->delete($id);
            return apiResponse(message: 'deleted successfully');
        } catch (\Exception $exception) {
            return apiResponse(message: $exception->getMessage(), code: 500);
        }
    }
}
