$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function removeRow(id , url){
   // var url = '/admin/menus/destroy'; //dua vao route delete
    if(confirm('Bạn có chắc chắn muốn xóa không !')){
        $.ajax({
            url:url,
            type:'delete',
            datatype:'json',
            data:{id},
            success:function(data,status){
                if(data.error===false){
                    alert(data.message);
                    location.reload();        
                }

                console.log(data);
                console.log(status);
            }
        })
    }
}

//Upload files
$('#upload').change(function(){ //upload la id cua o input them anh san pham
    const form = new FormData() ; // khoi tao mot form
    //appen form
    form.append('file', $(this)[0].files[0]) //dat ten la file va lay gia tri vua chon $this [0]:lay thang dau tien 
    $.ajax({
        processData:false,
        contentType:false,
        type:'POST',
        dataType:'JSON',
        data:form,
        url:'/admin/upload/services', //dua vao route upload
        //khi upload thanh cong se tra ve mot result
        success : function(results){
            //console.log(results);
            if(results.error == false){
                $('#image_show').html('<a href="'+results.url+'" target ="_blank" style="margin-left: 10px">'+
                                        '<img src="'+results.url+'" width="100px" style="border-style: dashed;">'+
                                        '</a>');
                $('#file').val(results.url);
            }else{
                alert("Upload file lỗi");
            }
        }
    });

});

