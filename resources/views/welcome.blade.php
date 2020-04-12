<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

    {{-- Font awesome --}}
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
     
    {{-- This div will be replaced with the Vue instance --}}
    <div id="app">
        <!-- use router-link component for navigation. -->
        <!-- specify the link by passing the `to` prop. -->
        <!-- `<router-link>` will be rendered as an `<a>` tag by default -->
            <router-link :to="{name: 'welcome'}">Home</router-link>
            <router-link :to="{name: 'home'}">Dashboard</router-link>
            <router-link :to="{name: 'login'}">login</router-link>
            <router-link :to="{name: 'register'}">register</router-link>
        
        {{-- Component matched by the route '/' will render here --}}
        <router-view></router-view>
        
    </div>
    

    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
