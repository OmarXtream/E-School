@extends('layout.manager.master')
@section('content')

    <!-- page content -->
    <section class="" id="page-content">
        <div class="container bg-light border shadow rounded overflow-hidden py-4 my-4">
          <div class="row">
            <div class="col-12 mb-3 text-center">
              <h4 class="title" style="border-color: #8B7277">المدرسين</h4>
            </div>
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif

            <div class="col-12 mb-2">
              <button class="text-white btn btn-primary d-inlin-block mb-3" data-toggle="modal" data-target="#createUsingModal">مدرس جديد</button>
              <div class="table-responive">
                <table class="table table-striped text-center table-hover">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">المدرس</th>
                      <th scope="col">المستوى</th>
                      <th scope="col">-</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th scope="row">1</th>
                      <td>حمد محمد</td>
                      <td>المستوى 1</td>
                      <td>حذف - تعديل</td>
                    </tr>
                    <tr>
                      <th scope="row">2</th>
                      <td>أحمد محمد</td>
                      <td>المستوى 2</td>
                      <td>حذف - تعديل</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Modal -->
      <div class="modal fade" id="createUsingModal" tabindex="-1" role="dialog" aria-labelledby="createUsingModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="createUsingModalTitle">مدرس جديد</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form method="POST">
                <div class="form-row">
                  <div class="col-12 mb-3">
                    <label for="name">الإسم</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="حمد محمد" required>
                  </div>
                  <div class="col-12 mb-3">
                    <label for="email">البريد الإلكتروني</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="email@name.com" required>
                  </div>
                  <div class="col-12 mb-3">
                    <label for="password">كلمة السر</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="*********" required>
                  </div>
                  <div class="col-12 mb-3">
                    <label for="level">المستوى</label>
                    <select name="level" id="" class="form-control">
                      <option value="0" selected disabled>قم بإختيار المستوى</option>
                      <option value="1">المستوى 1</option>
                      <option value="2">المستوى 2</option>
                      <option value="3">المستوى 3</option>
                    </select>
                  </div>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
              <button type="button" class="btn btn-primary">إنشاء</button>
            </div>
          </div>
        </div>
      </div>

@endsection

