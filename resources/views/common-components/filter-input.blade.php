<div class="col-md-{{ $col ?? '3' }}">
    <div class="form-group">
        <label for="{{ $id ?? $name }}">{{ $label }}</label>
        <input 
            type="{{ $type ?? 'text' }}" 
            class="form-control" 
            id="{{ $id ?? $name }}" 
            name="{{ $name }}" 
            value="{{ request($name) }}"
            placeholder="{{ $placeholder ?? '' }}"
        >
    </div>
</div>
