@if ($rating)
    @for ($i = 1; $i <= 5; $i++)
        <span class="{{ $i <= round($rating) ? 'text-yellow-400' : 'text-gray-300' }}">★</span>
    @endfor
@else
    <span class="text-slate-400">No rating yet</span>
@endif
