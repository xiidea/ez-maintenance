<script>
(function () {

    function httpStatus(url, callback) {
        var http = new XMLHttpRequest();
        http.open('HEAD', url);
        http.onreadystatechange = function () {
            if (this.readyState == this.DONE) {
                callback(this.status);
            }
        };
        http.send();
    }

    function reloadPage() {
        setTimeout('location.reload(true);', 1);
    }

    function reloadIfSiteUp() {
        httpStatus(location.href, function (sstatus) {
            if (sstatus == 503) {
                setTimeout(reloadIfSiteUp, <?php echo $interval * 1000 ?>)
            } else {
                reloadPage();
            }
        })
    }

    reloadIfSiteUp();
})();

</script>