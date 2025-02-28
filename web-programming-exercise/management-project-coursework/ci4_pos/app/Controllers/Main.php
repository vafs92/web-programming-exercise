<?php

namespace App\Controllers;

use App\Models\Auth;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionItem;

class Main extends BaseController
{
    protected $request;
    protected $session;
    protected $auth_model;
    protected $prod_model;
    protected $tran_model;
    protected $tran_item_model;
    protected $data; // Add this line

    public function __construct()
    {
        $this->request = \Config\Services::request();
        $this->session = session();
        $this->auth_model = new Auth;
        $this->prod_model = new Product;
        $this->tran_model = new Transaction;
        $this->tran_item_model = new TransactionItem;
        $this->data = ['session' => $this->session, 'request' => $this->request];
    }

    public function index()
    {
        $this->data['page_title'] = "Home";
        return view('pages/home', $this->data);
    }

    public function users()
    {
        $this->data['page_title'] = "Users";
        $this->data['page'] =  !empty($this->request->getVar('page')) ? $this->request->getVar('page') : 1;
        $this->data['perPage'] =  10;
        $this->data['total'] =  $this->auth_model->countAllResults();
        $this->data['users'] = $this->auth_model->paginate($this->data['perPage']);
        $this->data['total_res'] = is_array($this->data['users']) ? count($this->data['users']) : 0;
        $this->data['pager'] = $this->auth_model->pager;
        return view('pages/users/list', $this->data);
    }
    public function user_add()
    {
        if ($this->request->getMethod() == 'post') {
            extract($this->request->getPost());
            if ($password !== $cpassword) {
                $this->session->setFlashdata('error', "Password does not match.");
            } else {
                $udata = [];
                $udata['name'] = $name;
                $udata['email'] = $email;
                if (!empty($password))
                    $udata['password'] = password_hash($password, PASSWORD_DEFAULT);
                $udata['role'] = $role;
                $checkMail = $this->auth_model->where('email', $email)->countAllResults();
                if ($checkMail > 0) {
                    $this->session->setFlashdata('error', "User Email Already Taken.");
                } else {
                    $save = $this->auth_model->save($udata);
                    if ($save) {
                        $this->session->setFlashdata('main_success', "User Details has been updated successfully.");
                        return redirect()->to('Main/users');
                    } else {
                        $this->session->setFlashdata('error', "User Details has failed to update.");
                    }
                }
            }
        }

        $this->data['page_title'] = "Add User";
        return view('pages/users/add', $this->data);
    }
    public function user_edit($id = '')
    {
        if (empty($id))
            return redirect()->to('Main/users');
        if ($this->request->getMethod() == 'post') {
            extract($this->request->getPost());
            if ($password !== $cpassword) {
                $this->session->setFlashdata('error', "Password does not match.");
            } else {
                $udata = [];
                $udata['name'] = $name;
                $udata['email'] = $email;
                $udata['role'] = $role;
                if (!empty($password))
                    $udata['password'] = password_hash($password, PASSWORD_DEFAULT);
                $checkMail = $this->auth_model->where('email', $email)->where('id!=', $id)->countAllResults();
                if ($checkMail > 0) {
                    $this->session->setFlashdata('error', "User Email Already Taken.");
                } else {
                    $update = $this->auth_model->where('id', $id)->set($udata)->update();
                    if ($update) {
                        $this->session->setFlashdata('success', "User Details has been updated successfully.");
                        return redirect()->to('Main/user_edit/' . $id);
                    } else {
                        $this->session->setFlashdata('error', "User Details has failed to update.");
                    }
                }
            }
        }

        $this->data['page_title'] = "Edit User";
        $this->data['user'] = $this->auth_model->where("id ='{$id}'")->first();
        return view('pages/users/edit', $this->data);
    }

    public function user_delete($id = '')
    {
        if (empty($id)) {
            $this->session->setFlashdata('main_error', "user Deletion failed due to unknown ID.");
            return redirect()->to('Main/users');
        }
        $delete = $this->auth_model->where('id', $id)->delete();
        if ($delete) {
            $this->session->setFlashdata('main_success', "User has been deleted successfully.");
        } else {
            $this->session->setFlashdata('main_error', "user Deletion failed due to unknown ID.");
        }
        return redirect()->to('Main/users');
    }

