<?php

    session_start();

    $_SESSION['periode'] = $_GET['periode'];

    
?>
<script>
    history.back();
</script>