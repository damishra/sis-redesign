<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Dishant et. al present: ') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script>
        function simulatedClick(target, options) {

            var event = target.ownerDocument.createEvent('MouseEvents'),
                options = options || {},
                opts = { // These are the default values, set up for un-modified left clicks
                    type: 'click',
                    canBubble: true,
                    cancelable: true,
                    view: target.ownerDocument.defaultView,
                    detail: 1,
                    screenX: 0, //The coordinates within the entire page
                    screenY: 0,
                    clientX: 0, //The coordinates within the viewport
                    clientY: 0,
                    ctrlKey: false,
                    altKey: false,
                    shiftKey: false,
                    metaKey: false, //I *think* 'meta' is 'Cmd/Apple' on Mac, and 'Windows key' on Win. Not sure, though!
                    button: 0, //0 = left, 1 = middle, 2 = right
                    relatedTarget: null,
                };

            //Merge the options with the defaults
            for (var key in options) {
                if (options.hasOwnProperty(key)) {
                    opts[key] = options[key];
                }
            }

            //Pass in the options
            event.initMouseEvent(
                opts.type,
                opts.canBubble,
                opts.cancelable,
                opts.view,
                opts.detail,
                opts.screenX,
                opts.screenY,
                opts.clientX,
                opts.clientY,
                opts.ctrlKey,
                opts.altKey,
                opts.shiftKey,
                opts.metaKey,
                opts.button,
                opts.relatedTarget
            );

            //Fire the event
            target.dispatchEvent(event);
        }
        function openCity(evt, cityName) {
            // Declare all variables
            var i, tabcontent, tablinks;

            // Get all elements with class="tabcontent" and hide them
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }

            // Get all elements with class="tablinks" and remove the class "active"
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
			
			document.getElementById(cityName).style.display = "block";
			evt.currentTarget.className += " active";

		}
		function doLoad(){
            let target = document.getElementsByClassName('tablinks')[0];
            if(target) simulatedClick(target);
        }
    </script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Muli" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/normalize.css') }}" rel="stylesheet">
    <link href="{{ asset('css/skeleton.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
</head>
<body onload="doLoad()">
    <div id="app">
        @include('inc.nav')
        <div class="centered">
            @yield('content')
        </div>
    </div>
    @include('inc.messages')
</body>
</html>
