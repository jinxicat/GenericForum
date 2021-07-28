$(document).ready(function(){
  $('#comment_form').on('submit', function(event){
      event.preventDefault();
      var form_data = $(this).serialize();
      $.ajax({
        url:"https://traderbuzzforum.com/php/add_comment.php",
        method:"POST",
        data:form_data,
        dataType:"JSON",
        cache: false,
        success:function(data)
        {
          if(data.error != '')
          {
              $('#comment_form')[0].reset();
              $('#comment_message').html(data.error);
              load_comment();
          }
        }
    })
  });
});
