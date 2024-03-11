<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase Request Form</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            margin: 0;
            padding: 0;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header img {
            height: 100px; /* Adjust height as needed */
            width: auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Purchase Request Form</h1>
        <img src="https://plm.edu.ph/images/ui/plm-logo--with-header.png" alt="Pamantasan ng Lungsod ng Maynila Logo">
    </div>
    <table>
        <tr>
            <td colspan="2">Department: PFMO</td>
            <td colspan="2">         _________</td>
            <td colspan="2">Section: _________</td>
        </tr>
        <tr>
            <td colspan="2">PR. NO.: ___________</td>
            <td colspan="2">SAI No.: ___________</td>
            <td colspan="2">BUS NO.: ___________</td>

        </tr>
        <tr>


            <td colspan="2">Date:  _________</td>
            <td colspan="2">Date:  _________</td>
            <td colspan="2">Date:  _________</td>
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
        <!-- Repeat rows 4-24 for the data from the database -->
        <!-- Example: -->
        <!-- @foreach($purchaseRequestItems as $item) -->
        <!-- <tr> -->
        <!--     <td>{{ $item->item_no }}</td> -->
        <!--     <td>{{ $item->unit }}</td> -->
        <!--     <td>{{ $item->item_description }}</td> -->
        <!--     <td>{{ $item->quantity }}</td> -->
        <!--     <td>{{ $item->estimate_unit_cost }}</td> -->
        <!--     <td>{{ $item->estimate_cost }}</td> -->
        <!-- </tr> -->
        <!-- @endforeach -->
        <!-- End of repeating rows -->
        <tr>
            <td colspan="4">TOTAL</td>
            <td colspan="2">Total Cost</td> <!-- Replace 'Total Cost' with actual total cost from the database -->
        </tr>
        <tr>
            <td colspan="6">Delivery Duration: ___________</td>
        </tr>
        <tr>
            <td colspan="6">Purpose: ___________</td>
        </tr>
        <tr>
            <td></td>
            <td colspan="2">Recommended by: ___________</td>
            <td colspan="3">Approved by: ___________</td>
        </tr>
        <tr>
            <td></td>
            <td>Signature:</td>
            <td></td>
            <td>Printed Name: ___________</td>
            <td></td>
            <td>Printed Name: ___________</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>Designation: ___________</td>
            <td></td>
            <td></td>
            <td>Designation: ___________</td>
        </tr>
    </table>
</body>
</html>
