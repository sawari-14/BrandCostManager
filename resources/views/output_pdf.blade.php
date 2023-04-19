<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style type="text/css">
        @font-face {
            font-family: ipag;
            font-style: normal;
            font-weight: normal;
            src: url('{{ storage_path('fonts/ipaexg.ttf') }}') format('truetype');
        }
        @font-face {
            font-family: ipag;
            font-style: bold;
            font-weight: bold;
            src: url('{{ storage_path('fonts/ipaexg.ttf') }}') format('truetype');
        }
        body {
            font-family: ipag !important;
        }
        table{
            width:500px;
        }
        th{
            font-size:30px;
        }
        td{
            font-size:30px;
        }
        h1{
            margin-top:50px;
            margin-left:100px;
        }
        table{
            margin-left:100px;
        }
    </style>
</head>
<body>
    <h1>今年の総経費 : {{ $sum }}円</h1>
    <table border=1>
        @foreach($costs as $cost)
        <tr>
            <th>{{ $cost->content }}</th>
            <td>{{ $cost->sum_cost }}円</td>
        </tr>
        @endforeach
        <tr>
            <th>合計金額</th>
            <td>{{ $sum }}円</td>
        </tr>

</table>

</body>
</html>