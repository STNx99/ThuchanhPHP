<?php include 'app/views/shares/header.php'; ?>
<div class="max-w-4xl mx-auto px-4 py-6">
    <nav class="flex mb-6" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="/webbanhang/category" class="text-blue-600 hover:text-blue-800">Danh mục</a>
            </li>
            <li>
                <div class="flex items-center">
                    <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                    <span class="text-gray-500"><?php echo htmlspecialchars($category->name, ENT_QUOTES, 'UTF-8'); ?></span>
                </div>
            </li>
        </ol>
    </nav>

    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        <div class="bg-blue-500 text-white px-6 py-4 rounded-t-lg">
            <h1 class="text-2xl font-semibold"><?php echo htmlspecialchars($category->name, ENT_QUOTES, 'UTF-8'); ?></h1>
        </div>
        <div class="p-6">
            <h5 class="text-lg font-medium text-gray-900 mb-4">Chi tiết danh mục</h5>
            <div class="p-4 bg-gray-50 rounded-lg mb-6">
                <p class="font-medium text-gray-700 mb-2">Mô tả:</p>
                <p class="text-gray-600"><?php echo htmlspecialchars($category->description, ENT_QUOTES, 'UTF-8'); ?></p>
            </div>
            
            <div class="flex flex-col md:flex-row gap-3">
                <a href="/webbanhang/category" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg flex items-center justify-center space-x-2 transition duration-200">
                    <i class="fas fa-arrow-left"></i>
                    <span>Quay lại danh sách</span>
                </a>
                <a href="/webbanhang/category/edit/<?php echo $category->id; ?>" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg flex items-center justify-center space-x-2 transition duration-200">
                    <i class="fas fa-edit"></i>
                    <span>Sửa danh mục</span>
                </a>
                <a href="/webbanhang/category/delete/<?php echo $category->id; ?>" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg flex items-center justify-center space-x-2 transition duration-200"
                   onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này?');">
                    <i class="fas fa-trash"></i>
                    <span>Xóa danh mục</span>
                </a>
            </div>
        </div>
    </div>
</div>
<?php include 'app/views/shares/footer.php'; ?>