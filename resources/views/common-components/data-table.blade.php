<div class="table-responsive">
    <table class="table table-centered table-nowrap mb-0">
        <thead class="thead-light">
            <tr>
                @foreach($headers as $header)
                    <th>{{ $header }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @forelse($data as $row)
                <tr>
                    @foreach($columns as $column)
                        <td>
                            @if(is_callable($column))
                                {!! $column($row) !!}
                            @elseif(is_array($column))
                                @if($column['type'] === 'badge')
                                    <span class="badge badge-{{ $column['class'] ?? 'primary' }}">
                                        {{ data_get($row, $column['field']) }}
                                    </span>
                                @elseif($column['type'] === 'image')
                                    @if(data_get($row, $column['field']))
                                        <img src="{{ asset('storage/' . data_get($row, $column['field'])) }}" 
                                             alt="{{ $column['alt'] ?? '' }}" 
                                             class="avatar-sm rounded">
                                    @else
                                        <div class="avatar-sm">
                                            <span class="avatar-title rounded bg-soft-primary text-primary">
                                                {{ substr(data_get($row, $column['fallback'] ?? 'name'), 0, 2) }}
                                            </span>
                                        </div>
                                    @endif
                                @elseif($column['type'] === 'date')
                                    {{ data_get($row, $column['field'])->format($column['format'] ?? 'Y-m-d') }}
                                @elseif($column['type'] === 'limit')
                                    {{ Str::limit(data_get($row, $column['field']), $column['limit'] ?? 50) }}
                                @else
                                    {{ data_get($row, $column['field']) }}
                                @endif
                            @else
                                {{ data_get($row, $column) }}
                            @endif
                        </td>
                    @endforeach
                </tr>
            @empty
                <tr>
                    <td colspan="{{ count($headers) }}" class="text-center">
                        {{ $emptyMessage ?? 'No records found' }}
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
