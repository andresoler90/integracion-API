<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id={{env('ANALYTICS_GOOGLE_ID')}}"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', '{{env('ANALYTICS_GOOGLE_ID')}}');


    @if(Auth::check())
    //Usuario Logueado
    gtag('set', {'user_id': '{{Auth::user()->lg1_user}}'});

        @if (Session::has('googleEvent'))
        //Evento
        @php($eventGoogle=Session::get('googleEvent'))
        gtag('event', '{{$eventGoogle['name']}}', {
            'event_label' : '{{$eventGoogle['label']}}',
            'event_category' : '{{$eventGoogle['category']}}'
        });
        @endif
    @endif
</script>