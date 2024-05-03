session_start();
if(isset($_SESSION['ID']))
{

}
else
{
    header("Location: login.php");
}