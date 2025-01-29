@php
use \Illuminate\Support\Arr;
@endphp
@extends('layouts.app')

@section('content')
    {{-- breadcrumb --}}
    @include('layouts.components.breadcrumb', [
        'title' => trans('app.show_client'),
        'first_list_item' => trans('app.client'),
        'last_list_item' => trans('app.show_client')
    ])
    {{-- end breadcrumb --}}

    <!-- Row -->
    <div class="row">
        <div class="col-md-12 col-xl-12 col-xs-12 col-sm-12">
            <!--div-->
            <div class="card">
                <div class="card-body">
                    <div class="row row-sm mb-4">
                        <div class="col-lg">
                            <div class="main-content-label mg-b-5">@lang('app.name')</div>
                            <label class="form-control">{{ $client->name }}</label>
                        </div>
                        <div class="col-lg">
                            <div class="main-content-label mg-b-5">@lang('app.phone')</div>
                            <label class="form-control">{{ $client->phone }}</label>
                        </div>
                    </div>

                    <!-- Display sources if they exist -->
                    @if($client->sources->isNotEmpty())
                        <div class="row row-sm mb-4">
                            <div class="col-lg">
                                <div class="main-content-label mg-b-5">@lang('app.sources')</div>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>@lang('app.category_name')</th>
                                            <th>@lang('app.price')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($client->sources as $category)
                                            <tr>
                                                <td>{{ $category->name }}</td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @else
                        <div class="row row-sm mb-4">
                            <div class="col-lg">
                                <div class="main-content-label mg-b-5">@lang('app.sources')</div>
                                <label class="form-control">@lang('app.no_sources_found')</label>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- End Row -->
@endsection
