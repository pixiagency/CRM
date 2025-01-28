
<td>
    <div class="d-flex align-items-center">
        @can('edit services')
            <a class="btn btn-primary me-2" href="{{ route('services.edit', $model->id) }}">@lang('app.edit')</a>
        @endcan
        @can('show services')
            <a class="btn btn-primary me-2" href="{{ route('services.show', $model->id) }}">@lang('app.show')</a>
        @endcan
        @can('delete services')
        <form action="{{ route('services.destroy', $model->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this item?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">@lang('app.delete')</button>
        </form>
        @endcan
    </div>
</td>
