$(document).ready(function(){

    $('#show').click(function(){
        $('#tambahdata').fadeIn(1000);
        $('#hide').show();
        $(this).hide();
    });

    $('#hide').click(function(){
        $('#tambahdata').fadeOut(1000);
        $('#show').show();
        $(this).hide();
    })

    $('#canceledit').click(function() {
        $('#editdata').fadeOut();
        $('#show').show();
    })

    // $('#formadd input').blur(function(){
    //   if (!$(this).val()) {
    //     $(this).addClass("error");
    //   } else {
    //     $(this).removeClass("error");
    //   }
    // })

    // if ($('input[name = "stok"]').val() != '') {
    //   $('#savebutton').show();      
    // }

})