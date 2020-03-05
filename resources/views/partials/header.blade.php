<header class="sticky top-0 z-10 banner">
  <div class="container flex items-center justify-between max-w-6xl mx-auto">
    <a class="flex-shrink brand" href="{{ home_url('/') }}">
      <img class="w-auto h-6 lg:h-8 font-display" alt="{{ $siteName }}" />
      <span class="text-xs leading-none">{{ "siteDescription" }}</span>
    </a>

    <nav class="nav-primary">
      @if (has_nav_menu('primary_navigation'))
        {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav', 'echo' => false]) !!}
      @endif
    </nav>
  </div>
</header>
