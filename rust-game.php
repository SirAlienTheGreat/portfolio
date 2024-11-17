<!DOCTYPE html>
<head>
    <?php include $_SERVER["DOCUMENT_ROOT"] . "/titlebar.php"; ?>


</head>
<body>

    <div class="content">
        <h1>rust-game</h1>
        <h2>A demonstration of the future of programming</h2>
        <h3> Play the game <a href="/play-game.php">here</a> </h3>
        <p>In order to spur a virtuous cycle of Rust adoption (as described in
            my <a href="capstone-proposal.php">proposal</a>), I worked with a
            team in order to create a video game that might convince people to
            start adopting Rust. During this process, I needed to use 21st century skills</p>
    </div>
    <div style="text-align: center;">

        <div class="skill-div">
            <h3>Creative Problem-Solving</h3>
            <p>One of the issues that I encountered was that there was an object in the GLTF file that was exported from Blender that was causing my convex decomposition algorithm to panic. I had to take the vertices from my algorithm and graph them to find the problem. It turned out that my algorithm was panicking from a flat surface being decomposed. Once I figured this out, an easy flatness check and algorithm swap made rust-game panic-free.</p>
            <img src="/images/scatterplot.png" style="max-width: 100%;">
        </div>
        <div class="skill-div">
            <h3>Experimentation</h3>
            <p>While I was working on rust-game, after implementing GLTF loading and hitboxes, I needed to do a performance test to make sure that there were no critical memory issues that might prevent us from moving forward with importing Blender files into the game. To do this, I imported a Minecraft world that was far larger than our actual final world to see if there were any performance issues. Luckily, rust-game ran at a smooth 1440p/144FPS, even when put under an unrealistically sized world.</p>
            <img src="/images/minecraft.png" style="max-width: 100%;">
        </div>
        <div class="skill-div">
            <h3>Debugging</h3>
            <p>While I was implementing controller support, I had an issue with my trigonometry where, when pushing the analog stick directly to the left or right, no movement would register because of a NaN error. It turned out that this was because I was taking the arctangent of y/x, which doesn't exist at y=0.</p>
            <p>Please see <a href="https://github.com/SirAlienTheGreat/rust-game/blob/main/src/movement.rs#L92">this section of code</a> for the now working algorithm</p>
        </div>
        <div class="skill-div">
            <h3>Understanding of Engineering Principles</h3>
            <p>I had to understand engineering principles throughout the entire development process. Here are some of the many instances of this:</p>
            <ul>
                <li>Bevy uses <a href="https://en.wikipedia.org/wiki/Entity_component_system">ECS</a>, which was used in every function in my code</li>
                <li>Large projects (rust-game is over 1000 LOC) require careful thought towards scalability</li>
                <li>The WASM port required consideration of the limitations of what can run in browsers, which is why we switched to embedded assets</li>
                <li>One of the basic CS optimizations is operation caching, which I <a href="https://github.com/SirAlienTheGreat/rust-game/blob/main/src/decomp_caching.rs">used here</a> to deal with our convex decomposition algorithm</li>
                <li><a href="https://en.wikipedia.org/wiki/Serialization">Serialization/deserialization</a> is another fundamental CS principle, which was used when I was trying to implement operation caching.</li>
            </ul>
        </div>
        <div class="skill-div">
            <h3>Presentation Skills</h3>
            <p>When we presented our results, we had to communicate our project clearly to a non-technical audience. We decided to create a hands-on experience. For this to work, we had to make sure our game could properly communicate with school laptops, which we did using our WebAssembly port.</p>
        </div>
        <div class="skill-div">
            <h3>Collaboration</h3>
            <p>Teamwork and frequent communication was critical to make sure that the code of rust-game which I coded would be compatible with the 3D models created by my teammate. We overcame this issue by regularly communicating and testing our compatibility to detect features that existed in Blender but had not been implemented in my code, among other methods.</p>
        </div>

        <div class="skill-div">
            <h3>Schedule Management</h3>
            <p>We were on a very strict time limit, and still didn't fully understand our respective programming tools, so we decided to aggressively weight the learning phase of our project. This may have cost us a lot of time at the beginning, but it made the actual creation process very efficient.</p>
            <img src="/images/blender.png" style="max-width: 100%;">
            <p>I also had to deal with sunk cost fallacy when implementing multi-threaded convex decomposition. I spent almost a week trying to implement multi-threaded convex decomposition in order to speed up the development process, each day feeling like I was almost there™. Ultimately I decided to prioritize features that would help end users rather than just developers and dropped the idea.</p>
        </div>
    </div>


</body>
</html>
