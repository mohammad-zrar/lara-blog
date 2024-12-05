  @props(['name'])

  @error($name)
      <span class="text-xs text-red-500 italic font-semibold mt-1">{{ $message }}</span>
  @enderror
