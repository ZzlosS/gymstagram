<?php
require_once 'basic.php';
    if($loggedIn){
        $result = qM("SELECT m.id,m.name,m.gym_name,m.public,p.user_id,p.date_update,p.pic_path,p.pic_desc FROM `pictures` AS `p` LEFT JOIN `members` as `m` ON `p`.`user_id`=`m`.`id` WHERE `public`=1 OR `m`.`id`=$id $or ORDER BY `date_update` DESC LIMIT 0,2");
    }
    else{
        $result = qM("SELECT m.id,m.name,m.gym_name,m.public,p.user_id,p.date_update,p.pic_path,p.pic_desc FROM `pictures` AS `p` LEFT JOIN `members` as `m` ON `p`.`user_id`=`m`.`id` WHERE `public`=1 ORDER BY `date_update` DESC LIMIT 0,2");
    }


?>
    <style>
        div.im {
            margin: 5px 5px 20px 5px;
            width: 500px;
            height: 570px;
            background: #dee2e6;
            border-radius: 2%;
            /*border: 1px solid #9e9ea3;*/
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        }

        div.im:hover {
            border: 1px solid #FF6C40;
        }

        div.descN {
            padding-bottom: 10px;
            text-align: center;
        }
        div.desc {
            padding-top: 10px;
            text-align: center;
        }

    </style>
    <br><br>
    <input id="id" hidden value="<?php echo $loggedIn2?>" /> <!-- tu postavlja vrednost da li je neko logovan, pa je preko funckije salje u news_feed-->
        <div class="images" align="center">
            <?php
            while($row = $result->fetch_assoc()){
                $fid = $row['id']; //id korisnika
                $public = $row['public'];
                if($loggedIn){
                    echo "<div class='im' ><div class='descN'><a href='profile.php?gn=".$row['gym_name']."' data-hover='@".$row['gym_name']."' >@".$row['gym_name']."</a></div>";
                    echo "<a target=_blank href='".$row['pic_path']."'><img src='".$row['pic_path']."' height='500' width='500'></a>";
                    echo "<div class='desc'>".$row['pic_desc']."</div></div><br>";
                }
                else{
                    echo "<div class='im' ><div class='descN'><a href='profile.php?gn=".$row['gym_name']."' data-hover='@".$row['gym_name']."' >@".$row['gym_name']."</a></div>";
                    echo "<a target=_blank href='".$row['pic_path']."'><img src='".$row['pic_path']."' height='500' width='500'></a>";
                    echo "<div class='desc'>".$row['pic_desc']."</div></div><br>";
                }


            }
            ?>
        </div>

        <div class="loader">
            <img src="img/loader.gif">
        </div>

        <div class="up">
            <a onclick="topFunction()"><img src="img/up.png"></a>
        </div>

    <script>
        $(document).ready(function(){
            $('.loader').hide();
            $('.up').hide();
            var load = 0;
            <?php if($loggedIn){ //ako si prijavljen da prosledi koga sve pratis i tvoj id?>
            var following = [
                <?php
                $result2 = qM("SELECT * FROM `gym_buddies` WHERE `user_id`=$id");
                if($num_following == 0) {
                    echo $id.",".$id;
                }
                else{
                    while($row = $result2->fetch_assoc()){
                        echo  '"'.$row['friend_id'].'",';
                    }
                }
                ?>
            ];
            var id = <?php echo $id ?>;
            <?php } ?>
            var loged = document.getElementById('id').value;
                $(window).scroll(function(){
                    if($(window).scrollTop()===$(document).height()-$(window).height()){
                        $('.loader').show();
                        $('.up').show();
                        load++;
                        $.ajax({
                            method: 'post',
                            url: 'news_feed.php',
                            data:{
                                'load': load,
                                'loged': loged <?php if($loggedIn){ ?>,
                                'fol': following,
                                'id': id <?php } ?>
                            },
                            success: function (data) {
                                $('.images').append(data);
                                $('.loader').hide();
                            }
                        });
                    }
                })
        });

        function topFunction() {
            document.body.scrollTop = 0; // za Chrome, Safari i Operu
            document.documentElement.scrollTop = 0; // za IE i Firefox
        }
    </script>

    </body>
</html>