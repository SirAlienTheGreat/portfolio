<!-- Template file -->
<!DOCTYPE html>
<head>
    <?php include $_SERVER["DOCUMENT_ROOT"] . "/titlebar.php"; ?>
</head>
<body>

    <div class="content">
        <h1>Summer Program for Undergraduate Research (SPUR)<br>Just-in-time cross-language inlining on the GPU</h1>
        <h2>A brief overview of how my summer of undergrad research went</h2>
        <div style=";">
            <div class="skill-div-small">
                <img src="/images/libceed-logo.webp" style="max-width: 100%;">
            </div>
            <div class="skill-div" style="width: 100%; max-width: max(200px, min(800px, calc(100% - 400px)));">
                <h3>Mission Statement</h3>
                <p>My lab develops a simulation library <a href="https://gitlab.com/libceed/libCEED/">libCEED</a>, which accepts user-defined code for a small but critical component. This code is compiled just-in-time and runs on both CPU and GPU targets, and was previously written in C. My task was to allow users to write this in Rust, <a href="https://gitlab.com/libceed/libCEED/-/commit/2027fb9d13fe34211738d8539f90542a9801ae2c">which I did</a>, allowing for better memory safety and modern language features, such as unit-checking and auto-differentiation. </p>
            </div>
        </div>

    </div>
</body>
</html>
