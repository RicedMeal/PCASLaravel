<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase Request Form</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12px;
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
            margin-bottom: 20px;
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
        /* Remove margin and padding between tables */
        .header table, table + .footer table {
            margin-top: 0;.
            image-orientation: inherit;
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
    <div class="header">
        <table>
            <tr>
                <td class="center" style="vertical-align: middle;">
                    <img src="plm-logo--with-header.png" class="plm-logo">
                </td>
                <td>
                    <h2 class="title">PURCHASE REQUEST</h2>
                    <p class="subtitle">PAMANTASAN NG LUNGSOD NG MAYNILA (Agency)</p>
                </td>
            </tr>
            
        </table>
    </div>
    <table>
        <tr>
        <td>
            <p class="bold">Department: ____________________</p>
            <p>                  _______________________</p>
            <p class="bold">Section:        _______________________</p>

        </td>
        <td>
            <p class="bold">PR No.:         _______________________</p>
            <p class="bold">SAI No.:     _______________________</p>
            <p class="bold">BUS No:     _______________________</p>
        <td>
            <p class="bold">Date: ______________</p>
            <p class="bold">Date: ______________</p>
            <p class="bold">Date: ______________</p>
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
        <!-- Empty rows -->
        @for ($i = 0; $i < 20; $i++)
        <tr class="empty-row">
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        @endfor
        <!-- Total row -->
        <tr>
            <td colspan="4"></td>
            <td class="bold">Total</td>
            <td></td>
            <!-- <td>Delivery Duration</td> -->
        </tr>
    </table>
    <div class="footer">
        <table>
            <tr>
                <td>&nbsp;</td>
                <td class="bold center">Requested by:</td>
                <td class="bold center">Approved by:</td>
            </tr>
            <tr>
                <td>
                    <p class="bold">Signature: </p>
                    <p class="bold">Printed Name: </p>
                    <p class="bold">Designation: </p>
                </td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td colspan="3" class="bold">Purpose: ______________________________________</td>
            </tr>
        </table>
    </div>
</body>
</html>
