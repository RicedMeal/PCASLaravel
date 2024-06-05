<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock Card</title>
    <style>
        html {
            padding: 30px;
            margin: 30px;
            background-color: #fdf3d1;
        }
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 14px;
            margin: 0;
            padding: 0;
        }
        .header {
            margin-bottom: 20px;
            text-align: center;
            position: relative;
        }
        .header .left, .header .right {
            position: absolute;
            top: 0;
            font-size: 15px;
        }
        .header .left {
            left: 0;
        }
        .header .right {
            right: 0;
        }
        .subtitle {
            margin: 5px 0;
            text-align: left;
            font-weight: bold;
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
        .title {
            margin-top: 50px;
            text-align: center;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 30px;
        }
        tr, td {
            padding: 3px;
            margin: 3px;
            text-align: justify;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="left">Revised March 2016</div>
        <div class="right">Appendix 58</div>
        <h2 class="title">STOCK CARD</h2>
    </div>

    <div class="subtitle">
        Entity Name: <u>{{ $stockCard->entity_name }}</u>
    </div>
    <div class="subtitle">
        Fund Cluster: <u>{{ $stockCard->fund_cluster }}</u>
    </div>
    <table>
        <tr>
        <td colspan="5"> Item:  {{ $stockCard->item_code  }}</td>
        <td colspan="2"> Stock No.: {{ $stockCard->stock_no }}</td>
        </tr>
        <tr>
        <td colspan="5"> Description: {{ $stockCard->list_description}}</td>
        <td colspan="2"> Re-order Point: {{ $stockCard->reorder_point }}</td>
        </tr>
        <tr>
        <td colspan="5"> Unit: {{ $stockCard->unit }}</td>
        <td colspan="2"> &nbsp;</td>
        </tr>
        <thead>
            <tr>
                <th>Date</th>
                <th>Reference</th>
                <th colspan="1">Receipt</th>
                <th colspan="2">Issue</th>
                <th>Balance</th>
                <th>No. of Days to Consume</th>
            </tr>
            <tr>
                <th></th>
                <th></th>
                <th>Qty.</th>
                <th>Qty.</th>
                <th>Office</th>
                <th>Qty.</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($stockCardLists as $list)
            <tr>
                <td class="center" style="padding: 5px">{{ $list->date}}</td>
                <td class="center" style="padding: 5px">{{ $list->reference }}</td>
                <td class="center" style="padding: 5px">{{ $list->receipt_quantity }}</td>
                <td class="center" style="padding: 5px">{{ $list->issue_quantity}}</td>
                <td class="center" style="padding: 5px">{{ $list->issue_office }}</td>
                <td class="center" style="padding: 5px">{{ $list->balance_quantity }}</td>
                <td class="center" style="padding: 5px">{{ $list->no_of_days }}</td>
            </tr>
            @endforeach
        </tbody>
    </div>
</body>
</html>


 
