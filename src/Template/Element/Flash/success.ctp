<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>

<div class="alert alert-primary" role="alert" onclick="this.classList.add('hidden')">
    <strong>Heads up!</strong> <?= $message ?>
</div>

