<td>
    <div>
        @can('edit locations')

        <a class="btn btn-primary" href="{{route($path,$model->id)}}">@lang('app.edit')</a>
        @endcan

        @can('delete locations')
        <button class="btn btn-danger" role="button"
            onclick="destroy('{{route('locations.destroy', $model->id)}}')">@lang('app.delete')</button>
        @endcan
    </div>
</td>