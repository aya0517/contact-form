@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
<link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
@endsection

@section('content')

<div class="thanks-container">
    <div class="background-text">Thank you</div>
    <div class="main-text">
        <p>お問い合わせありがとうございました</p>
    </div>
    <div class="home__button">
        <a href="{{ url('/') }}" class="home__button-submit">HOME</a>
    </div>
</div>

@endsection