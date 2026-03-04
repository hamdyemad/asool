<div class="form-group row">
    <label for="{{ $id ?? $name }}" class="col-sm-2 col-form-label">
        {{ $label }}
        @if($required ?? false)
            <span class="text-danger">*</span>
        @endif
    </label>
    <div class="col-sm-10">
        <textarea 
            class="form-control @error($name) is-invalid @enderror" 
            name="{{ $name }}" 
            id="{{ $id ?? $name }}" 
            rows="{{ $rows ?? 4 }}"
            placeholder="{{ $placeholder ?? '' }}"
            {{ ($required ?? false) ? 'required' : '' }}
        >{{ $value ?? old($name) }}</textarea>
        @error($name)
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
        @if($help ?? false)
            <small class="form-text text-muted">{{ $help }}</small>
        @endif
    </div>
</div>
