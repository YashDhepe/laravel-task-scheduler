<div class="{{ $width }} col-12 pb-3 {{ $type == 'hidden'?'d-none':'' }}">
    <div class="mb-1">

        <label class="form-label {{ $type == 'hidden'?'hidden':'' }}" for="{{ $name }}">
            {{ $label }} 
            {!! !isset($previewLink)?'':'<a class="text-primary" target="_blank" href="'.asset($previewLink).'">(Preview)</a>' !!}
        </label>

        <input type="{{ $type }}" name="{{ $name }}" id="{{ $id }}" value="{{ $value }}" {{ $readOnly }}  maxlength="{{ $maxLength }}"
            class="form-control {{ $class }}" placeholder="{{ $placeholder }}" aria-label="{{ $placeholder }}" accept="{{ $accept }}" value="{{ old($name) }}"
            required />

        @error("$name")
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
</div>
