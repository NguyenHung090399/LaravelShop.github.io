@extends('admin.main');
@section('head')
   <script src="/ckeditor/ckeditor.js"></script>
@endsection

@section('content')
<form action="" method="POST"> @csrf
    <div class="card-body">
      <div class="form-group">
        <label for="menu">Tên Danh Mục</label>
        <input type="text" name="name" class="form-control" id="name" placeholder="Nhập tên danh mục">
      </div>
      <div class="form-group">
        <label>Danh Mục</label>
        <select name="parent_id" id="" class="from-control">
          <option value="0">Danh mục</option>
          @foreach ($menus as $item)
          <option value="{{ $item->id }}" style="text-align: center">{{ $item->name }}</option>
          @endforeach
            
        </select>
      </div>
      <div class="form-group">
        <label>Mô tả</label>
        <textarea name="description" class="form-control"></textarea>
      </div>
      <div class="form-group">
        <label>Nội dung</label>
        <textarea name="content" id="content" class="form-control"></textarea>
      </div>
      <div class="form-group">
        <label>Kích Hoạt</label>
        <div class="form-group">
            <div class="custom-control custom-radio">
              <input class="custom-control-input" value="1" type="radio" id="active" name="active">
              <label for="active" class="custom-control-label">Có</label>
            </div>
            <div class="custom-control custom-radio">
              <input class="custom-control-input" value="0" type="radio" id="noactive" name="active">
              <label for="noactive" class="custom-control-label">Không</label>
            </div>
          </div>
        </div>
    </div>
    <div class="card-footer">
      <button type="submit" class="btn btn-primary">Tạo Danh Mục</button>
    </div>
   
  </form>
@endsection

@section('footer')
    <script>
        CKEDITOR.replace('content'); //content là id ở ô Nội dung
    </script>
@endsection