    public function products()
    {
        $this->data['page_title'] = "Products";
        $this->data['page'] =  !empty($this->request->getVar('page')) ? $this->request->getVar('page') : 1;
        $this->data['perPage'] =  10;
        $this->data['total'] =  $this->prod_model->countAllResults();
        $this->data['products'] = $this->prod_model->paginate($this->data['perPage']);
        $this->data['total_res'] = is_array($this->data['products']) ? count($this->data['products']) : 0;
        $this->data['pager'] = $this->prod_model->pager;
        return view('pages/products/list', $this->data);
    }

    public function product_add()
    {
        if ($this->request->getMethod() == 'post') {
            // Ambil data dari form
            $code = $this->request->getPost('code');
            $name = $this->request->getPost('name');
            $description = $this->request->getPost('description');
            $price = $this->request->getPost('price');
            $avail = $this->request->getPost('avail');

            // Inisialisasi data untuk disimpan
            $udata = [
                'code' => $code,
                'name' => $name,
                'description' => $description,
                'price' => $price,
                'avail' => $avail
            ];

            // Menangani upload gambar
            $image = $this->request->getFile('foto_product');
            if ($image->isValid() && !$image->hasMoved()) {
                // Buat nama file baru yang unik
                $newName = $image->getRandomName(); // Nama baru yang unik
                $image->move('uploads', $newName); // Memindahkan file ke folder 'uploads'
                // Tambahkan nama file ke data produk
                $udata['foto_product'] = $newName;
            }

            // Validasi kode produk unik
            $checkCode = $this->prod_model->where('code', $code)->countAllResults();
            if ($checkCode) {
                $this->session->setFlashdata('error', "Product Code Already Taken.");
            } else {
                // Simpan data produk
                $save = $this->prod_model->save($udata);
                if ($save) {
                    $this->session->setFlashdata('success', "Product has been added successfully.");
                    return redirect()->to('Main/products/');
                } else {
                    $this->session->setFlashdata('error', "Failed to add the product.");
                }
            }
        }

        $this->data['page_title'] = "Add New Product";
        return view('pages/products/add', $this->data);
    }
    public function product_edit($id = '')
    {
        if (empty($id)) {
            return redirect()->to('Main/products');
        }

        if ($this->request->getMethod() == 'post') {
            extract($this->request->getPost());
            $udata = [];
            $udata['code'] = $code;
            $udata['name'] = $name;
            $udata['description'] = $description;
            $udata['price'] = $price;
            $udata['avail'] = $avail;

            // Menangani upload gambar
            $image = $this->request->getFile('foto_product');

            // Jika ada file gambar yang di-upload
            if ($image->isValid() && !$image->hasMoved()) {
                // Menghapus gambar lama (jika ada)
                $product = $this->prod_model->where('id', $id)->first();
                if (!empty($product['foto_product']) && file_exists('uploads/' . $product['foto_product'])) {
                    unlink('uploads/' . $product['foto_product']); // Menghapus gambar lama
                }

                // Menyimpan gambar baru
                $newName = $image->getRandomName(); // Nama baru yang unik
                $image->move('uploads', $newName); // Memindahkan file ke folder 'uploads'

                // Menambahkan nama gambar baru ke data produk
                $udata['foto_product'] = $newName;
            }

            // Memeriksa apakah kode produk sudah ada di database
            $checkCode = $this->prod_model->where('code', $code)->where("id != '{$id}'")->countAllResults();
            if ($checkCode) {
                $this->session->setFlashdata('error', "Product Code Already Taken.");
            } else {
                // Memperbarui data produk
                $update = $this->prod_model->where('id', $id)->set($udata)->update();
                if ($update) {
                    $this->session->setFlashdata('success', "Product Details has been updated successfully.");
                    return redirect()->to('Main/products/' . $id);
                } else {
                    $this->session->setFlashdata('error', "Product Details has failed to update.");
                }
            }
        }

        // Ambil data produk untuk ditampilkan
        $this->data['page_title'] = "Edit Product";
        $this->data['product'] = $this->prod_model->where("id", $id)->first();

        return view('pages/products/edit', $this->data);
    }

