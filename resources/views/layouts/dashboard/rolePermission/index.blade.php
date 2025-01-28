@extends('layouts.app')

@section('content')
{{-- breadcrumb --}}
@include('layouts.components.breadcrumb', [
'title' => trans('app.permission_title'),
'first_list_item' => trans('app.permission'),
'last_list_item' => trans('app.permission'),
])
{{-- end breadcrumb --}}

<div class="row">
    <div class="col-md-12 col-xl-12 col-xs-12 col-sm-12">
        <!--div-->
        <div class="card">
            <div class="card-body">

            <h1>Select Role</h1>
            <form id="role-form" method="GET">
                @csrf
                <div class="form-group mb-3">
                    <label for="role">Select Role</label>
                    <select name="role" id="role" class="form-control" required>
                        <option value="">-- Select Role --</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary" id="view-permissions-button" disabled><i
                                            class="fa fa-save pe-2"></i>@lang('View Permissions')</button>
            </form>
        </div>
    </div>
</div>
</div>
@endsection

@push('scripts')
<script>
    document.getElementById('role').addEventListener('change', function() {
        const roleId = this.value;
        const form = document.getElementById('role-form');
        if (roleId) {
            form.action = "{{ route('role-permissions.show', ['role' => ':role']) }}".replace(':role', roleId);
            document.getElementById('view-permissions-button').disabled = false;
        } else {
            form.action = "#";
            document.getElementById('view-permissions-button').disabled = true;
        }
    });
</script>
@endpush
