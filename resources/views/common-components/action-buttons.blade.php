@if($showUrl ?? false)
    <a href="{{ $showUrl }}" class="btn btn-sm btn-info" title="View">
        <i class="mdi mdi-eye"></i>
    </a>
@endif

@if($editUrl ?? false)
    <a href="{{ $editUrl }}" class="btn btn-sm btn-primary" title="Edit">
        <i class="mdi mdi-pencil"></i>
    </a>
@endif

@if($deleteUrl ?? false)
    <form action="{{ $deleteUrl }}" method="POST" class="d-inline">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('{{ $confirmMessage ?? 'Are you sure?' }}')" title="Delete">
            <i class="mdi mdi-delete"></i>
        </button>
    </form>
@endif

{{ $slot ?? '' }}
