<header>
<style>
.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 50px;
}

.container .service {
    font-size: 50px;
    font-weight: bolder;
    color: #2C7373;
    margin: 10px;
}

.search:focus-within{
    box-shadow: 0 0 5px #012E40;
}


header {
    background-color: #ffffff;
    padding: 20px 30px;
}

.logo {
    display: flex;
    align-items: center;
}

.title {
    margin-left: 10px;
    color: #2C7373;
}

.logo img {
    height: 60px;
}

.container .user-actions {
    margin-left: auto;
    display: flex;
}

.container .user-actions .login-btn {
    border-radius: 50px 0 0 50px;
}

.container .user-actions .signup-btn {
    border-radius: 0 50px 50px 0;
}

button {
    cursor: pointer;
    padding: 14px 35px;
    border: none;
    background-color: #2C7373;
    color: #fff;
    font-weight: bold;
    transition: background-color 0.3s;
}

button:hover {
    background-color: #012E40;
}


</style>
    <div class="container">
        <div class="logo">
            <img src="images/logo.png" alt="Service Finder Logo">
            <h1 class="title">Miagao Service Finder</h1>
            <?php 
            if(isset($_SESSION["id"])){
                echo '<div class="user-actions">
                        <a href="userProfile.php"><button class="login-btn" id="account" type="submit" >ACCOUNT</button></a>
                        <a href="logout.php"><button class="signup-btn" id="logout" type="submit">LOG OUT</button></a> 
                    </div>';
            }else{
                echo '<div class="user-actions">
                        <a href="login.php"><button class="login-btn">LOGIN</button></a>
                        <a href="signup.php"><button class="signup-btn">SIGN UP</button></a>
                    </div>';
            }
            ?>
        </div>
    </div>
</header>