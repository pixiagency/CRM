
<td>
    <div class="d-flex align-items-center">
        <a class="btn btn-primary me-2" href="{{ route('services.edit', $model->id) }}">@lang('app.edit')</a>
        <a class="btn btn-primary me-2" href="{{ route('services.show', $model->id) }}">@lang('app.show')</a>
        <form action="{{ route('services.destroy', $model->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this item?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">@lang('app.delete')</button>
        </form>
    </div>
</td>
