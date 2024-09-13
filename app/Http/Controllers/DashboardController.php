<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Customer;
use App\Models\Transaction;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $totalCustomers = $this->totalCustomers();
        $monthlyEarnings = $this->monthlyEarnings();
        $totalEarnings = $this->totalEarnings();
        $recentTransactions = $this->recentTransactions();
        $mostTransactions = $this->mostTransactions();
        return view('dashboard', compact('totalCustomers', 'monthlyEarnings', 'totalEarnings', 'recentTransactions', 'mostTransactions'));
    }

    // Fungsi ini untuk menghitung total customer yang terdaftar pada sistem
    private function totalCustomers() {
        return Customer::count(); // menghitung jumlah customer
    }

    // Fungsi ini untuk menghitung total pendapatan disetiap bulannya
    private function monthlyEarnings()
    {
        // variabel $currentYeay dan $currentMonth digunakan untuk mendapatkan tahun dan bulan saat ini
        $currentYear = date('Y');
        $currentMonth = date('m');

         // variabel $totalEarnings digunakan untuk mengambil total pendapatan pada tahun dan bulan saat ini yang dijumlahkan dari kolom price
        $totalEarnings = Transaction::whereYear('created_at', $currentYear)
            ->whereMonth('created_at', $currentMonth)
            ->sum('price');

        // variabel $formattedMonth digunakan untuk format bulan dan tahun
        $formattedMonth = date('F Y'); // Output yang keluar adalah September 2024

        return [
            'month' => $formattedMonth,  // mengembalikan nilai variabel yang dapat di panggil pada view 
            'total_earning' => $totalEarnings  // mengembalikan nilai variabel yang dapat di panggil pada view 
        ];
    }

    private function totalEarnings()
    {
        // variabel $curretYear digunakan untuk mengambil tahun saat ini
        $currentYear = date('Y');

        // variabel $totalEarnings digunakan untuk mengambil total pendapatan pada tahun saat ini yang dijumlahkan dari kolom price
        $totalEarnings = Transaction::whereYear('created_at', $currentYear)->sum('price');

        return [
            'total_earning' => $totalEarnings, // mengembalikan nilai variabel yang dapat di panggil pada view 
            'year' => $currentYear  // mengembalikan nilai variabel yang dapat di panggil pada view 
        ];
    }

    // Fungsi ini digunakan untuk menampilkan data transaksi yang terakhir ditambahkan
    private function recentTransactions() {
        // menggunakan method with untuk mengambil data relasi dari tabel lain agar tidak terjadinya N+1 Query
        // method orderBy() digunakan untuk mengurutkan data berdasarkan baru ditambah dari kolom created_at
        // method paginate() digunakan untuk menampilkan data per halaman
        return Transaction::with(['customer', 'vehicle_type'])->orderBy('created_at', 'desc')->paginate(5);
    }

    // Fungsi ini digunakan untuk menampilkan jumlah transaksi terbanyak dan total price transaksi dari customer
    private function mostTransactions() {
        return Customer::select('customers.name', // Mengambil nama dari tabel customers
            DB::raw('count(transactions.transaction_code) as transaction_count'), // Melakukan query untuk menghitung jumlah transaction dari kolom transaction_code dan di aliaskan sebagai transaction_count
            DB::raw('sum(transactions.price) as total_price')) // Melakukan query penjumlahan untuk menghitung total price dari setiap customer yang sudah melaukan transaction
            ->join('transactions', 'customers.id', '=', 'transactions.customer_id') // Melakukan query menggabungkan atau mencocokan tabel transaction yang memiliki kolom customer_id dengan tabel customer yang memiliki kolom id
            ->groupBy('customers.id', 'customers.name') // Method groupBy() digunakan untuk mengelompokkan berdasarkan id dan name dari tabel customer
            ->orderBy('transaction_count', 'desc') // method OrderBy() digunakan untuk mengurutkan jumlah transaksi terbanyak
            ->paginate(5); // method paginate() digunakan untuk menampilkan data per halaman contoh disini saya menggunakan paginate(5) maka didalam 1 halaman terdapat 5 data yang tertampil
    }
}
