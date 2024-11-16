<!DOCTYPE html>
<head>
    <style>
        .skill-div:hover {
            background-color:darkgreen
        }
        .skill-div-small:hover {
            background-color:darkgreen
        }
    </style>
    <?php include $_SERVER["DOCUMENT_ROOT"] . "/titlebar.php"; ?>
</head>
<body>
    <div class="content">
        <h1>Projects</h1>
        <h2>Some of the personal projects that I've done</h2>
        <div style="text-align: center;">
            <a href="https://github.com/SirAlienTheGreat/rust-game" style="color:lime; text-decoration: none;"><div class="skill-div">
                <h3>rust-game (Rust)</h3>
                <p>This was my STEM Academy Capstone Project. It's a game where you play as a glowing block, meant to demonstrate the Rust programming language</p>
                <a href="/images/rust-game-screenshot.png"><img src="/images/rust-game-screenshot.webp" style="max-width: 100%; "></a>
            </div></a>

            <a href="https://github.com/SirAlienTheGreat/oped-game-v2" style="color:lime; text-decoration: none;"><div class="skill-div">
                <h3>oped-game v2 (Rust)</h3>
                <p>This is a self-hosted <a href="https://animemusicquiz.com/">AMQ</a> clone developed in Rust. I made it because I wanted to play the AMQ game without relying on their servers and I also wanted to be able to play the full songs during the game</p>
                <a href="/images/oped-v2-screenshot.png"><img src="/images/oped-v2-screenshot.webp" style="max-width: 100%; "></a>
            </div></a>

            <a href="https://github.com/SirAlienTheGreat/integral-calculator" style="color:lime; text-decoration: none;"><div class="skill-div" >
                <h3>Integral Calculator (Rust)</h3>
                <p>This is a Riemann sum calculator made in Rust for WebAssembly that I made to practice the build process for WebAssembly. It calculates an integral by summing up a large (but not infinite) number of rectangles. The desktop version is also multithreaded</p>
                <a href="/images/screenshot-desktop.png"><img src="/images/screenshot-desktop.webp" style="max-width: 100%; "></a>
            </div></a>



            <a href="https://github.com/SirAlienTheGreat/discord-gdpr-grapher" style="color:lime; text-decoration: none;"><div class="skill-div" >
                <h3>discord-gdpr-grapher (Rust)</h3>
                <p>This projects calculates the number of messages you've sent in discord over time from the discord GDPR output. That means you can request your discord GDPR data and feed it into this program to see how many messages you've sent in any month for graphing</p>
                <a href="/images/discord-graph.png"><img src="/images/discord-graph.webp" style="max-width: 100%; "></a>
            </div></a>

            <a href="https://github.com/SirAlienTheGreat/MAL-anime-per-month" style="color:lime; text-decoration: none;"><div class="skill-div" ">
                <h3>MAL Data Calculator (Python)</h3>
                <p>Similar to discord-gdpr-grapher, this project calculates the amount and average rating of the anime you've watched based on your <a href="https://myanimelist.net/">MAL</a> exported data</p>
                <a href="/images/mal-graph.png"><img src="/images/mal-graph.png" style="max-width: 100%; "></a>
            </div></a>
        </div>

    </div>
</body>
</html>
