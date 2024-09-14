<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Transaction;
use App\Models\VehicleType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Fungsi ini untuk memanggil view index yang digunakan untuk menampilkan halaman utama transactions
    public function index () {
        // Membuat variabel $transactions untuk menampilkan data dari tabel transactions
        // menggunakan method with untuk mengambil data relasi dari tabel lain agar tidak terjadinya N+1 Query
        // method orderBy('created_at', 'desc') digunakan untuk mengurutkan data berdasarkan baru ditambah
        // method paginate(5) digunakan untuk menampilkan data hanya 5 per halaman
        $transactions = Transaction::with(['customer', 'vehicle_type'])->orderBy('created_at', 'desc')->paginate(5);

        // Kode program dibawah untuk memanggil view index yang dimana dalam folder transactions terdapat file index
        // dan compact untuk mengembalikan data atau variabel yang dapat digunakan dalam view
        return view('transactions.index', compact('transactions'));
    }

    // Fungsi ini untuk memanggil view create yang digunakan untuk menambahkan transaction
    public function create() {
        // Membuat variabel $transactionCode untuk mengambil fungsi generateUniqueTransactionCode yang akan ditampilkan pada view
        $transactionCode = $this->generateUniqueTransactionCode();

        // Membuat variabel $customers untuk mengambil semua data customer yang akan ditampilkan pada view
        $customers = Customer::all();

        // Membuat variabel $vTypes untuk mengambil semua data vehicle type yang akan ditampilkan pada view
        $vTypes = VehicleType::all();

        // Kode program dibawah untuk memanggil view create yang dimana dalam folder transactions terdapat file create
        // dan compact untuk mengembalikan data atau variabel yang dapat digunakan dalam view
        return view('transactions.create', compact('transactionCode', 'customers', 'vTypes'));
    }

    // Membuat fungsi untuk menghasilkan kode transaksi unik yang otomatis disetiap bulannya
    private function generateUniqueTransactionCode()
    {
        // Membuat variabel $prefix yang digunakan untuk kode transaksi yang tetap yaitu TR
        $prefix = 'TR';
        
        // Membuat variabel $yearMonth dengan format 'ym' yang dimana akan mengambil tanggal dan bulan saat ini
        // contoh saya membuat kode program ini pada tanggal 13 September 2024 maka hasilnya 2409
        $yearMonth = date('ym');
        
        // Membuat variabel $formattedPrefix yang digunakan untuk menggabungkan kode transaksi yang unik
        // Maka hasilnya seperti TR-2409
        $formattedPrefix = $prefix . '-' . $yearMonth . '-';

        // Membuat variabel $lastTransaction yang digunakan untuk mencari transaction terakhir
        // dengan kode prefix yang sama pada kode yang telah diformat pada variabel $formattedPrefix
        $lastTransaction = Transaction::where('transaction_code', 'like', $formattedPrefix . '%')
            ->orderBy('transaction_code', 'desc')
            ->first();

        // Membuat if logic dengan membuat variabel $lastTransaction yang digunakan untuk mengambil dari transaction terakhir
        if ($lastTransaction) {
            // Membuat variabel $lastNumber yang digunakan untuk mengambil angka terakhir dari kode transaksi sebelumnya
            // contoh: kode transaksi sebelumnya sudah dibuat yang berarti 0001 
            // maka kode transaksi yang diambil adalah 0001
            $lastNumber = (int)substr($lastTransaction->transaction_code, -4);
            
            // Membuat variabel $newNumber yang digunakan untuk menambahkan nilai kode transaksi yang sudah diambil sebelumnya
            // Jika sudah mendapat nilai atau kode transaksi dari $lastNumber yang sebelumnya adalah 0001
            // maka akan ditambahkan +1 yang berarti kode transaksi tersebut akan menjadi 0002
            $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
        } else {
            // Jika tidak ada transaction pada bulan ini maka akan direset kembali menjadi 0001
            $newNumber = '0001';
        }

        // Setelah melewati beberapa logika diatas kita mengembalikan nilai dengan menggabungkan dari variabel $formattedPrefix
        // dan $newNumber yang berarti jika pada bulan september belum terjadi transaksi maka hasilnya 'TR-2409-0001'
        // dan jika sebelumnya ada transaksi dan yang terakhir adalah 'TR-2409-0001' maka menjadi 'TR-2409-0002'
        return $formattedPrefix . $newNumber;
    }

    public function store(Request $request) {
        // Membuat validasi pada form create customer
        $validator = Validator::make($request->all(),
        // Aturan
        [
            // Aturan transaction_code adalah wajib diisi tetapi sudah digenerate otomatis pada view
            'transaction_code' => 'required', 

            // Aturan customer_id adalah wajib diisi
            'customer_id' => 'required',

            // Aturan vehicle_type_id adalah wajib diisi
            'vehicle_type_id' => 'required'
        ]);

        // Jika pengguna tidak mengikuti aturan dalam memnambahkan customer
        if($validator->fails()){
            // redirect dengan pesan error
            toast('Something went wrong!','error')->hideCloseButton()->autoClose(3000);
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Membuat variabel $customer dan $vehicleType untuk mengambil data
        $customer = Customer::findOrFail($request->customer_id);
        $vehicleType = VehicleType::findOrFail($request->vehicle_type_id);

        // Membuat variabel $transactionCount yang diambil dari tabel $customer->id
        // lalu menghitung jumlah transakasi yang sudah dilakukan oleh customer itu sendiri
        $transactionCount = Transaction::where('customer_id', $customer->id)->count();

        // logic ini digunakan untuk mengecek apakah jumlah transaksi itu sudah lebih atau sama dengan 5
        // jika sudah sesuai jumlah transaksi dari customer lebih atau sama dengan 5
        // maka variabel $price akan di set default 0 yang artinya gratis
        if ($transactionCount >= 5) {
            $price = 0; // diskon gratis cuci
        } else {
            // jika tidak maka harganya normal yang diambil dari tabel vehicle_types
            $price = $vehicleType->price; // Harga dari tabel vehicle_types
        }

        // Menyimpan data transaction yang diambil dari form transaction_code, customer_id dan vehicle_type_id
        // data price akan diambil dari logic diatas atau baris 123 atau 126
        Transaction::create([
            'transaction_code' => $request->transaction_code,
            'customer_id' => $request->customer_id,
            'vehicle_type_id' => $request->vehicle_type_id,
            'price' => $price
        ]);

        // Jika berhasil menyimpan data maka redirect ke transaction index
        toast('Transaction have been saved.','success')->hideCloseButton()->autoClose(3000);
        return redirect()->route('transactions.index');
    }
}
