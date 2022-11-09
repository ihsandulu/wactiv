
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
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
    
</div>    
@endsection