<!DOCTYPE html>
<html lang="es">
<head>
  @include('helpers.gtm-head')
  @include('helpers.google-analytics')
  @include('helpers.robots')

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no, user-scalable=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  @include('helpers.favicons')
  @include('helpers.hotjar')
  @include('helpers.facebook-pixel')

  <!-- Cambiado mix() por asset() para ruta correcta -->
  <link rel="stylesheet" href="{{ asset('content/themes/meat-theme/dist/css/app.css') }}">
  <link rel="stylesheet" href="{{ asset('content/themes/meat-theme/dist/css/styles.css') }}">
  <!-- Static resources which could be delayed -->
  <link crossorigin="anonymous" href="https://fonts.googleapis.com/css?family=Oswald:300,400|Playball|Raleway|Orbitron" rel="stylesheet">

  @wp_head
</head>

<body {{ body_class('body') }} style="background: url({{ themosis_assets() . '/images/back.jpg' }}) no-repeat center center">
  @include('helpers.gtm-body')

  @stack('modals')

  <div class="site wrapper" style="padding-top: none">
    <div class="site__header">
      @include('components.header-default')
    </div>

    <div class="site__content">
      @yield("content")
    </div>

    <div class="site__footer">
      @include('components.footer-default')
    </div>
  </div>

  @wp_footer

  <!-- Cambiado mix() por asset() para ruta correcta -->
  <script src="{{ asset('content/themes/meat-theme/dist/js/manifest.js') }}"></script>
  <script src="{{ asset('content/themes/meat-theme/dist/js/vendor.js') }}"></script>
  <script src="{{ asset('content/themes/meat-theme/dist/js/app.js') }}"></script>

  @stack('scripts')
</body>
</html>
