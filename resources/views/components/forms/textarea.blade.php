<div class="{{ $width }} col-12">
  <div class="mb-1">
      <label class="form-label" for="{{ $name }}">{{ $label }}</label>
      <textarea class="form-control {{ $class }}" name="{{ $name }}" id="{{ $id }}" cols="{{ $col }}" rows="{{ $row }}" placeholder="{{ $placeholder }}" aria-label="{{ $placeholder }}" {{ $required }}>{{ $value }}</textarea>
  </div>
</div>
