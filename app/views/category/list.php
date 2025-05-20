<?php include 'app/views/shares/header.php'; ?>
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Danh sách danh mục</h1>
        <a href="/webbanhang/category/add" class="btn btn-success">
            <i class="fas fa-plus-circle"></i> Thêm danh mục mới
        </a>
    </div>

    <?php if (empty($categories)): ?>
        <div class="alert alert-info">
            Chưa có danh mục nào. Hãy thêm danh mục mới!
        </div>
    <?php else: ?>
        <div class="row">
            <?php foreach ($categories as $category): ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">
                                <?php echo htmlspecialchars($category->name, ENT_QUOTES, 'UTF-8'); ?>
                            </h5>
                            <p class="card-text text-muted">
                                <?php echo htmlspecialchars(substr($category->description, 0, 100), ENT_QUOTES, 'UTF-8'); ?>
                                <?php echo (strlen($category->description) > 100) ? '...' : ''; ?>
                            </p>
                        </div>
                        <div class="card-footer bg-white border-top-0">
                            <div class="btn-group w-100">
                                <a href="/webbanhang/category/show/<?php echo $category->id; ?>" class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-eye"></i> Chi tiết
                                </a>
                                <a href="/webbanhang/category/edit/<?php echo $category->id; ?>" class="btn btn-outline-warning btn-sm">
                                    <i class="fas fa-edit"></i> Sửa
                                </a>
                                <a href="/webbanhang/category/delete/<?php echo $category->id; ?>" class="btn btn-outline-danger btn-sm"
                                    onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này?');">
                                    <i class="fas fa-trash"></i> Xóa
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
<?php include 'app/views/shares/footer.php'; ?>