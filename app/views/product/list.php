<?php include 'app/views/shares/header.php'; ?>
<h1>Danh sách sản phẩm</h1>
<a href="/webbanhang/Product/add" class="btn btn-success mb-2">Thêm sản phẩm mới</a>
<ul class="list-group">
    <?php foreach ($products as $product): ?>
        <li class="list-group-item">
            <div class="row">
                <div class="col-md-3">
                    <?php if (!empty($product->image_url)): ?>
                        <img src="<?php echo htmlspecialchars($product->image_url, ENT_QUOTES, 'UTF-8'); ?>"
                            alt="<?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?>"
                            class="img-fluid img-thumbnail" style="max-height: 150px;">
                    <?php else: ?>
                        <div class="text-center p-3 bg-light">
                            <i class="fa fa-image text-muted" style="font-size: 3rem;"></i>
                            <p class="mt-2 text-muted">Không có hình ảnh</p>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="col-md-9">
                    <h2>
                        <a href="/webbanhang/Product/show/<?php echo $product->id; ?>">
                            <?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?>
                        </a>
                    </h2>
                    <p><?php echo htmlspecialchars($product->description, ENT_QUOTES, 'UTF-8'); ?></p>
                    <p>Giá: <?php echo number_format($product->price, 0, ',', '.'); ?> VND</p>
                    <?php if (isset($product->category_name) && !empty($product->category_name)): ?>
                        <p><strong>Danh mục:</strong> <?php echo htmlspecialchars($product->category_name, ENT_QUOTES, 'UTF-8'); ?></p>
                    <?php else: ?>
                        <p><strong>Danh mục:</strong> Không có danh mục</p>
                    <?php endif; ?>
                    <a href="/webbanhang/Product/edit/<?php echo $product->id; ?>" class="btn btn-warning">Sửa</a>
                    <a href="/webbanhang/Product/delete/<?php echo $product->id; ?>" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');">Xóa</a>
                </div>
            </div>
        </li>
    <?php endforeach; ?>
</ul>
<?php include 'app/views/shares/footer.php'; ?>