    public function product_detail($id = '')
    {
        if (empty($id)) {
            $this->session->setFlashdata('main_error', "Product Details failed to load due to unknown ID.");
            return redirect()->to('Main/products');
        }

        // Corrected model reference
        $this->data['details'] = $this->prod_model->where('id', $id)->first();  // Corrected the model name

        if (!$this->data['details']) {
            $this->session->setFlashdata('main_error', "Product Details failed to load due to unknown ID.");
            return redirect()->to('Main/products');
        }

        // Menangani pembaruan produk jika POST
        if ($this->request->getMethod() == 'post') {
            $productData = $this->request->getPost();
            $udata = [
                'code' => $productData['code'],
                'name' => $productData['name'],
                'description' => $productData['description'],
                'price' => $productData['price'],
                'foto_product' => $productData['foto_product'],
                'avail' => $productData['avail'],
            ];

            $checkCode = $this->prod_model->where('code', $productData['code'])->where('id !=', $id)->countAllResults();
            if ($checkCode) {
                $this->session->setFlashdata('error', "Product Code Already Taken.");
            } else {
                $save = $this->prod_model->update($id, $udata);  // Corrected the model reference
                if ($save) {
                    $this->session->setFlashdata('main_success', "Product Details have been updated successfully.");
                    return redirect()->to('Main/products');
                } else {
                    $this->session->setFlashdata('error', "Product Details failed to update.");
                }
            }
        }

        // Menampilkan halaman produk detail
        $this->data['page_title'] = "Product Details";
        return view('pages/products/detail', $this->data);
    }
    public function product_delete($id = '')
    {
        if (empty($id)) {
            $this->session->setFlashdata('main_error', "Product Deletion failed due to unknown ID.");
            return redirect()->to('Main/products');
        }
        $delete = $this->prod_model->where('id', $id)->delete();
        if ($delete) {
            $this->session->setFlashdata('main_success', "Product has been deleted successfully.");
        } else {
            $this->session->setFlashdata('main_error', "Product Deletion failed due to unknown ID.");
        }
        return redirect()->to('Main/products');
    }
    public function pos()
    {
        $this->data['page_title'] = "New Transaction";
        $this->data['products'] =  $this->prod_model->findAll();

        return view('pages/pos/add', $this->data);
    }

    public function save_transaction()
    {
        extract($this->request->getPost());

        $pref = date("Ymd");
        $code = sprintf("%'.05d", 1);
        while (true) {
            if ($this->tran_model->where(" code = '{$pref}{$code}' ")->countAllResults() > 0) {
                $code = sprintf("%'.05d", ceil($code) + 1);
            } else {
                $code = $pref . $code;
                break;
            }
        }

        $data['code'] = $code;
        foreach ($this->request->getPost() as $k => $v) {
            if (!is_array($this->request->getPost($k)) && !in_array($k, ['id'])) {
                $data[$k] = htmlspecialchars($v);
            }
        }
        $save_transaction = $this->tran_model->save($data);
        if ($save_transaction) {
            $transaction_id = $this->tran_model->insertID();
            foreach ($product_id as $k => $v) {
                $data2['transaction_id'] = $transaction_id;
                $data2['product_id'] = $v;
                $data2['price'] = $price[$k];
                $data2['quantity'] = $quantity[$k];
                $this->tran_item_model->save($data2);
            }
            $this->session->setFlashdata('main_success', "Transaction has been saved successfully.");
            return redirect()->to('Main/pos');
        }
    }
    public function transactions()
    {
        $this->data['page_title'] = "Transactions";
        $this->data['page'] =  !empty($this->request->getVar('page')) ? $this->request->getVar('page') : 1;
        $this->data['perPage'] =  10;
        $this->data['total'] =  $this->tran_model->countAllResults();
        $this->data['transactions'] = $this->tran_model
            ->select(" transactions.*, COALESCE((SELECT SUM(transaction_items.quantity) FROM transaction_items where transaction_id = transactions.id ), 0) as total_items")
            ->paginate($this->data['perPage']);
        $this->data['total_res'] = is_array($this->data['transactions']) ? count($this->data['transactions']) : 0;
        $this->data['pager'] = $this->tran_model->pager;
        return view('pages/pos/list', $this->data);
    }

    public function transaction_delete($id = '')
    {
        if (empty($id)) {
            $this->session->setFlashdata('main_error', "Transaction Deletion failed due to unknown ID.");
            return redirect()->to('Main/transactions');
        }
        $delete = $this->tran_model->where('id', $id)->delete();
        if ($delete) {
            $this->session->setFlashdata('main_success', "Transaction has been deleted successfully.");
        } else {
            $this->session->setFlashdata('main_error', "Transaction Deletion failed due to unknown ID.");
        }
        return redirect()->to('Main/transactions');
    }
    public function transaction_view($id = '')
    {
        if (empty($id)) {
            $this->session->setFlashdata('main_error', "Transaction Details failed to load due to unknown ID.");
            return redirect()->to('Main/transactions');
        }
        $this->data['page_title'] = "Transactions";
        $this->data['details'] = $this->tran_model->where('id', $id)->first();
        if (!$this->data['details']) {
            $this->session->setFlashdata('main_error', "Transaction Details failed to load due to unknown ID.");
            return redirect()->to('Main/transactions');
        }
        $this->data['items'] = $this->tran_item_model
            ->select("transaction_items.*, CONCAT(products.code,'-',products.name) as product")
            ->where('transaction_id', $id)
            ->join('products', " transaction_items.product_id = products.id ", 'inner')
            ->findAll();
        return view('pages/pos/view', $this->data);
    }

