@extends('layouts.master')

@section('title') View Category @endsection

@section('content')
<div class="row">
    @component('common-components.breadcrumb')
        @slot('title') View Category @endslot
        @slot('li1') Lexa @endslot
        @slot('li2') Categories @endslot
        @slot('li3') View @endslot
    @endcomponent
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="card-title">Category Details</h4>
                    <div>
                        <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-primary waves-effect waves-light">
                            <i class="mdi mdi-pencil mr-1"></i> Edit
                        </a>
                        <a href="{{ route('categories.index') }}" class="btn btn-secondary waves-effect">
                            <i class="mdi mdi-arrow-left mr-1"></i> Back
                        </a>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label font-weight-bold">ID:</label>
                            <div class="col-sm-8">
                                <p class="form-control-plaintext">{{ $category->id }}</p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label font-weight-bold">Name:</label>
                            <div class="col-sm-8">
                                <p class="form-control-plaintext">{{ $category->name }}</p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label font-weight-bold">Description:</label>
                            <div class="col-sm-8">
                                <p class="form-control-plaintext">{{ $category->description ?? 'N/A' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label font-weight-bold">Created At:</label>
                            <div class="col-sm-8">
                                <p class="form-control-plaintext">{{ $category->created_at->format('Y-m-d H:i:s') }}</p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label font-weight-bold">Updated At:</label>
                            <div class="col-sm-8">
                                <p class="form-control-plaintext">{{ $category->updated_at->format('Y-m-d H:i:s') }}</p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label font-weight-bold">SubCategories:</label>
                            <div class="col-sm-8">
                                <p class="form-control-plaintext">{{ $category->subCategories->count() }}</p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label font-weight-bold">Products:</label>
                            <div class="col-sm-8">
                                <p class="form-control-plaintext">{{ $category->products->count() }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                @if($category->subCategories->count() > 0)
                    <hr>
                    <h5 class="mb-3">SubCategories</h5>
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($category->subCategories as $subCategory)
                                    <tr>
                                        <td>{{ $subCategory->id }}</td>
                                        <td>{{ $subCategory->name }}</td>
                                        <td>{{ Str::limit($subCategory->description, 50) }}</td>
                                        <td>
                                            <a href="{{ route('subcategories.show', $subCategory->id) }}" class="btn btn-sm btn-info">
                                                <i class="mdi mdi-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
