<input type="hidden" name="cargo_rate" id="cargoRate">

<input type="hidden" name="utm_source" value="<?php echo $_GET['utm_source'] ?? null;?>">
<input type="hidden" name="utm_medium" value="<?php echo $_GET['utm_medium'] ?? null;?>">
<input type="hidden" name="utm_campaign" value="<?php echo $_GET['utm_campaign'] ?? null;?>">
<input type="hidden" name="utm_term" value="<?php echo $_GET['utm_term'] ?? null;?>">
<input type="hidden" name="utm_content" value="<?php echo $_GET['utm_content'] ?? null;?>">
<input type="hidden" name="utm_referrer" value="<?php echo $_SERVER['HTTP_REFERER'] ?? null;?>">
<input type="hidden" name="utm_user_ip" value="<?php echo get_server_user_ip($_SERVER);?>">