    public function report()
    {
        $this->data['page_title'] = "Report";
        $this->data['page'] =  !empty($this->request->getVar('page')) ? $this->request->getVar('page') : 1;
        $this->data['perPage'] = 10;

        // Ambil input tanggal dari form
        $start_date = $this->request->getVar('start_date');
        $end_date = $this->request->getVar('end_date');

        // Base query
        $query = $this->tran_item_model
            ->select("transaction_items.*, CONCAT(products.code,'-',products.name) as product, transactions.code AS transaction_code, 
            (transaction_items.quantity * transaction_items.price) as total")
            ->join('products', "transaction_items.product_id = products.id", 'inner')
            ->join('transactions', "transaction_items.transaction_id = transactions.id", 'inner');

        // Tambahkan filter tanggal jika ada input
        if (!empty($start_date) && !empty($end_date)) {
            $query = $query->where("DATE(transaction_items.created_at) >=", $start_date)
                ->where("DATE(transaction_items.created_at) <=", $end_date);
        }

        // Hitung total hasil dan paginasi
        $this->data['total'] = $query->countAllResults(false); // false untuk mempertahankan query
        $this->data['transactions_item'] = $query->paginate($this->data['perPage']);
        $this->data['total_res'] = is_array($this->data['transactions_item']) ? count($this->data['transactions_item']) : 0;
        $this->data['pager'] = $this->tran_item_model->pager;

        // Query tambahan untuk hitung total qty, pendapatan, dan item paling laris
        $this->data['start_date'] = $start_date;
        $this->data['end_date'] = $end_date;

        if (!empty($start_date) && !empty($end_date)) {
            // Total Qty Terjual
            $this->data['total_qty'] = $this->tran_item_model
                ->join('transactions', "transaction_items.transaction_id = transactions.id", 'inner')
                ->where("DATE(transaction_items.created_at) >=", $start_date)
                ->where("DATE(transaction_items.created_at) <=", $end_date)
                ->selectSum('transaction_items.quantity', 'total_qty')
                ->get()->getRow()->total_qty ?? 0;

            // Total Pendapatan
            $this->data['total_income'] = $this->tran_item_model
                ->join('transactions', "transaction_items.transaction_id = transactions.id", 'inner')
                ->where("DATE(transaction_items.created_at) >=", $start_date)
                ->where("DATE(transaction_items.created_at) <=", $end_date)
                ->selectSum('transactions.total_amount', 'total_income') // total = qty * harga
                ->get()->getRow()->total_income ?? 0;

            // Item Paling Laris
            $this->data['most_sold_item'] = $this->tran_item_model
                ->join('products', "transaction_items.product_id = products.id", 'inner')
                ->where("DATE(transaction_items.created_at) >=", $start_date)
                ->where("DATE(transaction_items.created_at) <=", $end_date)
                ->select('products.name as product_name, SUM(transaction_items.quantity) as total_qty')
                ->groupBy('transaction_items.product_id')
                ->orderBy('total_qty', 'DESC')
                ->limit(1)
                ->get()->getRow();

            // Menghitung jumlah hari dalam periode
            $start_date = strtotime($this->data['start_date']);
            $end_date = strtotime($this->data['end_date']);
            $days_in_period = floor(($end_date - $start_date) / (60 * 60 * 24)) + 1; // Menambahkan 1 hari untuk menghitung hari pertama

            // Rata-rata Penjualan per Hari
            $this->data['avg_sales_per_day'] = $days_in_period > 0 && $this->data['total_income'] > 0 ?
                $this->data['total_income'] / $days_in_period : 0;
        } else {
            // Jika tidak ada filter, kosongkan nilai
            $this->data['total_qty'] = 0;
            $this->data['total_income'] = 0;
            $this->data['most_sold_item'] = null;
            $this->data['avg_sales_per_day'] = 0;
        }

        return view('pages/rekapan/view', $this->data);
    }
}
