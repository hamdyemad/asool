@extends('layouts.master')

@section('title') Edit Product @endsection

@section('headerCss')
    <link href="{{ URL::asset('/libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div class="row">
    @component('common-components.breadcrumb')
        @slot('title') Edit Product @endslot
        @slot('li1') Lexa @endslot
        @slot('li2') Products @endslot
        @slot('li3') Edit @endslot
    @endcomponent
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Edit Product</h4>

                <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    @component('common-components.form-select', [
                        'name' => 'category_id',
                        'label' => 'Category',
                        'required' => true
                    ])
                        <option value="">Select Category</option>
                    @endcomponent

                    @component('common-components.form-select', [
                        'name' => 'sub_category_id',
                        'label' => 'SubCategory'
                    ])
                        <option value="">Select Category First</option>
                    @endcomponent

                    @component('common-components.form-input', [
                        'name' => 'name',
                        'label' => 'Name',
                        'value' => old('name', $product->name),
                        'required' => true
                    ])
                    @endcomponent

                    @component('common-components.form-textarea', [
                        'name' => 'description',
                        'label' => 'Description',
                        'value' => old('description', $product->description),
                        'rows' => 4
                    ])
                    @endcomponent

                    @component('common-components.form-file', [
                        'name' => 'main_image',
                        'label' => 'Main Image',
                        'accept' => 'image/*',
                        'preview' => $product->main_image ? asset('storage/' . $product->main_image) : false,
                        'help' => 'Leave empty to keep current image'
                    ])
                    @endcomponent

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Current Images</label>
                        <div class="col-sm-10">
                            @if($product->images->count() > 0)
                                <div class="row">
                                    @foreach($product->images as $image)
                                        <div class="col-md-3 mb-3">
                                            <div class="card">
                                                <img src="{{ asset('storage/' . $image->image_path) }}" class="card-img-top" alt="Product Image">
                                                <div class="card-body p-2">
                                                    <form action="{{ route('products.deleteImage', [$product->id, $image->id]) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm btn-block" onclick="return confirm('Delete this image?')">
                                                            <i class="mdi mdi-delete"></i> Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-muted">No additional images</p>
                            @endif
                        </div>
                    </div>

                    @component('common-components.form-file', [
                        'name' => 'other_images[]',
                        'label' => 'Add More Images',
                        'accept' => 'image/*',
                        'multiple' => true,
                        'help' => 'You can select multiple images'
                    ])
                    @endcomponent

                    @component('common-components.form-buttons', [
                        'submitText' => 'Update Product',
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
    
    // Set initial category value
    @if($product->category)
        setSelect2Value('#category_id', {{ $product->category_id }}, '{{ $product->category->name }}');
    @endif
    
    // Initialize SubCategory Select2
    initSubCategorySelect2('#sub_category_id', '#category_id', {
        placeholder: 'Select SubCategory (Optional)',
        allowClear: true
    });
    
    // Set initial subcategory value
    @if($product->subCategory)
        setSelect2Value('#sub_category_id', {{ $product->sub_category_id }}, '{{ $product->subCategory->name }}');
    @endif
});
</script>
@endsection
