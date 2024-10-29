<!DOCTYPE html>
<head>
    <script src="include.js"></script>
    <link rel="stylesheet" type="text/css" href="styles.css"/>
</head>
<body>
    <div w3-include-html="titlebar.html"></div>



    <?php
    ini_set("display_errors", "1");
    ini_set("display_startup_errors", "1");
    error_reporting(E_ALL);
    ?>


    <?php
    define("LOGFILE", "/srv/http/log.txt");

    $secret_password = file_get_contents("pass.txt");

    define("SECRET", $secret_password);
    define("PULL_CMD", "echo hellothere >> log.txt");

    //echo "Password is " . SECRET;

    $post_data = file_get_contents("php://input");
    $signature = hash_hmac("sha1", $post_data, SECRET);

    /*function log_msg($message)
    {
        file_put_contents(LOGFILE, $message . "\n", FILE_APPEND);
        }*/

    if (empty($_SERVER["HTTP_X_HUB_SIGNATURE"])) {
        file_put_contents(
            LOGFILE,
            "git pull done with no signature" . "\n",
            FILE_APPEND
        );
        exit("no signature");
    }

    if (!hash_equals("sha1=" . $signature, $_SERVER["HTTP_X_HUB_SIGNATURE"])) {
        file_put_contents(
            LOGFILE,
            "Sigcheck failed. expected {$secret_password} but got {$signature}, postdata is {$post_data}" .
                "\n",
            FILE_APPEND
        );
        exit("signature doesn't match");
    }

    // At this point, we've verified the signature from Github, so we can do things.
    $date = date(" m/d/Y h:i:s a", time());
    // logs message

    file_put_contents(LOGFILE, "Deploying at {$date}" . "\n", FILE_APPEND);
    //log_msg("Deploying at {$date}");

    $output_lines = [];
    exec(PULL_CMD, $output_lines);

    if (!empty($output_lines)) {
        file_put_contents(
            LOGFILE,
            implode("\n", $output_lines) . "\n",
            FILE_APPEND
        );
        //log_msg(implode("\n", $output_lines));
    }
    ?>


    <script>
    includeHTML();
    </script>

</body>
</html>
