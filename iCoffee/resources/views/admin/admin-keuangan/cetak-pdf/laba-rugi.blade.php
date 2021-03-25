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
            <h3>LAPORAN LABA/RUGI</h3>
			<h3>Periode {{$periode}}</h3>
            <table class="table table-striped table-bordered" border="1" style="width:100%;">
                <thead>
                    <tr>
                        <th colspan="4" style="text-align: left">Pendapatan</th>
                    </tr>
                </thead>
                <tbody>
				@foreach($data1 as $pendapatan)
                    <tr>
                        <td>{{$pendapatan->nama_akun}}</td>
                        <td>Rp {{number_format($pendapatan->total)}}</td>
                        <td></td>
                        <td></td>
                    </tr>
				@endforeach
					<tr>
						<th colspan="2" style="text-align: left">Total Pendapatan :</th>
						<th>Rp
							{{number_format($total_pendapatan)}}</th>
						<th></th>
					</tr><tr><th colspan="4" style="height: 15px;"></th></tr>
					<tr>
                        <th colspan="4" style="text-align: left">Beban Pengeluaran</th>
                    </tr>
				@foreach($data2 as $pengeluaran)
                    <tr>
                        <td>{{$pengeluaran->nama_akun}}</td>
                        <td>Rp {{number_format($pengeluaran->total)}}</td>
                        <td></td>
                        <td></td>
                    </tr>
				@endforeach
					<tr>
						<th colspan="2" style="text-align: left">Total Beban Pengeluaran :</th>
						<th>Rp{{number_format($total_beban)}}</th>
						<th></th>
					</tr>
					<tr>
						<th colspan="3" style="text-align: left">Total Laba :</th>
						<th>Rp{{number_format($laba)}}</td>
					</tr>
                </tbody>
            </table>

        </main>
    </body>
</html>