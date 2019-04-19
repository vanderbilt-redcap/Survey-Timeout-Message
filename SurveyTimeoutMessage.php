<?php
namespace Vanderbilt\SurveyTimeoutMessage;

class SurveyTimeoutMessage extends \ExternalModules\AbstractExternalModule {
	function redcap_every_page_top($project_id) {
		global $surveys_enabled;
		global $survey_enabled;
		global $date_deleted;
		global $status;
		if (PAGE == 'surveys/index.php' && (!$surveys_enabled || $survey_enabled < 1 || $date_deleted != '' || $status == 2 || $status == 3)) {
			// see if there is a custom timeout message configured for this expired survey
			global $form_name;
			$settings = $this->getProjectSettings('surveys');
			foreach($settings['survey-name']['value'] as $i => $name) {
				if ($name == $form_name) {
					$customSurveyTimeoutMessage = $settings["timeout-message"]["value"][$i];
					break;
				}
			}
			
			// inject js to replace 2nd div html
			if (isset($customSurveyTimeoutMessage)) {
				echo <<<EOF
	<script type='text/javascript'>
		$(function() {
			$("body div:nth-child(2)").html("$customSurveyTimeoutMessage")
		});
	</script>
EOF;
			}
		}
	}
}