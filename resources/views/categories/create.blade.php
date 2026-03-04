@extends('layouts.master')

@section('title') Create Category @endsection

@section('content')
<div class="row">
    @component('common-components.breadcrumb')
        @slot('title') Create Category @endslot
        @slot('li1') Lexa @endslot
        @slot('li2') Categories @endslot
        @slot('li3') Create @endslot
    @endcomponent
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Create New Category</h4>

                <form action="{{ route('categories.store') }}" method="POST">
                    @csrf
                    
                    @component('common-components.form-input', [
                        'name' => 'name',
                        'label' => 'Name',
                        'required' => true,
                        'value' => old('name')
                    ])
                    @endcomponent

                    @component('common-components.form-textarea', [
                        'name' => 'description',
                        'label' => 'Description',
                        'value' => old('description')
                    ])
                    @endcomponent

                    @component('common-components.form-buttons', [
                        'submitText' => 'Save Category',
                        'cancelUrl' => route('categories.index')
                    ])
                    @endcomponent
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
