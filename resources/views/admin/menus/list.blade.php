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
                <td id="td">Tên</td>
                <td id="td">Trạng thái</td>
                <td id="td">Cập nhật</td>
                <td id="td">&nbsp;</td>
            </tr>
        </thead>
        <tbody>
            {{-- Dung de quy --}}
            {!! \App\Helpers\Helper::menu($menus) !!} 
            {{-- (!!) la de trinh bien dich ra html --}}
        </tbody>
    </table>
@endsection