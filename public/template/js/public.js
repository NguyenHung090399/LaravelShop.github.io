$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function loadMore(){
    const page = $('#page').val() ; 
    $.ajax({
        type : 'POST',
        dataType : 'JSON',
        data: {page} , 
        url : '/services/load-product',
        success: function(reslut){
            if(reslut != ''){
                $('#loadProduct').append(reslut.html()) ; // append du lieu tra ve vao the div co id = loadProduct
                //nang page len 1
                $('#page').val(page+1) ; 
            }else{
                alert('Không còn sản phẩm ! ') ; 
                //An nut loadMore
                $('$button-loadMore').css('display' , 'none') ; 
            }
        }

    });
}