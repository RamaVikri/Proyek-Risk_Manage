<?php
require '../conn.php';

class User{
    
    private $conn;
    
    public function __construct($conn)
    {
        $this->conn = $conn;
    }
    // method untuk menampilkan data pengguna menggunakan foreach
    public function data(){
        $query = "SELECT * FROM user ";
        $result = mysqli_query($this->conn, $query);
        $rows = [];
        while($row = mysqli_fetch_assoc($result)){
            $rows[] = $row;
        }
        return $rows;
    }
    
    // method untuk menambahkan data pengguna baru
    public function tambah_data($data){
        $username = $data["username"];
        $password = $data["password"];
        $nama = $data["nama"];
        $status = $data["status"];
    
        $input_data = "INSERT INTO user (username, password, nama, status) VALUES ('$username', '$password', '$nama', '$status')";
        mysqli_query($this-> conn, $input_data);
    
        return mysqli_affected_rows($this-> conn);
    }
    
    // method untuk menghapus pengguna
    public function delete($id){
       
    
        mysqli_query($this->conn, "DELETE FROM user WHERE id = $id");
    
        return mysqli_affected_rows($this->conn);
    }
    
    // method untuk update/ atau memperbarui data pengguna
   public function ubah_data($data){
        $id = $data["id"];
        $username = $data["username"];
        $password = $data["password"];
        $nama = $data["nama"];
        $status = $data["status"];
    
        $input_data = "UPDATE user SET username = '$username', password = '$password', nama ='$nama', status = '$status' WHERE id = $id";
    
        mysqli_query($this->conn, $input_data);
    
        return mysqli_affected_rows($this-> conn);
    }
}