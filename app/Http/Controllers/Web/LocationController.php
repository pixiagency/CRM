<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\DataTables\LocationsDataTable;
use App\DTO\Location\LocationDTO;
use Illuminate\Support\Facades\DB;
use App\Exceptions\NotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Areas\AreaStoreRequest;
use App\Http\Requests\Locations\LocationUpdateRequest;
use App\Http\Requests\Locations\LocationStoreRequest;

use App\Services\LocationService;

class LocationController extends Controller
{
    public function __construct(public LocationService $locationService) {
        $this->middleware('permission:view locations', ['only' => ['index']]);
        $this->middleware('permission:show locations', ['only' => ['show']]);
        $this->middleware('permission:edit locations', ['only' => ['edit', 'update']]);
        $this->middleware('permission:create locations', ['only' => ['create', 'store']]);
        $this->middleware('permission:delete locations', ['only' => ['destroy']]);
        $this->middleware('permission:create areas', ['only' => ['createArea']]);
        $this->middleware('permission:store areas', ['only' => ['storeArea']]);
    }

    public function index(LocationsDataTable $dataTable, Request $request)
    {
        $filters = array_filter($request->get('filters', []), function ($value) {
            return ($value !== null && $value !== false && $value !== '');
        });
        $withRelations = [];
        return $dataTable->with(['filters' => $filters, 'withRelations' => $withRelations])->render('layouts.dashboard.location.index');
    }

    public function create()
    {
        $cities = app()->make(LocationService::class)->getAll(filters: ['depthlessthen' => 3]);
        return view('layouts.dashboard.location.create', compact('cities'));
    }

    public function show(int $id)
    {
        try {
            $withRelations = [];
            $location = $this->locationService->findById(id: $id, withRelations: $withRelations);
            return view('layouts.dashboard.location.show', ['location' => $location]);
        } catch (NotFoundException $exception) {
            $toast = [
                'type' => 'error',
                'title' => 'Error',
                'message' => $exception->getMessage()
            ];
            return to_route('locations.index')->with('toast', $toast);
        }
    }

    public function store(LocationStoreRequest $request)
    {
        try {
            DB::beginTransaction();
            $locationDTO = LocationDTO::fromRequest($request);
            $this->locationService->store($locationDTO);
            $toast = [
                'type' => 'success',
                'title' => 'success',
                'message' => trans('app.location_created_successfully')
            ];
            DB::commit();
            return to_route('locations.index')->with('toast', $toast);
        } catch (\Exception $exception) {
            DB::rollBack();
            $toast = [
                'type' => 'error',
                'title' => 'error',
                'message' => trans('app.there_is_an_error')
            ];
            DB::commit();
            return back()->with('toast', $toast);
        }
    }

    public function edit($id)
    {
        try {
            $location = $this->locationService->findById(id: $id);
            $areas = $this->locationService->getAll(filters: ['parent' => $location->id]);
            return view('layouts.dashboard.location.edit', get_defined_vars());
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }

    public function update(LocationUpdateRequest $request, $id)
    {
        try {
            $locationDTO = $request->tolocationDTO();
            $this->locationService->update($locationDTO, $id);
            $toast = [
                'type' => 'success',
                'title' => 'success',
                'message' => trans('app.location_updated_successfully')
            ];
            return to_route('locations.index')->with('toast', $toast);
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
            $this->locationService->delete($id);
            return apiResponse(message: 'deleted successfully');
        } catch (\Exception $exception) {
            return apiResponse(message: $exception->getMessage(), code: 500);
        }
    }

    public function createArea($city_id)
    {
        $city = $this->locationService->findById($city_id);
        return view('layouts.dashboard.location.create-area', compact('city'));
    }

    public function storeArea(AreaStoreRequest $request)
    {
        try {
            $locationDTO = LocationDTO::fromRequest($request);
            $this->locationService->storeArea($locationDTO);
            $toast = [
                'type' => 'success',
                'title' => 'success',
                'message' => trans('app.location_created_successfully')
            ];
            return to_route('locations.index')->with('toast', $toast);
        } catch (\Exception $exception) {
            $toast = [
                'type' => 'error',
                'title' => 'error',
                'message' => trans('app.there_is_an_error')
            ];
            return back()->with('toast', $toast);
        }
    }
}
