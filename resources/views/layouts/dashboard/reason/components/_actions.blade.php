<td>
    <div class="d-flex align-items-center">
        @can('edit reasons')
            <a class="btn btn-primary me-2" href="{{ route('reasons.edit', $model->id) }}">@lang('app.edit')</a>
        @endcan
        @can('show reasons')
            <a class="btn btn-primary me-2" href="{{ route('reasons.show', $model->id) }}">@lang('app.show')</a>
        @endcan
        @can('delete reasons')
            <form action="{{ route('reasons.destroy', $model->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this item?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">@lang('app.delete')</button>
            </form>
        @endcan
    </div>
</td>
