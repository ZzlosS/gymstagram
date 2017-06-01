<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script>
    function info(){
        $.ajax({
            type:'post',
            url:'chat_ajax.php',
            //data: $(this).val(),
            dataType: 'json',
            success: function(data){
                //var fileName = data[0];
                //$("#music").attr("src",fileName).trigger("play");
                $('#chat_me #chat_message').css('background-image', 'url(' + data[2] + ')');
                $('#chat_h3').text(data[0]);
                $('#sag').text(data[1]);
                //$('#chat_me #chat_message').text(data[2]);
                $('#chat_friend #chat_message').text(data[3]);
            }
        });
    }
</script>

<?php
require_once 'basic.php';
if(!$loggedIn) die();
$mid = $id;

$result = qM("SELECT * FROM `members` WHERE `id`=$mid");
if($result->num_rows){
    $row = $result->fetch_array(MYSQL_ASSOC);
    $view = $row['email'];
}
else{
    $view = "";
}

?>
<div class="main">
    <?php
    $followers = array();
    $following = array();

    $result = qM("SELECT * FROM `gym_buddies` WHERE `user_id`=$mid");
    $num = $result->num_rows;
    for($j = 0; $j < $num; $j++){
        $row = $result->fetch_array(MYSQL_ASSOC);
        $followers[$j] = $row['friend_id'];
    }
    $result = qM("SELECT * FROM `gym_buddies` WHERE `friend_id`=$mid");
    $num = $result->num_rows;
    for($j = 0; $j < $num; $j++){
        $row = $result->fetch_assoc();
        $following[] = $row['user_id'];
    }

    $mutual = array_intersect($followers, $following);
    $followers = array_diff($followers, $mutual);
    $following = array_diff($following, $mutual);
    $friends = FALSE;

    if(sizeof($mutual)){
        //$size = sizeof($mutual);
        echo "<br><br><span class='subhead'><h3>Your ". $lang['friends'].":</h3>";
        echo "<ul>";
        foreach ($mutual as $friendId){
            $result = qM("SELECT * FROM `members` WHERE `id`=$friendId");
            $row = $result->fetch_assoc();
            $friendName = $row['gym_name'];
            echo "<li><a  onclick='info()'  class='name_hover'>$friendName</a></li>";
        }
        echo "</ul></span>";
        $friends = TRUE;
    }
?>
<link rel="stylesheet" href="css/chat.css" />

<link rel='stylesheet' href="css/font-awesome.min.css" />
<script src="js/prefixfree.min.js"></script>


<br><br>


<div id="bod">
    <div id="chat_container"">

        <div id="chat_bg-image">
            <h3 id="chat_h3">Mostafa Hassani</h3>
        </div>

        <div id='chat_followe'>
            <ul id="chat_ul">
                <li id="chat_li">
                    <a id="chat_a" href="#">
                        <span id='chat_number'>45</span>
                        <span id='chat_followe'>Followers</span>
                    </a>
                </li>
                <li id="chat_li">
                    <a id="chat_a" href="#">
                        <span id='chat_number'>5</span>
                        <span id='chat_followe'>Following</span>
                    </a>
                </li>
            </ul>
            <div id="chat_badboy"></div>
        </div>

        <div id="chat_image"></div>
        <input type="radio" id='chat_one' name='contorol' checked/>
        <label id="chat_one" for="chat_one"><i class='icon-comment-alt'></i></label>
        <input type="radio" id='chat_two' name='contorol' />
        <label id="chat_one" for="chat_two"><i class='icon-user'></i></label>
        <input type="radio" id='chat_three' name='contorol' />
        <label id="chat_one" for="chat_three"><i class='icon-comments-alt'></i></label>

        <div id="chat_all">
            <div id="chat_chat">
                <div id="chat_show-message">
                    <div id="chat_friend">
                        <img src="http://i.cubeupload.com/c6AJ19.png" width=32 height=32 />
                        <div id="chat_message">
                            <p>Hi. Am searching for something about Css.
                                would you mind helping me to find out?
                            </p>
                        </div>
                    </div>
                    <div id="chat_me">
                        <img src="http://i.cubeupload.com/nD0XUv.png" width=32 height=32 />
                        <div id="chat_message">
                            <p>Hi dear of course if i can ...</p>
                        </div>
                    </div>
                    <div id="chat_badboy"></div>
                </div>
                <div id="chat_type-text">
                    <input id="chat_input" type="text" placeholder='Chat with Mostafa...' />
                    <button type='submit'><i id='i' class='icon-comments-alt'></i></button>
                </div>
            </div>

            <div id="chat_Description">
                <p id="sag">My name is Mostafa Hasani.<br>
                    I'm in love with Html,Css and anything about web design.<br>
                    I like sports too...<br>
                    because healthy mind is in healthy body.
                </p>
            </div>

            <div id="chat_Link">
                <div id="chat_menu">
                    <ul id="chat_ul">
                        <li id="chat_li">
                            <a href="">codepen.io/Hassani</a>
                        </li>
                        <li id="chat_li">
                            <a href="">github.com/yegane</a>
                        </li>
                        <li id="chat_li">
                            <a href="">seyedmostafahassani@gmail.com</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div id="chat_badboy"></div>
        </div>
    </div>
</div>
</html>
