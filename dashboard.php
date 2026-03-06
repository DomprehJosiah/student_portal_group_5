<?php
session_start();

// Redirect to login if the person didn't actually sign in
if (!isset($_SESSION['is_logged_in'])) {
    header("Location: login.php");
    exit();
}

// Fetching the data you saved during Registration/Login
$fullName   = $_SESSION['full_name'];
$student_id = $_SESSION['student_id'];
$email      = $_SESSION['email'];
$profilePic = $_SESSION['profile_pic']; // This is the path to the file in /uploads
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KingLinks | Group 5 Dashboard</title>
    <link rel="stylesheet" href="assets/css/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
     <link rel="icon" type="image/png" href="assets/images/logo.png">
</head>
<body>

<header class="main-header">
    <nav class="navbar">
        <div class="nav-left">
            <div class="logo">
                <span class="logo-text">GROUP <span class="highlight">5</span></span>
            </div>
        </div>
        
        <div class="nav-center">
            <div class="search-container">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" placeholder="Search data...">
            </div>
        </div>

        <div class="nav-right">
            <a href="logout.php" class="btn-logout">
                <i class="fa-solid fa-power-off"></i> <span>Logout</span>
            </a>
        </div>
    </nav>
</header>



<div class="dashboard-wrapper">
    <nav class="sidebar">
        <div class="user-profile">
    <div class="profile-img">
        <?php if (!empty($_SESSION['profile_pic']) && file_exists($_SESSION['profile_pic'])): ?>
            <img src="<?php echo $_SESSION['profile_pic']; ?>" alt="Profile" style="width: 100%; height: 100%; border-radius: 50%; object-fit: cover;">
        <?php else: ?>
            <i class="fa-solid fa-user"></i>
        <?php endif; ?>
    </div>
    <h3><?php echo htmlspecialchars($_SESSION['full_name']); ?></h3>
    <p>ID: <?php echo htmlspecialchars($student_id); ?></p>
</div>

        <div class="sidebar-links">
            <a href="#" class="active"><i class="fa-solid fa-house"></i> Home</a>
            <a href="#"><i class="fa-solid fa-folder"></i> Student Classes</a>
            <a href="#"><i class="fa-solid fa-book"></i> Subjects</a>
            <a href="#"><i class="fa-solid fa-users"></i> Students</a>
            <a href="#"><i class="fa-solid fa-chart-simple"></i> Results</a>
            <a href="#"><i class="fa-solid fa-wallet"></i> Financials</a>
        </div>
    </nav>

    <main class="main-content">
        <div class="main-header-text">
            <h1>Dashboard, <?php echo $fullName; ?></h1>
        </div>
        
        <div class="stats-grid">
            <div class="stat-card accent-card">
                <div class="card-info">
                    <span class="label">Earning</span>
                    <span class="number">₵ 12,500</span>
                </div>
                <div class="card-icon"><i class="fa-solid fa-dollar-sign"></i></div>
            </div>

            <div class="stat-card">
                <div class="card-info">
                    <span class="label">Regd Users</span>
                    <span class="number">243</span>
                </div>
                <div class="card-icon orange-text"><i class="fa-solid fa-share-nodes"></i></div>
            </div>

            <div class="stat-card">
                <div class="card-info">
                    <span class="label">Likes</span>
                    <span class="number">1,259</span>
                </div>
                <div class="card-icon red-text"><i class="fa-solid fa-thumbs-up"></i></div>
            </div>

            <div class="stat-card">
                <div class="card-info">
                    <span class="label">Rating</span>
                    <span class="number">8.5</span>
                </div>
                <div class="card-icon gold-text"><i class="fa-solid fa-star"></i></div>
            </div>
        </div>

        <div class="content-row">
            <div class="large-card shadow-sm">
                <div class="card-header">
                    <span>Result Analysis</span>
                    <button class="check-btn">Check Now</button>
                </div>
                <div class="dummy-graph">
                    <div class="bar" style="height: 60%"></div>
                    <div class="bar" style="height: 80%"></div>
                    <div class="bar active-bar" style="height: 40%"></div>
                    <div class="bar" style="height: 90%"></div>
                    <div class="bar" style="height: 50%"></div>
                </div>
            </div>
        </div>
    </main>
</div>
</body>
</html>