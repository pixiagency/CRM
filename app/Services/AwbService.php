<?php

namespace App\Services;

use App\Models\Awb;
use App\Models\User;
use App\Models\Office;
use App\DTO\Awb\AwbDTO;
use App\Enums\UsersType;
use App\Models\Receiver;
use App\Models\AwbStatus;
use App\Enums\AwbStatuses;
use Illuminate\Support\Arr;
use App\Enums\ImageTypeEnum;
use App\Http\Livewire\Courier;
use App\Models\AwbServiceType;
use App\QueryFilters\AwbFilters;
use App\Models\CompanyShipmentType;
use Illuminate\Support\Facades\Auth;
use App\Exceptions\NotFoundException;
use App\Jobs\PerformActionJob;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;


class AwbService extends BaseService
{
    public $user;

    public function __construct(
        public Awb               $model,
        public ReceiverService   $receiverService,
        public PriceTableService $priceTableService,
        public BranchService     $branchService
    ) {
    }

    public function getModel(): Awb
    {
        return $this->model;
    }

    public function getAll(array $filters = [])
    {
        return $this->queryGet($filters)->get();
    }

    public function getTableName(): String
    {
        return $this->getModel()->getTable();
    }

    /**
     * @throws NotFoundException
     */
    public function listing(array $filters = [], array $withRelations = [], $perPage = 5): \Illuminate\Contracts\Pagination\CursorPaginator
    {
        return $this->queryGet(filters: $filters, withRelations: $withRelations)->cursorPaginate($perPage);
    }

    public function queryGet(array $filters = [], array $withRelations = []): Builder
    {
        $awbs = $this->model->with($withRelations)->orderBy('id', 'desc');
        return $awbs->filter(new AwbFilters($filters));
    }

    public function datatable(array $filters = [], array $withRelations = [])
    {
        $awbs = $this->getQuery()->with($withRelations)->selectRaw('awbs.*');
        return $awbs->filter(new AwbFilters($filters));
    }

    public function datatableOperationAwbs(array $filters = [], array $withRelations = [])
    {
        $awbs = $this->getQuery()
                ->with($withRelations)
                ->selectRaw('awbs.*')
                ->where('operator_id', Auth::user()->id)
                ->whereHas('latestStatus', function (Builder $query) {
                    $query->whereHas('status', function (Builder $query) {
                        $query->where('code', AwbStatuses::PICKUP->value)->orWhere('code', AwbStatuses::CREATE_SHIPMENT->value);
                    });
                })
                ;
        return $awbs->filter(new AwbFilters($filters));
    }
    public function datatableOfficeAwbs(array $filters = [], array $withRelations = [])
    {
        $awbs = $this->getQuery()
                ->with($withRelations)
                ->selectRaw('awbs.*')
                ->where('officer_id', Auth::user()->id)
                ->whereHas('latestStatus', function (Builder $query) {
                    $query->whereHas('status', function (Builder $query) {
                        $query->where('code', AwbStatuses::OPERATION->value)->orWhere('code', AwbStatuses::OFFICER->value)->orWhere('code', AwbStatuses::LINEHAUL->value);
                    });
                })
                ;
        return $awbs->filter(new AwbFilters($filters));
    }

    public function datatableCollectedAwbs(array $filters = [], array $withRelations = [])
    {

        $awbs = $this->getQuery()
                ->with($withRelations)
                ->selectRaw('awbs.*')
                ->where('operator_id', Auth::user()->id)
                ->orWhere('officer_id', Auth::user()->id);
                // ->whereHas('latestStatus', function (Builder $query) {
                //         $query->where('user_id', Auth::user()->id);
                // });
        return $awbs->filter(new AwbFilters($filters));
    }

