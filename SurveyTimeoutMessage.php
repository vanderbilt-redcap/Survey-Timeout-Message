<?php
namespace Vanderbilt\SurveyTimeoutMessage;

class SurveyTimeoutMessage extends \ExternalModules\AbstractExternalModule {
	function redcap_every_page_top() {
		if (PAGE == "surveys/index.php") {
			$msg = $this->getProjectSetting('timeout-message');
			echo <<<EOF
	<script type='text/javascript'>
		$(function() {
			$("body div:nth-child(2)").html("$msg")
		});
	</script>
EOF;
		}
	}
}