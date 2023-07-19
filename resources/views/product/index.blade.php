@extends('layouts.master')
@section('title') Bikeshop | รายการสินค้า @stop

@section('content')
    <div class="container">
        <h1>รายการสินค้า</h1>
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title">
                    <strong>รายการ</strong>
                </div>
            </div>
            <div class="panel-body">
                <!-- search form -->
                <form action="{{ URL::to('product/search') }}" method="post" class="form-inline">
                    {{ csrf_field() }}
                    <input type="text" name="searchInput" class="form-control" placeholder="พิมพ์รหัสหรือชื่อเพื่อค้นหา">
                    <button type="submit" class="btn btn-primary">ค้นหา</button>
                    <a href="{{ URL::to('product/add') }}" class="btn btn-success pull-right">เพิ่มสินค้า</a>
                </form>
            </div>
            <table class="table table-bordered bs-table">
                <thead>
                    <tr>
                        <th>รูปสินค้า </th>
                        <th>รหัส</th>
                        <th>ชื่อสินค้า </th>
                        <th>ประเภท</th>
                        <th>คงเหลือ</th>
                        <th>ราคาต่อหน่วย</th>
                        <th>การทํางาน</th>
                    </tr>
                </thead>
    
                <tbody>
                    @foreach ($products as $p_item)
                        <tr>
                            <td><img src="{{ $p_item->image_url }}"width="100px"></td>
                            <td>{{ $p_item->code }}</td>
                            <td width="300px">{{ $p_item->name }}</td>
                            <td>{{ $p_item->category->name }}</td>
                            <td class="bs-price">{{ number_format($p_item->stock_qty, 0) }}</td>
                            <td class="bs-price">{{ number_format($p_item->price, 2) }}</td>
                            <td class="bs-center">
                                <a href="{{ URL::to('product/edit/'.$p_item->id) }}" class="btn btn-info">
                                    <i class="fa fa-edit"></i> แก้ไข
                                </a>
                                <button class="btn btn-danger btn-delete" id-delete="{{ $p_item->id }}">
                                    <i class="fa fa-trash"></i> ลบ
                                </button>
                            </td>
                        </tr> 
                    @endforeach
                </tbody>
    
                <tfoot>
                    <tr>
                        <th colspan="5">รวม</th>
                        <th class="bs-price">{{ number_format($products->sum('stock_qty'), 0) }}</th>
                        <th class="bs-price">{{ number_format($products->sum('price'), 2) }}</th>
                    </tr>
                </tfoot>
            </table>
            <div class="panel-footer">
                <span>แสดงข้อมูลจำนวน {{ count($products) }} รายการ</span>
            </div>
        </div>
        {{ $products->links(); }}
    </div>

    <script type="text/javascript">
        // Use jQuery Technique
        $('.btn-delete').on('click', function(){
            if(confirm("Do you want to remove this item?")) {
                var url = "{{ URL::to('product/remove') }}" + '/' + $(this).attr('id-delete');
                window.location.href = url;
            }
        });
    </script>

@endsection

