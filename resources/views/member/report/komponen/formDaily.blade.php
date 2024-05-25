<div class="row mb-3">
    <div class="col-10">
        <div class="input-group input-group-sm">
            <input type="text" name="text{{ $index }}" class="form-control form-control-sm {{ $errors->has('text') ? 'border-danger' : '' }}" value="{{ old('text') }}" autocomplete="off">
        </div>
    </div>
    <div class="col-2" >
        <input  type="number" min="1" name="score{{ $index }}" maxlength="3" max="100" id="score" onchange="handleChange(this);" />
    </div>
</div>