<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase Request Form</title>
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
            vertical-align: top; /* Align content to the top */
        }
        td {
            text-align: left;
        }
        .center {
            text-align: center;
        }
        .empty-row td {
            height: 20px; /* Adjust height as needed */
        }
        .footer {
            margin-top: 20px;
        }
        .bold {
            font-weight: bold;
        }
        .plm-logo {
            height: 60px; /* Adjust height as needed */
            width: auto;
            vertical-align: middle;
            margin-right: 10px; /* Adjust margin as needed */
        }
        .title {
            margin: 0;
        }
        .subtitle {
            margin: 5px 0;
        }
        tr, td {
            padding: 3px;
            margin: 3px;
            text-align: justify;
            textbold: bold;
        }


    </style>
</head>
<body>
    <div>
        <table>
            <tr>
                <td class="center" style="vertical-align: middle;">
                    <img src="data:image/png;base64,{{ base64_encode(file_get_contents($imagePath)) }}" style="width: 500px; height:110px;">
                    <h2 class="title">PURCHASE REQUEST</h2>
                </td>
            </tr>          
        </table>
    </div>
    <table>
        <tr>
        <td>
            <p class="bold">Department:   <u>{{ $purchaseRequestForm->project->department  }}</u></p>
            <p class="bold">Section:      <u>{{ $purchaseRequestForm->section }}</u></p>

        </td>
        <td>
            <p class="bold">PR No.:        <u>{{ $purchaseRequestForm->pr_no }}</u></p>
            <p class="bold">SAI No.:     <u>{{ $purchaseRequestForm->sai_no }}<u></p>
            <p class="bold">BUS No:     <u>{{ $purchaseRequestForm->bus_no }}<u></p>
        <td>
            <p class="bold">Date: <u>{{ $purchaseRequestForm->date }}</u></p>
            <p class="bold">Date: </p>
            <p class="bold">Date: </p>
        </td>
        </tr>
    </table>
    <table>
        <tr>
            <th>Item No.</th>
            <th>Unit</th>
            <th>Item Description</th>
            <th>Quantity</th>
            <th>Estimated Unit Cost</th>
            <th>Estimated Cost</th>
        </tr>
        @foreach ($purchaseRequestItems as $item)
        <tr>
            <td class="center">{{ $item->item_no }}</td>
            <td class="center">{{ $item->unit }}</td>
            <td class="center">{{ $item->item_description }}</td>
            <td class="center">{{ $item->quantity }}</td>
            <td class="center">{{ $item->estimate_unit_cost }}</td>
            <td class="center">{{ $item->estimate_cost }}</td>
        </tr>
        @endforeach
        <!-- Total row -->
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td class="bold center">TOTAL</td>
            <td class="bold center">{{ $purchaseRequestForm->total }}</td>
            <tr>
                <td></td>
                <td></td>
                <td>Delivery Duration: {{ $purchaseRequestForm->delivery_duration }}</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </tr>
        <tr>
            <td colspan="6" style="padding-bottom: 40px">PURPOSE:  {{ $purchaseRequestForm->purpose }}</td>
            
        </tr>
    </table>
    <div>
        <table>
            <tr>
                <td>&nbsp;</td>
                <td class="bold center">Recommended by:</td>
                <td class="bold center">Approved by:</td>
            </tr>
            <tr>
                <td>
                    <p class="bold"><i>Signature: </i></p>
                    <p class="bold"><i>Printed Name: </i></p>
                    <p class="bold"><i>Designation: </i></p>
                </td>
                <td>
                    <p class="bold center">____________________________ </p>
                    <p class="bold center">{{ $purchaseRequestForm->recommended_by_name }} </p>
                    <p class="center"><i>{{ $purchaseRequestForm->recommended_by_designation }}</i></p>
                </td>
                <td>
                    <p class="bold center">___________________________ </p>
                    <p class="bold center">{{ $purchaseRequestForm->approved_by_name }}</p>
                    <p class="center"><i>{{ $purchaseRequestForm->approved_by_designation }}</i></p>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>
