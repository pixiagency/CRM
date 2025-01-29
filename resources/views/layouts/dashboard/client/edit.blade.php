@extends('layouts.app')

@section('content')

{{-- Breadcrumb --}}
@include('layouts.components.breadcrumb', [
    'title' => trans('app.edit_client_title'),
    'first_list_item' => trans('app.client'),
    'last_list_item' => trans('app.edit_client'),
])
{{-- End Breadcrumb --}}

<!-- Row -->
<div class="row">
    <div class="col-md-12 col-xl-12 col-xs-12 col-sm-12">
        <!-- Div -->
        <div class="card">
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('clients.update', $client->id) }}" method="post">
                    @csrf
                    @method('put')
                    <div class="row row-sm mb-4">
                        <!-- Name Field -->
                        <div class="col-lg">
                            <div class="form-group">
                                <div class="main-content-label mg-b-5">@lang('app.name') *</div>
                                <input
                                    class="form-control"
                                    value="{{ old('name', $client->name) }}"
                                    name="name"
                                    placeholder="@lang('app.name')"
                                    type="text"
                                >
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row row-sm mb-4">
                        <!-- Phone Field -->
                        <div class="col-lg">
                            <div class="form-group">
                                <div class="main-content-label mg-b-5">@lang('app.phone') *</div>
                                <input
                                    class="form-control"
                                    value="{{ old('phone', $client->phone) }}"
                                    name="phone"
                                    placeholder="@lang('app.phone')"
                                    type="text"
                                >
                                @error('phone')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row row-sm mb-4">
                        <!-- Email Field -->
                        <div class="col-lg">
                            <div class="form-group">
                                <div class="main-content-label mg-b-5">@lang('app.email') *</div>
                                <input
                                    class="form-control"
                                    value="{{ old('email', $client->email) }}"
                                    name="email"
                                    placeholder="@lang('app.email')"
                                    type="email"
                                >
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row row-sm mb-4">
                        <!-- Address Field -->
                        <div class="col-lg">
                            <div class="form-group">
                                <div class="main-content-label mg-b-5">@lang('app.address') *</div>
                                <input
                                    class="form-control"
                                    value="{{ old('address', $client->address) }}"
                                    name="address"
                                    placeholder="@lang('app.address')"
                                    type="text"
                                >
                                @error('address')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row row-sm mb-4">
                        <!-- Resource Field -->
                        <div class="col-lg">
                            <div class="form-group">
                                <div class="main-content-label mg-b-5">@lang('app.source') *</div>
                                <select class="form-control" name="resource_id">
                                    <option value="">@lang('app.select_source')</option>
                                    @foreach ($sources as $resource)
                                        <option value="{{ $resource->id }}" {{ old('resource_id', $client->resource_id) == $resource->id ? 'selected' : '' }}>
                                            {{ $resource->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('resource_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row row-sm mb-4">
                        <!-- Custom Fields -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="main-content-label mg-b-5">@lang('app.custom_fields')</div>
                                @foreach ($customFields as $field)
                                    <div>
                                        <label class="main-content-label mg-b-5">{{ $field->name }} *</label>
                                        @if ($field->type === 'text')
                                            <input type="text" name="custom_fields[{{ $field->id }}]" class="form-control" value="{{ old('custom_fields.' . $field->id, $client->custom_fields[$field->id] ?? '') }}">
                                        @elseif ($field->type === 'number')
                                            <input type="number" name="custom_fields[{{ $field->id }}]" class="form-control" value="{{ old('custom_fields.' . $field->id, $client->custom_fields[$field->id] ?? '') }}">
                                        @elseif ($field->type === 'date')
                                            <input type="date" name="custom_fields[{{ $field->id }}]" class="form-control" value="{{ old('custom_fields.' . $field->id, $client->custom_fields[$field->id] ?? '') }}">
                                        @elseif ($field->type === 'dropdown')
                                            <select name="custom_fields[{{ $field->id }}]" class="form-control">
                                                @foreach ($field->options as $option)
                                                    <option value="{{ $option }}" {{ (old('custom_fields.' . $field->id) == $option) ? 'selected' : '' }}>{{ $option }}</option>
                                                @endforeach
                                            </select>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="row row-sm mb-4">
                        <!-- Industries -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <div class="main-content-label mg-b-5">@lang('app.industry') *</div>
                                <div class="d-flex flex-wrap">
                                    @foreach ($industries as $industry)
                                        <div class="form-check me-3 mb-2">
                                            <input
                                                class="form-check-input"
                                                type="checkbox"
                                                name="industry[]"
                                                value="{{ $industry->id }}"
                                                id="industry-{{ $industry->id }}"
                                                {{ in_array($industry->id, old('industry', $client->industries->pluck('id')->toArray())) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="industry-{{ $industry->id }}">
                                                {{ $industry->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                                @error('industry')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row row-sm mb-4">
                        <!-- Services -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <div class="main-content-label mg-b-5">@lang('app.services') *</div>
                                <div class="d-flex flex-wrap">
                                    @foreach ($services as $service)
                                        <div class="form-check me-3 mb-2">
                                            <input
                                                class="form-check-input"
                                                type="checkbox"
                                                name="services[]"
                                                value="{{ $service->id }}"
                                                id="service-{{ $service->id }}"
                                                {{ in_array($service->id, old('services', $client->services->pluck('id')->toArray())) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="service-{{ $service->id }}">
                                                {{ $service->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                                @error('services')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="card-footer mt-4">
                        <div class="form-group mb-0 mt-3 justify-content-end">
                            <div>
                                <button type="submit" class="btn btn-primary"><i class="fa fa-save pe-2"></i>@lang('app.submit')</button>
                                <a role="button" href="{{ URL::previous() }}" class="btn btn-secondary"><i class="fa fa-backward pe-2"></i>@lang('app.back')</a>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<!-- End Row -->

@endsection

@push('scripts')
    <!-- Additional scripts can be added here -->
@endpush
