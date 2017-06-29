<?php
require_once 'basic.php';
    if($loggedIn){
        $result = qM("SELECT m.id,m.name,m.gym_name,p.user_id,p.date_update,p.pic_path,p.pic_desc FROM `pictures` AS `p` LEFT JOIN `members` as `m` ON `p`.`user_id`=`m`.`id` ORDER BY `date_update` DESC LIMIT 0,2");
    }
    else{
        $result = qM("SELECT m.id,m.name,m.gym_name,p.user_id,p.date_update,p.pic_path,p.pic_desc FROM `pictures` AS `p` LEFT JOIN `members` as `m` ON `p`.`user_id`=`m`.`id` WHERE `public`=1 ORDER BY `date_update` DESC LIMIT 0,2");
    }


?>
    <style>
        div.im {
            margin: 5px 5px 20px 5px;
            width: 500px;
            height: 570px;
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
                echo "<div class='im'><div class='descN'><a href='profile.php?gn=".$row['gym_name']."'>".$row['name']."</a></div>";
                echo "<a target=_blank href='".$row['pic_path']."'><img src='".$row['pic_path']."' height='500' width='500'></a>";
                echo "<div class='desc'>".$row['pic_desc']."</div></div>";
            }
            ?>
        </div>

        <div class="loader">
            <img src="img/loader.gif">
        </div>

        <div class="up">
            <a onclick="topFunction()"><img src="img/up.png"></a>
        </div>

    <!--<script src="js/jquery2.js"></script>-->
    <script>
        //to da se ubaci u jquery2.js
        $(document).ready(function(){
            $('.loader').hide();
            $('.up').hide();
            var load = 0;
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
                                'loged': loged
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