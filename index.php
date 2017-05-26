<?php include(__DIR__ . '/config.php'); ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>DFP ads in infinite scroll page - Genecy.com</title>
<meta name="description" content="">
<link rel="stylesheet" href="main.css?v=1" />

<script type='text/javascript'>
var googletag = googletag || {};
googletag.cmd = googletag.cmd || [];
(function() {
  var gads = document.createElement('script');
  gads.async = true;
  gads.type = 'text/javascript';
  var useSSL = 'https:' == document.location.protocol;
  gads.src = (useSSL ? 'https:' : 'http:') +
	'//www.googletagservices.com/tag/js/gpt.js';
  var node = document.getElementsByTagName('script')[0];
  node.parentNode.insertBefore(gads, node);
})();
</script>

<script type='text/javascript'>
var adSlots = {};
googletag.cmd.push(function() {
  googletag.defineSlot('<?php echo $config['adUnitPath']; ?>', <?php echo $config['adUnitSize']; ?>, 'div-gpt-ad-1234567890000-0').addService(googletag.pubads());
  googletag.pubads().enableSingleRequest();
  googletag.pubads().collapseEmptyDivs();
  googletag.enableServices();
});
</script>

</head>
<body>
	
	<div id="page">
		
		<div id="header"><a href="https://www.genecy.com/">Genecy.com</a></div>
		
		<div id="cont">
			
			<div class="mainCol">
				<div class="items" id="items">
					
					<?php for ($i = 1; $i <= 2; $i++): ?><div class="item" data-id="<?php echo $i; ?>">
						<span class="img"></span>
						<a href="#"><?php echo sprintf('Title #%d', $i); ?></a>
					</div><?php endfor; ?>
					
					<!-- DFP adslot -->
					<div class="dfpAd" id='div-gpt-ad-1234567890000-0' style='<?php echo $config['adUnitStyle']; ?>'>
						<script type='text/javascript'>
						googletag.cmd.push(function() { googletag.display('div-gpt-ad-1234567890000-0'); });
						</script>
					</div>
					
					<div class="btnMoreBl"><a href="#" class="btnLoadMore">Load more</a></div>
					
				</div>
			</div>
			
			<div class="rightCol">
				<div style="width:300px;height:250px;background-color:#ccc;"></div>
			</div>
			
			<div class="clear">&nbsp;</div>
			
		</div>
		
	</div>
	
	<script src="https://code.jquery.com/jquery-1.12.3.min.js"></script>
	<script>
	function fillElementWithAd($el, slotCode, size, targeting) {
		if (typeof targeting === 'undefined') {
			targeting = {};
		}else if( Object.prototype.toString.call( targeting ) !== '[object Object]' ) {
			targeting = {};
		}
		var elId = $el.attr('id');
		googletag.cmd.push(function() {
			var slot = googletag.defineSlot(slotCode, size, elId);
			for (var t in targeting) {
				slot.setTargeting(t,targeting[t]);
			}
			slot.addService(googletag.pubads());
			googletag.display(elId);
			googletag.pubads().refresh([slot]);
		});
	}
		
	$(document).ready(function() {
		
		$('a.btnLoadMore').click(function(e) {
			e.preventDefault();
			var lastId = $('#items').children('.item:last').data('id');
			$.ajax({
				type: 'GET',
				url: 'loadMoreItems.ajax.php',
				data: {lastId: lastId}
			}).done(function(resp) {
				$('a.btnLoadMore').parent().before(resp);
				fillElementWithAd($('#items').children('.dfpAd:last'), '<?php echo $config['adUnitPath']; ?>', <?php echo $config['adUnitSize']; ?>, {});
			});
		});
		
	});
	</script>
	
</body>

</html>