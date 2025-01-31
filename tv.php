<!DOCTYPE html>
<head>
    <?php include $_SERVER["DOCUMENT_ROOT"] . "/titlebar.php"; ?>

    <style>
        .skill-div:hover {
            background-color:darkgreen
        }
        .skill-div-small:hover {
            background-color:darkgreen
        }
    </style>
</head>
<body>
    <div class="content">
        <h1>Ridge TV (TV Production)</h1>

        <p>Fossil Ridge High School's weekly broadcast of school announcements and comedy skits.</p>
        <div style="text-align: center">
            <div id="player"></div>
        </div>

        <script>
            var tag = document.createElement('script');
                tag.src = "https://www.youtube.com/iframe_api";
                var firstScriptTag = document.getElementsByTagName('script')[0];
                firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

                // 3. This function creates an <iframe> (and YouTube player)
                //    after the API code downloads.
                var player;
                function onYouTubeIframeAPIReady() {
                    player = new YT.Player('player', {
                    height: '390',
                    width: '640',
                    videoId: 'jXjoIRnmD_w',
                    playerVars: {
                        'playsinline': 1
                    },
                    events: {
                        'onReady': onPlayerReady,
                        'onStateChange': onPlayerStateChange
                    }
                    });
                }

                // 4. The API will call this function when the video player is ready.
                function onPlayerReady(event) {
                    event.target.cueVideoById({videoId: 'jXjoIRnmD_w', startSeconds:117});
                    event.target.playVideo();
                    Player = event.target;
                }

                // 5. The API calls this function when the player's state changes.
                //    The function indicates that when playing a video (state=1),
                //    the player should play for six seconds and then stop.
                var done = false;
                function onPlayerStateChange(event) {
                    if (event.data == YT.PlayerState.PLAYING && !done) {
                    setTimeout(stopVideo, 6000);
                    done = true;
                    }
                }
                function stopVideo() {
                    player.stopVideo();
                }
                function load(id, secs){
                    console.log("Loading " + id + " at " + secs + " seconds")
                    player.loadVideoById({videoId: id, startSeconds:secs});
                    document.getElementById("player").scrollIntoView();
                }

        </script>

        <h2 style="text-align: center;">Writer and Director</h2>
        <p style="text-align: center;">In this role, I saw each segment through from idea through shoot and learned leadership, planning, and creative skills along the way.</p>
        <div style="text-align: center;">
            <a class="skill-div" onClick="load('jXjoIRnmD_w', 117)" style="color:lime">
                <div class="">
                    <h3>Interview with Calculus Enthusiast</h3>
                    <p>A segment that parodies calculus content using actual examples from class, but doubles as a sales pitch for school calculus classes</p>
                    <img src="images/calc-enthusiast.png" style="max-width: 100%;">
                    <p class="learn">This was the first segment I ever did, and it taught me the basics of shooting. Thanks to the hard work of my crew and all the calculus jokes in the script, this ended up being one of the best segments I've worked on</p>
                </div>
            </a>


            <a class="skill-div" onClick="load('yOzVtf3J2r8', 8)" style="color:lime">
                <div class="">
                    <h3>Climate Leadership Promo</h3>
                    <p>A segment that promotes the Climate Leadership Summit by parodying climate change deniers and burning a paper earth</p>
                    <img src="images/climate.png" style="max-width: 100%;">
                    <p class="learn">By creating the paper earth, I learned how to design props, and since we only had 1 earth (what a great metaphor), I had to make sure the the actors were all ready for the our singular take. Luckily, the actors performed perfectly, and we ended up with a segment with great production values.</p>
                </div>
            </a>

            <a class="skill-div" onClick="load('Xxkxt3rbq7A', 8)" style="color:lime">
                <div class="">
                    <h3>Bakemonogatari-style Study Skills</h3>
                    <p>A segment styled in the same way as Bakemonogatari intended to improve the study efficiency of the school. Note: Segment was split into 2 parts to demonstrate spaced repetition</p>
                    <img src="images/study-skills.png" style="max-width: 100%;">
                    <p class="learn">This was a really long segment with a lot going on in each part, from the text flashes to the stylized lighting and pop-up graphics. From this, I learned how to plan out such a large project in a detailed enough manner that we wouldn't need to ad-lib anything that could accidentally disrail the project. While this was a huge undertaking, the amount of detail in the final cut makes is all worth it.</p>
                </div>
            </a>


            <!--
            TEMPLATE

            <a class="skill-div-small" href="[URL]" style="color:lime">
                <div class="skill-div-small">
                    <h3>[NAME]</h3>
                    <p>[DESC]</p>
                    <img src="images/[IMAGE].png" style="max-width: 100%;">
                </div>
            </a>

            -->

        </div>

        <h2 style="text-align: center;">Episode Coproducer</h2>
        <p style="text-align: center;">In this role, I lead the class in developing segments and managing resources to get the episode out on time.<br>From this, I learned project planning and management skills.</p>
        <div style="text-align: center;">
            <a class="" onClick="load('GI0dcQio5YI', 0)" style="color:lime">
                <div class="skill-div">
                    <h3>Ridge TV Episode 13</h3>
                    <img src="images/alice-promo.png" style="max-width: 100%;">
                </div>
            </a>
        </div>


        <h2 style="text-align: center;">Segment Editor</h2>
        <div style="text-align: center;">
            <a class="skill-div-small" onClick="load('YqP5g8J4RgE', 234)" style="color:lime">
                <div class="">
                    <h3>Lip Dub Exit</h3>
                    <p>A segment meant to inform students of the plan for the rehearsal for the lip dub</p>
                    <img src="images/lip-dup-exit.png" style="max-width: 100%;">
                    <p class="learn-small">This was the first segment I edited in premiere, where I learned how to use premiere. Previously, I only knew how to use kdenlive, so it was a significant paradigm shift.</p>
                </div>
            </a>

            <a class="skill-div-small" onClick="load('D67JY4741PI', 0)" style="color:lime">
                <div class="">
                    <h3>Fortnite Segment</h3>
                    <p>A recurring gag in Ridge TV is the mentioning of Fortnight in random places. This segment parodies this.</p>
                    <img src="images/fortnite.png" style="max-width: 100%;">
                    <p class="learn-small">Here, I practiced my editing skills in preparation for Bakemonogatari Study Skills</p>
                </div>
            </a>

            <a class="skill-div-small" onClick="load('Xxkxt3rbq7A', 8)" style="color:lime">
                <div class="">
                    <h3>Bakemonogatari-style Study Skills</h3>
                    <img src="images/study-skills.png" style="max-width: 100%;">
                    <p class="learn-small">This episode has lots of complicated effects and stylizing, which shows the final result of all my learning</p>
                </div>
            </a>

        </div>

        <h2 style="text-align: center;">Actor</h2>
        <p style="text-align: center;">From these segments, I learned acting and teamwork skills</p>
        <div style="text-align: center;">
            <a class="skill-div-small" onClick="load('jXjoIRnmD_w', 115)" style="color:lime">
                <div class="">
                    <h3>Interview with Calculus Enthusiast</h3>
                    <img src="images/calc-enthusiast.png" style="max-width: 100%;">
                </div>

            <a class="skill-div-small" onClick="load('Xxkxt3rbq7A', 85)" style="color:lime">
                <div class="">
                    <h3>Senior Skip Day</h3>
                    <img src="images/ditch-day.png" style="max-width: 100%;">
                </div>
            </a>

            <a class="skill-div-small" onClick="load('D67JY4741PI', 0)" style="color:lime">
                <div class="">
                    <h3>Fortnite Segment</h3>
                    <img src="images/fortnite.png" style="max-width: 100%;">
                    <p class="learn-small">In this segment, I practiced my acting skills</p>
                </div>
            </a>
        </div>

        <h2 style="text-align: center;">Segment Crew</h2>
        <p style="text-align: center;">This includes roles where I did lights, camera, or sound, or some combination of the 3<br>From this, I learned the technical skills of film production and the way that sets are created.</p>
        <div style="text-align: center;">
            <a class="skill-div-small" onClick="load('jXjoIRnmD_w', 168)" style="color:lime">
                <div class="">
                    <h3>Into the woods promo</h3>
                    <img src="images/into-the-woods.png" style="max-width: 100%;">
                </div>
            </a>

            <a class="skill-div-small" onClick="load('jXjoIRnmD_w', 213)" style="color:lime">
                <div class="">
                    <h3>Ridge Weekly #8</h3>
                    <img src="images/ridge-weekly.png" style="max-width: 100%;">
                </div>
            </a>

            <a class="skill-div-small" onClick="load('D67JY4741PI', 188)" style="color:lime">
                <div class="">
                    <h3>Fridge Weekly #11</h3>
                    <img src="images/fridge-weekly.png" style="max-width: 100%;">
                </div>
            </a>

            <a class="skill-div-small" onClick="load('yOzVtf3J2r8', 130)" style="color:lime">
                <div class="">
                    <h3>State testing comedy</h3>
                    <img src="images/state-testing.png" style="max-width: 100%;">
                </div>
            </a>



            <a class="skill-div-small" onClick="load('IVDzPtTLfzY', 0)" style="color:lime">
                <div class="">
                    <h3>Slipping</h3>
                    <img src="images/slipping.png" style="max-width: 100%;">
                </div>
            </a>
        </div>

        <h3></h3>
    </div>


</body>
</html>
