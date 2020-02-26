<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>@yield('title')</title>
  <link rel="stylesheet" href="{{ asset('css/Admin/bootstrap.min.css') }}">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU"
    crossorigin="anonymous">
  <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
  @yield('ckeditor')
</head>

<body>
  {{-- Start header --}}
  <div class="container-fluid">
    <div class="row">
      <div class="col-12 px-0">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark justify-content-between">
          <a class="navbar-brand" href="{{ route('admin') }}">Admin Page</a>
          <h3 class="text-light text-uppercase">@yield('header')</h3>
          <div class="navbar-nav mx-3">
            <i class="fas fa-user-circle fa-fw text-light mt-2 mr-1"></i>
            <span class="text-light mr-2 mt-1">{{ Auth::user()->name }}</span>
            <a href="{{asset(route('index'))  }}"><button class="btn btn-success mr-2">Home Site</button></a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST">
              {{ csrf_field() }}
              <button type="button" class="btn border-0 btn-primary text-capitalize" data-toggle="modal" data-target="#logoutConfirm">Logout</button>
              <!-- Button trigger modal -->

              <!-- Modal -->
              <div class="modal fade" id="logoutConfirm" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Alert!!!</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      Do you want to Logout?
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger text-uppercase" data-dismiss="modal">Cancel</button>
                      <button type="submit" class="btn btn-primary text-uppercase">Okay</button>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </nav>
      </div>
    </div>
  </div>
  {{-- End header --}}