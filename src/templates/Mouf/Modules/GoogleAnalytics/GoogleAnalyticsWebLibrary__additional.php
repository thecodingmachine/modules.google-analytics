<?php
if($object->getAccountKey()) {
?>
<script type="text/javascript">
//Google Analytics
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', '<?php echo addslashes($object->getAccountKey()) ?>']);
<?php 
	if ($object->getDomainName()) {
		echo "_gaq.push(['_setDomainName', '".addslashes($object->getDomainName())."']);";
		echo "_gaq.push(['_setAllowLinker', true]);";	
	}
?>
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<?php 
}