    /**
     * @throws NotFoundException
     */
    public function store(AwbDTO $awbDTO)
    {

        $awb_dimension = [];
        //get default status
        $awb_status_id = AwbStatus::query()->where('code', AwbStatuses::CREATE_SHIPMENT->value)->first()?->id;

        // get receiver object info
        $receiver = $this->receiverService->findById(id: $awbDTO->receiver_id, withRelations: ['city', 'area']);

        //get branch address city and area
        $branch = $this->branchService->findById($awbDTO->branch_id);
        //get shipment type & payment type
        $shipment_type = CompanyShipmentType::find($awbDTO->shipment_type);
        $service_type = AwbServiceType::find($awbDTO->service_type);
        if (!$shipment_type || !$service_type)
            throw new NotFoundException(trans('app.shipment_type_or_service_type_not_found'));

        $priceTable = $this->priceTableService->getShipmentPrice(from: $branch->city_id, to: $receiver->city_id);

        $awbDTO->shipment_type = $shipment_type->name;
        $awbDTO->service_type = $service_type->name;

        $awbDTO->receiver_city_id = $receiver->city->id;
        $awbDTO->receiver_area_id = $receiver->area->id;
        $awbDTO->receiver_subarea_id = $receiver->subarea?->id?? null;
        $awbDTO->receiver_reference = $receiver->reference;
        $awbDTO->receiver_id = $receiver->id;

        $awbDTO->zone_price = $priceTable->price;
        //check on weight if there is additional kg price or not
        $awbDTO->additional_kg_price = 0;
        if ($awbDTO->weight > $priceTable->basic_kg)
            $awbDTO->additional_kg_price = ($awbDTO->weight - $priceTable->basic_kg) * $priceTable->additional_kg_price;

        $awbDTO->receiver_data = $this->getReceiverDataForAwb($receiver);


        // '''pickup courier''' assign to branch
        $pickup_courier = User::pickupCourier()->whereHas('locations', function(Builder $query) use($branch){
            $query->where('location_id', $branch->subarea?->id);
            })->first();
        $awbDTO->pickup_courier_id = $pickup_courier?->id;

        // '''operator''' assing from Pickup_Courier
        $awbDTO->operator_id=$pickup_courier?->workin?->user_id;

        // '''courier''' assign to reciever
        $courier = User::courier()->whereHas('locations', function(Builder $query) use($awbDTO){
                $query->where('location_id', $awbDTO->receiver_subarea_id);
            })->first();
        $awbDTO->courier_id = $courier->id ?? null;

        // '''office''' assing from Pickup_Courier
        $awbDTO->officer_id=$courier?->workin?->user_id;
        // $office_id = $courier->head_offices_id?? null;
        // $awbDTO->operator_id = User::operator()
        //     ->whereHas('office', function ($query) use ($office_id) {
        //         $query->where('id', $office_id);
        //     })->value('id') ?? null;



        // $awbDTO->line_haul_id = User::linehaul()->where('head_offices_id', $office_id)->first()->id ?? null;


        $awb_data = $awbDTO->toArray();
        $awb = $this->model->create($awb_data);
        //store default history
        $awb->history()->create(['user_id' => $awbDTO->user_id, 'awb_status_id' => $awb_status_id]);
        //get additional info
        $awb_additional_infos_data = array_filter($awbDTO->awbAdditionalInfos());

        //store additional infos
        if (count($awb_additional_infos_data))
            $awb->additionalInfo()->create($awb_additional_infos_data);

        $awb_shipment_dimension = array_filter($awbDTO->shipmentDimensions());
        if (count($awb_shipment_dimension)) {
            $length = Arr::get($awb_shipment_dimension, 'length');
            foreach ($length as $index => $dimension) {
                $awb_dimension[] = [
                    'awb_id' => $awb->id,
                    'height' => $awb_shipment_dimension['height'][$index],
                    'width' => $awb_shipment_dimension['width'][$index],
                    'length' => $dimension,

                ];
            }
            $awb->dimension()->createMany($awb_dimension);
        }

        PerformActionJob::dispatch($awb)->delay(now()->addMinutes(1));

        return $awb;
    }

    public function update(AwbDTO $awbDTO, $id)
    {
        $awb = $this->findById($id);
        $receiver = $this->receiverService->findById(id: $awbDTO->receiver_id, withRelations: ['city', 'area']);

        //get branch address city and area
        $branch = $this->branchService->findById($awbDTO->branch_id);

        $awbDTO->receiver_city_id = $receiver->city->id;
        $awbDTO->receiver_area_id = $receiver->area->id;
        $awbDTO->receiver_subarea_id = $receiver->subarea?->id?? null;
        $awbDTO->receiver_reference = $receiver->reference;
        $awbDTO->receiver_id = $receiver->id;
        $awbDTO->receiver_data = $this->getReceiverDataForAwb($receiver);

        $pickup_courier = User::pickupCourier()->whereHas('locations', function(Builder $query) use($branch){
            $query->where('location_id', $branch->subarea?->id);
            })->first();
        $awbDTO->pickup_courier_id = $pickup_courier?->id;

        // '''operator''' assing from Pickup_Courier
        $awbDTO->operator_id=$pickup_courier?->workin?->user_id;

        // '''courier''' assign to reciever
        $courier = User::courier()->whereHas('locations', function(Builder $query) use($awbDTO){
                $query->where('location_id', $awbDTO->receiver_subarea_id);
            })->first();
        $awbDTO->courier_id = $courier->id ?? null;

        // '''office''' assing from Pickup_Courier
        $awbDTO->officer_id=$courier?->workin?->user_id;

        $priceTable = $this->priceTableService->getShipmentPrice(from: $branch->city_id, to: $receiver->city_id);
        $awbDTO->additional_kg_price = 0;
        if ($awbDTO->weight > $priceTable->basic_kg)
            $awbDTO->additional_kg_price = ($awbDTO->weight - $priceTable->basic_kg) * $priceTable->additional_kg_price;
        $awbDTO->zone_price = $priceTable->price;

        $service_type = AwbServiceType::find($awbDTO->service_type);

        $awbDTO->service_type = $service_type->id;
        $awb->update($awbDTO->toArray());
        //get additional info
        $awb_additional_infos_data = array_filter($awbDTO->awbAdditionalInfos());
        //store additional infos
        if ($awb->additionalInfo()->first()) {
            $awb->additionalInfo()->update($awb_additional_infos_data);
        } else {
            $awb->additionalInfo()->create($awb_additional_infos_data);
        }
        return true;
    }

