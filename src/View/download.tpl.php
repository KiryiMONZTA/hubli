<p>Your files are ready to download.</p>

<div class='btns'>
<?php foreach ($this::$downloadFiles as $file): ?>
    <a class='btn' download='<?=$file['name']?>' href='<?=$file['link']?>' title='Download file <?=$file['name']?>'>Download <?=$file['language']?> file</a>
<?php endforeach; ?>
</div>

<div class='log'>
<?php foreach ($this::$logMessages as $message): ?>
    <p><?=$message?></p>
<?php endforeach; ?>
</div>
