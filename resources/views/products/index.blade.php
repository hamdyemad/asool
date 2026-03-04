@extends('layouts.master')

@section('title') Products @endsection

@section('headerCss')
    <link href="{{ URL::asset('/libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div class="row">
    @component('common-components.breadcrumb')
        @slot('title') Products @endslot
        @slot('li1') Lexa @endslot
        @slot('li2') Dashboard @endslot
        @slot('li3') Products @endslot
    @endcomponent
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="card-title">Products List</h4>
                    <a href="{{ route('products.create') }}" class="btn btn-primary waves-effect waves-light">
                        <i class="mdi mdi-plus mr-1"></i> Add Product
                    </a>
                </div>

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <!-- Filter Form -->
                @component('common-components.filter-form', ['action' => route('products.index')])
                    @component('common-components.filter-input', [
                        'name' => 'search',
                        'label' => 'Search',
                        'placeholder' => 'Search by name',
                        'col' => '3'
                    ])
                    @endcomponent

                    @component('common-components.filter-select', [
                        'name' => 'category_id',
                        'label' => 'Category',
                        'col' => '3'
                    ])
                        <option value="">All Categories</option>
                    @endcomponent

                    @component('common-components.filter-select', [
                        'name' => 'sub_category_id',
                        'label' => 'SubCategory',
                        'col' => '3'
                    ])
                        <option value="">Select Category First</option>
                    @endcomponent

                    @component('common-components.filter-input', [
                        'name' => 'date_from',
                        'label' => 'Created From',
                        'type' => 'date',
                        'col' => '3'
                    ])
                    @endcomponent

                    @component('common-components.filter-input', [
                        'name' => 'date_to',
                        'label' => 'Created To',
                        'type' => 'date',
                        'col' => '3'
                    ])
                    @endcomponent
                @endcomponent

                @component('common-components.data-table', [
                    'headers' => ['#', 'Image', 'Name', 'Category', 'SubCategory', 'Description', 'Created At', 'Actions'],
                    'data' => $products,
                    'columns' => [
                        'id',
                        ['type' => 'image', 'field' => 'main_image', 'fallback' => 'name'],
                        'name',
                        ['type' => 'badge', 'field' => 'category.name', 'class' => 'primary'],
                        function($product) {
                            if($product->subCategory) {
                                return '<span class="badge badge-info">' . $product->subCategory->name . '</span>';
                            }
                            return '<span class="text-muted">-</span>';
                        },
                        ['type' => 'limit', 'field' => 'description', 'limit' => 40],
                        ['type' => 'date', 'field' => 'created_at', 'format' => 'Y-m-d'],
                        function($product) {
                            return view('common-components.action-buttons', [
                                'showUrl' => route('products.show', $product->id),
                                'editUrl' => route('products.edit', $product->id),
                                'deleteUrl' => route('products.destroy', $product->id)
                            ])->render();
                        }
                    ],
                    'emptyMessage' => 'No products found'
                ])
                @endcomponent

                <!-- Pagination -->
                @component('common-components.pagination', ['paginator' => $products])
                @endcomponent
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
    // Initialize Category Select2 for filter
    initCategorySelect2('select[name="category_id"]', {
        placeholder: 'All Categories',
        allowClear: true
    });
    
    // Load initial category value if exists
    @if(request('category_id'))
        loadSelect2InitialValue('select[name="category_id"]', {{ request('category_id') }}, '/api/categories/search');
    @endif
    
    // Initialize SubCategory Select2 for filter
    $('select[name="sub_category_id"]').data('initial-load', true);
    initSubCategorySelect2('select[name="sub_category_id"]', 'select[name="category_id"]', {
        placeholder: 'All SubCategories',
        allowClear: true
    });
    
    // Load initial subcategory value if exists
    @if(request('sub_category_id'))
        loadSelect2InitialValue('select[name="sub_category_id"]', {{ request('sub_category_id') }}, '/api/subcategories/search');
    @endif
});
</script>
@endsection

