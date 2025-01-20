@php
use \Illuminate\Support\Arr ;
@endphp
@extends('layouts.app')

@section('content')

{{-- breadcrumb --}}
@include('layouts.components.breadcrumb',['title' => trans('app.create_new_awb_title'),'first_list_item' =>
trans('app.awbs'),'last_list_item' => trans('app.add_awb')])
{{-- end breadcrumb --}}

<!-- Row -->



<!-- End Row -->

@endsection

@endsection
