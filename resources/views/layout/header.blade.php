<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
  <head>
    <!-- meta-tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- CSS -->
    <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.2.1/css/bootstrap.min.css" integrity="sha384-vus3nQHTD+5mpDiZ4rkEPlnkcyTP+49BhJ4wJeJunw06ZAp+wzzeBPUXr42fi8If" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="{{asset('css/style.css')}}">

    <!-- other -->
    <link rel="icon" href="{{asset('imgs/icon.png')}}">
    <title>{{ config('app.name', 'E-School | Private School System') }}</title>
  </head>
  <body>

    <!-- header (title) -->
    <header class="py-2 text-white">
      <div class="container">
        <!-- title -->
        <section class="text-center my-5">
          <img src="{{asset('imgs/logo.png')}}" alt="Logo" class="mb-2">
          <h2 class="mb-4">عنوان رئيسي</h2>
          <p>بعض النصائح للطلاب وزوار الموقع</p>
        </section>
      </div>
    </header>
