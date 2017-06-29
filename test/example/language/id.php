<?php
require_once realpath(__DIR__ . '/..').'/config.php';
$lang = [
    'validation_username_ok' => 'Nama Pengguna OK!',
	'validation_username_fail' => 'Nama Pengguna telah terpakai!',
	'validation_email_ok' => 'Alamat email OK!',
	'validation_email_fail' => 'Alamat email telah terpakai!',
    'validation_email_letter_fail' => 'Format penulisan alamat email salah!',
    'validation_number_ok' => 'Format telepon OK!',
	'validation_number_fail' => 'Format telepon harus di isi angka saja!',
    'validation_username_letter_fail' => 'Format username adalah huruf, angka, atau huruf dan angka!',
    'currency_code' => 'IDR',
    'welcome_to' => 'Selamat datang di',
    'register' => 'Pendaftaran',
    'register_to' => 'Mendaftar di',
    'process_register_failed' => 'Proses Pendaftaran Gagal,',
    'your_password_is_not_match' => 'Password Anda tidak cocok!',
    'wrong_security_key' => 'Kode keamanan salah!',
    'not_agree_terms_of_service' => 'Anda tidak setuju dengan persyaratan layanan!',
    'i_agree_to' => 'Saya setuju dengan ',
    'form_register' => 'Formulir Pendaftaran',
    'input_username' => 'Harap di isi dengan Nama Pengguna Anda...',
    'input_password' => 'Harap di isi dengan Password Anda...',
    'input_fullname' => 'Harap di isi dengan Nama lengkap Anda...',
    'input_address' => 'Harap di isi dengan alamat Anda...',
    'input_phone' => 'Harap di isi dengan nomor telepon Anda...',
    'input_email' => 'Harap di isi dengan alamat surel Anda...',
    'input_about_me' => 'Jelaskan sedikit mengenai diri Anda...',
    'input_avatar' => 'Harap di isi dengan link gambar avatar Anda...',
    'input_subject' => 'Harap di isi dengan perihal / maksud tujuan Anda disini...',
    'input_message' => 'Harap di isi dengan pesan Anda disini...',
    'input_security_key' => 'Silahkan jawab pertanyaan keamanan ini...',
    'input_confirm_password' => 'Harap ulangi kembali password Anda...',
    'terms_of_service' => 'persyaratan layanan',
    'username' => 'Nama Pengguna',
    'password' => 'Kata Sandi',
    'confirm_password' => 'Konfirmasi Kata Sandi',
    'fullname' => 'Nama Lengkap',
    'address' => 'Alamat',
    'phone' => 'Telepon',
    'email' => 'Alamat Surel',
    'about_me' => 'Tentang Saya',
    'avatar' => 'Avatar',
    'subject' => 'Perihal',
    'security_key' => 'Kode Keamanan',
    'close' => 'Tutup',
    'submit_register' => 'Mendaftar',
    'terms_of_service_big' => 'Persyaratan Layanan',
    'modal_terms_of_service' => '<p>Anda setuju, melalui penggunaan layanan ini, Anda tidak akan menggunakan 
         Aplikasi ini untuk mengirim materi yang secara sengaja salah dan / atau memfitnah,
         Tidak akurat, kasar, vulgar, penuh kebencian, melecehkan, cabul, kotor,
         berorientasi seksual, mengancam, menyerang privasi seseorang, atau sebaliknya
         dari hukum apapun. Anda setuju untuk tidak mengirimkan materi yang dilindungi hak cipta kecuali jika
         Hak cipta tersebut dimiliki oleh Anda</p>

        <p>Kami sebagai pemilik aplikasi ini juga berhak mengungkapkan identitas Anda (atau
         apapun informasi yang kami ketahui tentang Anda) jika terjadi keluhan atau
         tindakan legal yang timbul dari pesan yang diposkan oleh Anda. Kami mencatat semua alamat protokol internet
         bagi yang mengakses situs ini</p>

        <p>Harap dicatat bahwa iklan, surat berantai, skema piramida, dan
         penghasutan adalah tidak diperbolehkan dalam aplikasi ini.</p>

        <p>Kami berhak menghapus semua konten apapun dengan alasan atau tanpa alasan apapun. 
         Kami berhak menghentikan keanggotaan apapun dengan alasan apapun atau tidak ada
         alasan sama sekali.</p>

        <p>Anda harus berusia minimal 13 tahun untuk menggunakan layanan ini.</p>',
    'home' => 'Beranda',
    'about' => 'Tentang',
    'privacy' => 'Privasi',
    'dashboard' => 'Dasbor',
    'data_user' => 'Data Pengguna',
    'explore' => 'Jelajah',
    'api_keys' => 'API Keys',
    'data_author' => 'Data Penulis',
    'data_language' => 'Data Bahasa',
    'data_translator' => 'Data Penerjemah',
    'data_type' => 'Data Tipe',
    'book_type' => 'Tipe Buku',
    'data_publisher' => 'Data Penerbit',
    'data_review' => 'Data Ulasan',
    'data_report_sales' => 'Data Laporan Penjualan',
    'withdrawal' => 'Penarikan',
    'showroom' => 'Showroom',
    'library' => 'Perpustakaan',
    'pending_library' => 'Menunggu Perpustakaan',
    'release_book' => 'Rilis Buku',
    'submit_book' => 'Kirim Buku',
    'user_settings' => 'Pengaturan Pengguna',
    'faq' => 'F.A.Q',
    'faq_detail' => 'Pertanyaan yang sering di jawab',
    'faq_description' => 'Kami telah menjawab beberapa pertanyaan yang sering diajukan.',
    'view_profile' => 'Lihat Profil',
    'about_us' => 'Tentang Kami',
    'privacy_policy' => 'Kebijakan Privasi',
    'login' => 'Masuk',
    'logout' => 'Keluar',
    'contact' => 'Kontak',
    'settings' => 'Pengaturan',
    'my_profile' => 'Profilku',
    'book_library' => 'Buku Perpustakaan',
    'book_showroom' => 'Showroom Buku',
    'contact_us' => 'Hubungi Kami',
    'data_withdrawal' => 'Data Penarikan',
    'explore_file' => 'Jelajah Berkas',
    'forgot_password' => 'Lupa Kata Sandi',
    'book_detail' => 'Detil Buku',
    'manage_withdrawal' => 'Kelola Penarikan',
    'user_profile' => 'Profile Pengguna',
    'edit_user_profile' => 'Edit Profile Pengguna',
    'verify_new_password' => 'Verifikasi Password Baru',
    'about_bookstore' => 'Sangat sederhana dan aman untuk membuat Book Store (eBook) seperti marketplace.',
    'feature' => 'Fitur',
    'whats_feature' => 'Apa sajakah fiturnya?',
    'feature_bookstore' => '<ol>
        <li>Tidak terbatas bagi setiap platform karena Bookstore di desain menggunakan sistem Rest API</li>
        <li>Setiap pengguna perpustakaan ebook masing-masing.</li>
        <li>Setiap pengguna dapat mengirim buku untuk mendapatkan pendapatan tambahan</li>
        <li>Berkas PDF dilindungi dengan enkripsi</li>
        <li>Sedeharna dan mudah untuk di modifikasi</li>
        <li>Mendukung banyak bahasa</li>
        </ol>',
    'requirement' => 'Spesifikasi',
    'whats_requirement' => 'Apa saja spesifikasinya?',
    'list_requirement' => '<ul>
        <li>Berjalan menggunakan PHP 5.5 atau versi yang lebih tinggi</li>
        <li>Apache Webserver dengan URL rewriting</li>
        <li>Membutuhkan mcrypt extension</li>
        <li>MySQL 5.6</li>
        </ul>',
    'license' => 'Lisensi',
    'whats_license' => 'menggunakan lisensi MIT',
    'contribute' => 'Kontribusi',
    'whats_contribute' => 'tersedia di Github',
    'pull_request' => 'Tarik Permintaan',
    'list_request' => '<ul>
        <li>Fork reSlim-bookstore repositori</li>
        <li>Buat branch baru pada setiap fitur atau peningkatan</li>
        <li>Kirim sebuah permintaan dari setiap fitur cabang ke dalam cabang pengembangan</li>
        </ul>',
    'search' => 'Cari',
    'search_here' => 'Cari disini...',
    'from_library' => 'dari Perpustakaan',
    'uniqueid' => 'Unik ID',
    'free' => 'Gratis',
    'price' => 'Harga',
    'language' => 'Bahasa',
    'status_payment' => 'Status Pembayaran',
    'on_library' => 'Dalam Perpustakaan',
    'buy_this_book' => 'Beli buku ini',
    'read_complete' => 'Baca Lengkap',
    'read_sample' => 'Baca Sampel',
    'download' => 'Unduh',
    'edit' => 'Ubah',
    'delete' => 'Hapus',
    'update' => 'Perbaharui',
    'manage' => 'Kelola',
    'title' => 'Judul',
    'description' => 'Deskripsi',
    'author' => 'Penulis',
    'translator' => 'Penerjemah',
    'type' => 'Tipe',
    'publisher' => 'Penerbit',
    'pages' => 'Halaman',
    'bookid' => 'Buku ID',
    'original_released' => 'Original Rilis',
    'information_detail' => 'Informasi Detil',
    'payment_information' => 'Informasi Pembayaran',
    'payment_info_1' => 'Untuk informasi pembayaran, Anda dapat kontak admin via Whatsapp:',
    'payment_info_2' => 'Dan jangan lupa sertakan Kode Uniq ID.',
    'thanks' => 'Terima Kasih',
    'thanks_detail' => 'Buku Anda akan tersimpan secara permanen di dalam perpustakaan Anda selamanya.',
    'submit_review' => 'Submit Ulasan',
    'message' => 'Pesan',
    'to_library' => 'ke Perpustakaan',
    'add_to_library' => 'Tambahkan ke Perpustakaan',
    'show_detail' => 'Tampilkan Detil',
    'new_book_type' => 'Jenis Buku Baru',
    'add_new_type' => 'Tambah Tipe Baru',
    'input_new_type' => 'Input nama tipe baru disini...',
    'input_new_typeid' => 'Input tipe id disini...',
    'cancel' => 'Batal',
    'submit' => 'Submit',
    'type_name' => 'Nama Tipe',
    'shows_no' => 'Menampilkan no',
    'from_total_data' => 'dari total data',
    'typeid' => 'Tipe ID',
    'update_type' => 'Perbaharui Tipe',
    'send_message_failed' => 'Proses Kirim Pesan Gagal',
    'form_contact_us' => 'Formulir Kontak Kami',
    'send_message' => 'Kirim Pesan',
    'first_date' => 'Tanggal Awal',
    'last_date' => 'Tanggal Akhir',
    'date_range' => 'Periode',
    'total_income' => 'Total Pendapatan',
    'total_sales' => 'Total Penjualan',
    'total_royalti_user' => 'Total Royalti Pengguna',
    'total_royalti_company' => 'Total Royalti Perusahaan',
    'royalti_username' => 'Royalti Pengguna',
    'input_domain' => 'Harap di isi dengan nama domain disini...',
    'domain' => 'Domain',
    'new_api' => 'API Keys baru',
    'add_new_api' => 'Tambah baru API Keys',
    'update_api_key' => 'Perbaharui API Keys',
    'data_api_key' => 'Data API Keys',
    'created' => 'Tanggal Dibuat',
    'updated_at' => 'Tanggal Diperbaharui',
    'updated_by' => 'Diperbaharui oleh',
    'status' => 'Status',
    'input_created' => 'Input tanggal dibuat disini...',
    'input_domain' => 'Input nama domain disini...',
    'input_api_key' => 'Input API Key disini...',
    'new_author' => 'Penulis Baru',
    'add_new_author' => 'Tambah Penulis baru',
    'author_name' => 'Nama Penulis',
    'input_author' => 'Input nama penulis disini...',
    'input_authorid' => 'Input id penulis disini...',
    'from_author' => 'dari Penulis',
    'authorid' => 'Penulis ID',
    'update_author' => 'Perbaharui Penulis',
    'new_language' => 'Bahasa Baru',
    'add_new_language' => 'Tambah Bahasa baru',
    'language_name' => 'Nama Bahasa',
    'input_language' => 'Input nama bahasa baru disini...',
    'input_languageid' => 'Input id bahasa disini...',
    'from_language' => 'dari Bahasa',
    'languageid' => 'Bahasa ID',
    'update_language' => 'Perbaharui Bahasa',
    'new_publisher' => 'Penerbit Baru',
    'add_new_publisher' => 'Tambah Penerbit baru',
    'publisher_name' => 'Nama Penerbit',
    'input_publisher' => 'Input nama penerbit baru disini...',
    'input_publisherid' => 'Input id penerbit disini...',
    'from_publisher' => 'dari Penerbit',
    'publisherid' => 'Penerbit ID',
    'update_publisher' => 'Perbaharui Penerbit',
    'from_review' => 'dari Data Ulasan',
    'update_review' => 'Perbaharui Data Ulasan',
    'input_review' => 'Input detil ulasan disini...',
    'reviewid' => 'Ulasan ID',
    'new_translator' => 'Penerjemah Baru',
    'add_new_translator' => 'Tambah Penerjemah baru',
    'translator_name' => 'Nama Penerjemah',
    'input_translator' => 'Input nama penerjemah baru disini...',
    'input_translatorid' => 'Input id penerjemah disini...',
    'from_translator' => 'from Penerjemah',
    'translatorid' => 'Penerjemah ID',
    'update_translator' => 'Perbaharui Penerjemah',
    'website' => 'Website',
    'input_website' => 'Input website penerjemah disini...',
    'role' => 'Sebagai',
    'data_report_withdrawal' => 'Data Laporan Penarikan',
    'date_transaction' => 'Tanggal Transaksi',
    'withdrawid' => 'Penarikan ID',
    'bank_name' => 'Nama Bank',
    'bank_address' => 'Alamat Bank',
    'bank_account' => 'Rekening Bank',
    'bank_no_account' => 'Nomor Rekening',
    'input_bank_name' => 'Harap di isi dengan nama bank Anda...',
    'input_bank_address' => 'Harap di isi dengan alamat bank Anda...',
    'input_bank_no_account' => 'Harap di isi dengan nomor rekening bank Anda...',
    'info_bank_account' => 'Anda seharusnya mengisi data ini agar kami dapat memproses penarikan Anda.',
    'no_reference' => 'No Referensi',
    'amount' => 'Nominal',
    'via_bank' => 'Via Bank',
    'from' => 'dari',
    'proof_of_transaction' => 'Bukti Transaksi',
    'upload_file' => 'Unggah File disini...',
    'upload_file_server' => 'Unggah File ke server',
    'input_file_title' => 'Harap di isi judul dari file Anda...',
    'input_file_alternate' => 'Harap di isi alternatif judul dari file Anda...',
    'input_file_external' => 'Harap di isi link luar dari file Anda...',
    'input_file_choose' => 'Pilih File',
    'input_date_upload' => 'Harap di isi tanggal unggah dari file Anda...',
    'input_itemid' => 'Harap di isi item id dari file Anda..."',
    'input_upload_by' => 'Harap di isi nama pengunggah dari file Anda...',
    'input_file_type' => 'Harap di isi jenis file Anda...',
    'input_file_direct' => 'Harap di isi link langsung dari file Anda...',
    'alternate' => 'Alternate',
    'external_link' => 'External Link',
    'upload_now' => 'Unggah Sekarang',
    'show_details' => 'show details',
    'detail_file' => 'Detail File',
    'itemid' => 'Item ID',
    'date_uploaded' => 'Date Uploaded',
    'upload_by' => 'Upload by',
    'file_type' => 'File Type',
    'direct_link' => 'Direct Link',
    'external_link' => 'External Link',
    'question' => 'Pertanyaan',
    'answer' => 'Jawaban',
    'example_question_1' => 'Bagaimana untuk melakukan pembayaran?',
    'example_question_2' => 'Berapa lama proses pembayarannya?',
    'example_question_3' => 'Bagaimana cara membaca buku?',
    'example_answer_1a' => 'Untuk saat ini kami hanya menerima pembayaran menggunakan transfer bank.<br>Kamu harus SMS atau kirim pesan melalui Whatsapp di nomor :',
    'example_answer_1b' => 'Kami akan membalas pesan Anda dengan memberikan informasi rekening bank kami.',
    'example_answer_2' => 'Dalam proses pembayaran mungkin akan diproses dalam waktu paling lambat 2x24 jam. Akan lebih cepat jika Anda langsung konfirmasi kepada kami.',
    'example_answer_3' => 'Masuk ke dalam menu Showroom lalu pilih salah satu buku dan klik Tambah ke Perpustakaan. Setelah itu, Anda masuk ke menu Perpustakaan lalu klik Baca Lengkap untuk membaca buku Anda.',
    'request_reset_password' => 'Formulir Permintaan Reset Kata Sandi',
    'reset_password' => 'Reset Kata Sandi',
    'note_review_1' => 'Pengguna hanya dapat submit sekali saja dalam setiap buku',
    'note_review_2' => 'Kode Html tidak dapat digunakan',
    'form_login' => 'Formulir Masuk',
    'remember_me' => 'Ingat Saya',
    'date' => 'Tanggal',
    'input_bookid' => 'Harap di isi book id disini...',
    'input_username_library' => 'Harap di isi dengan nama pengguna pemilik buku perpustakaan disini...',
    'input_uniqueid' => 'Harap di isi dengan uniq id disini...',
    'information' => 'Informasi',
    'information_login' => 'Anda harus masuk atau buat akun baru.<br><br> Pendaftaran gratis dan akan selalu gratis.',
    'go_login_page' => 'Menuju Halaman Masuk',
    'registered' => 'Terdaftar',
    'last_updated' => 'Terakhir Diperbaharui',
    'edit_profile' => 'Ubah Profil',
    'update_profile' => 'Perbaharui Profil',
    'change_password' => 'Ubah Kata Sandi',
    'change_password_failed' => 'Proses Perubahan Kata Sandi Gagal!',
    'new_password' => 'Kata Sandi Baru',
    'confirm_new_password' => 'Konfirmasi Kata Sandi Baru',
    'input_new_password' => 'Harap di isi dengan kata sandi baru Anda',
    'reinput_new_password' => 'Harap di isi ulang dengan kata sandi baru Anda',
    'old_password' => 'Password Lama',
    'input_old_password' => 'Harap di isi dengan kata sandi lama Anda',
    'save_settings' => 'Simpan Pengaturan',
    'input_settings_title' => 'Harap di isi dengan judul website ini disini...',
    'input_settings_hotline' => 'Harap di isi dengan nomor telepon untuk website ini disini...',
    'input_settings_sharethis' => 'Harap di isi dengan kode dari Sharethis disini...',
    'input_settings_basepath' => 'Harap di isi dengan url folder website Anda disini...',
    'input_settings_api' => 'Harap di isi dengan url folder Rest API Anda disini...',
    'input_settings_apikey' => 'Harap di isi dengan API Key Anda disini...',
    'info_get_apikey_1' => 'Jika belum memiliki API Keys? Anda dapat membuat nya paling tidak satu API Key ',
    'info_get_apikey_2' => 'disini...',
    'hotline' => 'Hotline',
    'basepath' => 'Base Path',
    'sharethis' => 'Sharethis',
    'urlapi' => 'Url API',
    'apikey' => 'API Key',
    'add_new_withdrawal' => 'Tambah Penarikan baru',
    'update_withdrawal' => 'Perbaharui Penarikan',
    'from_bank' => 'Dari Bank',
    'from_name' => 'Dari',
    'detail' => 'Detil',
    'input_withdraw_username' => 'Input nama pengguna disini...',
    'input_withdraw_detail' => 'Input detil penarikan disini...',
    'input_withdraw_fullname' => 'Input nama lengkap pengguna disini...',
    'input_withdraw_account' => 'Input nomor rekening bank pengguna disini...',
    'input_withdraw_bankname' => 'Input nama bank dari pengguna disini...',
    'input_withdraw_bankaddress' => 'Input alamat bank pengguna disini...',
    'input_withdraw_reference' => 'Input nomor referensi dari transaksi penarikan disini...',
    'input_withdraw_amount' => 'Input jumlah nominal untuk penarikan disini...',
    'input_withdraw_frombank' => 'Input nama bank Anda disini',
    'input_withdraw_fromname' => 'Input nama akun bank Anda disini...',
    'input_withdraw_pot' => 'Input bukti transaksi Anda disini...',
    'input_withdraw_id' => 'Input penarikan id disini...',
    'admin' => 'Admin',
    'new_release' => 'Rilis Buku Baru',
    'add_new_release' => 'Tambah Rilis Buku baru',
    'image' => 'Gambar',
    'input_image' => 'Input link gambar disini...',
    'input_description' => 'Input deskripsi buku disini...',
    'input_isbn' => 'Input nomor isbn buku disini...',
    'input_original' => 'Input tangal original rilis disini...',
    'tags' => 'Label',
    'input_tags' => 'Input label disini...',
    'input_price' => 'Input harga disini...',
    'input_pages' => 'Input berapa banyak halaman disini...',
    'sample_link' => 'Link Sample',
    'full_link' => 'Link Lengkap',
    'input_sample' => 'Harap di isi link versi samplenya disini...',
    'input_full' => 'Harap di isi link versi lengkapnya disini...',
    'from_release' => 'dari Rilis Buku',
    'update_release' => 'Perbaharui Rilis Buku',
    'data_release_book' => 'Data Rilis Buku',
    'new_submit' => 'Kirim Buku Baru',
    'add_new_submit' => 'Tambah Kirim Buku baru',
    'update_submit' => 'Perbaharui Kirim Buku',
    'submitid' => 'Kirim ID',
    'input_submitid' => 'Input id kirim buku disini...',
    'from_submit' => 'dari Kirim Buku',
    'purpose' => 'Tujuan',
    'data_submit_book' => 'Data Kirim Buku',
    'input_title' => 'Input judul disini...',
    'register_success' => 'Proses Registrasi Berhasil',
    'register_failed' => 'Proses Registrasi Failed',
    'update_success' => 'Proses Memperbaharui Berhasil',
    'update_failed' => 'Proses Memperbaharui Gagal',
    'login_failed' => 'Proses Masuk Gagal',
    'change_password_success' => 'Ubah Kata Sandi Berhasil',
    'upload_success' => 'Proses Unggah Berhasil',
    'upload_failed' => 'Proses Unggah Gagal',
    'delete_success' => 'Proses Menghapus Berhasil',
    'delete_failed' => 'Proses Menghapus Gagal',
    'process_add' => 'Proses Menambahkan ',
    'process_update' => 'Proses Memperbaharui ',
    'process_delete' => 'Proses Menghapus ',
    'process_saving' => 'Proses Menyimpan ',
    'success' => ' Berhasil!',
    'failed' => ' Gagal!',
    'settings_changed' => 'Pengaturan telah berubah!',
    'auto_refresh' => ' Halaman ini akan disegarkan secara otomatis dalam dua detik...',
    'not_connect_server' => 'Tidak dapat terkoneksi dengan server!',
    'message_sent' => 'Pesan berhasil terkirim!',
    'message_not_sent' => 'Pesan gagal terkirim!',
    'try_again' => 'Coba ulang kembali nanti!',
    'forgot_password_failed' => 'Proses Lupa Kata Sandi gagal!',
    'forgot_password_success' => 'Permintaan reset kata sandi telah terkirim ke email Anda!',
    'forgot_password_check' => 'Jika tidak, Cobalah untuk mengirimkan ulang lagi nanti.',
    'email_reset_title' => 'Permintaan Reset Kata Sandi',
    'email_reset_1' => '<html><body><p>Anda telah membuat permintaan untuk reset kata sandi.<br /><br />
                        Berikut ini adalah link untuk reset password Anda: <a href="',
    'email_reset_2' => '" target="_blank"><b>',
    'email_reset_3' => '</b></a>.<br /><br />
                        
                        Abaikan email ini jika Anda tidak ingin untuk reset kata sandi. Link akan otomatis kadaluarsa dalam waktu 3hari dari sekarang.<br /><br /><br />
                        Terima Kasih<br />',
    'last_update_privacy' => 'Terakhir diperbaharui pada 23 Mei 2017.',
    'privacy_notice' => 'Pemberitahuan Privasi',
    'privacy_information' => 'Pengumpulan Informasi, Penggunaan, dan Berbagi',
    'privacy_access' => 'Akses dan Kontrol atas Informasi',
    'privacy_security' => 'Keamanan',
    'privacy_redress' => 'Perbaikan',
    'privacy_detail_about' => '<p>
        '.$config['title'].' adalah pasar yang tersedia bagi setiap pengguna untuk menerbitkan eBook mereka sendiri.<br><br>

        Kebijakan privasi yang dimaksud adalah referensi yang mengatur dan melindungi penggunaan data dan informasi penting pengguna layanan '.$config['title'].' yang disediakan oleh '.$config['title'].'.
        Ini adalah tentang aktivitas data dan informasi yang telah dikumpulkan pada saat mendaftar, dan mengakses seperti alamat e-mail, nomor telepon, foto, gambar, dan lain-lain.<br><br>

        Dokumen kebijakan privasi ini dibuat sebagai informasi yang ditujukan untuk semua pengguna / pengunjung situs.
        Halaman ini dapat berubah sewaktu-waktu tanpa pemberitahuan sebelumnya. Jadi tolong baca dengan saksama.</p>',
    'privacy_detail_notice' => '<p>Pemberitahuan privasi ini mengungkapkan praktik privasi untuk '.$config['title'].'. Pemberitahuan privasi ini hanya berlaku untuk informasi yang dikumpulkan oleh situs web ini. Ini akan memberitahu Anda tentang hal berikut:
        <ol>
        <li>Informasi pengenal pribadi dikumpulkan dari Anda melalui situs web, bagaimana penggunaannya dan dengan siapa iklan tersebut dapat dibagikan?</li>
        <li>Pilihan apa yang tersedia bagi Anda terkait penggunaan data Anda?</li>
        <li>Prosedur keamanan di tempat untuk melindungi penyalahgunaan informasi Anda.</li>
        <li>Bagaimana Anda bisa memperbaiki ketidakakuratan informasi?</li>
        </ol>
        </p><br>
        <h4>Pendaftaran</h4>
        <p>Agar dapat menggunakan situs ini, pengguna harus terlebih dahulu melengkapi formulir pendaftaran. Selama registrasi pengguna diharuskan memberikan informasi tertentu (seperti nama dan alamat email). Informasi ini digunakan untuk menghubungi Anda tentang produk / layanan di situs kami di mana Anda telah menyatakan minatnya.
        </p>
        <h4>Cookies</h4>
        <p>Kami menggunakan "cookies" di situs ini. Cookies adalah selembar data yang tersimpan di hard drive pengunjung situs untuk membantu kami memperbaiki akses Anda ke situs kami dan mengidentifikasi pengunjung berulang ke situs kami. Misalnya, ketika kita menggunakan cookie untuk mengidentifikasi Anda, Anda tidak perlu memasukkan kata sandi lebih dari satu kali, sehingga menghemat waktu saat berada di situs kami. Cookie juga memungkinkan kami untuk melacak dan menargetkan minat pengguna kami untuk meningkatkan pengalaman di situs kami. Penggunaan cookie sama sekali tidak terkait dengan informasi identitas pribadi di situs kami.</p>
        <p>Beberapa mitra bisnis kami mungkin menggunakan cookies di situs kami (misalnya, pengiklan). Namun, kami tidak memiliki akses atau kontrol atas cookie ini.</p>
                                     
        <h4>Berbagi</h4>
        <p>Kami membagikan informasi demografis gabungan dengan mitra dan pengiklan kami. Ini tidak terkait dengan informasi pribadi apapun yang dapat mengidentifikasi individu manapun.<br><br>

        Dan / atau:<br>
        Kami menggunakan perusahaan jasa ekspedisi untuk mengirim pesanan, dan perusahaan pemrosesan kartu kredit menagih pengguna untuk barang dan jasa. Perusahaan-perusahaan ini tidak menyimpan, berbagi, menyimpan atau menggunakan informasi identitas pribadi untuk tujuan sekunder selain memenuhi pesanan Anda.<br><br>

        Dan / atau:<br>
        Kami bermitra dengan pihak lain untuk memberikan layanan khusus. Saat pengguna mendaftar untuk layanan ini, kami akan membagikan nama, atau informasi kontak lainnya yang diperlukan pihak ketiga untuk menyediakan layanan ini. Pihak-pihak ini tidak diizinkan untuk menggunakan informasi identitas pribadi kecuali untuk tujuan menyediakan layanan ini.</p>

        <h4>Tautan</h4>
        <p>Situs ini berisi tautan ke situs lain. Perlu diketahui bahwa kami tidak bertanggung jawab atas konten atau praktik privasi dari situs lain tersebut. Kami mendorong pengguna kami untuk waspada saat mereka meninggalkan situs kami dan membaca pernyataan privasi dari situs lain yang mengumpulkan informasi identitas pribadi.</p>',
    'privacy_detail_information' => '<p>Kami adalah pemilik tunggal dari informasi yang dikumpulkan di situs ini. Kami hanya memiliki akses ke / mengumpulkan informasi yang Anda berikan secara sukarela melalui email atau kontak langsung lainnya dari Anda. Kami tidak akan menjual atau menyewakan informasi ini kepada siapapun.<br><br>

        Kami akan menggunakan informasi Anda untuk menanggapi Anda, berkenaan dengan alasan Anda menghubungi kami. Kami tidak akan membagikan informasi Anda kepada pihak ketiga di luar organisasi kami, selain yang diperlukan untuk memenuhi permintaan Anda, misalkan, Untuk mengirim pesanan
.<br><br>

        Kecuali Anda meminta kami untuk tidak melakukannya, kami dapat menghubungi Anda melalui email di masa mendatang untuk memberi tahu Anda tentang spesial produk atau layanan baru, atau perubahan pada kebijakan privasi ini.<br><br>
        Kami tidak mengambil informasi pengguna atau pengunjung situs jika pengguna atau pengunjung tidak terdaftar sebagai anggota.</p>',
    'privacy_detail_access' => '<p>Anda dapat menyisih dari kontak masa depan dari kami setiap saat. Anda dapat melakukan hal berikut setiap saat dengan menghubungi kami melalui alamat email atau nomor telepon yang ada di situs kami:

        <ol>
        <li>Lihat data apa yang kita miliki tentang Anda, jika ada.</li>
        <li>Ubah / perbaiki data yang kami miliki tentang Anda.</li>
        <li>Sudahkah kita menghapus data yang kita miliki tentang Anda?</li>
        <li>Ungkapkan kekhawatiran Anda tentang penggunaan data Anda.</li>
        </ol>
        </p>',
    'privacy_detail_security' => '<p>Kami berhati-hati untuk melindungi informasi Anda. Bila Anda mengirimkan informasi sensitif melalui situs web, informasi Anda dilindungi baik online maupun offline.<br><br>

        Di mana pun kami mengumpulkan informasi sensitif (seperti data kartu kredit), informasi itu dienkripsi dan dikirimkan kepada kami dengan cara yang aman. Anda dapat memverifikasi ini dengan mencari ikon kunci di bilah alamat dan mencari "https" di awal alamat halaman Web.<br><br>

        Sementara kami menggunakan enkripsi untuk melindungi informasi sensitif yang dikirimkan secara online, kami juga melindungi informasi Anda secara offline. Hanya karyawan yang membutuhkan informasi untuk melakukan pekerjaan tertentu (misalnya, penagihan atau layanan pelanggan) diberi akses ke informasi identitas pribadi. Komputer / server tempat kami menyimpan informasi identitas pribadi disimpan di lingkungan yang aman.</p>',
    'privacy_detail_redress' => '<p>Jika Anda merasa bahwa kami tidak mematuhi kebijakan privasi ini, Anda harus menghubungi kami segera melalui telepon di '.$config['hotline'].' atau melalui email ke '.$config['email'].'.</p>'
];