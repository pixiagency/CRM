@extends('layouts.app')

@section('content')
    {{-- breadcrumb --}}
    @include('layouts.components.breadcrumb', [
        'title' => trans('app.create_new_service_title'),
        'first_list_item' => trans('app.service'),
        'last_list_item' => trans('app.add_service'),
    ])
    {{-- end breadcrumb --}}

    <!-- Row -->
    <div class="row">
        <div class="col-md-12 col-xl-12 col-xs-12 col-sm-12">
            <!--div-->
            <div class="card">
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('services.store') }}" method="post" id="service-form">
                        @csrf
                        <!-- Service Input Section -->
                        <div class="row row-sm mb-4">
                            <div class="col-lg">
                                <div class="form-group">
                                    <div class="main-content-label mg-b-5">@lang('app.name') *</div>
                                    <input class="form-control" value="{{ old('name') }}" name="name"
                                        placeholder="@lang('app.name')" type="text">
                                    @error('name')
                                        <div class="text-danger"> {{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg">
                                <div class="form-group">
                                    <div class="main-content-label mg-b-5">@lang('app.price')</div>
                                    <input class="form-control" value="{{ old('price') }}" name="price"
                                        placeholder="@lang('app.price')" type="number" step="0.01">
                                    @error('price')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Categories Section -->
                        <div class="row row-sm mb-4">
                            <div class="col-lg">
                                <div class="form-group">
                                    {{-- <div class="main-content-label mg-b-5">@lang('app.categories')</div> --}}
                                    <div id="categories-container" style="display: none;">
                                        <!-- Initial category input -->
                                        <div class="row row-sm mb-4">
                                            <div class="col-lg">
                                                <div class="form-group">
                                                    <div class="main-content-label mg-b-5">@lang('app.category_name')</div>
                                                    <input class="form-control" name="categories[0][name]" placeholder="@lang('app.category_name')" type="text">
                                                </div>
                                            </div>
                                            <div class="col-lg">
                                                <div class="form-group">
                                                    <div class="main-content-label mg-b-5">@lang('app.price')</div>
                                                    <input class="form-control" name="categories[0][price]" placeholder="@lang('app.price')" type="number" step="0.01">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" id="add-category" class="btn btn-secondary mt-2">
                                        <i class="fa fa-plus pe-2"></i>@lang('app.add_category')
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer mt-4">
                            <div class="form-group mb-0 mt-3 justify-content-end">
                                <div>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-save pe-2"></i>@lang('app.submit')
                                    </button>
                                    <a role="button" href="{{ URL::previous() }}" class="btn btn-primary">
                                        <i class="fa fa-backward pe-2"></i>@lang('app.back')
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Row -->
@endsection

@section('script_footer')
    <script>
        // Show the category input fields when the button is clicked
        document.getElementById('add-category').addEventListener('click', function () {
            const container = document.getElementById('categories-container');
            if (container.style.display === 'none') {
                container.style.display = 'block';
            } else {
                container.style.display = 'none';
            }
        });

        // Remove empty category inputs before form submission
        document.getElementById('service-form').addEventListener('submit', function (e) {
            const categoryInputs = document.querySelectorAll('.category-input');
            categoryInputs.forEach(input => {
                const name = input.querySelector('input[name*="[name]"]').value;
                const price = input.querySelector('input[name*="[price]"]').value;
                if (!name && !price) {
                    input.remove(); 
                }
            });
        });
    </script>
@endsection
