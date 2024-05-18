<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Requisition and Issue Slip</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
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
                    <h2 class="title" style="font-weight: bolder">REQUISITION AND ISSUE SLIP</h2>
                </td>
            </tr>          
        </table>
    </div>
    <table>
        <tr>
        <td>
            <p>Division:   <u>{{ $requisition->division }}</u></p>
            <p>Office:      <u>{{ $requisition->office }}</u></p>

        </td>
        <td>
            <p style="flex: auto">Responsibility Center Code:        <u>{{ $requisition->responsibility_center_code }}</u></p>
        </td>
        <td>
            <p>RIS No.: <u>{{ $requisition->ris_no }}</u></p>
            <p>SAI No.: <u>{{ $requisition->sai_no }}</u></p>
        </td>
        <td>
            <p>Date: <u>{{ $requisition->date }}</u></p>
            <p>Date: </p>
        </td>
        </tr>
    </table>
    
    <table>
        <tr>
            <td colspan="4" class="center bold"><i>REQUISITION</i></td>
            <td colspan="2"class="center bold"><i>ISSUANCE</i></td>
        </tr>
        <tr>
            <th>Stock No.</th>
            <th>Unit</th>
            <th>Description</th>
            <th>Quantity</th>
            <th>Quantity</th>
            <th>Remarks</th>
        </tr>
        @foreach ($requisitionItems as $item)
        <tr>
            <td class="center" style="padding: 5px">{{ $item->stock_no }}</td>
            <td class="center" style="padding: 5px">{{ $item->unit }}</td>
            <td class="center" style="padding: 5px">{{ $item->description }}</td>
            <td class="center" style="padding: 5px">{{ $item->quantity }}</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        @endforeach
        <tr>
            <td style="padding: 15px"></td>
            <td style="padding: 15px"></td>
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
            <td style="padding: 15px"></td>
            <td style="padding: 15px"></td>
        </tr>
        <tr>
            <td style="padding: 15px"></td>
            <td style="padding: 15px"></td>
            <td style="padding: 15px"></td>
            <td style="padding: 15px"></td>
            <td style="padding: 15px"></td>
            <td style="padding: 15px"></td>
        </tr>
        <tr>
            <td colspan="6" style="padding-bottom: 40px">Purpose:  {{ $requisition->purpose }}</td>    
        </tr>
    </table>
    <div>
        <table>
            <tr>
                <td>&nbsp;</td>
                <td class="center">Recommended By:</td>
                <td class="center">Approved By:</td>
                <td class="center">Issued By:</td>
                <td class="center">Received By:</td>
            </tr>
            <tr>
                <td class="center">Signature</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td class="center">Printed Name:</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td class="center bold">{{ $requisition->issued_by_name }}</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td class="center">Designation:</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td class="center">{{ $requisition->issued_by_designation }}</td>
                <td>&nbsp;</td>
            </tr>
        </table>
    </div>
</body>
</html>