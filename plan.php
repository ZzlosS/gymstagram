<?php
require_once 'basic.php';


?>
<style>

    #drop {
        text-align: center;
        margin: 50px;
    }

    #week-day{
        padding-left: 16%;
    }

    div.gallery {
        margin: 5px;
        /*word-break:break-all;*/
        float: left;
        width: 180px;
        height: 180px;
        text-align: center;
        border: 1px solid transparent;
    }

    #day{
        width: 300px;
        float: none;
        align-content: center;
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
        if($('.opt').val() == 1){
            var pl = 16
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
                $('#week-day').html(res).css({'padding-left': pl+'%'});
            }
        })

    }

    function day_show(id) {
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
                $('#week-day').html(res).css('padding-left', 0);
                $('#opt').val(2);
            }
        })
    }

</script>
<body>
<br><br><br>
<div id="drop">
    <input hidden id="day" />
    <input hidden id="id" value="<?php echo $id ?>"/>
    <label for="opt">View</label>
    <select id="opt" class="opt" onchange="dw()">
        <option value="1">Weekly</option>
        <option value="2">Daily</option>
    </select>
</div>
<div id="week-day" align="center">



</div>
</body>
</html>