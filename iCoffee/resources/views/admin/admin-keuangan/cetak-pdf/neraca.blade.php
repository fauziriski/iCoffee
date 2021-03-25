<html>
    <head>
        <style>
            /** 
                Set the margins of the page to 0, so the footer and the header
                can be of the full height and width !
             **/
            @page {
                margin: 0;
            }

            table {
                padding-top: 5%;
                border-collapse: collapse;
            }
            th {
                padding-left: 2%;
            }

            td {
                padding-left: 5%;
            }

            h3 {
                text-align: center;
                line-height: 4px;
            }
            /** Define now the real margins of every page in the PDF **/
            body {
                margin: 3cm 2cm 2cm;
            }

            /** Define the header rules **/
            header {
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                height: 3cm;
            }

            /** Define the footer rules **/
            footer {
                position: fixed;
                bottom: 0;
                left: 0;
                right: 0;
                height: 2cm;
            }
        </style>
    </head>
    <body>
        <!-- Define header and footer blocks before your content -->
        <!-- <header> <img src="{{ public_path('landing_page/images/LOGO.png') }}"
        width="100%" height="100%"/> </header> <footer> <img src="footer.png"
        width="100%" height="100%"/> </footer> -->

        <!-- Wrap the content of your PDF inside a main tag -->
        <main>
            <h3>PT. ICOFFEE.ID</h3>
            <h3>LAPORAN NERACA</h3>
            <h3>Periode
                {{$periode}}</h3>

            <div class="row">
                <div class="col-md-6">
                    <div class="table-responsive">
                        <table
                            class="table table-striped table-bordered"
                            border="1"
                            style="width:100%;">
                            <thead>
                                <tr>
                                    <th colspan="2">AKTIVA</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(isset($aktiva)){ ?>
                                @foreach($aktiva as $lancar)
                                <tr>
                                    <td>{{$lancar->nama_akun}}</td>
                                    <td>Rp
                                        {{number_format($lancar->total)}}</td>
                                </tr>
                                @endforeach
                                <?php }?>
                                <tr>
                                    <td>Aktiva Lancar</td>
                                    <td>Rp 0</td>
                                </tr>
                                <tr>
                                    <td>Aktiva Tetap</td>
                                    <td>Rp 0</td>
                                </tr>
                                <tr>
                                    <th colspan="2" style="height: 15px;"></th>
                                </tr>
                                <tr class="table-primary">
                                    <td>
                                        <strong>TOTAL AKTIVA :</strong>
                                    </td>
                                    <td>
                                        <strong>Rp
                                            {{number_format($total_aktiva)}}</strong>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="table-responsive">
                        <table
                            class="table table-striped table-bordered"
                            border="1"
                            style="width:100%;">
                            <thead>
                                <tr>
                                    <th colspan="2">PASIVA</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="2">
                                        <strong>Liabilitas<strong></td>
                                        </tr>
                                        <tr>
                                            <td>Hutang</td>
                                            <td>Rp
                                                {{number_format($total_hutang)}}</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <strong>Total Hutang</strong>
                                            </td>
                                            <td>
                                                <strong>Rp
                                                    {{number_format($total_hutang)}}</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th colspan="2" style="height: 15px;"></th>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <strong>Ekuitas</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Laba Ditahan</td>
                                            <td>Rp
                                                {{number_format($saldo)}}</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <strong>Total Ekuitas</strong>
                                            </td>
                                            <td>
                                                <strong>Rp
                                                    {{number_format($saldo)}}</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th colspan="2" style="height: 15px;"></th>
                                        </tr>
                                        <tr class="table-primary">
                                            <td>
                                                <strong>TOTAL PASIVA :</strong>
                                            </td>
                                            <td>
                                                <strong>Rp
                                                    {{number_format($saldo)}}</strong>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </main>
                </body>

            </html>