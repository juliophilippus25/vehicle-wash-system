<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Fungsi ini untuk memanggil view index atau halaman utama untuk melihat data customer
    public function index() {
        // Membuat variabel $customer untuk menampilkan data dari tabel customer dengan method get()
        // method orderBy() digunakan untuk mengurutkan data berdasarkan baru ditambah
        $customers = Customer::orderBy('created_at', 'desc')->get();

        // Kode program dibawah untuk memanggil view index yang dimana dalam folder customer terdapat file index
        // dan compact untuk mengembalikan data atau variabel yang dapat digunakan dalam view
        return view('customers.index', compact('customers'));
    }

    // Fungsi ini untuk memanggil view create yang digunakan untuk menambahkan customer
    public function create() {
        // Kode program dibawah untuk memanggil view create yang dimana dalam folder customer terdapat file create.blade.php
        return view('customers.create');
    }

    // Fungsi ini untuk menyimpan data customer
    public function store(Request $request) {
        // Membuat validasi pada form create customer
        $validator = Validator::make($request->all(),
        // Aturan
        [
            // Aturan name adalah wajib diisi dan minimal terdapat 3 huruf
            'name' => 'required|min:3', 

            // Aturan phone adalah wajib diisi, hanya angka yang dapat masuk ke database, dan hanya memiliki data yang unik pada kolom phone
            'phone' => 'required|min:10|numeric|unique:customers,phone',
        ]);

        // Jika pengguna tidak mengikuti aturan dalam memnambahkan customer
        if($validator->fails()){
            // redirect dengan pesan error
            toast('Something went wrong!','error')->hideCloseButton()->autoClose(3000);
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Menyimpan data customer yang diambil dari form name dan phone
        Customer::create([
            'name' => $request->name,
            'phone' => $request->phone
        ]);

        // Jika berhasil menyimpan data maka redirect ke customer index
        toast('Customer have been saved.','success')->hideCloseButton()->autoClose(3000);
        return redirect()->route('customers.index');
    }

    // Fungsi ini untuk memanggil view edit yang digunakan untuk mengubah data customer dan diambil berdasarkan id customer
    public function edit($id) {
        // Membuat variabel $customer mengambil data tertentu dengan method find($id) yang akan diambil sesuai dengan id yang dicari
        $customer = Customer::find($id);

        // Kode program dibawah untuk memanggil view edit yang dimana dalam folder customer terdapat file edit.blade.php
        // dan compact untuk mengembalikan data atau variabel yang dapat digunakan dalam view
        return view('customers.edit', compact('customer'));
    }

    // Fungsi ini untuk mengubah data customer
    public function update(Request $request, $id) {
        // Mengambil data customer sesuai dengan kolom id
        $customer = Customer::find($id);

         // Membuat validasi pada form create customer
         $validator = Validator::make($request->all(),
         // Aturan
         [
             // Aturan name adalah wajib diisi dan minimal terdapat 3 huruf
             'name' => 'required|min:3', 
 
             // Aturan phone adalah wajib diisi, hanya angka yang dapat masuk ke database
             'phone' => 'required|min:10|numeric',
         ]);
 
         // Jika pengguna tidak mengikuti aturan dalam memnambahkan customer
         if($validator->fails()){
             // redirect dengan pesan error
             toast('Something went wrong!','error')->hideCloseButton()->autoClose(3000);
             return redirect()->back()->withErrors($validator)->withInput();
         }
 
         // Mengubah data customer yang diambil dari form name dan phone
         $customer->name = $request->input('name');
         $customer->phone = $request->input('phone');
         $customer->update();
 
         // Jika berhasil menyimpan data maka redirect ke customer index
         toast('Customer have been updated.','success')->hideCloseButton()->autoClose(3000);
         return redirect()->route('customers.index');
    }

    public function delete($id) {
        // Mengambil data customer sesuai dengan kolom id
        $customer = Customer::find($id);

        // Untuk menghapus data customer menggunakan method delete()
        $customer->delete();

        // Jika berhasil menghapus data maka redirect kembali yaitu ke customer index
        toast('Customer have been deleted.','success')->hideCloseButton()->autoClose(3000);
        return redirect()->back();
    }
}
