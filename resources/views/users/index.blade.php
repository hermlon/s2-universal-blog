@extends('layouts.app')

@section('title', __('user.users'))

@section('content')

  <div class="container-fluid">
    <h1>{{ __('user.users') }}</h1>
    <hr>
    @foreach ($users as $user)
      @component('components.user.show')
        @slot('user', $user)
      @endcomponent
    @endforeach
  </div>

@endsection
