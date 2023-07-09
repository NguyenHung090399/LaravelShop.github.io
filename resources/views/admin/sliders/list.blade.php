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
                <td id="td">Tiêu Đề</td>
                <td id="td">Link</td>
                <td id="td">File</td>
                <td id="td">Trạng thái</td>
                <td id="td">Cập nhật</td>
                <td id="td">&nbsp;</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($sliders as $item)
            <tr>
                <td>{{$item->id}}</td>
                <td>{{ $item->name }}</td>
                <td><a href="{{ $item->url }}" target="_blank">{{ $item->url }}</a></td> 
                <td><a href="{{ $item->file }}" target="_blank"><img src="{{ $item->file }}" alt="" style="height: 40px;"></a></td>
                <td>{!! \App\Helpers\Helper::active($item->active) !!}</td>
                <td>{{ $item->updated_at }}</td>
                <td style="width:100px;">
                    <a href="/admin/sliders/edit/{{$item->id}}" class="btn btn-primary btn-sm">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="" class="btn btn-danger btn-sm" onclick="removeRow({{ $item->id }},'/admin/sliders/destroy')">
                        <i class="fas fa-trash"></i>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{-- Phan trang --}}
    {!! $sliders->links() !!}
@endsection