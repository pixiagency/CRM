<td class="text-end">
    <div>
        <button data-bs-toggle="dropdown" class="btn btn-primary blue-logo btn-block" aria-expanded="false"
            type="button">@lang('app.details')
            <i class="icon ion-ios-arrow-down tx-11 mg-l-3"></i>
        </button>
        <div class="dropdown-menu">
            <a href="{{ route('industries.show', $model->id) }}" class="dropdown-item">@lang('app.show')</a>
            <a href="{{ route('industries.edit', $model->id) }}" class="dropdown-item">@lang('app.edit')</a>
            <button role="button" onclick="destroy('{{ $url }}')" class="dropdown-item">@lang('app.delete')</button>
        </div>
        <!-- dropdown-menu -->
    </div>
</td>