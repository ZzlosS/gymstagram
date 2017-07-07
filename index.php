<?php
	require_once 'basic.php';
?>

<script>

    function show(id) {
        $.ajax({
            method: 'post',
            url: 'index_show.php',
            data: {'id':id},
            success: function (res) {
                if(id == 1){
                    $('.info1').show().html(res).css('background-color', '#dee2e6');
                }
                else if(id == 3){
                    $('.info2').show().html(res).css('background-color', '#dee2e6');
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

    .info1, .info2{
        width: 180px;
        height: 180px;
    }

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

    .footer-distributed .footer-left p{
        color:  #8f9296;
        font-size: 14px;
        margin: 0;
    }

    .footer-right{
        float: right;
        margin-top: 6px;
        max-width: 180px;
    }
    .footer-left{
        float: left;
        margin-top: 6px;
        max-width: 180px;
    }
    /* Footer links */

    .footer-distributed p.footer-links{
        font-size:18px;
        font-weight: bold;
        color:  #ffffff;
        margin: 0 0 10px;
        padding: 0;
    }

    .footer-distributed p.footer-links a{
        display:inline-block;
        line-height: 1.8;
        text-decoration: none;
        color:  inherit;
    }

    .footer-distributed a{
        display: inline-block;
        width: 35px;
        height: 35px;
        background-color:  #33383b;
        border-radius: 2px;

        font-size: 20px;
        color: #ffffff;
        text-align: center;
        line-height: 35px;

        margin-left: 3px;
    }

    /* If you don't want the footer to be responsive, remove these media queries */

    @media (max-width: 600px) {

        .footer-distributed .footer-left,
        .footer-distributed .footer-right{
            text-align: center;
        }

        .footer-distributed .footer-right{
            float: none;
            margin: 20px;
        }
/* div sa prikazom podataka da se stavi float left i right ili sta vec i da se sredi velicina da bude manja...*/
        .footer-distributed .footer-left p.footer-links{
            line-height: 1.8;
        }
    }
</style>
<footer class="footer-distributed">

    <div class="footer-right" onmouseover="show(1)" onmouseleave="show(2)">
        <img src="img/avatar.png"/>
    </div>
    <div class="footer-right"  onmouseover="show(1)" onmouseleave="show(2)"> <!-- mora ovako da bi islo s leve strane -->
        <div class="info1"></div>
    </div>


    <div class="footer-left"  onmouseover="show(3)" onmouseleave="show(4)">
        <img src="img/avatar.png" />
    </div>
    <div class="footer-left"  onmouseover="show(3)" onmouseleave="show(4)">
        <div class="info2"></div>
    </div>

</footer>

	</body>
</html>