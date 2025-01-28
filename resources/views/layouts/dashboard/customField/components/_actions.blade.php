<td>
    <div class="d-flex align-items-center">
        @can('edit customFields')
            <a class="btn btn-primary me-2" href="{{ route('custom-fields.edit', $model->id) }}">@lang('app.edit')</a>
        @endcan
        @can('show customFields')
            <a class="btn btn-primary me-2" href="{{ route('custom-fields.show', $model->id) }}">@lang('app.show')</a>
        @endcan
        @can('delete customFields')
            <form action="{{ route('custom-fields.destroy', $model->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this item?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">@lang('app.delete')</button>
            </form>
        @endcan
    </div>
</td>
