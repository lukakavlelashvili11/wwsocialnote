// $(function(){
    function destroy(desdata){
        var url="{{route('deslikes',':id')}}";
            url=url.replace(':id',desdata);
            $.ajax({
                url:url,
                type:'GET',
                success:function(response){
                    $('#post'+desdata).hide('slow');
                  }}
    )};    
// });
