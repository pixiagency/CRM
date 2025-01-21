<?php

namespace App\Http\Controllers\Web;

use Exception;
use App\Models\Service;
use Illuminate\Http\Request;
use App\DTO\Service\ServiceDTO;
use App\Services\ServiceService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\DataTables\ServicesDataTable;
use App\Exceptions\NotFoundException;
use App\Http\Requests\Service\ServiceStoreRequest;
use App\Http\Requests\Service\ServiceUpdateRequest;

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
        $withRelations = [];
        return $dataTable->with([
            'filters' => $filters,
            'withRelations' => $withRelations
        ])->render('layouts.dashboard.service.index');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('layouts.dashboard.service.create');
    }

    public function store(ServiceStoreRequest $request)
    {
        try{
            DB::beginTransaction();
            $srviceDTO=ServiceDTO::fromRequest($request);
            $service=$this->serviceService->store($srviceDTO);
            $toast = [
                'type' => 'success',
                'title' => 'success',
                'message' => trans('app.service_created_successfully')
            ];
            DB::commit();
            return to_route('services.index')->with('toast',$toast);
        }
        catch(Exception $e){
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

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        try {
            $withRelations = [];
            $service=$this->serviceService->findById(id:$id, withRelations: $withRelations);
            return view('layouts.dashboard.service.show',['service'=>$service]);
        }catch(NotFoundException $e){
            $toast = [
                'type' => 'error',
                'title' => 'Error',
                'message' => $e->getMessage()
            ];
            return to_route('services.index')->with('toast', $toast);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        try{
            $service=$this->serviceService->findById(id:$id);
            // dd($service);
            return view('layouts.dashboard.service.edit',compact('service'));
        }catch(Exception $e){
            return redirect()->back();
        }
    }



    public function update(ServiceUpdateRequest $request, $id)
    {
        try{
            $serviceDTO=$request->toServiceDTO();
            $this->serviceService->update($serviceDTO,$id);
            $toast = [
                'type' => 'success',
                'title' => 'success',
                'message' => trans('app.service_updated_successfully')
            ];
            return to_route('services.index')->with('toast', $toast);
        }
        catch (\Exception $e) {
            $toast = [
                'type' => 'error',
                'title' => 'error',
                'message' => trans('app.there_is_an_error')
            ];
            return back()->with('toast', $toast);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        try{
            $this->serviceService->delete($id);
            $toast = [
                'type' => 'success',
                'title' => 'success',
                'message' => trans('app.service_deleted_successfully')
            ];
            return to_route('services.index')->with('toast', $toast);
        }catch (\Exception $e) {
            $toast = [
                'type' => 'error',
                'title' => 'error',
                'message' => trans('app.there_is_an_error')
            ];
            return back()->with('toast', $toast);
        }
    }
}
