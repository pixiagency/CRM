<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Helpers\ApiResponse;
use Illuminate\Http\Request;
use App\Models\Tenant\Resource;
use App\DTO\Resource\ResourceDTO;
use App\Services\ResourceService;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Exceptions\NotFoundException;
use App\Http\Resources\SourceResource;
use App\Http\Requests\Resource\ResourceStoreRequest;
use App\Http\Requests\Resource\ResourceUpdateRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ResourceController extends Controller
{
    public function __construct(public ResourceService $resourceService)
    {

    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $filters = array_filter($request->get('filters', []), function ($value) {
                return ($value !== null && $value !== false && $value !== '');
            });
            $withRelations = [];
            $resources = $this->resourceService->listing($filters, $withRelations);
            return ApiResponse::sendResponse(200, 'Sources retrieved successfully', SourceResource::collection($resources));
        } catch (Exception $e) {
            return ApiResponse::sendResponse(500, $e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ResourceStoreRequest $request)
    {
        try {
            DB::beginTransaction();
            $resourceDTO = ResourceDTO::fromRequest($request);
            $resource = $this->resourceService->store($resourceDTO);
            DB::commit();
            return ApiResponse::sendResponse(201, 'Source created successfully', new SourceResource($resource));
        } catch (\Exception $e) {
            DB::rollBack();
            return ApiResponse::sendResponse(500, $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
        // $id = (int) $id;
        try {
            dd($id);
            $resource = $this->resourceService->findById($id);
            // $resource=Resource::find($id);
            return ApiResponse::sendResponse(200, 'Source retrieved successfully', new SourceResource($resource));
        } catch (NotFoundException $e) {
            return ApiResponse::sendResponse(404, $e->getMessage());
        } catch (Exception $e) {
            return ApiResponse::sendResponse(500, $e->getMessage());
        }
    }
    // public function show(Resource $resource)
    // {
    //     // dd($resource);
    //     return ApiResponse::sendResponse(200, 'Source retrieved successfully', new SourceResource($resource));
    // }


    /**
     * Update the specified resource in storage.
     */
    public function update(ResourceUpdateRequest $request,$id)
    {
        dd($id);
        try {
            $resourceDTO = $request->toResourceDTO();
            // dd($resourceDTO);
            $this->resourceService->update($resourceDTO, $id);
            return ApiResponse::sendResponse(200, 'Source updated successfully');
        } catch (NotFoundException $e) {
            return ApiResponse::sendResponse(404, $e->getMessage());
        } catch (\Exception $e) {
            return ApiResponse::sendResponse(500, $e->getMessage());
        }
    }

    // public function update(ResourceUpdateRequest $request, Resource $resource)
    // {

    //     $resourceDTO = $request->toResourceDTO();
    //     $resource->update($resourceDTO->toArray());
    //     return ApiResponse::sendResponse(200, 'Source updated successfully');
    // }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // $id = (int) $id;
        try {
            $this->resourceService->delete($id);
            return ApiResponse::sendResponse(200, 'Source deleted successfully');
        } catch (NotFoundException $e) {
            return ApiResponse::sendResponse(404, $e->getMessage());
        } catch (\Exception $e) {
            return ApiResponse::sendResponse(500, $e->getMessage());
        }
    }
}
