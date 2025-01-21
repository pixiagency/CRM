{{-- <td class="text-end">
    <div>
        <button data-bs-toggle="dropdown" class="btn btn-primary blue-logo btn-block"
            aria-expanded="false">@lang('app.details')
            <i class="icon ion-ios-arrow-down tx-11 mg-l-3"></i>
        </button>
        <div class="dropdown-menu" style="">
            <a href="{{route('locations.edit',$model->id)}}" class="dropdown-item">@lang('app.edit')</a>
            <button role="button" onclick="destroy('{{route('industies.destroy', $model->id)}}')"
                class="dropdown-item">@lang('app.delete')</button>
        </div>
        <!-- dropdown-menu -->
    </div>
</td> --}}

<td>
    <div>
        <a class="btn btn-primary" href="{{route('locations.edit',$model->id)}}">@lang('app.edit')</a>
        <button class="btn btn-danger" role="button"
            onclick="destroy('{{route('locations.destroy', $model->id)}}')">@lang('app.delete')</button>
    </div>
</td>