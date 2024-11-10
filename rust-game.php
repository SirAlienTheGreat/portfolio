<!DOCTYPE html>
<head>
    <?php include $_SERVER["DOCUMENT_ROOT"] . "/titlebar.php"; ?>


</head>
<body>
    <div w3-include-html="titlebar.html"></div>
    <div class="content">
        <h1>rust-game</h1>
        <h2>A demonstration of the future of programming</h2>
        <p>In order to spur a virtuous cycle of Rust adoption (as described in
            my <a href="capstone-proposal.html">proposal</a>), I worked with a
            team in order to create a video game that might convince people to
            start adopting Rust. During this process, I needed to use most of the
            21st century skills</p>
    </div>
    <div style="text-align: center;">
        <div class="skill-div">
            <h3>Inquiry-Based Learning</h3>
            <p>I had to learn how to use <a href="https://bevyengine.org/">bevy</a>,
                by testing different tools to see what they do. This is shown by
                the fact that I didn't use any non-documentation resources. </p>
            <img src="/images/bevy-example.svg" style="max-width: 100%;">
        </div>
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
            <h3>Critical thinking</h3>
            <p>I had to use critical thinking when importing the world from Blender to rust-game because I had many choices for file formats to import. I settled on GLTF because it was the most standard file format that supported all of the features we were planning to use.</p>
        </div>
        <div class="skill-div">
            <h3>Deductive and Inductive Reasoning</h3>
            <p>I used deductive reasoning when debugging. While I was implementing controller support, I had an issue with my trigonometry where, when pushing the analog stick directly to the left or right, no movement would register because of a NaN error. It turned out that this was because I was taking the arctangent of y/x, which doesn't exist at y=0. Figuring this out is an example of deductive reasoning.</p>
            <p>Please see <a href="https://github.com/SirAlienTheGreat/rust-game/blob/main/src/movement.rs#L92">this section of code</a> for the now working algorithm</p>
        </div>
        <div class="skill-div">
            <h3>Understanding of Engineering Principles</h3>
            <p>I had to understand engineering principles throughout the entire development process. Here are some of the many instances of this:</p>
            <ul>
                <li>Bevy uses ECS, which was used in every function in my code</li>
                <li>Rust requires understanding of memory safety in order to understand how to use it</li>
                <li>Large projects (We're over 1000 LOC) require careful thought towards scalability</li>
                <li>The WASM port required consideration of the limitations of what can run in browsers, which is why we switched to embedded assets</li>
                <li>One of the basic CS optimizations is operation caching, which <a href="https://github.com/SirAlienTheGreat/rust-game/blob/main/src/decomp_caching.rs">was used</a> to deal with our convex decomposition algorithm</li>
                <li><a href="https://en.wikipedia.org/wiki/Serialization">Serialization/deserialization</a> is another fundamental CS principle, which was used when I was trying to implement operation caching.</li>
            </ul>
        </div>
        <div class="skill-div">
            <h3>Effective Communication Skills</h3>
            <p>When we were presenting our results, we had to make sure that we could communicate our project clearly, and we decided the best way to do that would be to let students have a hands-on experience with it. In order for this to work, we would need to make sure our game could properly communicate with school laptops, which we did using the WASM port.</p>
        </div>
        <div class="skill-div">
            <h3>Collaboration/Teamwork</h3>
            <p>Teamwork was very important for us because we needed to be certain that rust-game would be compatible with our models, as otherwise we wouldn't have a working game at the end. We overcame this issue by regularly communicating and testing our compatibility for features that existed in Blender but not implemented in my code and other issues  </p>
        </div>

        <div class="skill-div">
            <h3>Task/Time Management</h3>
            <p>We were on a very strict time limit, and still didn't fully understand our respective programming tools, so we decided to aggressively weight the learning phase of our project. This may have cost us a lot of time at the beginning, but it made the actual creation process very efficient.</p>
            <img src="/images/blender.png" style="max-width: 100%;">
            <p>I also had to deal with sunk cost fallacy when implementing multi-threaded convex decomposition. I had spent almost a week trying to implement multi-threaded convex decomposition in order to speed up the development process, each day feeling like I was almost there&trade;. I had to decide to prioritize features that would help end users rather than just developers and drop the idea.</p>
        </div>
        <div class="skill-div">
            <h3>Perseverance/Resilience</h3>
            <p>Our strategy for persevering through difficult moments was to keep ourselves emotionally invested in our projects. This allowed us to push through any technical difficulties, even when we didn't want to.</p>
        </div>
    </div>


</body>
</html>
