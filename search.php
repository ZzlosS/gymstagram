<?php
    require_once 'basic.php';
    if(!$loggedIn) echo "<script>location.replace('index.php')</script>";

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
<body >

    <input id="id" hidden value="<?php echo $id?>" />
    <br><br>
    <button id='but' type="button" style="margin-left: 45%" onclick="f()">Show all</button>
    <br><br><br><br><br><br>


    <div class="ui-widget" align="center">

        <label for="tags">Tags: </label>
        <input id="tags" name="tags"/>

        <button value="Search" onclick="search()">
            <i class="icon-search"></i>
        </button>
    </div>


    <br><br>
    <div id="all" align="center">
        <?php
echo $res; ?>
    </div>
</body>
</html>