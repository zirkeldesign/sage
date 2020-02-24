@if ($items)
<section class="accordion">
  @foreach ($items as $id => $item)
  <article id="{{{ $item['id'] ?? "accordion-{$id}" }}}" class="w-full overflow-hidden border-t">
    <header>
      <{{ $title_tag }}>{{ $item['title'] }}</{{ $title_tag }}>
    </header>
    <div>
      {!! $item['content'] !!}
    </div>
  </article>
  @endforeach
</section>
@endif
