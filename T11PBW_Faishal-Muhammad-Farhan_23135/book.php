<?php

class Book {
    // Property private: hanya bisa diakses dari dalam class
    private $code_book; // Format harus "BB00" (2 huruf kapital + 2 angka)
    private $name;      // Nama buku, bebas tidak divalidasi khusus
    private $qty;       // Jumlah buku, harus bilangan bulat positif

    // Constructor dijalankan saat objek dibuat
    public function __construct($code_book, $name, $qty) {
        // Memanggil setter untuk validasi dan assign nilai
        $this->setCodeBook($code_book);
        $this->name = $name; // Tidak perlu validasi tambahan sesuai instruksi
        $this->setQty($qty);
    }

    // Setter private untuk code_book
    private function setCodeBook($code_book) {
        // Validasi format code_book harus 2 huruf kapital + 2 angka
        if (preg_match("/^[A-Z]{2}[0-9]{2}$/", $code_book)) {
            $this->code_book = $code_book; // Jika valid, simpan nilainya
        } else {
            // Jika tidak sesuai format, hentikan eksekusi dengan pesan error
            throw new Exception("Error: code_book harus dalam format 'BB00' (2 huruf kapital + 2 angka).");
        }
    }

    // Setter private untuk qty
    private function setQty($qty) {
        // Validasi: qty harus integer dan lebih dari 0
        if (is_int($qty) && $qty > 0) {
            $this->qty = $qty; // Jika valid, simpan nilainya
        } else {
            // Jika tidak valid, hentikan dengan pesan error
            throw new Exception("Error: qty harus berupa bilangan bulat positif.");
        }
    }

    // Getter untuk code_book, hanya mengembalikan nilai
    public function getCodeBook() {
        return $this->code_book;
    }

    // Getter untuk qty, hanya mengembalikan nilai
    public function getQty() {
        return $this->qty;
    }

    // Getter untuk name, meskipun tidak diminta setter/getter khusus
    public function getName() {
        return $this->name;
    }
}

// Contoh penggunaan
try {
    // Membuat objek buku dengan data valid
    $book1 = new Book("AB12", "Pemrograman Web", 10);

    // Menampilkan data buku
    echo "Kode Buku: " . $book1->getCodeBook() . "\n";
    echo "Nama Buku: " . $book1->getName() . "\n";
    echo "Jumlah: " . $book1->getQty() . "\n";

    // Contoh input salah: format code_book salah dan qty negatif
    $book2 = new Book("abc1", "OOP Dasar", -5); // Akan memicu Exception

} catch (Exception $e) {
    // Menampilkan pesan error jika validasi gagal
    echo $e->getMessage();
}
