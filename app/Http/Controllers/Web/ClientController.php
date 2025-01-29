<?php

namespace App\Http\Controllers\Web;


use App\Models\client;
use App\Models\Industry;
use App\Models\Resource;
use App\Models\CustomField;
use Illuminate\Http\Request;
use App\clients\Clientclient;
use App\DTO\Client\ClientDTO;
use Illuminate\Support\Facades\DB;
use App\DataTables\ClientsDataTable;
use App\Http\Controllers\Controller;
use App\Exceptions\NotFoundException;
use App\Http\Requests\Clients\StoreClientRequest;
use App\Http\Requests\Clients\UpdateClientRequest;
use App\Services\ClientService;

class ClientController extends Controller
{
    public function __construct(public ClientService $clientclient) {
        $this->middleware('permission:view clients', ['only' => ['index', 'show']]);
        $this->middleware('permission:create clients', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit clients', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete clients', ['only' => ['destroy']]);
    }

    public function index(ClientsDataTable $dataTable, Request $request)
    {
        $filters = array_filter($request->get('filters', []), function ($value) {
            return ($value !== null && $value !== false && $value !== '');
        });
        $withRelations = ['resource']; // Include the 'resource' relationship
        return $dataTable->with(['filters' => $filters, 'withRelations' => $withRelations])->render('layouts.dashboard.client.index');
    }

    public function create()
    {
        // Fetch related data for form (e.g., sources, industries, clients, custom fields)
        $sources = Resource::all();
        $industries = Industry::all();
        $clients = client::all();
        $customFields = CustomField::all();
        return view('layouts.dashboard.client.create', compact('sources', 'industries', 'clients', 'customFields'));
    }

    public function store(StoreClientRequest $request)
    {
        try {
            DB::beginTransaction();
            // Create ClientDTO from the request
            $clientDTO = ClientDTO::fromRequest($request);
            // Store the client using the client
            $client = $this->clientclient->store($clientDTO);
            $toast = [
                'type' => 'success',
                'title' => 'Success',
                'message' => trans('app.client_created_successfully')
            ];
            DB::commit();
            return to_route('clients.index')->with('toast', $toast);
        } catch (\Exception $e) {
            DB::rollBack();
            $toast = [
                'type' => 'error',
                'title' => 'Error',
                'message' => $e->getMessage()
            ];
            return back()->with('toast', $toast);
        }
    }

    public function edit( $id)
    {
        // Fetch related data for editing
        $sources = Resource::all();
        $industries = Industry::all();
        $clients = client::all();
        $customFields = CustomField::all();
        $client = $this->clientclient->findById(id: $id);
        return view('layouts.dashboard.client.edit', compact('client', 'sources', 'industries', 'clients', 'customFields'));
    }

    public function update(UpdateClientRequest $request, $id)
    {
        try {
            DB::beginTransaction();
            // Create ClientDTO from the request
            $clientDTO = ClientDTO::fromRequest($request);
            // Update the client using the client
            $client = $this->clientclient->update($id, $clientDTO);
            // Success message
            $toast = [
                'type' => 'success',
                'title' => 'Success',
                'message' => trans('app.client_updated_successfully')
            ];
            DB::commit();
            return to_route('clients.index')->with('toast', $toast);
        } catch (\Exception $e) {
            DB::rollBack();
            // Error message
            $toast = [
                'type' => 'error',
                'title' => 'Error',
                'message' => $e->getMessage()
            ];
            return back()->with('toast', $toast);
        }
    }

    public function show(int $id)
    {
        try {
            $withRelations = ['sources', 'industries', 'clients', 'customFields'];
            $client=$this->clientclient->findById(id:$id, withRelations: $withRelations);
            return view('layouts.dashboard.client.show',['client'=>$client]);
        }catch(NotFoundException $e){
            $toast = [
                'type' => 'error',
                'title' => 'Error',
                'message' => $e->getMessage()
            ];
            return to_route('clients.index')->with('toast', $toast);
        }
    }

    public function destroy(Client $client)
    {

    }
}
