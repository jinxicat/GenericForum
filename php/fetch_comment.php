<?php
include '../safe/dbh.php';
$thread_id = mysqli_real_escape_string ($dbc, $_GET['id']);
$usn = mysqli_real_escape_string ($dbc, $_GET['user']);
$board = mysqli_real_escape_string ($dbc, $_GET['board']);

$query = "SELECT * FROM comments WHERE parent_comment_id = '0' AND thread_id = '$thread_id' ORDER BY comment_id DESC";
$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$output = '';

foreach($result as $row)
{ $date = gmdate("m-d", $row['time_stamp']);
  $time = gmdate("H:i", $row['time_stamp']);

  $output .= '
  <div class="comrow">
    <div class="comcol"><b>Commented by:</b>' . $row["user"] . '
      <b>&nbsp;&nbsp;On:</b> ' . $date . ' <b>&nbsp;&nbsp;At:</b> ' . $time . 'UTC<br />
    ' . $row["comment"] . '<br />
    <button type="button" onclick="showForm(\'comment_form_' . $row["comment_id"] . '\')"
      class="btn btn-success btn-sm" style="margin-left:25%" id="' . $row["comment_id"] . '">
      Reply</button></div></div></div>
    <form style="display:none" id="comment_form_' . $row["comment_id"] . '" method="POST">
    <div class="form_group">
        <input class="form_control" type="hidden" name="name" id="name" value="' . $usn . '"/>
        <input class="form_control" type="hidden" name="thread_id" id="thread_id" value="' . $thread_id . '"/>
    </div>
    <div class="form_group">
      <textarea class="form_control comment_form" style="margin-left: 5%; width: 60%" name="comment_content" id="comment_content" placeholder="Reply" rows="3"></textarea>
    </div>
    <div class="form_group" style="margin-left: 50%">
      <input type="hidden" name="comment_id" id="comment_id" value="' . $row["comment_id"] . '"/>
      <input class="btn btn-success btn-sm" type="submit" onclick="javascript:location=\'thread.php?user=' . $usn . '&id=' . $thread_id . '&board=' . $board . '\';void(0);" name="submit" id="submit" value="Reply"/>
    </div>
    </form></div><script>
    var ypos_2 = sessionStorage.getItem(\'ypos\') - 500;
    $(document).ready(function scrollWin(){
 window.scrollTo(0, ypos_2);
});
    $(document).ready(function(){
      $(\'#comment_form_' . $row["comment_id"] . '\').on(\'submit\', function(event){
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
              if(data.error != \'\')
              {
                  $(\'#comment_form_' . $row["comment_id"] . '\')[0].reset();
                  $(\'#comment_message\').html(data.error);
              }
            }
        })
      });
    });
</script>';
  $output .= get_reply_comment($connect, $row["comment_id"]);
}

echo $output;

function get_reply_comment($connect, $parent_id = 0, $marginleft = 0){
  $thread_id = $_GET['id'];
  $usn = $_GET['user'];
  $board = $_GET['board'];
  $query = "SELECT * FROM comments WHERE parent_comment_id = '" . $parent_id . "' ORDER BY comment_id DESC";
  $statement = $connect->prepare($query);
  $statement->execute();
  $result = $statement->fetchAll();
  $count = $statement->rowCount();
  if($parent_id == 0)
  {
    $marginleft = 0;
  } else {
    $marginleft = $marginleft + 48;
  }
  $output = '';
  if($count > 0){
    foreach($result as $row){
      $date = gmdate("m-d", $row['time_stamp']);
      $time = gmdate("H:i", $row['time_stamp']);
      $output .= '
      <div class="comrow" style="margin-left:'.$marginleft.'px">
      <div class="comcol"><b>Commented by:</b>' . $row["user"] . '
        <b>&nbsp;&nbsp;On:</b> ' . $date . ' <b>&nbsp;&nbsp;At:</b> ' . $time . 'UTC<br />
          ' . $row["comment"] . '<br />
          <button type="button" onclick="showForm(\'comment_form_' . $row["comment_id"] . '\');"
            class="btn btn-success btn-sm" style="margin-left:25%" id="' . $row["comment_id"] . '">
            Reply</button></div></div></div>
          <form style="display:none" id="comment_form_' . $row["comment_id"] . '" method="POST">
          <div class="form_group">
              <input class="form_control" type="hidden" name="name" id="name" value="' . $usn . '"/>
              <input class="form_control" type="hidden" name="thread_id" id="thread_id" value="' . $thread_id . '"/>
          </div>
          <div class="form_group">
            <textarea class="form_control comment_form" style="margin-left: 5%; width: 60%" name="comment_content" id="comment_content" placeholder="Reply" rows="3"></textarea>
          </div>
          <div class="form_group" style="margin-left: 50%">
            <input type="hidden" name="comment_id" id="comment_id" value="' . $row["comment_id"] . '"/>
            <input class="btn btn-success btn-sm" type="submit" onclick="javascript:location=\'thread.php?user=' . $usn . '&id=' . $thread_id . '&board=' . $board . '\';void(0);" name="submit" id="submit" value="Reply"/>
          </div>
          </form></div>
          <script>
          var ypos_2 = sessionStorage.getItem(\'ypos\') - 500;
          $(document).ready(function scrollWin(){
       window.scrollTo(0, ypos_2);
      });
          $(document).ready(function(){
            $(\'#comment_form_' . $row["comment_id"] . '\').on(\'submit\', function(event){
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
                    if(data.error != \'\')
                    {
                        $(\'#comment_form_' . $row["comment_id"] . '\')[0].reset();
                        $(\'#comment_message\').html(data.error);
                    }
                  }
              })
            });
          });
      </script>';
      $output .= get_reply_comment($connect, $row["comment_id"], $marginleft);
    }
  }
  return $output;
}
