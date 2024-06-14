<span class="text-xs text-red-500">
  @if ($errors->has($field))
    {{ $errors->first($field) }}
  @endif
</span>
