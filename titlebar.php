<style>
    #main_titlebar {
        display:flex;
        gap:15px;
        background-color: rgb(17, 48, 0);
        overflow:hidden;
        padding-top:12px;
        padding-bottom: 12px;
        padding-left: 15px;
        text-align: center;
    }
    .titlebar_item {
        color: rgb(0, 0, 0);
        font-size: x-large;
        background-color: limegreen;
        padding: 5px;
        -ms-transform: skewX(20deg);
        -webkit-transform: skewX(20deg);
        transform: skewX(20deg);
        display: inline-block;
        text-decoration: none;
    }
    .titlebar_item:hover{
        box-shadow: 0 12px 16px 0 rgba(21, 255, 0, 0.24),0 17px 50px 0 rgba(21, 255, 0,0.19);
        background-color: lime;
        -ms-transform: skewX(15deg);
        -webkit-transform: skewX(15deg);
        transform: skewX(15deg);
        display: inline-block;
    }
</style>
<div id="main_titlebar">
    <a href="/index.php" class="titlebar_item">Home</a>
    <!--<a href="/capstone-proposal.php" class="titlebar_item">Capstone proposal</a>-->
    <a href="/rust-game.php" class="titlebar_item">rust-game</a>
    <a href="/classwork.php" class="titlebar_item">Classwork</a>
    <a href="/tv.php" class="titlebar_item">TV production</a>
    <a href="/play-game.php" class="titlebar_item">Play the game!</a>

</div>

<link rel="stylesheet" type="text/css" href="styles.css"/>
