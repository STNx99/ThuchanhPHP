<?php include 'app/views/shares/header.php'; ?>

<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 relative overflow-hidden">
    <!-- Background Elements -->
    <div class="absolute inset-0 z-0">
        <div class="absolute top-1/4 left-1/4 w-72 h-72 bg-gradient-to-r from-blue-400/20 to-purple-400/20 rounded-full blur-3xl"></div>
        <div class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-gradient-to-r from-pink-400/20 to-red-400/20 rounded-full blur-3xl"></div>
    </div>
    
    <div class="max-w-md w-full space-y-8 relative z-10">
        <div class="bg-white/70 backdrop-blur-lg rounded-3xl shadow-2xl p-10 border border-white/50">
            <!-- Icon Container -->
            <div class="text-center mb-8">
                <div class="mx-auto w-24 h-24 bg-gradient-to-r from-red-500 to-pink-600 rounded-full flex items-center justify-center mb-6 shadow-lg">
                    <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center">
                        <i class="fas fa-shield-alt text-red-500 text-2xl"></i>
                    </div>
                </div>
                <div class="space-y-2">
                    <h1 class="text-3xl font-bold text-gray-800 mb-2">Truy cập bị từ chối</h1>
                    <div class="w-24 h-1 bg-gradient-to-r from-red-500 to-pink-500 mx-auto rounded-full"></div>
                </div>
            </div>

            <!-- Message -->
            <div class="text-center mb-8">
                <div class="bg-red-50 border-l-4 border-red-500 p-6 rounded-lg mb-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-exclamation-triangle text-red-500 text-lg"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-red-700 font-medium">Không có quyền truy cập</p>
                        </div>
                    </div>
                </div>
                
                <p class="text-gray-600 leading-relaxed mb-6">
                    Xin lỗi, bạn không có quyền truy cập vào trang này. 
                    Vui lòng liên hệ quản trị viên nếu bạn cho rằng đây là lỗi hệ thống.
                </p>
                
                <!-- Additional Info -->
                <div class="bg-blue-50 rounded-lg p-4 mb-6">
                    <div class="flex text-blue-700">
                        <i class="fas fa-info-circle mr-2"></i>
                        <span class="text-sm font-medium">Bạn có thể thử các hành động sau:</span>
                    </div>
                    <ul class="text-sm text-blue-600 mt-2 text-start space-y-1">
                        <li>• Kiểm tra lại quyền truy cập của bạn</li>
                        <li>• Liên hệ với quản trị viên hệ thống</li>
                        <li>• Quay lại trang trước đó</li>
                    </ul>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4">
                <button onclick="history.back()" class="flex-1 group relative px-6 py-3 bg-gradient-to-r from-gray-500 to-gray-600 text-white font-semibold rounded-xl transition-all duration-300 hover:from-gray-400 hover:to-gray-500 hover:shadow-lg hover:-translate-y-0.5">
                    <span class="flex items-center justify-center">
                        <i class="fas fa-arrow-left mr-2 group-hover:-translate-x-1 transition-transform duration-300"></i>
                        Quay lại
                    </span>
                </button>
                
                <a href="/" class="flex-1 group relative px-6 py-3 bg-gradient-to-r from-blue-500 to-blue-600 text-white font-semibold rounded-xl transition-all duration-300 hover:from-blue-400 hover:to-blue-500 hover:shadow-lg hover:-translate-y-0.5">
                    <span class="flex items-center justify-center">
                        <i class="fas fa-home mr-2 group-hover:scale-110 transition-transform duration-300"></i>
                        Trang chủ
                    </span>
                </a>
            </div>

            <!-- Contact Support -->
            <div class="mt-8 pt-6 border-t border-gray-200">
                <p class="text-center text-sm text-gray-500 mb-4">Cần hỗ trợ?</p>
                <div class="flex justify-center space-x-6">
                    <a href="mailto:support@webbanhang.com" class="flex items-center text-blue-600 hover:text-blue-700 transition-colors duration-200">
                        <i class="fas fa-envelope mr-2"></i>
                        <span class="text-sm">Email</span>
                    </a>
                    <a href="tel:+84123456789" class="flex items-center text-green-600 hover:text-green-700 transition-colors duration-200">
                        <i class="fas fa-phone mr-2"></i>
                        <span class="text-sm">Hotline</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'app/views/shares/footer.php'; ?>