@extends('layouts.app')

@section('styles')
    <link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/datatable/css/buttons.dataTables.min.css') }}" rel="stylesheet">

@endsection

@section('content')
    {{--    breadcrumb --}}
    @include('layouts.components.breadcrumb', [
        'title' => trans('app.accountings_title'),
        'first_list_item' => trans('app.accountings'),
        'last_list_item' => trans('app.all_accountings'),
    ])
    {{--    end breadcrumb --}}

    <!--start filters section -->
    @include('layouts.dashboard.accounting.components._filters')
    <!--end filterd section -->


    <!-- End Row -->
@endsection

@section('scripts')

@endsection
