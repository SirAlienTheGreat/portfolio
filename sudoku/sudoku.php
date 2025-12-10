<!DOCTYPE html>
<head>
    <?php include $_SERVER["DOCUMENT_ROOT"] . "/titlebar.php"; ?>
    <title>Sudoku solver</title>
    <style>
        .sudokuEntry {
            min-width: 10px;
            min-height: 10px;
            font-size:115%;
            text-align:center;
        }
        .spacer {
            min-height: 10px;
            width: 4px;
            display: block;
        }

        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type="number"] {
            -moz-appearance: textfield;
        }
        #sudokuBoard{
            width:min(100%,400px);
            height:min(100%,400px);
        }

    </style>
    <script type="module" src="./sudoku-web.js"></script>
</head>
<body>

    <div class="content">
        <h1>Sudoku Solver</h1>
        <table id="sudokuBoard"></table>

        <button
            onclick="
                writeSudoku(
                    '000000000000000000000000000000000000000000000000000000000000000000000000000000000',
                )
            "
            class="on-page-button"
        >
            Clear board
        </button>
        <button onclick="generateNewBoard()" class="on-page-button">Generate new board</button>
        <button onclick="solveSudoku()" class="on-page-button">Solve Sudoku</button>
        <button onclick="run_web_benchmark()" class="on-page-button">Run benchmark</button>
        <button onclick="run_internal_benchmark()" class="on-page-button">
            Run internal benchmark
        </button>
        <p id="output" style="min-height:30px"> </p>

        <p>This is a project I made as extra study for my intro to AI course. It uses <a href="https://en.wikipedia.org/wiki/Simulated_annealing">simulated annealing</a> to solve the sudoku, as explained in the diagram below</p>

        <img src="/images/sudoku-solver-diagram.svg" style="max-width: 100%;">
        <p>View the source code on <a href="https://github.com/SirAlienTheGreat/soducant/">my github repo for this project</a></p>
    </div>
</body>
</html>
