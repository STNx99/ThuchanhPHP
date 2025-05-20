<?php include 'app/views/shares/header.php'; ?>
<div class="container mt-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/webbanhang/category">Danh mục</a></li>dy">
            <li class="breadcrumb-item active" aria-current="page"><?php echo htmlspecialchars($category->name, ENT_QUOTES, 'UTF-8'); ?></li>/h5>
        </ol>
        </p>
    </nav>div>

    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white">
            <h1 class="h3 mb-0"><?php echo htmlspecialchars($category->name, ENT_QUOTES, 'UTF-8'); ?></h1>
        </div>
        <div class="card-body">
            <h5 class="card-title">Chi tiết danh mục</h5>
            <div class="p-3 bg-light rounded mb-3">
                <p class="card-text"><strong>Mô tả:</strong></p>
                <p class="card-text"><?php echo htmlspecialchars($category->description, ENT_QUOTES, 'UTF-8'); ?></p>
            </div>

















            <?php include 'app/views/shares/footer.php'; ?>
        </div>
    </div>
</div>
</div> </a> <i class="fas fa-arrow-left"></i> Quay lại danh sách <a href="/webbanhang/category" class="btn btn-secondary"> </a> <i class="fas fa-trash"></i> Xóa danh mục onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này?');"> <a href="/webbanhang/category/delete/<?php echo $category->id; ?>" class="btn btn-danger" </a> <i class="fas fa-edit"></i> Sửa danh mục <a href="/webbanhang/category/edit/<?php echo $category->id; ?>" class="btn btn-warning">
        <div class="btn-group">
            <div class="card-footer bg-white"> </div>