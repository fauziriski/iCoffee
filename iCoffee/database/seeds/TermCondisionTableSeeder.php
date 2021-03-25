<?php

use Illuminate\Database\Seeder;
use App\Terms_and_condition;

class TermCondisionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $x1= Terms_and_condition::create([
            'type' => '1',
            'text' => 'Rekening Bersama iCoffee adalah rekening bersama resmi milik iCoffee yang disepakati oleh iCoffee dan para pengguna untuk proses transaksi jual beli dan lelang di Situs iCoffee. 
            Rekening bersama iCoffee disediakan untuk melindungin pembelian dan penjualan. Untuk melindungi terhadap risiko tanggung jawab, pembayaran untuk pembelian yang dilakukan kepada Penjual dengan menggunakan Layanan akan diselenggarakan oleh iCoffee atau agen yang berwenang ("Rekening Bersama iCoffee"). Pengguna tidak akan menerima bunga atau penghasilan lain dari jumlah yang telah anda bayarkan ke Rekening Bersama iCoffee.',
            'status' => '1',
        ]);

        $x2 = Terms_and_condition::create([
            'type' => '1',
            'text' => 'Setelah Pembeli melakukan pembayaran untuk pesanannya, Uang Pembelian Pembeli akan disimpan di Rekening Bersama iCoffee 
            sampai:',
            'status' => '1',
        ]);

        $x2_1 = Terms_and_condition::create([
            'type' => '1',
            'branch' => $x2->id,
            'text' => 'Pembeli mengirimkan konfirmasi kepada iCoffee bahwa Pembeli telah menerima barang dalam keadaan baik.
            ',
            'status' => '1',
        ]);

        $x2_2 = Terms_and_condition::create([
            'type' => '1',
            'branch' => $x2->id,
            'text' => 'Pembeli tidak mengirimkan konfirmasi 2 hari setelah barang yang dibeli oleh pembeli sampai',
            'status' => '1',
        ]);

        $x3 = Terms_and_condition::create([
            'type' => '1',
            'text' => 'Pembayaran yang dilakukan melalui saluran iCoffee akan disimpan di Rekening Bersama iCoffee selama jangka waktu 2 minggu. ',
            'status' => '1',
        ]);

        $x4 = Terms_and_condition::create([
            'type' => '1',
            'text' => 'Apabila, untuk alasan apapun, rekening bank Penjual tidak dapat dikreditkan dan/atau Penjual tidak dapat dihubungi,
             iCoffee akan melaksanakan usaha yang wajar untuk menghubungi Penjual dengan menggunakan rincian kontak yang diberikan oleh Penjual tersebut. Dalam hal Penjual tidak dapat dihubungi dan Uang Pembelian Pembeli tetap tidak diklaim selama lebih dari 12 bulan setelah uang tersebut jatuh tempo untuk diberikan untuk Penjual, iCoffee akan menangani Uang Pembelian Pembeli yang tidak diklaim tersebut.',
            'status' => '1',
        ]);

        $x5 = Terms_and_condition::create([
            'type' => '1',
            'text' => 'Penjual/Pembeli haruslah pemilik Akun dan melakukan transaksi di Situs hanya atas nama dirinya sendiri. iCoffee mungkin memerlukan Penjual atau Pembeli untuk memberikan data pribadi Penjual atau Pembeli seperti foto identitas terkini, rincian rekening bank dan/atau dokumen lain apapun yang diperlukan, untuk tujuan verifikasi, termasuk verifikasi yang diperlukan oleh pengelola pembayaran pihak ketiga dan penyedia layanan logistik. Dengan ini Penjual/Pembeli memberi persetujuan kepada iCoffee untuk menggunakan atau memberikan kepada pihak
             ketiga data pribadi Penjual/Pembeli untuk memfasilitasi penggunaan Situs oleh Penjual/Pembeli.',
            'status' => '1',
        ]);

        $x6 = Terms_and_condition::create([
            'type' => '1',
            'text' => 'Jika Pembeli melakukan komplain pada suatu order iCoffee akan melakukan melaksanakan usaha untuk melakukan vervikasi terhadap yang dikeluhkan. Lalu iCoffee berhak mengatur dana yang tersimpan pada Rekening Bersama iCoffee agar dikembalikan ke pembeli atau diteruskan ke penjual.',
            'status' => '1',
        ]);

        $x7 = Terms_and_condition::create([
            'type' => '1',
            'text' => 'Rekening Pengguna iCoffee dapat digunakan Pembeli untuk menyimpan uang dan menerima pengembalian dana untuk yang dilakukan di Situs melalui transfer bank.
            ',
            'status' => '1',
        ]);

        $x8 = Terms_and_condition::create([
            'type' => '1',
            'text' => 'Setiap Pengguna telah diberikan akun yang memiliki layanan Rekening Pengguna iCoffee',
            'status' => '1',
        ]);

        $x9 = Terms_and_condition::create([
            'type' => '1',
            'text' => 'Rekening Pengguna iCoffee memungkinkan Penjual untuk menyimpan uang yang mereka terima dari hasil penjualan dan pengembalian biaya pengiriman.
            ',
            'status' => '1',
        ]);

        $x10 = Terms_and_condition::create([
            'type' => '1',
            'text' => 'Uang dari penjualan barang anda di iCoffee akan dikreditkan ke Saldo Penjual iCoffee anda dalam waktu 2 hari setelah barang diterima oleh Pembeli berdasarkan status pengiriman termutakhir dari penyedia jasa pengiriman atau segera setelah Pembeli mengkonfirmasi di Situs bahwa mereka telah menerima barang tersebut.',
            'status' => '1',
        ]);

        $x11 = Terms_and_condition::create([
            'type' => '1',
            'text' => 'Pada saat ini, iCoffee hanya dapat melakukan pembayaran kepada Penjual melalui bank transfer. Oleh karena itu, Penjual diminta untuk memberikan rincian rekening bank Penjual kepada iCoffee untuk menerima pembayaran dari iCoffee
            ',
            'status' => '1',
        ]);

        $x12 = Terms_and_condition::create([
            'type' => '1',
            'text' => 'Pembeli dan Penjual mengakui dan setuju bahwa keputusan iCoffee (termasuk setiap permohonan) sehubungan dengan dan dalam kaitan dengan setiap masalah mengenai Garansi iCoffee bersifat final.',
            'status' => '1',
        ]);
    }
}
