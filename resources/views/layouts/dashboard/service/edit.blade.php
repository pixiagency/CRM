@extends('layouts.app')

@section('content')

{{-- breadcrumb --}}
@include('layouts.components.breadcrumb', [
'title' => trans('app.edit_awb_title'),
'first_list_item' => trans('app.awbs'),
'last_list_item' => trans('app.edit_awb'),
])
{{-- end breadcrumb --}}

{{-- content --}}

@endsection

@endsection
