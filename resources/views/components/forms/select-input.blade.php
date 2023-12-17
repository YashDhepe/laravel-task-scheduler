<div class="{{ $width }} col-12">
    <div class="mb-1">
        <label class="form-label"
            for="{{ $name }}">{{ $label }}</label>
        <select name="{{ $name }}" id="{{ $id }}" {{ $multiple }} class="form-control {{ $class }} ">
            @if (!is_null($options))
                @if (!is_null($placeholder))
                    <option selected disabled value="">{{ $placeholder }}</option>
                @endif
                @forelse ($options as $option)
                    <option {{ !is_null($val)?(($option['id'] == $val)?'selected':''):'' }} value="{{ $option[$optionKey] }}">{{ $option["$key"] }}</option>
                @empty
                    <option selected disabled>No Records Found</option>
                @endforelse
            @endif
        </select>
    </div>
</div>
