@extends('admin.main')

@section('content')
    <form action="" method="POST">@csrf
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="menu">Tiêu Đề</label>
                        <input type="text" name="name" value="{{ $slider->name }}" class="form-control"  placeholder="Nhập tiêu đề">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="menu">Link</label>
                        <input type="text" name="url" value="{{ $slider->url }}"  class="form-control" >
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="menu">Sắp Xếp</label>
                        <input type="number" name="sort_by" value="{{ $slider->sort_by }}"  class="form-control" >
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="menu">Ảnh Slider</label>
                <input type="file"  class="form-control" id="upload">
                <div id="image_show">
                    <a href="{{ $slider->file }}" target="_blank" style="margin-left: 10px">
                        <img src="{{ $slider->file }}" alt=""  width="100px" style="border-style: dashed;">
                    </a>
                </div>
                <input type="hidden" name="file" id="file" value="{{ $slider->file }}">
            </div>

            <div class="form-group">
                <label>Kích Hoạt</label>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="1" type="radio" id="active" name="active" {{ $slider->active==1 ? 'checked="" ':''}}>
                    <label for="active" class="custom-control-label">Có</label>
                </div>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="0" type="radio" id="no_active" name="active" {{ $slider->active==0 ? 'ckecked="" ' : '' }} >
                    <label for="no_active" class="custom-control-label">Không</label>
                </div>
            </div>

        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Cập Nhật Slider</button>
        </div>
    </form>
@endsection

