$('.select_gym').click(function(){
    var gym_id = $(this).attr("gym_id");
    $.ajax({
        url :"/gym/switch",
        type:"POST",
        cache:false,
        data:{
            gym_id:gym_id, 
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success:function(data){
            console.log(data);
            if(data.statu){
                Swal.fire({
                    icon: 'success',
                    title: 'Good job!',
                    text: data.msg,
                    showConfirmButton: false
                  })
                location.reload();
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: data,
                  })
            }
           
        }
    });
});