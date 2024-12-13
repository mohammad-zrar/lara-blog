<textarea
    {{ $attributes->merge(['class' => 'bg-orange-50/50 border border-orange-300 text-orange-900 text-sm rounded-sm focus:ring-1 focus:ring-orange-600 focus:border-orange-500 block w-full py-1 px-2 outline-none resize-none']) }}>{{ $slot }}</textarea>
