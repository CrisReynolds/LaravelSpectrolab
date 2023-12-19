<html>

<head>
    <title>Vale de ingreso</title>
    <style>
        #watermark {
            color: #d0d0d0;
            font-size: 70pt;
            -webkit-transform: rotate(-45deg);
            -moz-transform: rotate(-45deg);
            position: absolute;
            margin-top: 25%;
            width: 800px;
            text-align: center;
            z-index: -1;
        }

        tbody {
            font-family: 'Segoe UI';
            font-size: 8pt;
        }

        .tdLegend {
            font-family: 'Segoe UI';
            font-size: 6pt;
        }

        .title {
            font-family: 'Segoe UI';
            font-size: 12pt;
            font-weight: bold;
        }

        .subtitle {
            font-family: 'Segoe UI';
            font-size: 10pt;
            font-weight: bold;
        }

        .sizetab {
            width: 800px;
        }
    </style>
</head>

<body>
    @livewire('vale-compra',['compra_id'=>$id])
</body>
</html>
