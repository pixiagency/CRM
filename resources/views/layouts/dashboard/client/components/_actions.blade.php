<td>
    <div class="d-flex align-items-center">
        @can('edit clients')
            <a class="btn btn-primary me-2" href="{{ route('clients.edit', $model->id) }}">@lang('app.edit')</a>
        @endcan
        @can('show clients')
            <a class="btn btn-primary me-2" href="{{ route('clients.show', $model->id) }}">@lang('app.show')</a>
        @endcan
        @can('delete clients')
            <form action="{{ route('clients.destroy', $model->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this item?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">@lang('app.delete')</button>
            </form>
        @endcan
    </div>
</td>
