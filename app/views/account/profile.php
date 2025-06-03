<?php include 'app/views/shares/header.php'; ?>

<?php
if (!isset($_SESSION['username'])) {
    header('Location: /webbanhang/account/login');
    exit;
}

if (isset($success)) {
    echo "<div class='fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50'>$success</div>";
}

if (isset($errors)) {
    echo "<div class='fixed top-4 right-4 bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg z-50'>";
    foreach ($errors as $err) {
        echo "<div>$err</div>";
    }
    echo "</div>";
}
?>

<section class="min-h-screen bg-gradient-to-br from-gray-900 via-purple-900 to-violet-800 py-12">
    <div class="max-w-4xl mx-auto px-4">
        <!-- Profile Header -->
        <div class="bg-gray-800 rounded-2xl shadow-2xl p-8 border border-gray-700 mb-8">
            <div class="flex items-center space-x-6">
                <div class="w-24 h-24 bg-gradient-to-r from-purple-500 to-pink-500 rounded-full flex items-center justify-center">
                    <i class="fas fa-user text-white text-3xl"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-bold text-white mb-2"><?= htmlspecialchars($user->fullname ?? 'User') ?></h1>
                    <p class="text-gray-300">@<?= htmlspecialchars($user->username ?? 'username') ?></p>
                    <span class="inline-block px-3 py-1 bg-purple-600 text-white text-sm rounded-full mt-2">
                        <?= ucfirst($user->role ?? 'user') ?>
                    </span>
                </div>
            </div>
        </div>

        <div class="grid md:grid-cols-2 gap-8">
            <!-- View Profile -->
            <div class="bg-gray-800 rounded-2xl shadow-2xl p-8 border border-gray-700">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold text-white">Thông tin cá nhân</h2>
                    <button onclick="toggleEdit()" class="text-purple-400 hover:text-purple-300 transition duration-200">
                        <i class="fas fa-edit text-xl"></i>
                    </button>
                </div>

                <div class="space-y-4">
                    <div class="border-b border-gray-700 pb-4">
                        <label class="block text-gray-400 text-sm mb-1">Tên đăng nhập</label>
                        <p class="text-white font-medium"><?= htmlspecialchars($user->username ?? '') ?></p>
                    </div>
                    <div class="border-b border-gray-700 pb-4">
                        <label class="block text-gray-400 text-sm mb-1">Họ và tên</label>
                        <p class="text-white font-medium"><?= htmlspecialchars($user->fullname ?? '') ?></p>
                    </div>
                    <div class="border-b border-gray-700 pb-4">
                        <label class="block text-gray-400 text-sm mb-1">Vai trò</label>
                        <p class="text-white font-medium"><?= ucfirst($user->role ?? 'user') ?></p>
                    </div>
                    <div class="border-b border-gray-700 pb-4">
                        <label class="block text-gray-400 text-sm mb-1">Ngày tạo tài khoản</label>
                        <p class="text-white font-medium"><?= isset($user->created_at) ? date('d/m/Y', strtotime($user->created_at)) : 'N/A' ?></p>
                    </div>
                </div>
            </div>

            <!-- Edit Profile -->
            <div id="editForm" class="bg-gray-800 rounded-2xl shadow-2xl p-8 border border-gray-700 hidden">
                <h2 class="text-2xl font-bold text-white mb-6">Chỉnh sửa thông tin</h2>
                
                <form action="/webbanhang/account/updateProfile" method="post">
                    <div class="space-y-6">
                        <div class="relative">
                            <input type="text" 
                                   name="fullname" 
                                   value="<?= htmlspecialchars($user->fullname ?? '') ?>"
                                   class="w-full px-4 py-3 bg-transparent border-2 border-gray-600 rounded-lg text-white placeholder-gray-400 focus:border-purple-500 focus:ring-2 focus:ring-purple-500 focus:ring-opacity-50 outline-none transition duration-200" 
                                   placeholder=" " />
                            <label class="absolute left-4 -top-2.5 bg-gray-800 px-2 text-sm text-gray-300">Họ và tên</label>
                        </div>
                        
                        <div class="relative">
                            <input type="password" 
                                   name="current_password" 
                                   class="w-full px-4 py-3 bg-transparent border-2 border-gray-600 rounded-lg text-white placeholder-gray-400 focus:border-purple-500 focus:ring-2 focus:ring-purple-500 focus:ring-opacity-50 outline-none transition duration-200" 
                                   placeholder=" " />
                            <label class="absolute left-4 -top-2.5 bg-gray-800 px-2 text-sm text-gray-300">Mật khẩu hiện tại</label>
                        </div>
                        
                        <div class="relative">
                            <input type="password" 
                                   name="new_password" 
                                   class="w-full px-4 py-3 bg-transparent border-2 border-gray-600 rounded-lg text-white placeholder-gray-400 focus:border-purple-500 focus:ring-2 focus:ring-purple-500 focus:ring-opacity-50 outline-none transition duration-200" 
                                   placeholder=" " />
                            <label class="absolute left-4 -top-2.5 bg-gray-800 px-2 text-sm text-gray-300">Mật khẩu mới (để trống nếu không đổi)</label>
                        </div>
                        
                        <div class="relative">
                            <input type="password" 
                                   name="confirm_password" 
                                   class="w-full px-4 py-3 bg-transparent border-2 border-gray-600 rounded-lg text-white placeholder-gray-400 focus:border-purple-500 focus:ring-2 focus:ring-purple-500 focus:ring-opacity-50 outline-none transition duration-200" 
                                   placeholder=" " />
                            <label class="absolute left-4 -top-2.5 bg-gray-800 px-2 text-sm text-gray-300">Xác nhận mật khẩu mới</label>
                        </div>
                    </div>
                    
                    <div class="flex space-x-4 mt-6">
                        <button type="submit" 
                                class="flex-1 bg-transparent border-2 border-purple-500 text-purple-400 font-semibold py-3 px-6 rounded-lg hover:bg-purple-500 hover:text-white transform hover:scale-105 transition duration-200">
                            Cập nhật
                        </button>
                        <button type="button" 
                                onclick="toggleEdit()"
                                class="flex-1 bg-transparent border-2 border-gray-500 text-gray-400 font-semibold py-3 px-6 rounded-lg hover:bg-gray-500 hover:text-white transform hover:scale-105 transition duration-200">
                            Hủy
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-gray-800 rounded-2xl shadow-2xl p-8 border border-gray-700 mt-8">
            <h2 class="text-2xl font-bold text-white mb-6">Thao tác nhanh</h2>
            <div class="grid grid-cols-1 md:grid-cols-<?= isset($_SESSION['role']) && $_SESSION['role'] === 'admin' ? '4' : '3' ?> gap-4">
                <a href="/webbanhang/product" class="flex items-center p-4 bg-blue-600 rounded-lg hover:bg-blue-700 transition duration-200">
                    <i class="fas fa-shopping-bag text-white text-xl mr-3"></i>
                    <span class="text-white font-medium">Xem sản phẩm</span>
                </a>
                <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                <a href="/webbanhang/account/admin" class="flex items-center p-4 bg-gradient-to-r from-red-600 to-pink-600 rounded-lg hover:from-red-700 hover:to-pink-700 transition duration-200">
                    <i class="fas fa-crown text-white text-xl mr-3"></i>
                    <span class="text-white font-medium">Quản trị</span>
                </a>
                <?php endif; ?>
                <a href="/webbanhang/account/profile" class="flex items-center p-4 bg-green-600 rounded-lg hover:bg-green-700 transition duration-200">
                    <i class="fas fa-user text-white text-xl mr-3"></i>
                    <span class="text-white font-medium">Hồ sơ</span>
                </a>
                <a href="/webbanhang/account/logout" class="flex items-center p-4 bg-red-600 rounded-lg hover:bg-red-700 transition duration-200">
                    <i class="fas fa-sign-out-alt text-white text-xl mr-3"></i>
                    <span class="text-white font-medium">Đăng xuất</span>
                </a>
            </div>
        </div>
    </div>
</section>

<script>
function toggleEdit() {
    const editForm = document.getElementById('editForm');
    editForm.classList.toggle('hidden');
}

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
