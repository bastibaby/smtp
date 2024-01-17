@if (getenv("ENVIRONMENT") == 'production' && getenv('GOOGLE_ANALYTICS'))
    @if ( !isPagespeed() )
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id={{ getenv('GOOGLE_ANALYTICS') }}"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', "{{ getenv('GOOGLE_ANALYTICS') }}");
        </script>
    @endif
@endif
