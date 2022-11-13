<?php
if(isset($_COOKIE['homsusername'])) {
  unset($_COOKIE['homsusername']);
  setcookie('homsusername', '', time() - 3600); // empty value and old timestamp
}
echo"<script type=\"text/javascript\">
 window.location.assign(\"index.php\")
</script>";
?>