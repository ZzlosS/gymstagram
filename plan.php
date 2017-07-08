<?php
require_once 'basic.php';


?>
<style>

    .soflow{
        width: 255px;
        margin: 5px;
        padding: 5px;
    }

    #opt{
        width: 100px;
        margin: 5px;
        padding: 5px;
    }

    #drop {
        text-align: center;
        margin: 50px;
    }

    #week-day{
        padding-left: 16%;
        padding-right: 10%; /*mora na manjoj rezoluciji*/
    }

    div.gallery {
        margin: 5px;
        /*word-break:break-all;*/
        float: left;
        width: 190px;
        height: 250px;
        text-align: center;
        border: 1px solid transparent;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        background-color: #dee2e6;
        border-radius: 2%;
        position: relative;
    }

    #day{
        width: 400px;
        height: 400px;
        float: none;
        align-content: center;
    }

    #next{
        position: absolute;
        bottom: 0;
        right: 0;
    }
    #previous{
        position: absolute;
        bottom: 0;
        left: 0;
    }

    div.gallery:hover {
        border: 1px solid #FF6C40;
    }

    div.gallery a:hover{
        color: #FF6C40;
    }

</style>

<script>
    $(function(){
        var d = new Date();
        var n = d.getDay();
        document.getElementById("day").value = n; // hvata koji je danas dan i upisuje u input
        $.ajax({
            method: 'post',
            url: 'plan_day.php',
            data: {
                'daily': $('#opt').val(),
                'id': $('#id').val()
            },
            success: function (res) {
                $('#week-day').html(res);
            }
        })
    });

    function dw() {
        //day week prikaz
        //treba 0 za dan, a 16% za nedelju zbog centriranog prikaza
        var pl = 0;
        var pl2 = 0; /*mora na manjoj rezoluciji*/
        if($('.opt').val() == 1){
            var pl = 16
            var pl2 = 10
        }
        $.ajax({
            method: 'post',
            url: 'plan_day.php',
            data: {
                'day': $('#day').val(),
                'daily': $('#opt').val(),
                'id': $('#id').val()
            },
            success: function (res) {
                $('#week-day').html(res).css({'padding-left': pl+'%', 'padding-right': pl2+'%'});
            }
        })
    }

    function enable(day, type) {
        $.ajax({
            method: 'post',
            url: 'plan_make.php',
            data: {
                'day': day,
                'id': $('#id').val(),
                'type': type,
                'today': $('#day').val()
            },
            success: function (res) {
                if(type == 2){ //dan
                    $('#opt').val(2);
                    $('.desc').html(res);
                    $('#s').html("<i class='icon-save'></i>");
                }
                else if(type == 1 || type == 3){ //prazan-pun preko nedelje
                    $('#week-day').html(res).css({'padding-left': 0, 'padding-right': 0});
                    $('#opt').val(2);
                    $('#s').html("<i class='icon-save'></i>");
                }
            }
        })
    }

    function clear_day(day, type) {
        $.ajax({
            method: 'post',
            url: 'plan_make.php',
            data: {
                'id': $('#id').val(),
                'clear': 1,
                'day': day,
                'weed': type
            },
            dataType: 'json',
            success: function (res) {
                if(res[2] == 2){
                    $('.desc').html(res[1]);
                    $('#s').html('');
                    $('#t').html('');
                }
                else
                {
                    switch (res[0]) {
                        case('1'):
                            $('#mon').html(res[1]);
                            break;
                        case('2'):
                            $('#tue').html(res[1]);
                            break;
                        case('3'):
                            $('#wed').html(res[1]);
                            break;
                        case('4'):
                            $('#thu').html(res[1]);
                            break;
                        case('5'):
                            $('#fri').html(res[1]);
                            break;
                        case('6'):
                            $('#sat').html(res[1]);
                            break;
                        case('7'):
                            $('#sun').html(res[1]);
                            break;
                    }
                }

            }
        })
    }

    function save(day) {
        $.ajax({
            method: 'post',
            url: 'plan_make.php',
            data: {
                'id': $('#id').val(),
                'day': day,
                'from': $('#from').val(),
                'to': $('#to').val(),
                'muscle_id': $('#mc').val(),
                'ex1': $('#ex1').val(),
                'ex2': $('#ex2').val(),
                'ex3': $('#ex3').val(),
                'ex4': $('#ex4').val()
            },
            success: function (res) {
                $('#s').html('');
                $('.desc').html(res);
            }
        })
    }

    function day_show(id) { //prikazuje danasnji dan
        if(id < 8 && id > 0) {
            $.ajax({
                method: 'post',
                url: 'plan_day.php',
                data: {
                    'day': id,
                    'daily': 2,
                    'id': $('#id').val(),
                    'today': $('#day').val()
                },
                success: function (res) {
                    $('#week-day').html(res).css({'padding-left': 0, 'padding-right': 0});
                    $('#opt').val(2);
                }
            })
        }
    }
    //mc = muscle_group ... -_-
    function exercise(day) { //pravi padajuce liste kad izaberes grupu misica
        $.ajax({
            method: 'post',
            url: 'plan_make.php',
            data:{
                'id_mc': $('#mc').val(),
                'id': $('#id').val(),
                'day': day
            },
            success: function (res) {
                $('#mc_div').html(res)
            }
        })
    }

    function to() {
        $.ajax({
            method: 'post',
            url: 'plan_make.php',
            data:{
                'hour': $('#from').val()
            },
            success: function (res) {
                $('#to').html(res)
            }
        })
    }

</script>
    <body>
        <br><br><br>
        <div id="drop">
            <input hidden id="day" /> <!-- id dana -->
            <input hidden id="id" value="<?php echo $id ?>"/>  <!-- id korisnika -->
            <label for="opt"><?php echo $lang['view'] ?></label>
            <select id="opt" class="opt soflow" onchange="dw()">
                <option value="1"><?php echo $lang['Weekly'] ?></option>
                <option value="2"><?php echo $lang['Daily'] ?></option>
            </select>
        </div>
        <div id="week-day" align="center">
        </div>
    </body>
</html>