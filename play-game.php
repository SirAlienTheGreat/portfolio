<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <?php include $_SERVER["DOCUMENT_ROOT"] . "/titlebar.php"; ?>

    <style>
        canvas {
            background-color: rgb(0, 255, 64);
            width:100%;
            height:100vh;
        }
    </style>
</head>
<h3>If you're able to play the <a href="https://github.com/SirAlienTheGreat/rust-game/releases/tag/v1.0.0">desktop version</a>, that is highly preferred.</h3>
<p>Please allow time for the game to download (1-2 minutes)</p>
<script type="module">
    import init from './target/rust-game.js'
    init()
</script>
<p style="font-family: monospace;">
|==========================================|<br>
| Action | Keyboard/mouse | Xinput gamepad |<br>
|^^^^^^^^|^^^^^^^^^^^^^^^^|^^^^^^^^^^^^^^^^|<br>
| Move&nbsp;&nbsp;&nbsp;| WASD&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;| Left stick&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|<br>
|------------------------------------------|<br>
| Camera | Mouse movement | Right stick&nbsp;&nbsp;&nbsp;&nbsp;|<br>
|------------------------------------------|<br>
|&nbsp;Jump&nbsp;&nbsp;&nbsp;|&nbsp;Space&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;Bottom&nbsp;button&nbsp;&nbsp;|<br>
|------------------------------------------|<br>
|&nbsp;Dash&nbsp;&nbsp;&nbsp;|&nbsp;Q&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;Left&nbsp;button&nbsp;&nbsp;&nbsp;&nbsp;|<br>
|------------------------------------------|<br>
|&nbsp;Fall&nbsp;&nbsp;&nbsp;|&nbsp;Shift&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;Right&nbsp;trigger&nbsp;&nbsp;|<br>
|==========================================|<br>
</p>



</html>
