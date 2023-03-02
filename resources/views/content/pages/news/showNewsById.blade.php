@php
$configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Home')

@section('content')

<div class="card p-2">
    <h1>{{$dataNew[0]->news_title}}</h1>
    @php
        echo $dataNew[0]->news_detail;
    @endphp
</div>
@endsection
