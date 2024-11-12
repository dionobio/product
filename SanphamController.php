<?php
require_once "./models/SanphamModel.php";

class SanphamController
{
    private $model;

        public function __construct()
        {
            $this->model = new SanphamModel();
        }

    // Hiển thị danh sách sản phẩm
    public function showSanphamList()
{
    $searchTerm = $_GET['search'] ?? ''; 
    if ($searchTerm) {
        $Sanphams = $this->model->searchByName($searchTerm);
    } else {
        $Sanphams = $this->model->getAll();
    }
    include 'views/sanpham/sanpham_list.php';
}



    // Hiển thị form thêm sản phẩm
    public function showAddSanphamForm()
    {
        $danhMucs = $this->model->getDanhMucs(); 
        require_once 'views/sanpham/sanpham_add.php'; 
    }

    // Xử lý thêm sản phẩm mới
    public function addSanpham() {
        // Kiểm tra phương thức yêu cầu là POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'danh_muc_id'     => $_POST['danh_muc_id'] ?? null,
                'ten_san_pham'    => $_POST['ten_san_pham'] ?? '',
                'mo_ta'           => $_POST['mo_ta'] ?? '',
                'gia_ban'         => $_POST['gia_ban'] ?? 0,
                'gia_nhap'        => $_POST['gia_nhap'] ?? 0,
                'gia_khuyen_mai'  => $_POST['gia_khuyen_mai'] ?? 0,
                'so_luong'        => $_POST['so_luong'] ?? 0,
                'hinh_anh'        => $_FILES['hinh_anh']['name'] ?? '', 
                'trang_thai'      => $_POST['trang_thai'] ?? 'active',
                'ngay_nhap'       => $_POST['ngay_nhap'] ?? date('Y-m-d'), 
                'luot_xem'        => 0,
                'mo_ta_chi_tiet'  => $_POST['mo_ta_chi_tiet'] ?? ''
            ];
            $uploadDir = './admin/uploads/';
            if (!empty($_FILES['hinh_anh']['name'])) {
                $uploadFile = $uploadDir . basename($_FILES['hinh_anh']['name']);
                if (move_uploaded_file($_FILES['hinh_anh']['tmp_name'], $uploadFile)) {
                    $data['hinh_anh'] = $uploadFile; // Lưu đường dẫn hình ảnh vào dữ liệu
                } else {
                    echo "Lỗi khi tải hình ảnh lên!";
                }
            } else {
                $data['hinh_anh'] = ''; // Nếu không có hình ảnh, bỏ qua
            }

                        // Kiểm tra nếu đường dẫn ảnh không thuộc thư mục uploads
            if (strpos($uploadFile, './admin/uploads/') !== 0) {
                echo "Lỗi: Hình ảnh phải được lưu trong thư mục uploads!";
                exit;
            }
                

            // Thực hiện thêm sản phẩm
            $result = $this->model->add($data);
            if ($result) {
                header('Location: index.php?act=list-sanpham'); // Chuyển hướng sau khi thêm thành công
                exit;
            } else {
                echo "Lỗi khi thêm sản phẩm!";
            }
        } else {
            echo "Yêu cầu không hợp lệ!";
        }
    }
    

    // Hiển thị form chỉnh sửa sản phẩm
    public function showEditSanphamForm()
    {
        $id = $_GET['id'] ?? null;
        if ($id && is_numeric($id)) {
            $Sanpham = $this->model->getById($id);
            if ($Sanpham) {
                require "views/sanpham/sanpham_edit.php";
            } else {
                echo "Không tìm thấy sản phẩm với ID: $id";
            }
        } else {
            echo "ID không hợp lệ!";
        }
    }

    // Cập nhật sản phẩm
    public function updateSanpham()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'];

        // Kiểm tra nếu có file hình ảnh mới
        $hinhAnh = $_FILES['hinh_anh']['name'] ? $_FILES['hinh_anh']['name'] : $_POST['hinh_anh_cu'];

        // Nếu có hình ảnh mới, xử lý upload
        if ($_FILES['hinh_anh']['name']) {
            $uploadDir = './admin/uploads/';
            $uploadFile = $uploadDir . basename($_FILES['hinh_anh']['name']);
            move_uploaded_file($_FILES['hinh_anh']['tmp_name'], $uploadFile);
        }

        $data = [
            'id' => $id,
            'danh_muc_id' => $_POST['danh_muc_id'],
            'ten_san_pham' => $_POST['ten_san_pham'],
            'mo_ta' => $_POST['mo_ta'],
            'gia_ban' => $_POST['gia_ban'],
            'gia_nhap' => $_POST['gia_nhap'],
            'gia_khuyen_mai' => $_POST['gia_khuyen_mai'],
            'so_luong' => $_POST['so_luong'],
            'hinh_anh' => $hinhAnh,
            'trang_thai' => $_POST['trang_thai'],
            'ngay_nhap' => $_POST['ngay_nhap'],
            'luot_xem' => $_POST['luot_xem'],
            'mo_ta_chi_tiet' => $_POST['mo_ta_chi_tiet']
        ];

        $this->model->update($id, $data);
        header("Location: index.php?act=list-sanpham");
    } else {
        echo "Phương thức không hợp lệ!";
    }
}


    // Xóa sản phẩm
    public function deleteSanpham($id)
{
    if ($id && is_numeric($id)) {  // Kiểm tra ID hợp lệ
        $this->model->delete($id);
        header("Location: index.php?act=list-sanpham");
    } else {
        echo "ID không hợp lệ!";
    }
}
    

}