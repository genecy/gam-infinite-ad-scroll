<?php
$lastId = isset($_GET['lastId']) ? (int)$_GET['lastId'] : 0;
if ($lastId <= 0) {
	exit();
}
include(__DIR__ . '/config.php');
?>
<?php for ($i = 1; $i <= 2; $i++): ?><div class="item" data-id="<?php echo ($lastId + $i); ?>">
	<span class="img"></span>
	<a href="#"><?php echo sprintf('Title #%d', ($lastId + $i)); ?></a>
</div><?php endfor; ?>

<div class="dfpAd" id="<?php echo sprintf('ad-%s', uniqid()); ?>" style="<?php echo $config['adUnitStyle']; ?>"></div>