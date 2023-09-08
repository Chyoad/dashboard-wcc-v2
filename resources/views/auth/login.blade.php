@extends('layouts.guest')

@section('content')
<section class="vh-100"">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card shadow-2-strong" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">

            <h3 class="mb-5">{{ __('Log in') }}</h3>

            <form action="{{ route('login') }}" method="POST">
              @csrf

              <div class="form-outline mb-4">
                <input type="text" id="username" name="username" class="form-control form-control-lg @error('username') is-invalid @enderror" placeholder="{{ __('Username') }}" required autocomplete="username" autofocus>
                @error('username')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="form-outline mb-4">
                <input type="password" id="password" name="password" class="form-control form-control-lg @error('password') is-invalid @enderror" placeholder="{{ __('Password') }}" required autocomplete="current-password">
                @error('password')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="form-check d-flex justify-content-start mb-4">
                <input class="form-check-input" type="checkbox" value="" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label ms-2" for="remember">{{ __('Remember password') }}</label>
              </div>

              <button type="submit" class="main-btn primary-btn btn-hover w-100 text-center">
                                    {{ __('Login') }}
                                </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>  
@endsection

