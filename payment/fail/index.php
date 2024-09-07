<?php
session_start();
?>
<script>
document.location.href="https://globaltrend.am<?php echo $_SESSION['redir'];?>?op=fail";
</script>