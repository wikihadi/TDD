<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="user_id" content="{{ $user->id }}">
        <meta name="user_name" content="{{ $user->name }}">
        <link rel="icon" href="/storage/avatar/{{ $user->avatar }}" sizes="16x16">

        <title>Tiroj Department of Design</title>

        <!-- Fonts -->
        <link href="/css/app.css" rel="stylesheet">
        <style>
            *{
                font-family: 'Vazir', sans-serif !important;
            }
            .v-application .headline, .v-application .title{
                font-family: 'Vazir', sans-serif !important;
            }
            .v-application a:hover {
                text-decoration: none !important;
            }
        </style>
    </head>
    <body>
    <div id="app">
        <dashboard v-bind:user="{{ Auth::user() }}" :unreadnotifications="{{auth()->user()->unReadNotifications}}" :readnotifications="{{auth()->user()->readNotifications}}"></dashboard>
    </div>
        <script src="/js/app.js"></script>
    </body>
</html>
