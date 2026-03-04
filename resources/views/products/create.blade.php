@extends('layouts.master')

@section('title') Create Product @endsection

@section('headerCss')
    <link href="{{ URL::asset('/libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div class="row">
    @component('common-components.breadcrumb')
        @slot('title') Create Product @endslot
        @slot('li1') Lexa @endslot
        @slot('li2') Products @endslot
        @slot('li3') Create @endslot
    @endcomponent
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Create New Product</h4>

                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    @component('common-components.form-select', [
                        'name' => 'category_id',
                        'label' => 'Category',
                        'required' => true
                    ])
                        <option value="">Select Category</option>
                    @endcomponent

                    @component('common-components.form-select', [
                        'name' => 'sub_category_id',
                        'label' => 'SubCategory',
                        'attributes' => 'disabled'
                    ])
                        <option value="">Select Category First</option>
                    @endcomponent

                    @component('common-components.form-input', [
                        'name' => 'name',
                        'label' => 'Name',
                        'required' => true
                    ])
                    @endcomponent

                    @component('common-components.form-textarea', [
                        'name' => 'description',
                        'label' => 'Description',
                        'rows' => 4
                    ])
                    @endcomponent

                    @component('common-components.form-file', [
                        'name' => 'main_image',
                        'label' => 'Main Image',
                        'accept' => 'image/*'
                    ])
                    @endcomponent

                    @component('common-components.form-file', [
                        'name' => 'other_images[]',
                        'label' => 'Other Images',
                        'accept' => 'image/*',
                        'multiple' => true,
                        'help' => 'You can select multiple images'
                    ])
                    @endcomponent

                    @component('common-components.form-buttons', [
                        'submitText' => 'Save Product',
                        'cancelUrl' => route('products.index')
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
    
    // Initialize SubCategory Select2
    initSubCategorySelect2('#sub_category_id', '#category_id', {
        placeholder: 'Select SubCategory (Optional)',
        allowClear: true
    });
});
</script>
@endsection
