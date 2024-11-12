<?php
   class SanphamModel
   {
       private $pdo;
   
       public function __construct()
       {
           $this->pdo = connectDB(); // Giả sử hàm connectDB() đã được định nghĩa bên ngoài
       }
   
       // Lấy tất cả sản phẩm
       public function getAll()
       {
           try {
               $stmt = $this->pdo->query("SELECT * FROM san_phams"); // Thực hiện truy vấn
               $Sanphams = $stmt->fetchAll(PDO::FETCH_ASSOC);
               return $Sanphams;
           } catch (PDOException $e) {
               echo "Lỗi kết nối CSDL: " . $e->getMessage();
               return []; // Trả về mảng rỗng nếu có lỗi
           }
       }
       public function searchByName($searchTerm)
   {
       try {
           // Sử dụng LIKE để tìm kiếm tên sản phẩm
           $stmt = $this->pdo->prepare("SELECT * FROM san_phams WHERE ten_san_pham LIKE :search");
           $stmt->execute(['search' => '%' . $searchTerm . '%']);
           $Sanphams = $stmt->fetchAll(PDO::FETCH_ASSOC);
           return $Sanphams;
       } catch (PDOException $e) {
           echo "Lỗi kết nối CSDL: " . $e->getMessage();
           return [];  // Nếu có lỗi, trả về mảng rỗng
       }
   }
   
   
   
       // Lấy sản phẩm theo ID
       public function getById($id)
       {
           try {
               $stmt = $this->pdo->prepare("SELECT * FROM san_phams WHERE id = :id");
               $stmt->execute(['id' => $id]);
               return $stmt->fetch(PDO::FETCH_ASSOC);
           } catch (PDOException $e) {
               echo "Lỗi khi lấy dữ liệu sản phẩm: " . $e->getMessage();
               return false;
           }
       }
       
   
       // Thêm sản phẩm mới
       public function add($data)
       {
           try {
               $stmt = $this->pdo->prepare("INSERT INTO san_phams (danh_muc_id, ten_san_pham, mo_ta, gia_ban, gia_nhap, gia_khuyen_mai, so_luong, hinh_anh, trang_thai, ngay_nhap, luot_xem, mo_ta_chi_tiet) 
                                            VALUES (:danh_muc_id, :ten_san_pham, :mo_ta, :gia_ban, :gia_nhap, :gia_khuyen_mai, :so_luong, :hinh_anh, :trang_thai, :ngay_nhap, :luot_xem, :mo_ta_chi_tiet)");
               return $stmt->execute([
                   'danh_muc_id' => $data['danh_muc_id'],
                   'ten_san_pham' => $data['ten_san_pham'],
                   'mo_ta' => $data['mo_ta'],
                   'gia_ban' => $data['gia_ban'],
                   'gia_nhap' => $data['gia_nhap'],
                   'gia_khuyen_mai' => $data['gia_khuyen_mai'],
                   'so_luong' => $data['so_luong'],
                   'hinh_anh' => $data['hinh_anh'],
                   'trang_thai' => $data['trang_thai'],
                   'ngay_nhap' => $data['ngay_nhap'],
                   'luot_xem' => $data['luot_xem'],
                   'mo_ta_chi_tiet' => $data['mo_ta_chi_tiet']
               ]);
           } catch (PDOException $e) {
               echo "Lỗi khi thêm sản phẩm: " . $e->getMessage();
               return false;
           }
       }
   
       // Cập nhật sản phẩm theo ID
       public function update($id, $data)
       {
           try {
               $stmt = $this->pdo->prepare("UPDATE san_phams 
                                            SET danh_muc_id = :danh_muc_id, ten_san_pham = :ten_san_pham, mo_ta = :mo_ta, gia_ban = :gia_ban, gia_nhap = :gia_nhap, 
                                                gia_khuyen_mai = :gia_khuyen_mai, so_luong = :so_luong, hinh_anh = :hinh_anh, trang_thai = :trang_thai, 
                                                ngay_nhap = :ngay_nhap, luot_xem = :luot_xem, mo_ta_chi_tiet = :mo_ta_chi_tiet 
                                            WHERE id = :id");
               return $stmt->execute([
                   'id' => $id,
                   'danh_muc_id' => $data['danh_muc_id'],
                   'ten_san_pham' => $data['ten_san_pham'],
                   'mo_ta' => $data['mo_ta'],
                   'gia_ban' => $data['gia_ban'],
                   'gia_nhap' => $data['gia_nhap'],
                   'gia_khuyen_mai' => $data['gia_khuyen_mai'],
                   'so_luong' => $data['so_luong'],
                   'hinh_anh' => $data['hinh_anh'],
                   'trang_thai' => $data['trang_thai'],
                   'ngay_nhap' => $data['ngay_nhap'],
                   'luot_xem' => $data['luot_xem'],
                   'mo_ta_chi_tiet' => $data['mo_ta_chi_tiet']
               ]);
           } catch (PDOException $e) {
               echo "Lỗi khi cập nhật sản phẩm: " . $e->getMessage();
               return false;
           }
       }
   
       // Xóa sản phẩm theo ID
     public function delete($id)
   {
       try {
           // Bắt đầu transaction
           $this->pdo->beginTransaction();
   
           // Xóa bản ghi từ bảng san_phams
           $stmt = $this->pdo->prepare("DELETE FROM san_phams WHERE id = :id");
           $stmt->execute(['id' => $id]);
   
           // Cập nhật lại ID cho các bản ghi còn lại (ID > id bị xóa sẽ giảm đi 1)
           $stmt = $this->pdo->prepare("UPDATE san_phams SET id = id - 1 WHERE id > :id");
           $stmt->execute(['id' => $id]);
   
           // Cập nhật lại giá trị AUTO_INCREMENT (để tiếp tục từ ID lớn nhất hiện có)
           $stmt = $this->pdo->query("SELECT MAX(id) AS max_id FROM san_phams");
           $row = $stmt->fetch();
           $max_id = $row['max_id'];
   
           // Đặt lại giá trị AUTO_INCREMENT
           if ($max_id !== null) {
               $this->pdo->query("ALTER TABLE san_phams AUTO_INCREMENT = " . ($max_id + 1));
           } else {
               $this->pdo->query("ALTER TABLE san_phams AUTO_INCREMENT = 1");
           }
   
           // Commit transaction nếu mọi thứ thành công
           $this->pdo->commit();
   
           return true;
       } catch (PDOException $e) {
           // Nếu có lỗi, rollback transaction
           if ($this->pdo->inTransaction()) {
               $this->pdo->rollBack();
           }
           echo "Lỗi khi xóa sản phẩm: " . $e->getMessage();
           return false;
       }
   }
   
   
   
       
       public function getDanhMucs()
   {
       $sql = "SELECT * FROM danh_mucs WHERE trang_thai = 1"; // Chỉ lấy danh mục còn hàng
       $stmt = $this->pdo->prepare($sql);
       $stmt->execute();
       return $stmt->fetchAll(PDO::FETCH_ASSOC); // Trả về mảng danh mục
   }
       
}
?>