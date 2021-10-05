
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Admin - @yield('title')</title>

  @include('glob_partials.css_assets')
  @stack('custom-style')
  <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
  <div id="app">
    <div class="main-wrapper">
      
      @include('admin._partials.navbar')

      @include('admin._partials.sidebar')

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>@yield('breadcumb-title')</h1>
          </div>

          @yield('content')

        </section>
      </div>
  
      @include('glob_partials.footer')
    </div>
  </div>

  @include('glob_partials.js_asset')

  @stack('custom-js')

</body>
</html>
