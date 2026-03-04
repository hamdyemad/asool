@extends('layouts.master')

@section('title') View SubCategory @endsection

@section('content')
<div class="row">
    @component('common-components.breadcrumb')
        @slot('title') View SubCategory @endslot
        @slot('li1') Lexa @endslot
        @slot('li2') SubCategories @endslot
        @slot('li3') View @endslot
    @endcomponent
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="card-title">SubCategory Details</h4>
                    <div>
                        <a href="{{ route('subcategories.edit', $subCategory->id) }}" class="btn btn-primary waves-effect waves-light">
                            <i class="mdi mdi-pencil mr-1"></i> Edit
                        </a>
                        <a href="{{ route('subcategories.index') }}" class="btn btn-secondary waves-effect">
                            <i class="mdi mdi-arrow-left mr-1"></i> Back
                        </a>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label font-weight-bold">ID:</label>
                            <div class="col-sm-8">
                                <p class="form-control-plaintext">{{ $subCategory->id }}</p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label font-weight-bold">Category:</label>
                            <div class="col-sm-8">
                                <p class="form-control-plaintext">
                                    <span class="badge badge-primary">{{ $subCategory->category->name }}</span>
                                </p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label font-weight-bold">Name:</label>
                            <div class="col-sm-8">
                                <p class="form-control-plaintext">{{ $subCategory->name }}</p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label font-weight-bold">Description:</label>
                            <div class="col-sm-8">
                                <p class="form-control-plaintext">{{ $subCategory->description ?? 'N/A' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label font-weight-bold">Created At:</label>
                            <div class="col-sm-8">
                                <p class="form-control-plaintext">{{ $subCategory->created_at->format('Y-m-d H:i:s') }}</p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label font-weight-bold">Updated At:</label>
                            <div class="col-sm-8">
                                <p class="form-control-plaintext">{{ $subCategory->updated_at->format('Y-m-d H:i:s') }}</p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label font-weight-bold">Products:</label>
                            <div class="col-sm-8">
                                <p class="form-control-plaintext">{{ $subCategory->products->count() }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                @if($subCategory->products->count() > 0)
                    <hr>
                    <h5 class="mb-3">Products</h5>
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
                                @foreach($subCategory->products as $product)
                                    <tr>
                                        <td>{{ $product->id }}</td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ Str::limit($product->description, 50) }}</td>
                                        <td>
                                            <a href="{{ route('products.show', $product->id) }}" class="btn btn-sm btn-info">
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
