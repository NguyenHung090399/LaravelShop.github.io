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
                <td id="td">Tên Khách Hàng</td>
                <td id="td">SĐT</td>
                <td id="td">Email</td>
                <td id="td">Ngày Đặt Hàng</td>
                <td id="td">&nbsp;</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($customers as $item)
            <tr>
                <td>{{$item->id}}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->phone }}</td> 
                <td>{{ $item->email }}</td>
                <td>{{ $item->created_at}}</td>
                <td style="width:100px;">
                    <a href="/admin/customers/view/{{$item->id}}" class="btn btn-primary btn-sm">
                        <i class="fas fa-eye"></i>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{-- Phan trang --}}
    {!! $customers->links() !!}
@endsection