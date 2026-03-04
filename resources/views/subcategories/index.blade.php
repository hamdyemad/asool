@extends('layouts.master')

@section('title') SubCategories @endsection

@section('headerCss')
    <link href="{{ URL::asset('/libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div class="row">
    @component('common-components.breadcrumb')
        @slot('title') SubCategories @endslot
        @slot('li1') Lexa @endslot
        @slot('li2') Dashboard @endslot
        @slot('li3') SubCategories @endslot
    @endcomponent
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="card-title">SubCategories List</h4>
                    <a href="{{ route('subcategories.create') }}" class="btn btn-primary waves-effect waves-light">
                        <i class="mdi mdi-plus mr-1"></i> Add SubCategory
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
                @component('common-components.filter-form', ['action' => route('subcategories.index')])
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

                    @component('common-components.filter-input', [
                        'name' => 'date_from',
                        'label' => 'Created From',
                        'type' => 'date',
                        'col' => '2'
                    ])
                    @endcomponent

                    @component('common-components.filter-input', [
                        'name' => 'date_to',
                        'label' => 'Created To',
                        'type' => 'date',
                        'col' => '2'
                    ])
                    @endcomponent
                @endcomponent

                @component('common-components.data-table', [
                    'headers' => ['#', 'Category', 'Name', 'Description', 'Created At', 'Actions'],
                    'data' => $subCategories,
                    'columns' => [
                        'id',
                        ['type' => 'badge', 'field' => 'category.name', 'class' => 'primary'],
                        'name',
                        ['type' => 'limit', 'field' => 'description', 'limit' => 50],
                        ['type' => 'date', 'field' => 'created_at', 'format' => 'Y-m-d'],
                        function($subCategory) {
                            return view('common-components.action-buttons', [
                                'showUrl' => route('subcategories.show', $subCategory->id),
                                'editUrl' => route('subcategories.edit', $subCategory->id),
                                'deleteUrl' => route('subcategories.destroy', $subCategory->id)
                            ])->render();
                        }
                    ],
                    'emptyMessage' => 'No subcategories found'
                ])
                @endcomponent

                <!-- Pagination -->
                @component('common-components.pagination', ['paginator' => $subCategories])
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
});
</script>
@endsection
