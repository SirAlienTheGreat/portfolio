<!DOCTYPE html>
<head>
    <?php include $_SERVER["DOCUMENT_ROOT"] . "/titlebar.php"; ?>
</head>
<body>

    <div class="content">
        <h1>Summer Program for Undergraduate Research (SPUR)<br>Just-in-time cross-language inlining on the GPU</h1>
        <p>Thank you to my mentors <a href="https://jeremylt.org/">Jeremy Thompson</a> and <a href="https://jedbrown.org/">Professor Jed Brown</a> at <a href="https://phypid.org/">PhyPID</a>!</p>
        <h2>A brief overview of how my summer of undergrad research went</h2>
        <div style="width: 100%;">
            <div class="skill-div-small">
                <img src="/images/libceed-logo.webp" style="max-width: 100%;">
            </div>
            <div class="skill-div" style="width: 100%; max-width: max(200px, calc(100% - 400px));">
                <h3>Mission Statement</h3>
                <p>My lab develops a simulation library <a href="https://gitlab.com/libceed/libCEED/">libCEED</a>, which accepts user-defined code for a small but critical component. This code is compiled just-in-time and runs on both CPU and GPU targets, and was previously written in C. My task was to allow users to write this in Rust, <a href="https://gitlab.com/libceed/libCEED/-/commit/2027fb9d13fe34211738d8539f90542a9801ae2c">which I did</a>, allowing for better memory safety and modern language features, such as unit-checking and auto-differentiation. </p>
            </div>
        </div>
        <h2>High-level technical overview</h2>
        <img src="/images/2025confpaper-general-diagram.svg" style="max-width: 100%; "></a>
        <p>Making this work on the GPU, where calling a function is not allowed, requires a complex pipeline, where both C and Rust sources are compiled manually into an Intermediate Representation (IR) - A low-level programming language that many programming languages individually compile to. After all source files are in the same language (LLVM), it is possible to link all the files into one big file, optimize the code, and compile it to a GPU with the individual LLVM tools.</p>
        <p>For a more detailed explanation, please read my paper in <a href="/2025confpaper.php">webpage</a> or <a href="images/2025confpaper.pdf">PDF</a> format. Please note that this paper is intended for more technical audiences than the rest of this website.</p>

        <h2>Skills this project taught me</h2>
        <div style="text-align: center;">
            <div class="skill-div">
                <h3>Perseverance</h3>
                <p>This project was very complex, and full of issues that are very challenging to debug, especially with the LLVM tools. There were many points where I wanted to give up and choose a more straightforward project for my internship, but I decided to persevere and finish the project. This has made me into a more resilient person who is capable of accepting more difficult tasks in the future.</p>
            </div>

            <div class="skill-div">
                <h3>Collaborative software development</h3>
                <p>Before this project, I had never worked on such a large project; there were never more than 2-3 people, we all started around the same time, and the projects never got too large. This made onboarding onto libCEED much harder, as I had to get accustomed to the conventions of coordinating on such a large project. Now that I've successfully done this, I'm more prepared for the onboarding of my next big project.</p>
            </div>

            <div class="skill-div">
                <h3>Requesting assistance (Just the right amount)</h3>
                <p>There were many points in this project where I had to decide whether to ask my professor for help or keep struggling with a problem. It's important to find a balance between being over-reliant on others (wasting their time) and locking myself into a fruitless endeavor (wasting my time). My heuristic was to generally ask for help when I've exhausted my intuition, debugging tools, and relevant documentation, and then created a reproducible example that I could send to my professor</p>
            </div>
        </div>
    </div>

</body>
</html>
