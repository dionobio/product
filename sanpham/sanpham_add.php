<!doctype html>
<html lang="vi" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
   data-sidebar-image="none" data-preloader="disable" data-theme="default" data-theme-colors="default">
   <head>
      <meta charset="UTF-8" />
      <title>Thêm Sản Phẩm Mới</title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta content="Quản lý sản phẩm" name="description" />
      <meta content="Your Company" name="author" />
      <!-- CSS -->
      <?php require_once "views/layouts/libs_css.php"; ?>
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
                           <h4 class="mb-sm-0">Thêm Sản Phẩm Mới</h4>
                           <div class="page-title-right">
                              <ol class="breadcrumb m-0">
                                 <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
                                 <li class="breadcrumb-item active">Thêm sản phẩm</li>
                              </ol>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-12">
                        <div class="card">
                           <div class="card-header">
                              <h4 class="card-title mb-0">Thông Tin Sản Phẩm</h4>
                           </div>
                           <div class="card-body">
                              <form action="index.php?act=add-sanpham-submit" method="POST"
                                 enctype="multipart/form-data">
                                 <div class="mb-3">
                                    <label for="ten_san_pham" class="form-label">Tên sản phẩm</label>
                                    <input type="text" class="form-control" id="ten_san_pham"
                                       name="ten_san_pham" required>
                                 </div>
                                 <div class="mb-3">
                                    <label for="mo_ta" class="form-label">Mô tả</label>
                                    <textarea class="form-control" id="mo_ta" name="mo_ta" required></textarea>
                                 </div>
                                 <div class="mb-3">
                                    <label for="ngay_nhap" class="form-label">Ngày nhập</label>
                                    <input type="date" class="form-control" id="ngay_nhap" name="ngay_nhap"
                                       value="<?php echo date('Y-m-d'); ?>" required>
                                 </div>
                                 <div class="mb-3">
                                    <label for="gia_ban" class="form-label">Giá bán</label>
                                    <input type="number" class="form-control" id="gia_ban" name="gia_ban"
                                       required>
                                 </div>
                                 <div class="mb-3">
                                    <label for="gia_nhap" class="form-label">Giá nhập</label>
                                    <input type="number" class="form-control" id="gia_nhap" name="gia_nhap"
                                       required>
                                 </div>
                                 <div class="mb-3">
                                    <label for="gia_khuyen_mai" class="form-label">Giá khuyến mãi</label>
                                    <input type="number" class="form-control" id="gia_khuyen_mai"
                                       name="gia_khuyen_mai">
                                 </div>
                                 <div class="mb-3">
                                    <label for="so_luong" class="form-label">Số lượng</label>
                                    <input type="number" class="form-control" id="so_luong" name="so_luong"
                                       required>
                                 </div>
                                 <div class="mb-3">
                                    <label for="trang_thai" class="form-label">Trạng thái</label>
                                    <select class="form-select" id="trang_thai" name="trang_thai" required>
                                       <option value="active">Active</option>
                                       <option value="inactive">Inactive</option>
                                    </select>
                                 </div>
                                 <div class="mb-3">
                                    <label for="danh_muc_id" class="form-label">Danh mục</label>
                                    <select class="form-select" id="danh_muc_id" name="danh_muc_id" required>
                                       <option value="">Chọn danh mục</option>
                                       <?php if (isset($danhMucs) && !empty($danhMucs)): ?>
                                       <?php foreach ($danhMucs as $danhMuc): ?>
                                       <option value="<?php echo $danhMuc['id']; ?>">
                                          <?php echo $danhMuc['ten_danh_muc']; ?>
                                       </option>
                                       <?php endforeach; ?>
                                       <?php else: ?>
                                       <option value="">Chưa có danh mục nào</option>
                                       <?php endif; ?>
                                    </select>
                                 </div>
                                 <div class="mb-3">
                                    <label for="hinh_anh" class="form-label">Hình ảnh sản phẩm</label>
                                    <input type="file" class="form-control" id="hinh_anh" name="hinh_anh">
                                 </div>
                                 <button type="submit" class="btn btn-success">Lưu sản phẩm</button>
                              </form>
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
   </body>
</html>