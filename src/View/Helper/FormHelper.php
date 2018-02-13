<?php
namespace SweetAlertHelper\View\Helper;

use Cake\View\Helper\FormHelper as BaseHelper;

class FormHelper extends FormHelper
{
	protected function _confirm($message, $okCode, $cancelCode = '', $options = []){
        $confirm = "if (confirm({$message})) { {$okCode} } {$cancelCode}";
		$swal = [
			'text'				=> $message,
			'showCancelButton'	=> true,
			'dangerMode'		=> true,
			'type'				=> 'error'
		];
		$confirm = "swal(".json_encode($swal).").then(function(res){ if(res){ {$okCode} } });";
        // We cannot change the key here in 3.x, but the behavior is inverted in this case
        $escape = isset($options['escape']) && $options['escape'] === false;
        if ($escape) {
            $confirm = h($confirm);
        }

        return $confirm;
    }
}
