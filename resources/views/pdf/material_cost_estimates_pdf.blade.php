<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Material Cost Estimates PDF</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 14px;
            margin: 0;
            padding: 0;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            image-orientation: inherit;
            align-content: center;
        }
        .content {
            margin-bottom: 20px;
        }
        .bold {
            font-weight: bold;
        }

    </style>
</head>
<body>
    <div class="header">
        <img src="data:image/png;base64,{{ base64_encode(file_get_contents($imagePath)) }}" style="width: 500px; height:110px;">
        <h2 class="bold" style="font-size: 16px">PHYSICAL FACILITIES MANAGEMENT OFFICE</h2>
        <h2 class="bold" style="font-size: 15px"><u>MATERIALS AND COST ESTIMATES</u></h2>
    </div>
    <div class="content">
        <div>
            <p style="margin-left: 10px">Project: <u class="bold">{{ $materialCostEstimates->project->project_title }}</u></p>
            <p style="margin-left: 10px">Location: <u class="bold">{{ $materialCostEstimates->location }}</u></p>
        </div>

        <div>
            <table style="border-collapse: collapse; width: 100%" >
                <tr>
                    <th style="border: none; padding: 5px; text-align:center">Item No.</th>
                    <th style="border: none; padding: 5px; text-align:center">DESCRIPTION</th>
                    <th style="border: none; padding: 5px; text-align:center">Quantity</th>
                    <th style="border: none; padding: 5px; text-align:center">Unit</th>
                    <th style="border: none; padding: 5px; text-align:center">Unit Cost</th>
                    <th style="border: none; padding: 5px; text-align:center">Amount</th>
                </tr>
                @foreach ($materialCostEstimatesItems as $item)
                <tr>
                    <td style="border: none; padding: 5px; text-align:center">{{ $item->item_no }}</td>
                    <td style="border: none; padding: 5px; text-align:center">{{ $item->description }}</td>
                    <td style="border: none; padding: 5px; text-align:center">{{ $item->quantity }}</td>
                    <td style="border: none; padding: 5px; text-align:center">{{ $item->unit }}</td>
                    <td style="border: none; padding: 5px; text-align:center">{{ $item->unit_cost }}</td>
                    <td style="border: none; padding: 5px; text-align:center">{{ $item->amount }}</td>
                </tr>
                @endforeach
            </table>
        </div>
        
    </div>
    <div class="footer">
        <div>
            <p class="bold" style="margin-left: 550px">TOTAL: <u>Php {{ $materialCostEstimates->total }}</u></p>
        </div>
        <p></p>
        <p></p>
        <p></p>
        <p style="margin-left: 420px">Prepared by: </p>
        <p></p>
        <p></p>
        <p></p>
        <p class="bold" style="margin-left: 470px">{{ $materialCostEstimates->prepared_by }}</p>
        <p style="margin-left: 480px"><i>{{ $materialCostEstimates->prepared_by_designation }}</i></p>
        <p></p>
        <p style="margin-left: 50px">Checked by:</p>
        <p></p>
        <p></p>
        <p></p>
        <p class="bold" style="margin-left: 100px"> {{ $materialCostEstimates->checked_by }}</p>
        <p style="margin-left: 120px"><i>{{ $materialCostEstimates->checked_by_designation }}</i></p>
    </div>
</body>
</html>
