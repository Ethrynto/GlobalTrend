<?php
session_start();
?>
<script>
document.location.href="https://globaltrend.am<?php echo $_SESSION['redir'];?>";
</script>