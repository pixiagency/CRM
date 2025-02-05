@extends('layouts.app')

@section('content')
{{-- breadcrumb --}}
@include('layouts.components.breadcrumb', [
'title' => trans('app.piplines_title'),
'first_list_item' => trans('app.piplines'),
'last_list_item' => trans('app.create_pipline'),
])
{{-- end breadcrumb --}}

<!-- Row -->
<div class="row row-sm">
    <div class="col-lg-12">
        <div class="card custom-card">
            <div class="card-header">
                
            </div>
            <div class="card-body">
                <form action="{{ route('piplines.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Pipeline Name</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="stages">Stages</label>
                        <div id="stages">
                            <div class="stage">
                                <input type="text" name="stages[0][name]" class="form-control" placeholder="Stage Name" required>
                                <input type="number" name="stages[0][seq_number]" class="form-control" placeholder="Sequence Number" required>
                            </div>
                        </div>
                        <button type="button" id="addStage" class="btn btn-primary mt-3">Add Stage</button>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Row -->
@endsection

@push('scripts')
<script>
    document.getElementById('addStage').addEventListener('click', function() {
        const stagesDiv = document.getElementById('stages');
        const stageCount = stagesDiv.querySelectorAll('.stage').length;
        const newStage = document.createElement('div');
        newStage.classList.add('stage');
        newStage.innerHTML = `
            <input type="text" name="stages[${stageCount}][name]" class="form-control" placeholder="Stage Name" required>
            <input type="number" name="stages[${stageCount}][seq_number]" class="form-control" placeholder="Sequence Number" required>
        `;
        stagesDiv.appendChild(newStage);
    });
</script>
@endpush
