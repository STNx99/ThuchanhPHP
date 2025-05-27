<?php include 'app/views/shares/header.php'; ?>

<div class="container mx-auto px-4 py-8">
    <nav class="mb-8" aria-label="breadcrumb">
        <ol class="flex items-center space-x-2 text-sm">
            <li><a href="/webbanhang/product" class="text-blue-600 hover:text-blue-800">Sản phẩm</a></li>
            <li class="text-gray-500">/</li>
            <li class="text-gray-700 font-medium">Sửa sản phẩm</li>
        </ol>
    </nav>

    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-lg shadow-xl overflow-hidden">
            <div class="bg-blue-600 text-white p-6">
                <h1 class="text-2xl font-bold">Sửa sản phẩm</h1>
            </div>
            <div class="p-8">
                <?php if (!empty($errors)): ?>
                    <div class="bg-red-50 border-l-4 border-red-400 p-4 mb-6">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-exclamation-circle text-red-400"></i>
                            </div>
                            <div class="ml-3">
                                <ul class="text-sm text-red-700 space-y-1">
                                    <?php foreach ($errors as $error): ?>
                                        <li><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <form method="POST" action="/webbanhang/Product/update" onsubmit="return validateForm();" enctype="multipart/form-data" class="space-y-6">
                    <input type="hidden" name="id" value="<?php echo $product->id; ?>">
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Tên sản phẩm:</label>
                            <input type="text" id="name" name="name" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200" 
                                   value="<?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?>" required>
                        </div>
                        
                        <div>
                            <label for="price" class="block text-sm font-medium text-gray-700 mb-2">Giá (VNĐ):</label>
                            <input type="number" id="price" name="price" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200" 
                                   step="0.01" value="<?php echo htmlspecialchars($product->price, ENT_QUOTES, 'UTF-8'); ?>" required>
                        </div>
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Mô tả:</label>
                        <textarea id="description" name="description" 
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200" 
                                  rows="5" required><?php echo htmlspecialchars($product->description, ENT_QUOTES, 'UTF-8'); ?></textarea>
                    </div>

                    <div>
                        <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">Danh mục:</label>
                        <select id="category_id" name="category_id" 
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200" required>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?php echo $category->id; ?>" <?php echo $category->id == $product->category_id ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($category->name, ENT_QUOTES, 'UTF-8'); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Hình ảnh sản phẩm:</label>
                        <?php if (!empty($product->image_url)): ?>
                            <div class="mb-4">
                                <img src="<?php echo htmlspecialchars($product->image_url, ENT_QUOTES, 'UTF-8'); ?>" 
                                     alt="<?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?>" 
                                     class="w-48 h-48 object-cover rounded-lg shadow-md">
                            </div>
                        <?php endif; ?>
                        <label for="product_image" class="block text-sm font-medium text-gray-700 mb-2">Cập nhật hình ảnh:</label>
                        <input type="file" id="product_image" name="product_image" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200" 
                               accept="image/*">
                        <?php if (!empty($product->image_url)): ?>
                            <p class="text-sm text-gray-500 mt-2">Để trống nếu không muốn thay đổi ảnh</p>
                        <?php endif; ?>
                    </div>

                    <div class="flex flex-col md:flex-row justify-between gap-4 pt-6 border-t border-gray-200">
                        <a href="/webbanhang/Product/list" class="inline-flex items-center justify-center px-6 py-3 bg-gray-500 text-white font-semibold rounded-lg hover:bg-gray-600 transition duration-200">
                            <i class="fas fa-arrow-left mr-2"></i>Quay lại danh sách sản phẩm
                        </a>
                        <button type="submit" class="inline-flex items-center justify-center px-8 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition duration-200">
                            <i class="fas fa-save mr-2"></i>Lưu thay đổi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="justify-between">
    <?php include 'app/views/shares/footer.php'; ?>
</div>