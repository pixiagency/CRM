@extends('layouts.app')

@section('content')

    {{-- breadcrumb --}}
    @include('layouts.components.breadcrumb', [
        'title' => trans('app.create_new_service_title'),
        'first_list_item' => trans('app.service'),
        'last_list_item' => trans('app.add_service'),
    ])
    {{-- end breadcrumb --}}

    {{-- content --}}

@endsection
@section('script_footer')

@endsection
