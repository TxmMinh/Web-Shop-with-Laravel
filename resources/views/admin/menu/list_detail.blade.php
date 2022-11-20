@extends('admin.main')

@section('content')
    <div class="card-body">
        <h3>Chi tiết sản phẩm</h3>

        <h2>{{ $menu->name }}</h2>
        <p>{{ $menu->content }}</p>
        <div>{!! $des !!}</div>
    </div>
@endsection