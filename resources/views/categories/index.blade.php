@extends('layouts.master')

@section('title') Categories @endsection

@section('content')
<div class="row">
    @component('common-components.breadcrumb')
        @slot('title') Categories @endslot
        @slot('li1') Lexa @endslot
        @slot('li2') Dashboard @endslot
        @slot('li3') Categories @endslot
    @endcomponent
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="card-title">Categories List</h4>
                    <a href="{{ route('categories.create') }}" class="btn btn-primary waves-effect waves-light">
                        <i class="mdi mdi-plus mr-1"></i> Add Category
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
                @component('common-components.filter-form', ['action' => route('categories.index')])
                    @component('common-components.filter-input', [
                        'name' => 'search',
                        'label' => 'Search',
                        'placeholder' => 'Search by name or description',
                        'col' => '4'
                    ])
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
                    'headers' => ['#', 'Name', 'Description', 'Created At', 'Actions'],
                    'data' => $categories,
                    'columns' => [
                        'id',
                        'name',
                        ['type' => 'limit', 'field' => 'description', 'limit' => 50],
                        ['type' => 'date', 'field' => 'created_at', 'format' => 'Y-m-d'],
                        function($category) {
                            return view('common-components.action-buttons', [
                                'showUrl' => route('categories.show', $category->id),
                                'editUrl' => route('categories.edit', $category->id),
                                'deleteUrl' => route('categories.destroy', $category->id)
                            ])->render();
                        }
                    ],
                    'emptyMessage' => 'No categories found'
                ])
                @endcomponent

                <!-- Pagination -->
                @component('common-components.pagination', ['paginator' => $categories])
                @endcomponent
            </div>
        </div>
    </div>
</div>
@endsection
