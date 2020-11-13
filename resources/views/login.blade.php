@extends('layout')
@section('content')
<div class="wrapper fadeInDown">
    <div id="formContent">
      <!-- Tabs Titles -->
      <!-- Icon -->
      <div class="fadeIn first">
        <img src="http://danielzawadzki.com/codepen/01/icon.svg" id="icon" alt="User Icon" />
      </div>
      <!-- Login Form -->
      <form id="login_form" name="login_form">
          @csrf
        <input type="text" id="email" class="fadeIn second" name="email" placeholder="login">
        <input type="text" id="password" class="fadeIn third" name="password" placeholder="password">
        <input type="submit" class="fadeIn fourth" id="submit"  value="Log In">
      </form>
      {{-- <!-- Remind Passowrd -->
      <div id="formFooter">
        <a class="underlineHover" href="#">Forgot Password?</a>
      </div> --}}
    </div>
  </div>
  <script>
   $('#login_form').submit(function (evt) {
        evt.preventDefault();
        var formData = {
            'email': $('#email').val(),
            'password': $('#password').val(),
        };
       // $("#submit").value('Please wait...');
        // process the form
        $.ajax({
            type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url: "{{url('api/login')}}", // the url where we want to POST
            data: formData, // our data object
            dataType: 'JSON', // what type of data do we expect back from the server
            success: function (data) {
                if (data['message']=="success") {
                    console.log(data['user']['id']);
                    //console.log(data['access_token']);
                    Cookies.set('access_token', data['access_token']);
                    window.location.href = "{{url('books')}}";
                   // console.log(Cookies.get('access_token'));
                }
            }
        });
    });
</script>
@endsection

