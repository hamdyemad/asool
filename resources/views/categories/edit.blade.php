@extends('layouts.master')

@section('title') Edit Category @endsection

@section('content')
<div class="row">
    @component('common-components.breadcrumb')
        @slot('title') Edit Category @endslot
        @slot('li1') Lexa @endslot
        @slot('li2') Categories @endslot
        @slot('li3') Edit @endslot
    @endcomponent
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Edit Category</h4>

                <form action="{{ route('categories.update', $category->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    @component('common-components.form-input', [
                        'name' => 'name',
                        'label' => 'Name',
                        'value' => old('name', $category->name),
                        'required' => true
                    ])
                    @endcomponent

                    @component('common-components.form-textarea', [
                        'name' => 'description',
                        'label' => 'Description',
                        'value' => old('description', $category->description),
                        'rows' => 4
                    ])
                    @endcomponent

                    @component('common-components.form-buttons', [
                        'submitText' => 'Update Category',
                        'cancelUrl' => route('categories.index')
                    ])
                    @endcomponent
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
