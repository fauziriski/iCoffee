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
                padding-top : 5%;
                border-collapse: collapse;
            }

			th{
				padding-left: 2%
			}

			td{
				padding-left: 10%
			}

			h3{
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
        <!-- <header>
            <img src="{{ public_path('landing_page/images/LOGO.png') }}" width="100%" height="100%"/>
        </header>

        <footer>
            <img src="footer.png" width="100%" height="100%"/>
        </footer> -->

        <!-- Wrap the content of your PDF inside a main tag -->
        <main>
			<h3>PT. ICOFFEE.ID</h3>
            <h3>LAPORAN PERUBAHAN MODAL</h3>
			<h3>Periode {{$periode}}</h3>
              <table class="table table-striped table-bordered" border="1" style="width:100%;">
                <thead>
                    <tr>
                        <th>Keterangan</th>
                        <th>Modal</th>
                        <th>Saldo Laba</th>
                        <th>Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Saldo,
                            {{$periode}}</td>
                        <td>Rp
                            {{number_format($modal)}}</td>
                        <td></td>
                        <td>Rp
                            {{number_format($modal)}}</td>
                    </tr>
                    <tr>
                        <td>Laba/Rugi</td>
                        <td></td>
                        <td>Rp
                            {{number_format($laba)}}</td>
                        <td>Rp
                            {{number_format($laba)}}</td>
                    </tr>
                    <tr>
                        <td><strong>Saldo,
                            {{$periode}}</strong></td>
                        <td><strong>Rp
                            {{number_format($modal)}}</strong></td>
                        <td><strong>Rp
                            {{number_format($laba)}}</strong></td>
                        <td><strong>Rp
                            {{number_format($saldo)}}</strong></td>
                    </tr>
                </tbody>
            </table>
        </main>
    </body>
</html>