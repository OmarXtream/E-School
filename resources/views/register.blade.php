@extends('layout.master')
@section('content')

    <!-- page content -->
    <section class="d-flex justify-content-center align-items-center" id="page-content">
        <div class="container bg-light border shadow rounded overflow-hidden">
          <div class="row">
  
            <div class="col-md-6 py-4 justify-content-center order-1">
              <p class="text-muted mb-3">قم بتعبئة البيانات التالية لإتمام عملية التسجيل</p>
              <form method="POST">
                <div class="form-row">
                  <div class="col-12 mb-4">
                    <label for="email">البريد الإلكتروني:</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="Email@name.com" required>
                  </div>
  
                  <div class="col-12 mb-4">
                    <label for="name">الإسم الكامل:</label>
                    <input type="text" id="name" name="name" class="form-control" placeholder="حمد حامد محمد" required>
                  </div>
  
  
                  <div class="col-12 mb-4">
                    <label for="email">كلمة السر:</label>
                    <input type="password" id="email" name="email" class="form-control" placeholder="*****" required>
                  </div>
  
                  <div class="col-12 mb-4">
                    <label for="email">مفتاح التسجيل:</label>
                    <input type="text" id="email" name="email" class="form-control" placeholder="12345" required>
                  </div>
  
                  <div class="col-12 mb-4">
                    <label for="name">صورة شخصية:</label>
                    <input type="file" id="name" name="name" placeholder="حمد حامد محمد" required>
                  </div>
  
                  <div class="col-12 clearfix">
                    <button class="btn btn-primary float-right">تسجيل الدخول</button>
                  </div>
                </div>
              </form>
            </div>
  
            <div class="col-md-6 py-3 d-flex justify-content-center align-items-center text-white order-0 order-md-2" style="background-color: #8B7277;">
              <h3 class="title">تسجيل جديد</h3>
            </div>
  
          </div>
        </div>
      </section>
      @endsection

