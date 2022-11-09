
@extends('templates/main')
@section('container')
<div class="container mt-5">
    <div class="row  d-flex justify-content-center p-5 mt-5 ">
      <form action="{{ url("/register") }}" method="post" class="col-md-5 border p-5 rounded-3">
        @csrf
        <h1 class="d-flex justify-content-center mb-5">Register</h1>
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
          <input onkeyup="confirm();" value="{{ old('password') }}" required name="password" type="text" class="form-control @error('password') is-invalid @enderror" id="password">
          @error('password') 
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
        <div class="mb-3">
          <label for="cpassword" class="form-label">Confirm Password</label>
          <input onkeyup="confirm();" value="{{ old('cpassword') }}" required  type="text" class="form-control @error('cpassword') is-invalid @enderror" id="cpassword">
          @error('cpassword') 
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
          <div id="mpass" class="alert alert-danger">
          </div>
          <script>
            function confirm(){
              let pass=$("#password").val();
              let cpass=$("#cpassword").val();
              if(pass==cpass){
                $("#mpass").hide();
                $("#mpass").text("");
              }else{
                $("#mpass").show();
                $("#mpass").text("Password tidak sama!");
              }
            }
            confirm();
            </script>
        </div>
        <div class="mb-3">
          <label for="username" class="form-label">User Name</label>
          <input value="{{ old('username') }}" required name="username" type="text" class="form-control @error('username') is-invalid @enderror" id="username" aria-describedby="usernameHelp">
          <div id="usernameHelp" class="form-text">We'll never share your username with anyone else.</div>
          @error('username') 
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
        <!-- <div class="mb-3 mt-3">
            <label for="user_picture" class="form-label">Picture:</label>
            <input type="file" class="form-control" id="user_picture" placeholder="Enter Picture" name="user_picture" value="{{ old('user_picture') }}"><br/>
            <?php if(old('user_picture')!=""){$user_image="images/user_picture/".$posts["user_picture"];}else{$user_image="images/nopicture.png";}?>
            <img id="user_picture_image" width="100" height="100" src="<?=url($user_image);?>"/>
            <script>
                function readURL(input) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();
            
                        reader.onload = function (e) {
                            $('#user_picture_image').attr('src', e.target.result);
                        }
            
                        reader.readAsDataURL(input.files[0]);
                    }
                }
            
                $("#user_picture").change(function () {
                    readURL(this);
                });
            </script>
        </div> -->
        <div class="row">        
          <div class="col-md-6">          
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
          <div class="col-md-6">
            <a class="text-success mt-2"  style="float:right;" href="{{url('/redirectgoogle')}}">Google</a>
          </div>
        </div>
      </form>
    </div>
    
</div>    
@endsection