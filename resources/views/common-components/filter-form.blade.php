<div class="card border mb-3">
    <div class="card-body">
        <form method="GET" action="{{ $action }}">
            <div class="row">
                {{ $slot }}
                
                <div class="col-md-2">
                    <div class="form-group">
                        <label>&nbsp;</label>
                        <div>
                            <button type="submit" class="btn btn-primary btn-block">
                                <i class="mdi mdi-magnify"></i> Filter
                            </button>
                            <a href="{{ $action }}" class="btn btn-secondary btn-block mt-1">
                                <i class="mdi mdi-refresh"></i> Reset
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
