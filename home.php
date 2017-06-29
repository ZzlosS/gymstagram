<?php
require_once 'basic.php';

    $result = qM("SELECT m.id,m.name,m.gym_name,p.user_id,p.date_update,p.pic_path,p.pic_desc FROM `pictures` AS `p` LEFT JOIN `members` as `m` ON `p`.`user_id`=`m`.`id` ORDER BY `date_update` DESC LIMIT 0,2");
   /* $count = qM("SELECT * FROM `members`");
    $n = $count->num_rows;*/
?>
    <style>
        div.im {
            margin: 5px 5px 20px 5px;
            border: 1px solid #ccc;
            width: 500px;
            height: 570px;
        }

        div.im:hover {
            border: 1px solid #777;
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
                $(window).scroll(function(){
                    if($(window).scrollTop()===$(document).height()-$(window).height()){
                        $('.loader').show();
                        $('.up').show();
                        load++;
                        $.post("news_feed.php", {load:load}, function(data){
                            $('.images').append(data);
                            $('.loader').hide();
                        })
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