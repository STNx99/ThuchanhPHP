<?php include 'app/views/shares/header.php'; ?>
<div class="container mt-4">
    <h1><?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?></h1>
    <div class="card mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <?php if (!empty($product->image)): ?>
                        <img src="<?php echo htmlspecialchars($product->image, ENT_QUOTES, 'UTF-8'); ?>"
                            alt="<?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?>"
                            class="img-fluid img-thumbnail mb-3">
                    <?php else: ?>
                        <div class="text-center p-4 bg-light mb-3">
                            <i class="fa fa-image text-muted" style="font-size: 5rem;"></i>
                            <p class="mt-3 text-muted">Không có hình ảnh</p>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="col-md-8">
                    <h5 class="card-title">Thông tin chi tiết sản phẩm</h5>
                    <p class="card-text"><strong>Mô tả:</strong> <?php echo htmlspecialchars($product->description, ENT_QUOTES, 'UTF-8'); ?></p>
                    <p class="card-text"><strong>Giá:</strong> <?php echo number_format($product->price, 0, ',', '.'); ?> VND</p>
                    <?php
                    $categoryModel = new CategoryModel((new Database())->getConnection());
                    $category = $categoryModel->getCategoryById($product->category_id);
                    ?>
                    <p class="card-text"><strong>Danh mục:</strong>
                        <?php echo ($category) ? htmlspecialchars($category->name, ENT_QUOTES, 'UTF-8') : 'Không có danh mục'; ?>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="btn-group">
        <a href="/webbanhang/product/edit/<?php echo $product->id; ?>" class="btn btn-warning">Sửa sản phẩm</a>
        <a href="/webbanhang/product/delete/<?php echo $product->id; ?>" class="btn btn-danger"
            onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');">Xóa sản phẩm</a>
        <a href="/webbanhang/product" class="btn btn-secondary">Quay lại danh sách</a>
    </div>
</div>
<?php include 'app/views/shares/footer.php'; ?>