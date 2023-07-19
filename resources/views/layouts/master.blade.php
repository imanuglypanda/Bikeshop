<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Bikeshop | จำหน่ายอะไหล่จักรยานออนไลน์')</title>

    {{-- css --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/font-awesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/toastr/build/toastr.min.css') }}">

    {{-- js --}}
    <script src="{{ asset('js/angular.min.js') }}"></script>
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('vendor/toastr/build/toastr.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
</head>

<body>
    <div class="container">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="navbar-header">
                <a class="navbar-brand" href="{{ URL::to('') }}">Bikeshop</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li><a href="{{ URL::to('home') }}">หน้าแรก</a></li>
                    @guest
                    @else
                        <li><a href="{{ URL::to('product') }}">จัดการข้อมูลสินค้า</a></li>
                        <li><a href="{{ URL::to('category') }}">ประเภทสินค้า</a></li>
                        <li><a href="#">รายงาน</a></li>
                    @endguest
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    @guest
                        <li><a href="{{ route('login') }}">ล็อกอิน</a></li>
                        <li><a href="{{ route('register') }}">ลงทะเบียน</a></li>
                    @else
                        <li><a href="#">{{ Auth::user()->name }} </a></li>
                        <li>
                            <a href="{{ route('logout') }}">ออกจากระบบ </a>
                        </li>
                        <li>
                            <a href="{{ URL::to('cart/view') }}"> 
                                <i class="fa fa-shopping-cart"></i> ตะกร้า
                                <span class="label label-danger">
                                    @if (Session::has('cart_items'))
                                        {{ count(Session::get('cart_items')) }}
                                    @else
                                        {{ count(array()) }}
                                    @endif
                                </span>
                            </a>
                       </li>
                    @endguest
                </ul>
            </div>
        </nav>
        <h1 style="text-align: center;">นายธนภัทร จีนสำราญ 6306021611060</h1>
    </div>
    @yield('content')
    @yield('script')

    @if (session('msg'))
        @if (session('ok'))
            <script>
                toastr.success("{{ session('msg') }}")
            </script>
        @else
            <script>
                toastr.error("{{ session('msg') }}")
            </script>
        @endif
    @endif
</body>

</html>
