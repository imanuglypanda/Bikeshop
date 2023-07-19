@extends('layouts.master')
@section('title') Bikeshop | ประเภทสินค้า @stop

@section('content')
    <div class="container">
        <h1>ประเภทสินค้า</h1>
        <div class="panel-heading">
            <div class="panel-title">
                <strong>รายการ</strong>
            </div>
        </div>
        <div class="panel-body">
            <!-- search form -->
            <form action="{{ URL::to('category/search') }}" method="post" class="form-inline">
                {{ csrf_field() }}
                <input type="text" name="searchInput" class="form-control" placeholder="พิมพ์รหัสหรือชื่อเพื่อค้นหา">
                <button type="submit" class="btn btn-primary">ค้นหา</button>
                <a href="{{ URL::to('category/add') }}" class="btn btn-success pull-right">เพิ่มประเภทสินค้า</a>
            </form>
        </div>
        <table class="table table-bordered bs-table">
            <thead style="text-align: center;">
                <tr>
                    <th style="text-align: center; width: 100px">รหัสประเภท</th>
                    <th>ชื่อประเภทสินค้า</th>
                    <th style="text-align: center; width: 200px">การทํางาน</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($categories as $c_item)
                    <tr>
                        <td style="text-align: center;">{{ $c_item->id }}</td>
                        <td>{{ $c_item->name }}</td>
                        <td class="bs-center">
                            <a href="category/edit/{{ $c_item->id }}" class="btn btn-info">
                                <i class="fa fa-edit"></i> แก้ไข
                            </a>
                            <a href="#" class="btn btn-danger btn-delete" id-delete="{{ $c_item->id }}">
                                <i class="fa fa-trash"></i> ลบ
                            </a>
                        </td>
                    </tr> 
                @endforeach
            </tbody>
        </table>
    </div>

    <script type="text/javascript">
        // Use jQuery Technique
        $('.btn-delete').on('click', function(){
            if(confirm("Do you want to remove this item?")) {
                var url = "{{ URL::to('category/remove') }}" + '/' + $(this).attr('id-delete');
                window.location.href = url;
            }
        });
    </script>
@endsection