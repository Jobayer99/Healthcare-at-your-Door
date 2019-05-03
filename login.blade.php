@extends('client.layout.master')

@section('content')
<section class="hero-wrap hero-wrap-2" style="background-image: url('images/bg_1.jpg');"
    data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
      <div class="row no-gutters slider-text align-items-center justify-content-center">
        <div class="col-md-9 ftco-animate text-center">
          <h1 class="mb-2 bread">Login</h1>
          <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home <i
                  class="ion-ios-arrow-forward"></i></a></span> <span>Login <i class="ion-ios-arrow-forward"></i></span>
          </p>
        </div>
      </div>
    </div>
  </section>

  <section class="ftco-section ftco-no-pt ftco-no-pb ftco-counter img" id="section-counter"
    style="background-image: url(images/bg_3.jpg);" data-stellar-background-ratio="0.5">
    <div class="container">
      <div class="row">
        <div class="col-md-6 py-5 pr-md-5">
          <div class="heading-section heading-section-white ftco-animate mb-5">
            @if(Session::has('flash'))
            <div class="alert alert-danger alert-dismissible">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              <strong>Access denied!</strong> {{Session::get('flash')}}
            </div>
            @endif
            <span class="subheading">Consultation</span>
            <h2 class="mb-4">Register here</h2>
          </div>
          <form action="{{url('/user-registration')}}" class="appointment-form ftco-animate" method="post">
            {{csrf_field()}}
            <div class="d-md-flex">
              <div class="form-group">
                <input type="text" required class="form-control" placeholder="First Name" name="first_name">
              </div>
              <div class="form-group ml-md-4">
                <input type="text" required class="form-control" placeholder="Last Name" name="last_name">
              </div>
            </div>
            <div class="d-md-flex">
              <div class="form-group">
                <div class="form-group ml-md-4">
                  <input type="email" required class="form-control" placeholder="Email" name="email">
                </div>
                <div class="form-group ml-md-4">
                  <input type="text" required class="form-control" placeholder="Skype ID" name="skype">
                </div>
              </div>
            </div>

            <div class="d-md-flex">
              <div class="form-group">
                <div class="input-wrap">
                  <div class="icon"><span class="ion-md-calendar"></span></div>
                  <input type="text" class="form-control appointment_date" placeholder="Birth" required name="birth_date">
                </div>
              </div>
              <div class="form-group ml-md-4">
                <input type="password" class="form-control" required placeholder="Password" name="password">
              </div>
            </div>
            <div class="form-group ml-md-4">
              <input type="submit" name="loginsubmit" value="Submit" class="btn btn-secondary py-3 px-4">
            </div>

          </form>
        </div>
  </section>



  <section class="ftco-section ftco-no-pt ftco-no-pb contact-section">
    <div class="container">
      <div class="row d-flex align-items-stretch no-gutters">
        <div class="col-md-6 p-4 p-md-5 order-md-last bg-light">

          <div class="form-group">
            <form id="form-group" method="post" action="user-login-attempt">
              {{csrf_field()}}
              <input type="email" name="email" class="form-control" placeholder="Email">
          </div>

          <div class="form-group">
            <input type="password" name="password" class="form-control" placeholder="Password">
          </div>

          <div class="form-group">
            <select name="user_role" class="form-control">
              <option value="0" selected >Login as patient</option>
              <option value="1">Login as doctor</option>
            </select>
          </div>

          <div class="form-group">
            <input type="submit" class="btn btn-primary py-3 px-5" value="Login">
          </div>

          </form>
        </div>

      </div>
    </div>
  </section>
@endsection
