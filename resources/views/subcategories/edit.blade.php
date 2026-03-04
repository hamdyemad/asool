@extends('layouts.master')

@section('title') Edit SubCategory @endsection

@section('headerCss')
    <link href="{{ URL::asset('/libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div class="row">
    @component('common-components.breadcrumb')
        @slot('title') Edit SubCategory @endslot
        @slot('li1') Lexa @endslot
        @slot('li2') SubCategories @endslot
        @slot('li3') Edit @endslot
    @endcomponent
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Edit SubCategory</h4>

                <form action="{{ route('subcategories.update', $subCategory->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    @component('common-components.form-select', [
                        'name' => 'category_id',
                        'label' => 'Category',
                        'required' => true
                    ])
                        <option value="">Select Category</option>
                    @endcomponent

                    @component('common-components.form-input', [
                        'name' => 'name',
                        'label' => 'Name',
                        'required' => true,
                        'value' => old('name', $subCategory->name)
                    ])
                    @endcomponent

                    @component('common-components.form-textarea', [
                        'name' => 'description',
                        'label' => 'Description',
                        'value' => old('description', $subCategory->description)
                    ])
                    @endcomponent

                    @component('common-components.form-buttons', [
                        'submitText' => 'Update SubCategory',
                        'cancelUrl' => route('subcategories.index')
                    ])
                    @endcomponent
                </form>
            </div>
        </div>
    </div>
</div>
@endsection


@section('footerScript')
<script src="{{ URL::asset('/libs/select2/select2.min.js')}}"></script>
<script src="{{ URL::asset('/js/select2-ajax.js')}}"></script>
<script>
$(document).ready(function() {
    // Initialize Category Select2
    initCategorySelect2('#category_id', {
        placeholder: 'Select Category',
        allowClear: false
    });
    
    // Set initial category value
    @if($subCategory->category)
        setSelect2Value('#category_id', {{ $subCategory->category_id }}, '{{ $subCategory->category->name }}');
    @endif
});
</script>
@endsection
