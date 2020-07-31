<form method="GET" action="{{ $actionUrl }}">
    <div class="col-md-4 px-0">
        <div class="form-group">
            <div class="input-group">
                <input type="text" name="search_query"
                       class="form-control {{ $errors->has('search_query') ? ' is-invalid' : '' }}"
                       value="{{ $searchQuery ?? old('search_query') }}"
                       placeholder="{{ @$placeholder ?? 'Search' }}">
                <div class="input-group-append">
                    <button type="submit" class="input-group-text">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
            @if ($errors->has('search_query'))
                <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $errors->first('search_query') }}</strong>
                </span>
            @endif
        </div>
    </div>
</form>