{{-- <td class="text-end">
    <div>
        <button data-bs-toggle="dropdown" class="btn btn-primary blue-logo btn-block"
            aria-expanded="false">@lang('app.details')
            <i class="icon ion-ios-arrow-down tx-11 mg-l-3"></i>
        </button>
        <div class="dropdown-menu" style="">
            @can('edit_price_tables')
            <a href="{{route('industies.edit',$model->id)}}" class="dropdown-item">@lang('app.edit')</a>
            @endcan
            @can('delete_price_tables')
            <button role="button" onclick="destroy('{{route('industies.destroy', $model->id)}}')"
                class="dropdown-item">@lang('app.delete')</button>
            @endcan
        </div>
        <!-- dropdown-menu -->
    </div>
</td> --}}

<td>
    <div>
        @can('edit industries')
            <a class="btn btn-primary" href="{{route('industries.edit',$model->id)}}">@lang('app.edit')</a>
        @endcan

        @can('delete industries')
            <button class="btn btn-danger" role="button"
                onclick="destroy('{{route('industries.destroy', $model->id)}}')">@lang('app.delete')</button>
        @endcan
    </div>
</td>
