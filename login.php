<?php session_start();

// membatasi halaman sudah login
if (isset($_SESSION['login'])) {
    header('Location:dashboard.php');
    exit();
}

include(__DIR__ . '/config/app.php');


//mengecek apakah tombol login di tekan
if (isset($_POST['login'])) {
    //mengambil data dari form login
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    //check username
    $result = mysqli_query($conn, "SELECT * FROM data_akun WHERE username = '$username'");

    // jika ada username
    if (mysqli_num_rows($result) == 1) {
        //check password tanpa hash
        $row = mysqli_fetch_assoc($result);
        if ($password === $row['password']) {
            //set session
            $_SESSION['login']    = true;
            $_SESSION['id']       = $row['id'];
            $_SESSION['nama']     = $row['nama'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['identit4s']    = $row['identit4s'];
            header("Location: dashboard.php");
            exit;
        }
    }
    $error = true;
}


?>


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

            <form class="space-y-4" action="" method="POST">

                <?php if (isset($error)) : ?>
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <b>Username/password anda salah</b>
                    </div>
                <?php endif; ?>
                <div>
                    <label for="email" class="block text-gray-700 font-medium mb-1">Username</label>
                    <input type="text" id="email" placeholder="Username" name="username"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>

                <div>
                    <label for="password" class="block text-gray-700 font-medium mb-1">Password</label>
                    <input type="password" id="password" placeholder="********" name="password"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>

                <button type="submit" name="login"
                    class="w-full bg-blue-600 text-white py-2 rounded-lg font-semibold hover:bg-blue-700 transition-colors">
                    Login
                </button>
            </form>

        </div>
    </div>
</body>

</html>