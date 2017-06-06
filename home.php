<?php
require_once 'basic.php';
if(!$loggedIn) die();

    $result = qM("SELECT * FROM `members` ORDER BY `pic_date` DESC LIMIT 0,2");
   /* $count = qM("SELECT * FROM `members`");
    $n = $count->num_rows;*/
?>
    <br><br>
        <div class="images">
            <?php
            while($row = $result->fetch_assoc()){
                echo "<p align='center'><img src='".$row['pic_path']."' height='500' width='500'></p>".$row['id'];
            }
            ?>
        </div>

        <div class="loader">
            <img src="img/loader.gif">
        </div>

        <div class="up">
            <a onclick="topFunction()"><img src="img/up.png"></a>
        </div>

    <script src="js/jquery2.js"></script>
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