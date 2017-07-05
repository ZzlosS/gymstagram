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
        padding-right: 10%; /*mora na manjoj rezoluciji*/
    }

    div.gallery {
        margin: 5px;
        /*word-break:break-all;*/
        float: left;
        width: 180px;
        height: 180px;
        text-align: center;
        border: 1px solid transparent;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);

        border-radius: 2%;
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
    };

    function enable() {
        $('#inp').prop('disabled', false );
        $('#s').html("<i class='icon-save'></i>");
        //sve sto treba da se omoguci za izmenu
    }

    function save() {
        $('#inp').prop('disabled', true );
        $('#s').html('');
        //da salje podatke stranici koja ce da upisuje u bazu podatke i da postavi formu na disabled
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
                $('#week-day').html(res).css({'padding-left': 0, 'padding-right': 0});
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