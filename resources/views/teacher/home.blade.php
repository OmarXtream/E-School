@extends('layout.teacher.master')
@section('content')



    <!-- page content -->
    <section class="" id="page-content">
        <div class="container bg-light border shadow rounded overflow-hidden py-4 my-4">
          <div class="row">
            <div class="col-12 mb-3 text-center">
              <h4 class="title" style="border-color: #8B7277">الطلبة</h4>
            </div>

            <div class="col-12 mb-2">
              <div class="table-responive">
                <table class="table table-striped text-center table-hover">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">الطالب</th>
                      <th scope="col">المستوى</th>
                      <th scope="col">مجموع الدرجات</th>
                      <th scope="col">-</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th scope="row">1</th>
                      <td>حمد محمد</td>
                      <td>المستوى 1</td>
                      <td>200</td>
                      <td>ترقية - إخفاض</td>
                    </tr>
                    <tr>
                      <th scope="row">2</th>
                      <td>أحمد محمد</td>
                      <td>المستوى 2</td>
                      <td>150</td>
                      <td>ترقية - إخفاض</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </section>

@endsection

