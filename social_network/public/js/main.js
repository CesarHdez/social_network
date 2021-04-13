var url = 'http://social_network.com.devel/';
window.addEventListener("load", function () {

    $('.btn-like').css('cursor', 'pointer');
    $('.btn-dislike').css('cursor', 'pointer');

    function like() {
        $('.btn-like').unbind('click').click(function () {
            console.log('like');
            $(this).addClass('btn-dislike').removeClass('btn-like');
            $(this).attr('src', url+'img/hearts_red.png');
            $.ajax({
                url: url+'like/'+$(this).data('id'),
                type: 'GET',
                success: function(response){
                    console.log(response);
                    if(response.like){
                        console.log('u did like');
                    }
                    else{
                        console.log('error to do like');
                    }          
                }
            });
            
            dislike();
        });
    }
    like();

    function dislike() {
        $('.btn-dislike').unbind('click').click(function () {
            console.log('dislike');
            $(this).addClass('btn-like').removeClass('btn-dislike');
            $(this).attr('src', url+'img/hearts_black.png');
            
            $.ajax({
                url: url+'dislike/'+$(this).data('id'),
                type: 'GET',
                success: function(response){
                    console.log(response);
                    if(response.like){
                        console.log('u did dislike');
                    }
                    else{
                        console.log('error to do dislike');
                    }          
                }
            });
            
            like();
        });
    }
    dislike();
});