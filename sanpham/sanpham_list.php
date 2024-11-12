<!doctype html>
<html lang="vi" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
   data-sidebar-image="none" data-preloader="disable" data-theme="default" data-theme-colors="default">
   <head>
      <meta charset="UTF-8" />
      <title>Danh sách người dùng</title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta content="Quản lý người dùng" name="description" />
      <meta content="Your Company" name="author" />
      <!-- CSS -->
      <?php
         require_once "views/layouts/libs_css.php";
         ?>
   </head>
   <body>
      <div id="layout-wrapper">
         <!-- HEADER -->
         <?php
            require_once "views/layouts/header.php";
            require_once "views/layouts/siderbar.php";
            ?>
         <div class="vertical-overlay"></div>
         <div class="main-content">
            <div class="page-content">
               <div class="container-fluid">
                  <div class="row">
                     <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                           <h4 class="mb-sm-0">Quản Lý Sản Phẩm</h4>
                           <div class="page-title-right">
                              <ol class="breadcrumb m-0">
                                 <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
                                 <li class="breadcrumb-item active">Sản Phẩm</li>
                              </ol>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-12">
                        <div class="card">
                           <div class="card-header align-items-center d-flex">
                              <h4 class="card-title mb-0 flex-grow-1">Danh sách sản phẩm</h4>
                              <a href="index.php?act=add-sanpham" class="btn btn-soft-success"><i
                                 class="ri-add-circle-line align-middle me-1"></i> Thêm sản phẩm mới</a>
                           </div>
                           <form method="GET" action="?act=list-sanpham">
                              <input type="text" name="search" placeholder="Tìm kiếm sản phẩm">
                              <button type="submit">Tìm</button>
                           </form>
                           <div class="card-body">
                              <div class="table-responsive">
                                 <table class="table table-striped table-nowrap align-middle mb-0">
                                    <tr>
                                       <th>ID</th>
                                       <th>Tên Sản Phẩm</th>
                                       <th>Danh Mục</th>
                                       <th>Hình Ảnh</th>
                                       <th>Mô Tả</th>
                                       <th>Giá Bán</th>
                                       <th>Giá Nhập</th>
                                       <th>Giá Khuyến Mãi</th>
                                       <th>Số Lượng</th>
                                       <th>Trạng Thái</th>
                                       <th>Ngày Nhập</th>
                                       <th>Lượt Xem</th>
                                       <th>Hành Động</th>
                                    </tr>
                                    <?php 
                                       if (isset($Sanphams) && count($Sanphams) > 0) {
                                           foreach ($Sanphams as $Sanpham) {
                                               echo "<tr>";
                                               echo "<td>" . $Sanpham['id'] . "</td>";
                                               echo "<td>" . htmlspecialchars($Sanpham['ten_san_pham']) . "</td>";
                                               echo "<td>" . htmlspecialchars($Sanpham['danh_muc_id']) . "</td>";
                                               echo "<td><img src='uploads/" . htmlspecialchars($Sanpham['hinh_anh']) . "' alt='Hình sản phẩm' width='50' height='50'></td>";
                                               echo "<td>" . htmlspecialchars($Sanpham['mo_ta']) . "</td>";
                                               echo "<td>" . number_format($Sanpham['gia_ban']) . "</td>";
                                               echo "<td>" . number_format($Sanpham['gia_nhap']) . "</td>";
                                               echo "<td>" . number_format($Sanpham['gia_khuyen_mai']) . "</td>";
                                               echo "<td>" . $Sanpham['so_luong'] . "</td>";
                                               echo "<td>" . $Sanpham['trang_thai'] . "</td>";
                                               echo "<td>" . date('d/m/Y', strtotime($Sanpham['ngay_nhap'])) . "</td>";
                                               echo "<td>" . $Sanpham['luot_xem'] . "</td>";
                                       
                                               echo "<td>
                                                       <a href='index.php?act=edit-sanpham&id=" . $Sanpham['id'] . "' class='btn btn-warning btn-sm me-1'>Sửa</a>
                                                       <a href='index.php?act=delete-sanpham&id=" . $Sanpham['id'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Bạn có chắc chắn muốn xóa?\")'>Xóa</a>
                                                     </td>";
                                               echo "</tr>";
                                           }
                                       } else {
                                           echo "<tr><td colspan='11' class='text-center'>Không có dữ liệu</td></tr>";
                                       }
                                       ?>
                                 </table>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <footer class="footer">
               <div class="container-fluid">
                  <div class="row">
                     <div class="col-sm-6">
                        <script>
                           document.write(new Date().getFullYear())
                        </script> © Your Company.
                     </div>
                     <div class="col-sm-6">
                        <div class="text-sm-end d-none d-sm-block">
                           Design & Develop by Your Company
                        </div>
                     </div>
                  </div>
               </div>
            </footer>
         </div>
      </div>
      <button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
      <i class="ri-arrow-up-line"></i>
      </button>
      <div id="preloader">
         <div id="status">
            <div class="spinner-border text-primary avatar-sm" role="status">
               <span class="visually-hidden">Loading...</span>
            </div>
         </div>
      </div>
      <?php
         require_once "views/layouts/libs_js.php";
         ?>
   </body>
</html>