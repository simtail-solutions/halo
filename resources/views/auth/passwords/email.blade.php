@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" class="application-form" action="{{ route('password.email') }}">
                        @csrf

                        <div class="row my-3">
                            <div class="form-group col">
                                <label for="email" class="col-form-labelt">{{ __('E-Mail Address') }}</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div> 
                        </div>
                        
                        <div class="row my-3">
                            <div class="form-group col d-flex justify-content-center">
                                     <button type="submit" class="btn btn-lg btn-info">
                                        {{ __('Send Password Reset Link') }}
                                    </button>
                                </div>

                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
