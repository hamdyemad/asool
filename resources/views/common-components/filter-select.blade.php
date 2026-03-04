<div class="col-md-{{ $col ?? '3' }}">
    <div class="form-group">
        <label for="{{ $id ?? $name }}">{{ $label }}</label>
        <select class="form-control" id="{{ $id ?? $name }}" name="{{ $name }}">
            {{ $slot }}
        </select>
    </div>
</div>
