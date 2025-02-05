<td>
    <div class="d-flex align-items-center">
        @can('edit customFields')
            <a class="btn btn-primary me-2" href="{{ route('custom-fields.edit', $model->id) }}"><i class="icon-pencil"></i></a>
        @endcan
        @can('view customFields')
            <a class="btn btn-primary me-2" href="{{ route('custom-fields.show', $model->id) }}"><i class="icon-eye"></i></a>
        @endcan
        @can('delete customFields')
            <form action="{{ route('custom-fields.destroy', $model->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this item?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"><i class="icon-trash"></i></button>
            </form>
        @endcan
    </div>
</td>
