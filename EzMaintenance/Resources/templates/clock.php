<!DOCTYPE html>
<html>
<head lang="en">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="robots" content="noindex,nofollow"/>
    <title> <?php echo $msg ?> </title>
    <style type="text/css">
        @import url(http://fonts.googleapis.com/css?family=Nunito:300&text=:);
        html { height: 100%; }
        body {
            min-height: 100%; margin: 0;
            background: rgb(0,122,255); color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        #currtime {
            font-family: Helvetica Neue, Helvetica, Arial, Lucida Grande, sans-serif;
            font-weight: 100;
            display: block;
            text-align: center;
            font-size: 12vw;
            padding: 4rem 0;
        }
        #currtime span {
            display: inline-block;
            font-family: Avenir Next, Nunito, sans-serif;
            font-weight: 100;
            font-size: 8vw;
            position: relative;
            top: -2vw;
        }
        @media all and (max-width: 600px) {
            #currtime {
                font-size: 4rem;
                padding: 2rem 0;
            }
        }
        @media all and (max-width: 350px) {
            #currtime { font-size: 3rem; padding: 2rem 0; }
        }
    </style>
</head>
<body>
<time title="<?php echo $title ?>" id="currtime"></time>
<?php echo $javascript ?>
<script>
    var currentTime = document.getElementById("currtime");
    function zeropadder(n) {
        return (parseInt(n,10) < 10 ? '0' : '')+n;
    }
    function updateTime(){
        var timeNow= new Date(),
            hh = timeNow.getHours(),
            mm = timeNow.getMinutes(),
            ss = timeNow.getSeconds(),
            formatAMPM = (hh >= 12?'PM':'AM');
        hh = hh % 12 || 12;
        currentTime.innerHTML = hh + "<span>:</span>" + zeropadder(mm) + "<span>:</span>" + zeropadder(ss) + " " + formatAMPM;
        setTimeout(updateTime,1000);
    }
    updateTime();
</script>
</body>
</html>