    public function pod(int $id, array $data): bool
    {
        $user_id = auth('sanctum')->id();
        $awb = $this->findById($id);
        $awb_data = Arr::except($data, ['title', 'actual_recipient', 'title', 'card_number']);
        $awb->update($awb_data);
        if (isset($data['images']) && is_array($data['images']))
            foreach ($data['images'] as $image) {
                $fileData = FileService::saveImage(file: $image, path: 'uploads/awbs', field_name: 'images');
                $fileData['type'] = ImageTypeEnum::CARD;
                $awb->storeAttachment($fileData);
            }
        $awb_history_data = [
            'user_id' => $user_id,
            'awb_status_id' => $awb->id,
            'lat' => $data['lat'],
            'lng' => $data['lng'],
        ];
        return $awb->history()->create($awb_history_data);
    }

    public function deleteMultiple(array $ids)
    {
        return $this->getQuery()->whereIn('id', $ids)->delete();
    }

    public function delete(int $id)
    {
        return $this->getQuery()->where('id', $id)->delete();
    }

    public function status(int $id, array $awb_status_data = [])
    {
        $awb = $this->findById($id);
        return $awb->history()->create($awb_status_data);
    }

    private function getReceiverDataForAwb(Receiver|Model $receiver): array
    {
        return [
            'id' => $receiver->id,
            'city' => $receiver->city->title,
            'area' => $receiver->area->title,
            'subarea' => $receiver->subarea?->title??null,
            'address1' => $receiver->address1,
            'phone1' => $receiver->phone1,
            'phone2' =>  $receiver->phone2,
            'name' =>  $receiver->name,
            'receiving_company' =>  $receiver->receiving_company,
            'receiving_branch' => $receiver->receiving_branch,
            'lat' => $receiver->lat,
            'lng' => $receiver->lng,
            'title' => $receiver->title,
        ];
    }

    public function changeCourier(int $courier_id, int $awb_id)
    {
        $awb = Awb::find($awb_id);
        $awb->update([
            'courier_id' => $courier_id,
        ]);
        return true;
    }

    public function changeOperator(int $operator_id, int $awb_id)
    {
        $awb = Awb::find($awb_id);
        $awb->update([
            'operator_id' => $operator_id
        ]);
        return true;
    }

    public function scanAwb($code)
    {
        $awb = Awb::where('code', $code)->first();

        if (!$awb) {
            return apiResponse(message: "AWB not found", code: 404);
        }

        $user_id = Auth::user()->id;
        $currentStatusCode = $awb->latestStatus->status->code ?? null;

        if (is_null($currentStatusCode)) {
            return apiResponse(message: "Current status not found", code: 404);
        }

        $nextStatus = null;
        if ($user_id == $awb->pickup_courier_id && $awb->latestStatus->status->code < AwbStatuses::PICKUP->value) {
            $nextStatus = AwbStatuses::PICKUP->value;
        } elseif ($user_id == $awb->officer_id && $awb->latestStatus->status->code < AwbStatuses::OFFICER->value) {
            $nextStatus = AwbStatuses::OFFICER->value;
        } elseif ($user_id == $awb->operator_id && $awb->latestStatus->status->code < AwbStatuses::OPERATION->value) {
            $nextStatus = AwbStatuses::OPERATION->value;
        } elseif ($user_id == $awb->line_haul_id && $awb->latestStatus->status->code < AwbStatuses::LINEHAUL->value) {
            $nextStatus = AwbStatuses::LINEHAUL->value;
        } elseif ($user_id == $awb->courier_id && $awb->latestStatus->status->code < AwbStatuses::COURIER->value) {
            $nextStatus = AwbStatuses::COURIER->value;
        }

        if ($nextStatus !== null) {
            $awbStatus = AwbStatus::where('code', $nextStatus)->first();
            if ($awbStatus) {
                $awb->history()->create(['user_id' => $user_id, 'awb_status_id' => $awbStatus->id]);
                $awb->update([
                    'is_scanned' => true
                ]);
                return apiResponse(data: true, message: "AWB scaned successfully", code: 200);
            } else {
                return apiResponse(data: false, message: "AWB status not found", code: 404);
            }
        }
        return apiResponse(data: false,message: "AWB scaned before", code: 406);
    }

    //
}



