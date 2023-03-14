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

  <link rel="stylesheet" href="{{ mix('/css/app.css') }}">

  @wp_head
</head>

<body {{ body_class('body') }}>
  @include('helpers.gtm-body')

  @stack('modals')

  <div class="site wrapper">
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
  @include('helpers.google-maps-script')
  <script src="{{mix('/js/manifest.js')}}"></script>
  <script src="{{mix('/js/vendor.js')}}"></script>
  <script src="{{mix('/js/app.js')}}"></script>
  @stack('scripts')
</body>
</html>
