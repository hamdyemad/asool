<div class="form-group row">
    <label for="{{ $id ?? $name }}" class="col-sm-2 col-form-label">
        {{ $label }}
        @if($required ?? false)
            <span class="text-danger">*</span>
        @endif
    </label>
    <div class="col-sm-10">
        @if($preview ?? false)
            <div class="mb-2">
                <img src="{{ $preview }}" alt="{{ $label }}" class="img-thumbnail" style="max-width: 200px;">
            </div>
        @endif
        <input 
            class="form-control @error($name) is-invalid @enderror" 
            type="file" 
            name="{{ $name }}" 
            id="{{ $id ?? $name }}"
            accept="{{ $accept ?? 'image/*' }}"
            {{ ($required ?? false) ? 'required' : '' }}
            {{ ($multiple ?? false) ? 'multiple' : '' }}
        >
        @error($name)
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
        @if($help ?? false)
            <small class="form-text text-muted">{{ $help }}</small>
        @endif
    </div>
</div>
