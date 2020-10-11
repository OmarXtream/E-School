@extends('layout.master')
@section('content')

    <!-- page content -->
    <section class="d-flex justify-content-center align-items-center" id="page-content">
      <div class="container bg-light border shadow rounded overflow-hidden">
        <div class="row">

          <div class="col-md-6 py-4 justify-content-center order-1">
            <p class="text-muted mb-3">قم بتعبئة البيانات التالية لإتمام عملية تسجيل الدخول</p>
            <form method="POST" action="{{ route('login') }}">
                @csrf

      <div class="form-row">
                <div class="col-12 mb-4">
                  <label for="email">البريد الإلكتروني:</label>
                  <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Email@name.com" required>
                  @error('email')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                  @enderror

                </div>

                <div class="col-12 mb-4">
                  <label for="password">كلمة السر:</label>
                  <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="*****" required>
                  @error('password')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror

                </div>

                <div class="col-12 clearfix">
                  <button class="btn btn-primary float-right">تسجيل الدخول</button>
                </div>
              </div>
            </form>
          </div>

          <div class="col-md-6 py-3 d-flex justify-content-center align-items-center text-white order-0 order-md-2" style="background-color: #8B7277;">
            <h3 class="title">تسجيل الدخول</h3>
          </div>

        </div>
      </div>
    </section>
    @endsection

