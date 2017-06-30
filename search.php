<?php
    require_once 'basic.php';
    if(!$loggedIn) echo "<script>location.replace('home.php')</script>";

    $res = '';
?>
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
        <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
        <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
        <style>
            .ui-autocomplete {
                max-height: 200px;
                overflow-y: auto;
                /* prevent horizontal scrollbar */
                overflow-x: hidden;
            }
            /* IE 6 doesn't support max-height
             * we use height instead, but this forces the menu to always be this tall
             */
            * html .ui-autocomplete {
                height: 200px;
            }
            #tags{
                font: 13px Helvetica, Arial, sans-serif;
                width: 200px;
                height: 25px
            }
        </style>
        <script type="text/javascript">

            function f(){
                $.ajax({
                    method: 'post',
                    url: 'members.php',
                    data: {'id': $('#id').val()},
                    success: function (res) {
                        $('#all').html(res);
                    }
                });
            }
            function search() {
                $.ajax({
                    method: 'post',
                    url: 'members.php',
                    data: {'tags' : $('#tags').val(),'id': $('#id').val()},
                    success: function (res) {
                        $('#all').html(res);
                    }
                });
            }

            $(function() {

                var availableTags = [
                    <?php
                    $query = qM("SELECT `name`,`lname`,`gym_name` FROM `members` WHERE `id`!= $id");
                    while($array = $query->fetch_assoc()){
                        echo '"'.$array['name'].' '.$array['lname'].'",'.'"'.$array['gym_name'].'",';
                    }
                    ?>
                ];
                $( "#tags" ).autocomplete({
                    source: availableTags
                });
            });
        </script>
    </head>
    <body id="b2">
        <div class="container2">
            <section id="content2">
                <form>
                <h1><?php echo $lang['search'] ?></h1>
                </form>
                <input id="id" hidden value="<?php echo $id?>" />

                <?php if($role == 2){ ?>
                <button id='but' type="button" style="margin-left: 28%" onclick="f()"><?php echo $lang['Sa'] ?></button>
                <?php } ?>

                <div class="ui-widget" align="center">

                    <label>
                    <input id="tags" name="tags" placeholder="<?php echo $lang['tags'] ?>" />
                    </label>
                    <button value="Search" onclick="search()">
                        <i class="icon-search"></i>
                    </button>
                </div>
                <br><br>

                <div id="all" align="center">
                    <?php
                    echo $res; ?>
                </div>
           </section>
        </div>

    </body>
</html>