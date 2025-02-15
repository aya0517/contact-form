@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{asset('css/sanitize.css')}}" />
<link rel="stylesheet" href="{{asset('css/thanks.css')}}" />

<div class="text">
    <div class="background-text">
        <p>Thank you</p>
    </div>
    <div class="main-text">
        <p>お問い合わせありがとうございました</p>
    </div>
    <div class="home__button">
        <a href="{{ route('contact.show') }}" class="home__button-submit">HOME</a>
    </div>
</div>
@endsection