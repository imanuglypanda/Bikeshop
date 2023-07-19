@extends('layouts.master')
@section('title')    Product | Add    @endsection


@section('content')


{{-- 'action' => 'ProductController@onInsert' --}}
{!! 
    Form::open(
        array(
            'action' => 'App\Http\Controllers\ProductController@onInsert', 
            'method' => 'post', 
            'enctype' => 'multipart/form-data'
        )
    ) 
!!}

    <ul class="breadcrumb">
        <li><a href="/product">หน้าสินค้า</a></li>
        <li><a href="#">เพิ่มสินค้า</a></li>
    </ul>

    @if($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <div class="panel panel-default">
        <div class="panel-header">
            <h1 style="margin: 40px 10px;">เพิ่มสินค้า</h1>
        </div>
        
        <div class="panel-body">
            <table>
                <tr style="height: 48px;">
                    <td style="width: 240px">
                        {{ Form::label('code', 'รหัสสินค้า') }} </td>
                    <td>{{ Form::text('code', Request::old('code'), ['class' => 'form-control']) }}</td>
                </tr>
                <tr style="height: 48px;">
                    <td style="width: 240px">
                        {{ Form::label('name', 'ชื่อสินค้า ') }}</td>
                    <td>{{ Form::text('name', Request::old('name'), ['class' => 'form-control']) }}</td>
                </tr>
                <tr>
                    <td>{{ Form::label('category_id', 'ประเภทสินค้า') }}</td>
                    <td>
                        {{ Form::select('category_id', $categories, ['class' => 'form-control']) }}
                    </td>
                </tr>
                <tr style="height: 48px;">
                    <td style="width: 240px">
                        {{ Form::label('stock_qty', 'คงเหลือ') }}</td>
                    <td>{{ Form::text('stock_qty', Request::old('stock_qty'), ['class' => 'form-control']) }} </td>
                </tr>
                <tr style="height: 48px;">
                    <td style="width: 240px">
                        {{ Form::label('price', 'ราคาขายต่อหน่วย') }}</td>
                    <td>{{ Form::text('price', Request::old('price'), ['class' => 'form-control']) }}</td>
                </tr>
                <tr style="height: 48px;">
                    <td style="width: 240px">
                        {{ Form::label('image', 'เลือกรูปภาพสินค้า ') }}</td>
                    <td>{{ Form::file('image') }}</td>
                </tr>
            </table>
        </div>

        <div class="panel-footer">
            <a href="/product" class="btn btn-danger">ยกเลิก</a>
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> บันทึก</button>
        </div>
    </div>

{!! Form::close() !!}


@endsection