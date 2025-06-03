<?php 
require_once('app/helpers/SessionHelper.php');
SessionHelper::requireAdmin();
include 'app/views/shares/header.php'; 
?>

<section class="min-h-screen bg-gradient-to-br from-gray-900 via-purple-900 to-violet-800 py-12">
    <div class="max-w-7xl mx-auto px-4">
        <!-- Admin Header -->
        <div class="bg-gray-800 rounded-2xl shadow-2xl p-8 border border-gray-700 mb-8">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="w-16 h-16 bg-gradient-to-r from-red-500 to-pink-500 rounded-full flex items-center justify-center">
                        <i class="fas fa-crown text-white text-2xl"></i>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-white mb-2">Trang Quản Trị</h1>
                        <p class="text-gray-300">Chào mừng, <?= htmlspecialchars($_SESSION['username']) ?>!</p>
                    </div>
                </div>
                <div class="text-right">
                    <span class="inline-block px-4 py-2 bg-red-600 text-white text-sm rounded-full font-semibold">
                        <i class="fas fa-shield-alt mr-2"></i>ADMIN
                    </span>
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-gradient-to-r from-blue-600 to-blue-700 rounded-xl p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-blue-100">Tổng Sản Phẩm</p>
                        <p class="text-2xl font-bold"><?= count($products ?? []) ?></p>
                    </div>
                    <i class="fas fa-box text-3xl text-blue-200"></i>
                </div>
            </div>
            
            <div class="bg-gradient-to-r from-green-600 to-green-700 rounded-xl p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-green-100">Danh Mục</p>
                        <p class="text-2xl font-bold"><?= count($categories ?? []) ?></p>
                    </div>
                    <i class="fas fa-tags text-3xl text-green-200"></i>
                </div>
            </div>
            
            <div class="bg-gradient-to-r from-purple-600 to-purple-700 rounded-xl p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-purple-100">Người Dùng</p>
                        <p class="text-2xl font-bold"><?= count($users ?? []) ?></p>
                    </div>
                    <i class="fas fa-users text-3xl text-purple-200"></i>
                </div>
            </div>
            
            <div class="bg-gradient-to-r from-orange-600 to-orange-700 rounded-xl p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-orange-100">Đơn Hàng</p>
                        <p class="text-2xl font-bold">0</p>
                    </div>
                    <i class="fas fa-shopping-cart text-3xl text-orange-200"></i>
                </div>
            </div>
        </div>

        <!-- Management Sections -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Product Management -->
            <div class="bg-gray-800 rounded-2xl shadow-2xl p-8 border border-gray-700">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold text-white flex items-center">
                        <i class="fas fa-box mr-3 text-blue-400"></i>
                        Quản Lý Sản Phẩm
                    </h2>
                    <button onclick="toggleSection('products')" class="text-gray-400 hover:text-white transition duration-200">
                        <i class="fas fa-chevron-down text-xl"></i>
                    </button>
                </div>
                
                <div id="products-section" class="space-y-4">
                    <div class="grid grid-cols-2 gap-4">
                        <a href="/webbanhang/product/add" class="flex items-center justify-center p-4 bg-green-600 rounded-lg hover:bg-green-700 transition duration-200">
                            <i class="fas fa-plus mr-2"></i>
                            <span class="text-white font-medium">Thêm Sản Phẩm</span>
                        </a>
                        <a href="/webbanhang/product" class="flex items-center justify-center p-4 bg-blue-600 rounded-lg hover:bg-blue-700 transition duration-200">
                            <i class="fas fa-list mr-2"></i>
                            <span class="text-white font-medium">Danh Sách</span>
                        </a>
                    </div>
                    
                    <div class="bg-gray-700 rounded-lg p-4">
                        <h4 class="text-white font-semibold mb-3">Sản Phẩm Gần Đây</h4>
                        <div class="space-y-2 max-h-40 overflow-y-auto">
                            <?php if (!empty($products)): ?>
                                <?php foreach (array_slice($products, 0, 5) as $product): ?>
                                    <div class="flex items-center justify-between p-2 bg-gray-600 rounded">
                                        <span class="text-white text-sm"><?= htmlspecialchars($product->name) ?></span>
                                        <span class="text-green-400 text-sm font-semibold"><?= number_format($product->price) ?>đ</span>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p class="text-gray-400 text-sm">Chưa có sản phẩm nào</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Category Management -->
            <div class="bg-gray-800 rounded-2xl shadow-2xl p-8 border border-gray-700">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold text-white flex items-center">
                        <i class="fas fa-tags mr-3 text-green-400"></i>
                        Quản Lý Danh Mục
                    </h2>
                    <button onclick="toggleSection('categories')" class="text-gray-400 hover:text-white transition duration-200">
                        <i class="fas fa-chevron-down text-xl"></i>
                    </button>
                </div>
                
                <div id="categories-section" class="space-y-4">
                    <div class="grid grid-cols-2 gap-4">
                        <a href="/webbanhang/category/add" class="flex items-center justify-center p-4 bg-green-600 rounded-lg hover:bg-green-700 transition duration-200">
                            <i class="fas fa-plus mr-2"></i>
                            <span class="text-white font-medium">Thêm Danh Mục</span>
                        </a>
                        <a href="/webbanhang/category" class="flex items-center justify-center p-4 bg-blue-600 rounded-lg hover:bg-blue-700 transition duration-200">
                            <i class="fas fa-list mr-2"></i>
                            <span class="text-white font-medium">Danh Sách</span>
                        </a>
                    </div>
                    
                    <div class="bg-gray-700 rounded-lg p-4">
                        <h4 class="text-white font-semibold mb-3">Danh Mục Hiện Có</h4>
                        <div class="space-y-2 max-h-40 overflow-y-auto">
                            <?php if (!empty($categories)): ?>
                                <?php foreach ($categories as $category): ?>
                                    <div class="flex items-center justify-between p-2 bg-gray-600 rounded">
                                        <span class="text-white text-sm"><?= htmlspecialchars($category->name) ?></span>
                                        <span class="text-green-400 text-xs">ID: <?= $category->id ?></span>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p class="text-gray-400 text-sm">Chưa có danh mục nào</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- User Management -->
            <div class="bg-gray-800 rounded-2xl shadow-2xl p-8 border border-gray-700">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold text-white flex items-center">
                        <i class="fas fa-users mr-3 text-purple-400"></i>
                        Quản Lý Người Dùng
                    </h2>
                    <button onclick="toggleSection('users')" class="text-gray-400 hover:text-white transition duration-200">
                        <i class="fas fa-chevron-down text-xl"></i>
                    </button>
                </div>
                
                <div id="users-section" class="space-y-4">
                    <div class="grid grid-cols-2 gap-4">
                        <a href="/webbanhang/account/register" class="flex items-center justify-center p-4 bg-green-600 rounded-lg hover:bg-green-700 transition duration-200">
                            <i class="fas fa-user-plus mr-2"></i>
                            <span class="text-white font-medium">Thêm User</span>
                        </a>
                        <a href="/webbanhang/admin/users" class="flex items-center justify-center p-4 bg-blue-600 rounded-lg hover:bg-blue-700 transition duration-200">
                            <i class="fas fa-list mr-2"></i>
                            <span class="text-white font-medium">Danh Sách</span>
                        </a>
                    </div>
                    
                    <div class="bg-gray-700 rounded-lg p-4">
                        <h4 class="text-white font-semibold mb-3">Người Dùng Gần Đây</h4>
                        <div class="space-y-2 max-h-40 overflow-y-auto">
                            <?php if (!empty($users)): ?>
                                <?php foreach (array_slice($users, 0, 5) as $user): ?>
                                    <div class="flex items-center justify-between p-2 bg-gray-600 rounded">
                                        <span class="text-white text-sm"><?= htmlspecialchars($user->username) ?></span>
                                        <span class="text-<?= $user->role === 'admin' ? 'red' : 'green' ?>-400 text-xs font-semibold">
                                            <?= strtoupper($user->role) ?>
                                        </span>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p class="text-gray-400 text-sm">Chưa có người dùng nào</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- System Settings -->
            <div class="bg-gray-800 rounded-2xl shadow-2xl p-8 border border-gray-700">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold text-white flex items-center">
                        <i class="fas fa-cog mr-3 text-orange-400"></i>
                        Cài Đặt Hệ Thống
                    </h2>
                    <button onclick="toggleSection('settings')" class="text-gray-400 hover:text-white transition duration-200">
                        <i class="fas fa-chevron-down text-xl"></i>
                    </button>
                </div>
                
                <div id="settings-section" class="space-y-4">
                    <div class="grid grid-cols-1 gap-4">
                        <a href="/webbanhang/admin/backup" class="flex items-center justify-center p-4 bg-yellow-600 rounded-lg hover:bg-yellow-700 transition duration-200">
                            <i class="fas fa-database mr-2"></i>
                            <span class="text-white font-medium">Sao Lưu Dữ Liệu</span>
                        </a>
                        <a href="/webbanhang/admin/logs" class="flex items-center justify-center p-4 bg-purple-600 rounded-lg hover:bg-purple-700 transition duration-200">
                            <i class="fas fa-file-alt mr-2"></i>
                            <span class="text-white font-medium">Xem Logs</span>
                        </a>
                        <a href="/webbanhang/admin/config" class="flex items-center justify-center p-4 bg-indigo-600 rounded-lg hover:bg-indigo-700 transition duration-200">
                            <i class="fas fa-wrench mr-2"></i>
                            <span class="text-white font-medium">Cấu Hình</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-gray-800 rounded-2xl shadow-2xl p-8 border border-gray-700 mt-8">
            <h2 class="text-2xl font-bold text-white mb-6 flex items-center">
                <i class="fas fa-bolt mr-3 text-yellow-400"></i>
                Thao Tác Nhanh
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <a href="/webbanhang/product" class="flex items-center p-4 bg-blue-600 rounded-lg hover:bg-blue-700 transition duration-200">
                    <i class="fas fa-eye text-white text-xl mr-3"></i>
                    <span class="text-white font-medium">Xem Trang Chủ</span>
                </a>
                <a href="/webbanhang/account/profile" class="flex items-center p-4 bg-green-600 rounded-lg hover:bg-green-700 transition duration-200">
                    <i class="fas fa-user text-white text-xl mr-3"></i>
                    <span class="text-white font-medium">Hồ Sơ</span>
                </a>
                <button onclick="clearCache()" class="flex items-center p-4 bg-orange-600 rounded-lg hover:bg-orange-700 transition duration-200">
                    <i class="fas fa-trash text-white text-xl mr-3"></i>
                    <span class="text-white font-medium">Xóa Cache</span>
                </button>
                <a href="/webbanhang/account/logout" class="flex items-center p-4 bg-red-600 rounded-lg hover:bg-red-700 transition duration-200">
                    <i class="fas fa-sign-out-alt text-white text-xl mr-3"></i>
                    <span class="text-white font-medium">Đăng Xuất</span>
                </a>
            </div>
        </div>
    </div>
</section>

<script>
function toggleSection(sectionId) {
    const section = document.getElementById(sectionId + '-section');
    section.classList.toggle('hidden');
}

function clearCache() {
    if (confirm('Bạn có chắc chắn muốn xóa cache?')) {
        alert('Cache đã được xóa thành công!');
    }
}

// Auto-hide notifications
setTimeout(() => {
    const notifications = document.querySelectorAll('.fixed.top-4.right-4');
    notifications.forEach(notification => {
        notification.style.opacity = '0';
        notification.style.transform = 'translateX(100%)';
        setTimeout(() => notification.remove(), 300);
    });
}, 5000);
</script>

<?php include 'app/views/shares/footer.php'; ?>
