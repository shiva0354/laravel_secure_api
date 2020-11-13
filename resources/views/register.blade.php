@extends('layout')
@section('content')
<div class="wrapper fadeInDown">
    <div id="formContent">
      <!-- Tabs Titles -->
      <!-- Icon -->
      <div class="fadeIn first">
        <img src="http://danielzawadzki.com/codepen/01/icon.svg" id="icon" alt="User Icon" />
      </div>
      <!-- Register Form -->
    <form action="{{url('api/register')}}" method="POST">
          @csrf
        <input type="text" id="name" class="fadeIn second" name="name" placeholder="name">
        <input type="text" id="email" class="fadeIn second" name="email" placeholder="email">
        <input type="text" id="password" class="fadeIn third" name="password" placeholder="password">
        <input type="text" id="password_confirm" class="fadeIn third" name="password_confirmation" placeholder="password_confirm">
        <input type="submit" class="fadeIn fourth" value="Register">
    </form>
    </div>
  </div>
@endsection
