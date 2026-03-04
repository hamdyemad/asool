@extends('layouts.master')

@section('title') View Product @endsection

@section('content')
<div class="row">
    @component('common-components.breadcrumb')
        @slot('title') View Product @endslot
        @slot('li1') Lexa @endslot
        @slot('li2') Products @endslot
        @slot('li3') View @endslot
    @endcomponent
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="card-title">Product Details</h4>
                    <div>
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary waves-effect waves-light">
                            <i class="mdi mdi-pencil mr-1"></i> Edit
                        </a>
                        <a href="{{ route('products.index') }}" class="btn btn-secondary waves-effect">
                            <i class="mdi mdi-arrow-left mr-1"></i> Back
                        </a>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label font-weight-bold">ID:</label>
                            <div class="col-sm-8">
                                <p class="form-control-plaintext">{{ $product->id }}</p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label font-weight-bold">Name:</label>
                            <div class="col-sm-8">
                                <p class="form-control-plaintext">{{ $product->name }}</p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label font-weight-bold">Category:</label>
                            <div class="col-sm-8">
                                <p class="form-control-plaintext">
                                    <span class="badge badge-primary">{{ $product->category->name }}</span>
                                </p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label font-weight-bold">SubCategory:</label>
                            <div class="col-sm-8">
                                <p class="form-control-plaintext">
                                    @if($product->subCategory)
                                        <span class="badge badge-info">{{ $product->subCategory->name }}</span>
                                    @else
                                        <span class="text-muted">N/A</span>
                                    @endif
                                </p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label font-weight-bold">Description:</label>
                            <div class="col-sm-8">
                                <p class="form-control-plaintext">{{ $product->description ?? 'N/A' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label font-weight-bold">Created At:</label>
                            <div class="col-sm-8">
                                <p class="form-control-plaintext">{{ $product->created_at->format('Y-m-d H:i:s') }}</p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label font-weight-bold">Updated At:</label>
                            <div class="col-sm-8">
                                <p class="form-control-plaintext">{{ $product->updated_at->format('Y-m-d H:i:s') }}</p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label font-weight-bold">Main Image:</label>
                            <div class="col-sm-8">
                                @if($product->main_image)
                                    <img src="{{ asset('storage/' . $product->main_image) }}" alt="{{ $product->name }}" class="img-thumbnail" style="max-width: 200px;">
                                @else
                                    <p class="form-control-plaintext text-muted">No image</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                @if($product->images->count() > 0)
                    <hr>
                    <h5 class="mb-3">Additional Images</h5>
                    <div class="row">
                        @foreach($product->images as $image)
                            <div class="col-md-3 mb-3">
                                <div class="card">
                                    <img src="{{ asset('storage/' . $image->image_path) }}" class="card-img-top" alt="Product Image">
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
