
@extends('templates/main')
@section('container')
<div class="container mt-5">
    <div class="row  d-flex justify-content-center p-5 mt-5 ">
      <form action="{{ url("/login") }}" method="post" class="col-md-5 border p-5 rounded-3">
        @csrf
        <h1 class="d-flex justify-content-center mb-5">Login</h1>
        <div class="mb-3">
          <label for="email" class="form-label">Email address</label>
          <input value="{{ old('email') }}" autofocus required name="email" type="email" class="form-control @error('email') is-invalid @enderror" id="email" aria-describedby="emailHelp">
          <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
          @error('email') 
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input value="{{ old('password') }}" required name="password" type="password" class="form-control @error('password') is-invalid @enderror" id="password">
          @error('password') 
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
        <div class="mb-3">
          <label for="remember" class="form-label">Remember Me</label>
          <input value="{{ old('remember') }}" name="remember" type="checkbox" class="" id="remember">         
        </div>
        <div class="row">        
          <div class="col-md-4">          
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
          <div class="col-md-4">
            <a class="text-success mt-2 d-flex justify-content-center align-items-center" href="{{url('/register')}}">Register</a>
          </div>
          <div class="col-md-4">
            <a class="text-success mt-2"  style="float:right;" href="{{url('/redirectgoogle')}}">
              <img src="<?=url('images/google.png');?>" style="height:30px; width:auto;" />
            </a>
          </div>
        </div>
      </form>
    </div>
    
</div>    
@endsection