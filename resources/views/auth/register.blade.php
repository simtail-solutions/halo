@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" class="application-form" autocomplete="off">
                        @csrf
<div class="row m-3">

    <div class="form-group col-md-6">
        <label for="name" class="col-form-label">{{ __('Contact Name') }}</label>

            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
    </div>

    <div class="form-group col-md-6">
        <label for="businessName" class="col-form-label">{{ __('Business Name') }}</label>

            <input id="businessName" type="text" class="form-control @error('businessName') is-invalid @enderror" name="businessName" value="{{ old('businessName') }}" required autocomplete="businessName" autofocus>

            @error('businessName')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
</div>

<div class="row m-3">
    <div class="form-group col-md-6">
        <div class="form-group" class="form-control @error('industry') is-invalid @enderror" >
            <label class="" for="industry">{{ __('Industry') }}</label>
            <select class="form-control" id="industry" name="industry">
                <option value="" disabled selected hidden></option>
                <option value="Dental">Dental</option>
                <option value="Fertility">Fertility</option>
                <option value="Hair Restoration">Hair Restoration</option>
                <option value="Plastic Surgery">Plastic Surgery</option>
                <option value="Varicose Veins">Varicose Veins</option>
                <option value="Other">Other</option>
            </select>
            @error('industry')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>


        <div class="form-group col-md-6">
        <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Phone') }}</label>

            <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus>

            @error('phone')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
</div>

<div class="row m-3">
    <div class="form-group col-md-6">
        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group col-md-6">
            <label for="abn" class="col-md-4 col-form-label text-md-right">{{ __('ABN') }}</label>
                <input type="text" id="abn" class="form-control @error('abn') is-valid @enderror" name="abn" minlength="11" maxlength="11" value="{{  old('abn') }}" required placeholder="Enter ABN with no spaces"  >
            
                @error('abn')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror

        </div>
    </div>                    

<div class="row m-3">
    <div class="form-group col-md-6">
        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group col-md-6">
            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
            </div>

</div>     

<div class="row m-3">
    <div class="form-group col d-flex justify-content-center">
        <button type="submit" class="btn btn-lg btn-info">
            {{ __('Register') }}
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
