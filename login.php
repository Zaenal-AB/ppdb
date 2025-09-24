<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen p-6">
    <div class="bg-white flex flex-col md:flex-row rounded-2xl shadow-xl overflow-hidden max-w-4xl w-full">

        <!-- Left side: Illustration -->
        <div class="md:w-1/2 bg-gray-100 flex items-center justify-center p-6">
            <img src="assets/register.png" alt="Illustration" class="w-full h-auto object-contain">
        </div>

        <!-- Right side: Login Form -->
        <div class="md:w-1/2 p-8 flex flex-col justify-center">
            <h2 class="text-3xl font-bold text-gray-800 mb-6">Login Admin PPDB</h2>

            <form class="space-y-4">
                <div>
                    <label for="email" class="block text-gray-700 font-medium mb-1">Username</label>
                    <input type="text" id="email" placeholder="Username"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>

                <div>
                    <label for="password" class="block text-gray-700 font-medium mb-1">Password</label>
                    <input type="password" id="password" placeholder="********"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>

                <button type="submit"
                    class="w-full bg-blue-600 text-white py-2 rounded-lg font-semibold hover:bg-blue-700 transition-colors">
                    <a href="dashboard.php">Login</a>
                </button>
            </form> 

        </div>
    </div>
</body>

</html>