@extends('app')
@section('nav_title', '网站免责')
@section('title', '网站免责')
@section('sub_title', '网站免责')
@section('main_content')
<iframe id="main" src="{{ URL::asset('extend/pages/law.html')  }}" name="main" frameborder="0" height="900px" width="100%" scrolling="auto" onload="this.height=main.document.body.scrollHeight"></iframe>
@endsection