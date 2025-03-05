
@if (!$textarea)
    <div class="row mb-3">
        <label class="{{ $classLabel }} col-form-label py-0">
            {{ $label }}
            @if ($isRequired)
                <span class="text-danger">*</span>
            @endif
        </label>
        <div class="{{ $classField }}">
            <div class="input-group input-group-sm">
                <input type="{{ $type }}" name="{{ $name }}"
                    class="form-control form-control-sm @error($name) is-invalid @enderror" value="{{ old($name,$value) }}"
                    @if($isRequired) required @endif @if($readonly) readonly @endif @if($disabled) disabled @endif>
                @if ($isDate)
                    <span class="input-group-text"><i class="bi-calendar2"></i></span>
                @endif
            </div>
            
            @if ($errors->has($name))
                <div class="small text-danger">{{ $errors->first($name) }}</div>
            @endif
        </div>
    </div>
@else
    <div class="row mb-3">
        <label class="{{ $classLabel }} col-form-label py-0">{{ $label }}
            @if ($isRequired)
                <span class="text-danger">*</span>
            @endif
        </label>
        <div class="{{ $classField }}">
            <textarea name="{{ $name }}"
                class="form-control form-control-sm {{ $errors->has($name) ? 'border-danger' : '' }}" rows="3">{{ old($name,$value) }}</textarea>
            @if ($errors->has($name))
                <div class="small text-danger">{{ ucfirst($errors->first($name)) }}</div>
            @endif
        </div>
    </div>
@endif
