<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PFMO ANNUAL SUPPLIES REPORT</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 14px;
            margin: 0;
            padding: 0;
        }
        .header {
            text-align: auto;
            margin-bottom: 20px;
            image-orientation: inherit;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 0;
        }
        th, td {
            border: 1px solid #000;
            padding: 6px;
            text-align: center;
            vertical-align: top; 
        }
        td {
            text-align: left;
        }
        .center {
            text-align: center;
        }
        .empty-row td {
            height: 20px; 
        }
        .bold {
            font-weight: bold;
        }
        .subtitle {
            margin: 5px 0;
        }
        tr, td {
            padding: 3px;
            margin: 3px;
            text-align: justify;
        }
        .title {
            font-size: 23px
        }
    </style>
</head>
<body>
    <div>
        <table>
            <tr>
                <td class="center" style="vertical-align: middle;">
                    <img src="data:image/png;base64,{{ base64_encode(file_get_contents($imagePath)) }}" style="width: 500px; height:110px;">
                    <h2 class="title" style="font-weight: bolder">PFMO ANNUAL SUPPLIES REPORT</h2>
                </td>
            </tr>          
        </table>
    </div>
    <table>
        <tr>
            <td style="font-size: 18px"><b>User:</b> {{$pfmoSupplies->user}}</td>
            <td style="font-size: 18px"><b>Year:</b> {{ \Carbon\Carbon::parse($pfmoSupplies->entry_date)->format('Y') }}</td>
        </tr>
    </table>
    <table>
        <tr>
            <th>Stock No.</th>
            <th>Unit</th>
            <th>Description</th>
            <th>Quantity</th>
        </tr>
        @foreach ($pfmoSuppliesLists as $list)
        <tr>
            <td class="center" style="padding: 5px">{{ $list->stock_no }}</td>
            <td class="center" style="padding: 5px">{{ $list->unit }}</td>
            <td class="center" style="padding: 5px">{{ $list->description }}</td>
            <td class="center" style="padding: 5px">{{ $list->quantity }}</td>
        </tr>
        @endforeach
        <tr>
            <td style="padding: 15px"></td>
            <td style="padding: 15px"></td>
            <td style="padding: 15px"></td>
            <td style="padding: 15px"></td>
        </tr>
        <tr>
            <td style="padding: 15px"></td>
            <td style="padding: 15px"></td>
            <td style="padding: 15px"></td>
            <td style="padding: 15px"></td>
        </tr>
        <tr>
            <td style="padding: 15px"></td>
            <td style="padding: 15px"></td>
            <td style="padding: 15px"></td>
            <td style="padding: 15px"></td>
        </tr>
    </table>
</body>
</html>