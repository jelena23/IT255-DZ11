<?phpheader("Access-Control-Allow-Origin: *");header('Access-Control-Allow-Methods: POST');include("functions.php");if(isset($_POST[‘name']) &amp;&amp; isset($_POST[‘surname']) &amp;&amp;isset($_POST['username']) &amp;&amp; isset($_POST['password'])){$firstname = $_POST[‘name'];$lastname = $_POST[‘surname'];$username = $_POST['username'];$password = $_POST['password'];echo register($username,$password,$name,$surname);}?>