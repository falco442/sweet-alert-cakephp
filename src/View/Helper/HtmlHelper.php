<?php
namespace SweetAlertHelper\View\Helper;

use Cake\View\Helper\HtmlHelper as BaseHelper;

class HtmlHelper extends BaseHelper
{
	protected function _confirm($message, $okCode, $cancelCode = '', $options = []){
		$swal = [
			'text'				=> $message,
			'showCancelButton'	=> true,
			'dangerMode'		=> true,
			'type'				=> 'error'
		];
		$confirm = "(function(e,obj){ e.preventDefault(); e.stopPropagation(); swal(".json_encode($swal).").then(function(res){ if(res.value){ window.location.href = obj.getAttribute('href'); } }); })(event,this)";

        // We cannot change the key here in 3.x, but the behavior is inverted in this case
        $escape = isset($options['escape']) && $options['escape'] === false;
        if ($escape) {
            $confirm = h($confirm);
        }

        return $confirm;
    }
}
