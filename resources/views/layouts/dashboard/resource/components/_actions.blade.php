<td>
    <div class="d-flex align-items-center">
        @can('edit sources')
            <a class="btn btn-primary me-2" href="{{ route('resources.edit', $model->id) }}"><i class="icon-pencil"></i></a>
        @endcan
        @can('view sources')
        <a class="btn btn-primary me-2" href="{{ route('resources.show', $model->id) }}"><i class="icon-eye"></i></a>
        @endcan
        @can('delete sources')
        <form action="{{ route('resources.destroy', $model->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this item?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger"> <i class="icon-trash"></i></button>
        </form>
        @endcan
    </div>
</td>
