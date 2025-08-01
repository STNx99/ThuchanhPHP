<?php include 'app/views/shares/header.php'; ?>
<section class="min-h-screen bg-gradient-to-br from-gray-900 via-purple-900 to-violet-800 flex items-center justify-center py-12">
    <div class="max-w-md w-full mx-4">
        <div class="bg-gray-800 rounded-2xl shadow-2xl p-8 border border-gray-700">
            <form action="/webbanhang/account/checklogin" method="post">
                <div class="text-center mb-8">
                    <h2 class="text-3xl font-bold text-white mb-2 uppercase tracking-wide">Login</h2>
                    <p class="text-gray-300 mb-6">Please enter your login and password!</p>
                </div>
                
                <div class="space-y-6">
                    <div class="relative">
                        <input type="text" 
                               name="username" 
                               class="w-full px-4 py-3 bg-transparent border-2 border-gray-600 rounded-lg text-white placeholder-gray-400 focus:border-purple-500 focus:ring-2 focus:ring-purple-500 focus:ring-opacity-50 outline-none transition duration-200" 
                               placeholder=" " />
                        <label class="absolute left-4 -top-2.5 bg-gray-800 px-2 text-sm text-gray-300">UserName</label>
                    </div>
                    
                    <div class="relative">
                        <input type="password" 
                               name="password" 
                               class="w-full px-4 py-3 bg-transparent border-2 border-gray-600 rounded-lg text-white placeholder-gray-400 focus:border-purple-500 focus:ring-2 focus:ring-purple-500 focus:ring-opacity-50 outline-none transition duration-200" 
                               placeholder=" " />
                        <label class="absolute left-4 -top-2.5 bg-gray-800 px-2 text-sm text-gray-300">Password</label>
                    </div>
                </div>
                
                <div class="mt-6">
                    <a href="#!" class="text-gray-400 text-sm hover:text-purple-400 transition duration-200">Forgot password?</a>
                </div>
                
                <button type="submit" 
                        class="w-full mt-6 bg-transparent border-2 border-purple-500 text-purple-400 font-semibold py-3 px-6 rounded-lg hover:bg-purple-500 hover:text-white transform hover:scale-105 transition duration-200">
                    Login
                </button>
                
                <div class="flex justify-center space-x-6 mt-6">
                    <a href="#!" class="text-gray-400 hover:text-purple-400 transition duration-200">
                        <i class="fab fa-facebook-f text-xl"></i>
                    </a>
                    <a href="#!" class="text-gray-400 hover:text-purple-400 transition duration-200">
                        <i class="fab fa-twitter text-xl"></i>
                    </a>
                    <a href="#!" class="text-gray-400 hover:text-purple-400 transition duration-200">
                        <i class="fab fa-google text-xl"></i>
                    </a>
                </div>
                
                <div class="text-center mt-8">
                    <p class="text-gray-300">Don't have an account? 
                        <a href="/webbanhang/account/register" class="text-purple-400 font-semibold hover:text-purple-300 transition duration-200">Sign Up</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</section>

<?php include 'app/views/shares/footer.php'; ?>