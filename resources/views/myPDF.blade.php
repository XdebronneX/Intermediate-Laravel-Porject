{{-- <html>

<head>
    <style type="text/css">
        /** Define the margins of your page **/
        @page {
            margin: 100px 25px;
        }

        header {
            position: fixed;
            top: -60px;
            left: 0px;
            right: 0px;
            height: 50px;
            font-size: 20px !important;

            /** Extra personal styles **/
            background-color: #008B8B;
            color: white;
            text-align: center;
            line-height: 35px;
        }

        footer {
            position: fixed;
            bottom: -60px;
            left: 0px;
            right: 0px;
            height: 50px;
            font-size: 20px !important;

            /** Extra personal styles **/
            background-color: #008B8B;
            color: white;
            text-align: center;
            line-height: 35px;
        }


        /* Let's make sure all tables have defaults */
        table td {
            vertical-align: top;
        }

        /* -------------------------------------
            BODY & CONTAINER
        ------------------------------------- */


        .body-wrap {
            background-color: #f6f6f6;
            width: 100%;
        }

        .container {
            display: block !important;
            max-width: 600px !important;
            margin: 0 auto !important;
            /* makes it centered */
            clear: both !important;
        }

        .content {
            max-width: 600px;
            margin: 0 auto;
            display: block;
            padding: 20px;
        }

        /* -------------------------------------
            INVOICE
            Styles for the billing table
        ------------------------------------- */
        .invoice {
            margin: 40px auto;
            text-align: left;
            width: 80%;
        }

        .invoice td {
            padding: 5px 0;
        }

        .invoice .invoice-items {
            width: 100%;
        }

        .invoice .invoice-items td {
            border-top: #eee 1px solid;
        }

        .invoice .invoice-items .total td {
            border-top: 2px solid #333;
            border-bottom: 2px solid #333;
            font-weight: 700;
        }
    </style>
</head>

<body>
    <!-- Define header and footer blocks before your content -->
    <header>
        F & O Clinic Inc. TAguig City
    </header>

    <footer>
        Copyright © 2022 | F & O Clinic Inc. TAguig City
    </footer>
    <main>
        <table class="body-wrap">
            <tbody>
                <tr>
                    <td></td>
                    <td class="container" width="600">
                        <div class="content">
                            <table class="main" width="100%" cellpadding="0" cellspacing="0">
                                <tbody>
                                    <tr>
                                        <td class="content-wrap aligncenter">
                                            <table width="100%" cellpadding="0" cellspacing="0">
                                                <tbody>
                                                    <tr>
                                                        <td class="content-block" align="center">
                                                            <h2>Thanks for Availing Our Grooming Services</h2>
                                                        </td>
                                                    </tr>
                                                    <tr>

                                                        <td class="content-block">
                                                            <table class="invoice">
                                                                <tbody>
                                                                    <tr>
                                                                        <td>Customer Name:<strong>
                                                                                {{ $customers }}</strong><br>
                                                                            Pet name:
                                                                            <strong>{{ $pets }}</strong>
                                                                            <br> {{ date('d-m-Y H:i:s') }}<br>
                                                                            Groomer :<strong>
                                                                                {{ $employees }}</strong>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <table class="invoice-items" cellpadding="0"
                                                                                cellspacing="0">
                                                                                <tbody>
                                                                                    <tr class="total">
                                                                                        <td>Service Name</td>
                                                                                        <td class="alignright">Price
                                                                                        </td>
                                                                                    </tr>
                                                                                    <?php $total = 0; ?>
                                                                                    @foreach ($trans as $record)
                                                                                        <tr>
                                                                                            <td>{{ $record->service_name }}
                                                                                            </td>
                                                                                            <td class="alignright">
                                                                                                {{ $record->service_cost }}
                                                                                            </td>
                                                                                        </tr>
                                                                                        <?php $total = $total + $record->service_cost; ?>
                                                                                    @endforeach

                                                                                    <tr class="total">
                                                                                        <td class="alignright"
                                                                                            width="80%">Total</td>
                                                                                        <td class="alignright">
                                                                                            {{ $total }}</td>
                                                                                    </tr>

                                                                                </tbody>
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="content-block" align="center">
                                                            F & O Clinic Inc. TAguig City
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </main>
</body>

</html> --}}

<!DOCTYPE html>
<html>
<header>
    PetClinic
</header>


<head>
    <h6>{{ $info->created_at }}</h6>
    <title>Transaction Receipt</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <h6>CUSTOMER: <strong>{{ $info->fname }} {{ $info->lname }} </strong></h6>
    <h6>PET: <strong>{{ $info->pname }}</strong></h6>

    <h6>ADDRESS: {{ $info->addressline }}</h6>
    <h6>STATUS: {{ $info->status }}</h6>
    <table class="table table-bordered">
        <tr>
            <th>Service Name</th>
            <th>Service Cost</th>

        </tr>
        @foreach ($tableee as $table)
            <tr>
                <td>{{ $table->service_name }}</td>
                <td>{{ $table->service_cost }}</td>
            </tr>
        @endforeach
        <tr>
            <td><strong>Total</strong></td>
            <td>{{ $add }}</td>
        </tr>

    </table>

    <footer>
        Copyright © 2022 | PetClinic
    </footer>
</body>

</html>
