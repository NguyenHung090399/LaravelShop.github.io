@extends('admin.main');

@section('content')
    <table class="table">
        <style>
            thead{
                background-color: aqua;
                text-align: center;
            }
            td{
                text-align: center;
                color: rgb(240, 69, 17);
            }
            #td{
                color: black;
            }
        </style>
        <thead>
            <tr>
                <td id="td">ID</td>
                <td id="td">Tên Sản Phẩm</td>
                <td id="td">Danh Mục</td>
                <td id="td">Giá Gốc</td>
                <td id="td">Giá Sale</td>
                <td id="td">Trạng thái</td>
                <td id="td">Cập nhật</td>
                <td id="td">&nbsp;</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $item)
            <tr>
                <td>{{$item->id}}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->menu->name }}</td> 
                {{-- menu la funciton quan he trong class Product --}}
                <td>{{ $item->price }}</td>
                <td>{{ $item->price_sale }}</td>
                <td>{!! \App\Helpers\Helper::active($item->active) !!}</td>
                <td>{{ $item->updated_at }}</td>
                <td style="width:100px;">
                    <a href="/admin/products/edit/{{$item->id}}" class="btn btn-primary btn-sm">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="" class="btn btn-danger btn-sm" onclick="removeRow({{ $item->id }},'/admin/products/destroy')">
                        <i class="fas fa-trash"></i>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{-- Phan trang --}}
    {!! $products->links() !!}
@endsection