<?php
require_once 'basic.php';
if(!$loggedIn) die();
/*if(isset$post) show profile}
else page.back*/
?>
<head>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <style>
        .ui-autocomplete {
            max-height: 100px;
            overflow-y: auto;
            /* prevent horizontal scrollbar */
            overflow-x: hidden;
        }
        /* IE 6 doesn't support max-height
         * we use height instead, but this forces the menu to always be this tall
         */
        * html .ui-autocomplete {
            height: 100px;
        }
    </style>
    <script>
        $(function() {
            var availableTags = [
                <?php
                $query = qM("SELECT `name` FROM `members`");
                while($array = $query->fetch_assoc()){
                    echo '"'.$array['name'].'",';
                }
                ?>
            ];
            $( "#tags" ).autocomplete({
                source: availableTags
            });
        });
    </script>
</head>
<body>
<div class="ui-widget">
    <label for="tags">Tags: </label>
    <input id="tags" />
</div>
</body></html>