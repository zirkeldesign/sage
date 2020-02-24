@if ($items)
<section class="accordion">
  @foreach ($items as $id => $item)
  <article id="{{{ $item['id'] ?? "accordion-{$id}" }}}" class="w-full overflow-hidden tab">
    <input id="{{{ $item['id'] ?? "accordion-{$id}" }}}-cb" class="absolute opacity-0" style="display:none" type="radio" name="tabs" aria-hidden="true">
    <header class="flex items-center justify-between px-3 py-2 border-b cursor-pointer select-none">
      <label class="flex items-center justify-between flex-1 cursor-pointer" for="{{{ $item['id'] ?? "accordion-{$id}" }}}-cb">
        <{{ $title_tag }} class="mb-0">{{ $item['title'] }}</{{ $title_tag }}>
        <div class="flex items-center justify-center flex-shrink-0 w-6 h-6 p-1 ml-3 border rounded-full">
          <svg aria-hidden="true" width="16" height="16" class="fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
          </svg>
        </div>
      </label>
    </header>
    <div class="overflow-hidden tab-content">
      <div class="px-3 py-2">{!! $item['content'] !!}</div>
    </div>
  </article>
  @endforeach
</section>
@endif
