@php
use \Illuminate\Support\Arr ;
@endphp
@extends('layouts.app')

@section('content')

{{-- breadcrumb --}}
@include('layouts.components.breadcrumb',['title' => trans('app.show_resource_title'),'first_list_item' =>
trans('app.resource'),'last_list_item' => trans('app.show_resource')])
{{-- end breadcrumb --}}

<!-- Row -->

<!-- Row -->
<div class="row">
    <div class="col-md-12 col-xl-12 col-xs-12 col-sm-12">
        <!--div-->
        <div class="card">
            <div class="card-body">

                <div class="row row-sm mb-4">
                    <div class="col-lg">
                        <div class="main-content-label mg-b-5">@lang('app.name')</div>
                        <label class="form-control">{{ $resource->name }}</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- End Row -->

<!-- End Row -->

@endsection
