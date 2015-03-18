<?php
if(!defined('APPLICATION_ENV') || APPLICATION_ENV != 'down') {
    die('Access denied');
}

const HEARTBEAT = 5;

header('HTTP/1.1 503 Service Temporarily Unavailable');
header('Status: 503 Service Temporarily Unavailable');
header('Retry-After: ' . HEARTBEAT);
?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="robots" content="noindex,nofollow" />
    <title> Under maintenance </title>
    <style type="text/css">
        * {margin: 0; padding: 0; font-size: 100%;}
        body {text-align: center; font-family: Arial, sans-serif; font-size:small; color: black;}
        div#ct_site {margin-left: auto; margin-right: auto; margin-top: 4em; width: 500px; }
        p {margin: 1em 0; font-size: 120%; }
    </style>

</head>
<body>
<div id="ct_site">

    <p>Our site is currently undergoing maintenance.</p>

</div>
<script>
    (function () {

        function httpStatus(url, callback)
        {
            var http = new XMLHttpRequest();
            http.open('HEAD', url);
            http.onreadystatechange = function() {
                if (this.readyState == this.DONE) {
                    callback(this.status);
                }
            };
            http.send();
        }

        function reloadPage()
        {
            setTimeout('location.reload(true);', 1);
        }

        function reloadIfSiteUp() {
            httpStatus(location.href, function (sstatus) {
                if (sstatus == 503) {
                    setTimeout(reloadIfSiteUp, <?php echo HEARTBEAT * 1000 ?>)
                } else {
                    reloadPage();
                }
            })
        }

        reloadIfSiteUp();
    })();

</script>
</body>
</html>