@extends('layouts.master')
@section('title') Bikeshop | แก้ไขประเภทลสินค้า @stop

@section('content')

{!! 
    Form::open( 
        array(
            'action' => 'App\Http\Controllers\CategoryController@onUpdate', 
            'method' => 'post', 
            'enctype' => 'multipart/form-data'
        ) 
    )
!!}

    <div class="container">
        <h1>แก้ไขสินค้า</h1>
        <ul class="breadcrumb">
            <li><a href="{{ URL::to('product') }}">หน้าแรก</a></li>
            <li class="active">แก้ไขสินค้า</li>
        </ul>

        
        <input type="hidden" name="id" value="{{ $category->id }}">

        @if($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title">
                    <strong>ประเภทสินค้า</strong>
                </div>
            </div>
            <div class="panel-body">
                <table>
                    <tr>
                        <td style="width: 140px">{{ Form::label('name', 'รหัสประเภทสินค้า') }}</td>
                        <td><h4>{{ $category->id }}</h4></td>
                    </tr>
                    <tr>
                        <td>{{ Form::label('name', 'ชื่อประเภทสินค้า') }}</td>
                        <td>{{ Form::text('name', $category->name, ['class' => 'form-control', 'placeholder' => 'ชื่อประเภทสินค้า']) }}</td>
                    </tr>
                </table>
            </div>
            <div class="panel-footer">
                <a href="/category" class="btn btn-danger">ยกเลิก</a>
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-save">บันทึก</i>
                </button>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@endsection