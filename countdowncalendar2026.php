<!-- Template file -->
<!DOCTYPE html>
<head>
    <?php include $_SERVER["DOCUMENT_ROOT"] . "/titlebar.php"; ?>
    <style>
        .cal-entry {
            min-width: 40px;
            min-height: 10px;
            font-size:115%;
            text-align:center;
        }
        .cal-oos {
            background:black;
        }
        .cal-before {
            background:green;
        }
        .cal-today {
            background:yellow;
        }
        .cal-after {
            background:red;
            color:black;
        }
        .spacer {
            min-height: 10px;
            width: 4px;
            display: block;
        }
    </style>

    <script src="./countdowncalendar2026.js"></script>
</head>
<body>

    <div class="content">
        <h1>Countdown to August 5th, 2026</h1>
        <table id="calendar">
            <!--<tr>
                <th class="cal-entry"><p><br></p></th>
                <th class="cal-entry"><p><br></p></th>
                <th class="cal-entry"><p><br></p></th>
                <th class="cal-entry"><p>1</p></th>
                <th class="cal-entry"><p>2</p></th>
                <th class="cal-entry"><p>3</p></th>
                <th class="cal-entry"><p>4</p></th>
            </tr>
            <tr>
                <th class="cal-entry"><p>5</p></th>
                <th class="cal-entry"><p>6</p></th>
                <th class="cal-entry"><p>7</p></th>
                <th class="cal-entry"><p>8</p></th>
                <th class="cal-entry"><p>9</p></th>
                <th class="cal-entry"><p>10</p></th>
                <th class="cal-entry"><p>11</p></th>
                </tr>-->
        </table>

        <h2 id="counter"></h2>
    </div>
</body>
</html>
