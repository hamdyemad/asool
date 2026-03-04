<div class="form-group row">
    <label for="{{ $id ?? $name }}" class="col-sm-2 col-form-label">
        {{ $label }}
        @if($required ?? false)
            <span class="text-danger">*</span>
        @endif
    </label>
    <div class="col-sm-10">
        <input 
            class="form-control @error($name) is-invalid @enderror" 
            type="{{ $type ?? 'text' }}" 
            name="{{ $name }}" 
            id="{{ $id ?? $name }}" 
            value="{{ $value ?? old($name) }}"
            placeholder="{{ $placeholder ?? '' }}"
            {{ ($required ?? false) ? 'required' : '' }}
            {{ $attributes ?? '' }}
        >
        @error($name)
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
        @if($help ?? false)
            <small class="form-text text-muted">{{ $help }}</small>
        @endif
    </div>
</div>
