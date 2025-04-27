@extends('layouts.app')

@section('title', 'お問い合わせありがとうございました')

@section('content')
<link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
<div class="thanks-bg">Thank you</div>
<div class="thanks-message">
    お問い合わせありがとうございました</div>
    <a href="{{ route('contact.form') }}" class="home-btn">HOME</a>
    @endsection