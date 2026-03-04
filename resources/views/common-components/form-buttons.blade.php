<div class="form-group row">
    <div class="col-sm-10 offset-sm-2">
        <button type="submit" class="btn btn-primary waves-effect waves-light">
            <i class="mdi mdi-content-save mr-1"></i> {{ $submitText ?? 'Save' }}
        </button>
        <a href="{{ $cancelUrl }}" class="btn btn-secondary waves-effect">
            <i class="mdi mdi-cancel mr-1"></i> {{ $cancelText ?? 'Cancel' }}
        </a>
    </div>
</div>
