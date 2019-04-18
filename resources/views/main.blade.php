@extends('layouts.app')

@section('content')

  <nav class="navbar navbar-light navbar-white">
    <a title="News" aria-label="News" class="nav-item nav-link active" href=""><i class="fas fa-newspaper fa-2x nav-icon"></i><span class="nav-text">News</span></a>
    <a class="nav-item nav-link active" href=""><i class="fas fa-calendar-alt fa-2x nav-icon"></i><span class="nav-text">Events</span></a>
  </nav>

  @if (Auth::check())
    <form method="POST" action="{{ action('PostController@store') }}">
      @csrf
      <div class="row align-items-end">
        <div class="form-group col-md col-sm-12">
          <textarea class="form-control" name="body" placeholder="{{ __('post.new_hint')}}" aria-label="{{ __('post.new')}}" required>{{ old('body') }}</textarea>
        </div>
        <div class="form-group col-auto">
          <button class="btn btn-primary float-right" type="submit">{{ __('post.create')}}</button>
        </div>
      </div>
      @include('layouts.errors')
    </form>
  @endif
  @foreach ($posts as $post)
    @component('components.post.show')
      @slot('post', $post)
        {{ $post->body }}
    @endcomponent
  @endforeach

  @endsection
