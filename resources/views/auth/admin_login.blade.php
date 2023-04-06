@extends('layouts.admin')

@section('admin_content')
<div class="hold-transition login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
          <div class="card-header text-center">
            <a href="{{ url('/') }}" class="h1"><b>Admin</b>Panel</a>
          </div>
          <div class="card-body">
            <p class="login-box-msg">Admin Login Panel</p>
      
            <form action="{{ route('login') }}" method="post">
                @csrf
                <div class="input-group mb-3">
                    <input type="email" class="form-control" name="email" required autocomplete="email" placeholder="Email" autofocus>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                @if($errors->has('email'))
                    <small style="color:red">{{ $errors->first('email') }}</small>
                @endif
                <div class="input-group mb-3">
                    <input id="password" type="password" class="form-control" name="password" required autocomplete="current-password" placeholder="Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                @if($errors->has('password'))
                    <small style="color:red">{{ $errors->first('password') }}</small>
                @endif
            <div class="row">
                <div class="col-8">
                  <div class="icheck-primary">
                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label for="remember">
                      Remember Me
                    </label>
                  </div>
                </div>
                <!-- /.col -->
                <div class="col-4">
                  <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                </div>
                <!-- /.col -->
              </div>
            </form>
      
            <p class="mb-1">
              <a href="#">I forgot my password</a>
            </p>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
@endsection