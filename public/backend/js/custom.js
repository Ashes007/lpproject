  $(document).ready(function(){

    $('#country_id').change(function(){
    var country_id = $(this).val();
      $.ajax({
        type: 'POST',
        data: {_token:csrf_token, country_id:country_id},
        url: base_url+'city/getstate',
        success: function(msg){
            $('#state_id').html(msg);            
        }

      });
    });

  });
  