<?php
	require_once 'basic.php';
	if(!$loggedIn){
		
?>

<script>

    function show(id) {
        $.ajax({
            method: 'post',
            url: 'index_show.php',
            data: {'id':id},
            success: function (res) {
                if(id == 1){
                    $('.info1').show().html(res);
                }
                else if(id == 3){
                    $('.info2').show().html(res);
                }
                else{
                    $('.info1').hide();
                    $('.info2').hide();
                }
            }
        })
    }

</script>

<style>

    .footer-distributed{
        background-color: #292c2f;
        box-shadow: 0 1px 1px 0 rgba(0, 0, 0, 0.12);
        box-sizing: border-box;
        width: 100%;
        text-align: left;
        font: normal 16px sans-serif;

        padding: 45px 50px;
        margin-top: 80px;
        position: fixed;
        bottom: 0;
    }

    .info1, .info2{
        width: 310px;
        max-height: 180px;
        float: inherit;
    }


    p.p-info, p.p-info2 {
        max-width: 300px;
        vertical-align: middle;
        color: #E85F37;
        font-family: "Open Sans", sans-serif;
        font-size: 10px;
        letter-spacing: 1px;
        font-weight: 700;
        text-transform: uppercase;
        padding: 10px 25px;
        background-color: #FFF;
        border: 1px solid #DC5227;
        -moz-border-radius: 5px;
        -webkit-border-radius: 5px;
        border-radius: 5px;
        box-shadow: inset 0 -3px 0 #ffcfbc;
        position: relative;
    }

    p.p-info:after {
        content: '';
        position: absolute;
        border-style: solid;
        border-color: transparent #FFF;
        display: block;
        width: 0;
        z-index: 1;
        top: 12px
    }
    p.p-info:before {
        content: '';
        position: absolute;
        border-style: solid;
        border-color: transparent #DC5227;
        display: block;
        width: 0;
        z-index: 1;
        top: 10px
    }
    /*left*/
    .footer-left{
        float: left;
        margin-top: 6px;
        padding-left: 10px;
        max-width: 180px;
    }

    p.left:after{
        border-width: 9px 9px 9px 0;
        left: -9px;
    }
    p.left:before{
        border-width: 11px 10px 11px 0;
        left: -10px;
    }
    /*right */

    .footer-right{
        float: right;
        margin-top: 6px;
        padding-right: 10px;
        max-width: 180px;
    }

    p.right:after{
        border-width: 9px 0 9px 9px;
        right: -9px;
    }
    p.right:before{
        border-width: 11px 0 11px 10px;
        right: -10px;
    }

</style>
<footer class="footer-distributed">

    <div class="footer-right" onmouseover="show(1)" onmouseleave="show(2)">
        <img src="img/jr.jpg"/>

    </div>
    <div class="footer-right"  onmouseover="show(1)" onmouseleave="show(2)"> <!-- mora ovako da bi islo s leve strane -->
        <div class="info1"></div>

    </div>


    <div class="footer-left"  onmouseover="show(3)" onmouseleave="show(4)">
        <img src="img/ss.jpg" />
    </div>
    <div class="footer-left"  onmouseover="show(3)" onmouseleave="show(4)">
        <div class="info2"></div>
    </div>

</footer>

	</body>
</html>
<?php
	}
	else{
		echo "<script>location.replace('home.php');</script>";
	}