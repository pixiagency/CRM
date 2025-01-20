@extends('layouts.app')

@section('content')

{{-- breadcrumb --}}
@include('layouts.components.breadcrumb', [
    'title' => trans('app.edit_service_title'),
    'first_list_item' => trans('app.service'),
    'last_list_item' => trans('app.edit_service'),
])
{{-- end breadcrumb --}}

<!-- Row -->
<div class="row">
    <div class="col-md-12 col-xl-12 col-xs-12 col-sm-12">
        <!--div-->
        <div class="card">
            <div class="card-body">
                <form action="{{ route('services.update', $service->id) }}" method="post">
                    @csrf
                    @method('put')
                    <div class="row row-sm mb-4">
                        <div class="col-lg">
                            <div class="main-content-label mg-b-5">@lang('app.name') *</div>
                            <input class="form-control" value="{{ $service->name }}" name="name"
                                placeholder="@lang('app.name')" type="text">
                            @error('name')
                                <div class="text-danger"> {{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Add Price Field -->
                    <div class="row row-sm mb-4">
                        <div class="col-lg">
                            <div class="main-content-label mg-b-5">@lang('app.price') *</div>
                            <input class="form-control" value="{{ $service->price }}" name="price"
                                placeholder="@lang('app.price')" type="number" step="0.01">
                            @error('price')
                                <div class="text-danger"> {{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="card-footer mt-4">
                        <div class="form-group mb-0 mt-3 justify-content-end">
                            <div>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-save pe-2"></i>@lang('app.submit')
                                </button>

                                <a role="button" href="{{ URL::previous() }}" class="btn btn-primary">
                                    <i class="fa fa-backward pe-2"></i>@lang('app.back')
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
