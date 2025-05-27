<?php include 'app/views/shares/header.php'; ?>
<div class="max-w-7xl mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-900">Danh sách danh mục</h1>
        <a href="/webbanhang/category/add" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg flex items-center space-x-2 transition duration-200">
            <i class="fas fa-plus-circle"></i>
            <span>Thêm danh mục mới</span>
        </a>
    </div>

    <?php if (empty($categories)): ?>
        <div class="bg-blue-50 border border-blue-200 text-blue-700 px-4 py-3 rounded-lg">
            Chưa có danh mục nào. Hãy thêm danh mục mới!
        </div>
    <?php else: ?>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php foreach ($categories as $category): ?>
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 hover:shadow-md transition duration-200 flex flex-col">
                    <div class="p-6 flex-grow">
                        <h5 class="text-xl font-semibold text-gray-900 mb-3">
                            <?php echo htmlspecialchars($category->name, ENT_QUOTES, 'UTF-8'); ?>
                        </h5>
                        <p class="text-gray-600 text-sm">
                            <?php echo htmlspecialchars(substr($category->description, 0, 100), ENT_QUOTES, 'UTF-8'); ?>
                            <?php echo (strlen($category->description) > 100) ? '...' : ''; ?>
                        </p>
                    </div>
                    <div class="p-4 border-t border-gray-100">
                        <div class="flex space-x-2">
                            <a href="/webbanhang/category/show/<?php echo $category->id; ?>" class="flex-1 bg-blue-50 hover:bg-blue-100 text-blue-600 px-3 py-2 rounded text-sm text-center transition duration-200">
                                <i class="fas fa-eye"></i> Chi tiết
                            </a>
                            <a href="/webbanhang/category/edit/<?php echo $category->id; ?>" class="flex-1 bg-yellow-50 hover:bg-yellow-100 text-yellow-600 px-3 py-2 rounded text-sm text-center transition duration-200">
                                <i class="fas fa-edit"></i> Sửa
                            </a>
                            <a href="/webbanhang/category/delete/<?php echo $category->id; ?>" class="flex-1 bg-red-50 hover:bg-red-100 text-red-600 px-3 py-2 rounded text-sm text-center transition duration-200"
                                onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này?');">
                                <i class="fas fa-trash"></i> Xóa
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
<?php include 'app/views/shares/footer.php'; ?>