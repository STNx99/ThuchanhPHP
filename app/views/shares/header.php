<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Ban Hang</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#6366F1',
                        secondary: '#EC4899',
                        accent: '#14B8A6'
                    },
                    fontFamily: {
                        'display': ['Inter', 'system-ui', 'sans-serif'],
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.5s ease-in-out',
                        'slide-down': 'slideDown 0.3s ease-out',
                        'bounce-subtle': 'bounceSubtle 0.6s ease-in-out'
                    }
                }
            }
        }
    </script>
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes bounceSubtle {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-4px); }
        }
        .glass-effect {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
    </style>
</head>

<body class="bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100 min-h-screen flex flex-col font-display">
    <nav class="bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 shadow-xl sticky top-0 z-50 border-b border-white/20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <div class="flex items-center">
                    <a class="text-3xl font-bold text-white hover:text-blue-100 transition-all duration-300 flex items-center group" href="/webbanhang/Product/">
                        <div class="w-12 h-12 mr-3 bg-white/20 rounded-xl flex items-center justify-center group-hover:bg-white/30 transition-all duration-300 group-hover:rotate-12">
                            <i class="fas fa-store text-xl"></i>
                        </div>
                        <span class="bg-gradient-to-r from-white to-blue-100 bg-clip-text text-transparent">
                            Web Bán Hàng
                        </span>
                    </a>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:block">
                    <div class="ml-10 flex items-center space-x-2">
                        <a href="/webbanhang/Product/" class="group relative text-white hover:text-blue-100 px-6 py-3 rounded-xl text-sm font-semibold transition-all duration-300 hover:bg-white/10 hover:shadow-lg hover:-translate-y-0.5">
                            <div class="flex items-center">
                                <i class="fas fa-box-open mr-2 group-hover:animate-bounce-subtle"></i>
                                Sản phẩm
                            </div>
                            <div class="absolute inset-0 rounded-xl bg-gradient-to-r from-blue-400/20 to-purple-400/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </a>
                        <a href="/webbanhang/Category/" class="group relative text-white hover:text-blue-100 px-6 py-3 rounded-xl text-sm font-semibold transition-all duration-300 hover:bg-white/10 hover:shadow-lg hover:-translate-y-0.5">
                            <div class="flex items-center">
                                <i class="fas fa-th-large mr-2 group-hover:animate-bounce-subtle"></i>
                                Danh mục
                            </div>
                            <div class="absolute inset-0 rounded-xl bg-gradient-to-r from-purple-400/20 to-pink-400/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </a>
                        <a href="/webbanhang/Product/Cart" class="group relative text-white hover:text-blue-100 px-6 py-3 rounded-xl text-sm font-semibold transition-all duration-300 hover:bg-white/10 hover:shadow-lg hover:-translate-y-0.5">
                            <div class="flex items-center">
                                <i class="fas fa-shopping-cart mr-2 group-hover:animate-bounce-subtle"></i>
                                Giỏ hàng
                            </div>
                            <div class="absolute inset-0 rounded-xl bg-gradient-to-r from-pink-400/20 to-red-400/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </a>
                        
                        <!-- User/Login Section -->
                        <?php if (isset($_SESSION['username'])): ?>
                            <div class="relative ml-4">
                                <button onclick="toggleUserMenu()" class="group flex items-center text-white hover:text-blue-100 px-6 py-3 rounded-xl text-sm font-semibold transition-all duration-300 hover:bg-white/10 hover:shadow-lg">
                                    <div class="w-8 h-8 bg-gradient-to-r from-blue-400 to-purple-400 rounded-full flex items-center justify-center mr-3">
                                        <i class="fas fa-user text-white text-sm"></i>
                                    </div>
                                    <?php echo htmlspecialchars($_SESSION['username'] ?? 'User'); ?>
                                    <i class="fas fa-chevron-down ml-2 group-hover:rotate-180 transition-transform duration-300"></i>
                                </button>
                                <div id="userDropdown" class="hidden absolute right-0 mt-3 w-56 bg-white glass-effect rounded-2xl shadow-2xl py-2 z-50 animate-slide-down">
                                    <a href="/webbanhang/account/profile" class="flex items-center px-6 py-3 text-sm text-black hover:bg-black/20 transition-all duration-200 rounded-xl mx-2">
                                        <i class="fas fa-user-circle mr-3 text-blue-300"></i>Thông tin cá nhân
                                    </a>
                                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                                    <a href="/webbanhang/account/admin" class="flex items-center px-6 py-3 text-sm text-red-400 hover:bg-red-500/20 transition-all duration-200 rounded-xl mx-2">
                                        <i class="fas fa-crown mr-3"></i>Admin
                                    </a>
                                    <?php endif; ?>
                                    <a href="/webbanhang/User/Orders" class="flex items-center px-6 py-3 text-sm text-black hover:bg-black/20 transition-all duration-200 rounded-xl mx-2">
                                        <i class="fas fa-shopping-bag mr-3 text-green-300"></i>Đơn hàng
                                    </a>
                                    <hr class="my-2 border-black/20 mx-4">
                                    <a href="/webbanhang/account/logout" class="flex items-center px-6 py-3 text-sm text-red-300 hover:bg-red-500/20 transition-all duration-200 rounded-xl mx-2">
                                        <i class="fas fa-sign-out-alt mr-3"></i>Đăng xuất
                                    </a>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="flex items-center space-x-3 ml-4">
                                <a href="/webbanhang/account/login" class="text-white hover:text-blue-100 px-6 py-3 rounded-xl text-sm font-semibold transition-all duration-300 hover:bg-white/10 border border-white/30">
                                    <i class="fas fa-sign-in-alt mr-2"></i>
                                    Đăng nhập
                                </a>
                                <a href="/webbanhang/account/register" class="bg-gradient-to-r from-yellow-400 to-orange-500 text-white px-6 py-3 rounded-xl text-sm font-semibold transition-all duration-300 hover:shadow-lg hover:-translate-y-0.5 hover:from-yellow-300 hover:to-orange-400">
                                    <i class="fas fa-user-plus mr-2"></i>
                                    Đăng ký
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                
                <!-- Mobile Menu Button -->
                <div class="md:hidden">
                    <button onclick="toggleMenu()" class="text-white hover:bg-white/20 p-3 rounded-xl transition-all duration-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile menu -->
        <div class="md:hidden hidden animate-slide-down" id="mobileMenu">
            <div class="px-4 pt-2 pb-6 space-y-2 glass-effect border-t border-white/20">
                <a href="/webbanhang/Product/" class="flex items-center text-white hover:bg-white/20 px-4 py-3 rounded-xl text-base font-medium transition-all duration-300">
                    <i class="fas fa-box-open mr-3"></i>
                    Sản phẩm
                </a>
                <a href="/webbanhang/Category/" class="flex items-center text-white hover:bg-white/20 px-4 py-3 rounded-xl text-base font-medium transition-all duration-300">
                    <i class="fas fa-th-large mr-3"></i>
                    Danh mục
                </a>
                <a href="/webbanhang/Product/Cart" class="flex items-center text-white hover:bg-white/20 px-4 py-3 rounded-xl text-base font-medium transition-all duration-300">
                    <i class="fas fa-shopping-cart mr-3"></i>
                    Giỏ hàng
                </a>
                
                <!-- Mobile User/Login Section -->
                <?php if (isset($_SESSION['username'])): ?>
                    <div class="border-t border-white/20 pt-4 mt-4">
                        <div class="flex items-center text-white px-4 py-2 text-sm bg-white/10 rounded-xl mb-3">
                            <div class="w-8 h-8 bg-gradient-to-r from-blue-400 to-purple-400 rounded-full flex items-center justify-center mr-3">
                                <i class="fas fa-user text-white text-sm"></i>
                            </div>
                            <?php echo htmlspecialchars($_SESSION['username'] ?? 'User'); ?>
                        </div>
                        <a href="/webbanhang/account/profile" class="flex items-center text-black hover:bg-white/20 px-4 py-3 rounded-xl text-base font-medium transition-all duration-300">
                            <i class="fas fa-user-circle mr-3"></i>Thông tin cá nhân
                        </a>
                        <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                        <a href="/webbanhang/account/admin" class="flex items-center text-red-400 hover:bg-red-500/20 px-4 py-3 rounded-xl text-base font-medium transition-all duration-300">
                            <i class="fas fa-crown mr-3"></i>Admin
                        </a>
                        <?php endif; ?>
                        <a href="/webbanhang/User/Orders" class="flex items-center text-black hover:bg-white/20 px-4 py-3 rounded-xl text-base font-medium transition-all duration-300">
                            <i class="fas fa-shopping-bag mr-3"></i>Đơn hàng
                        </a>
                        <a href="/webbanhang/account/logout" class="flex items-center text-red-300 hover:bg-red-500/20 px-4 py-3 rounded-xl text-base font-medium transition-all duration-300">
                            <i class="fas fa-sign-out-alt mr-3"></i>Đăng xuất
                        </a>
                    </div>
                <?php else: ?>
                    <div class="border-t border-white/20 pt-4 mt-4 space-y-2">
                        <a href="/webbanhang/account/login" class="flex items-center text-white hover:bg-white/20 px-4 py-3 rounded-xl text-base font-medium transition-all duration-300 border border-white/30">
                            <i class="fas fa-sign-in-alt mr-3"></i>Đăng nhập
                        </a>
                        <a href="/webbanhang/account/register" class="flex items-center bg-gradient-to-r from-yellow-400 to-orange-500 text-white px-4 py-3 rounded-xl text-base font-medium transition-all duration-300">
                            <i class="fas fa-user-plus mr-3"></i>Đăng ký
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </nav>
    <main class="flex-grow">
        <script>
            function toggleMenu() {
                const mobileMenu = document.getElementById('mobileMenu');
                mobileMenu.classList.toggle('hidden');
            }
            
            function toggleUserMenu() {
                const userDropdown = document.getElementById('userDropdown');
                userDropdown.classList.toggle('hidden');
            }
            
            document.addEventListener('click', function(event) {
                const mobileMenu = document.getElementById('mobileMenu');
                const userDropdown = document.getElementById('userDropdown');
                const button = event.target.closest('button');
                
                if (!button && !mobileMenu.contains(event.target)) {
                    mobileMenu.classList.add('hidden');
                }
                
                if (!event.target.closest('[onclick="toggleUserMenu()"]') && userDropdown && !userDropdown.contains(event.target)) {
                    userDropdown.classList.add('hidden');
                }
            });
        </script>
</body>

</html>