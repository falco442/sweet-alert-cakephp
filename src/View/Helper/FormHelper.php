<?php
namespace SweetAlertHelper\View\Helper;

use Cake\View\Helper\FormHelper as BaseHelper;

class FormHelper extends BaseHelper
{
    protected function _confirm($message, $okCode, $cancelCode = '', $options = [])
    {
        $swal = [
            'text' => $message,
            'showCancelButton' => true,
            'dangerMode' => true,
            'type' => 'error'
        ];
        $confirm = "(function(e,obj){ e.preventDefault(); e.stopPropagation(); swal(".json_encode($swal).").then(function(res){ if(res.value){ ".$okCode." } }); })(event,this)";
        
        // We cannot change the key here in 3.x, but the behavior is inverted in this case
        $escape = isset($options['escape']) && $options['escape'] === false;
        if ($escape) {
            $confirm = h($confirm);
        }
        
        return $confirm;
    }
    
    public function postLink($title, $url = null, array $options = [])
    {
        $options += ['block' => null, 'confirm' => null];
        
        $requestMethod = 'POST';
        if (!empty($options['method'])) {
            $requestMethod = strtoupper($options['method']);
            unset($options['method']);
        }
        
        $confirmMessage = $options['confirm'];
        unset($options['confirm']);
        
        $formName = str_replace('.', '', uniqid('post_', true));
        $formOptions = [
            'name' => $formName,
            'style' => 'display:none;',
            'method' => 'post',
        ];
        if (isset($options['target'])) {
            $formOptions['target'] = $options['target'];
            unset($options['target']);
        }
        $templater = $this->templater();
        
        $restoreAction = $this->_lastAction;
        $this->_lastAction($url);
        
        $action = $templater->formatAttributes(
            [
                'action' => $this->Url->build($url),
                'escape' => false
            ]
        );
        
        $out = $this->formatTemplate(
            'formStart', [
                'attrs' => $templater->formatAttributes($formOptions) . $action
            ]
        );
        $out .= $this->hidden(
            '_method', [
                'value' => $requestMethod,
                'secure' => static::SECURE_SKIP
            ]
        );
        $out .= $this->_csrfField();
        
        $fields = [];
        if (isset($options['data']) && is_array($options['data'])) {
            foreach (Hash::flatten($options['data']) as $key => $value) {
                $fields[$key] = $value;
                $out .= $this->hidden($key, ['value' => $value, 'secure' => static::SECURE_SKIP]);
            }
            unset($options['data']);
        }
        $out .= $this->secure($fields);
        $out .= $this->formatTemplate('formEnd', []);
        $this->_lastAction = $restoreAction;
        
        if ($options['block']) {
            if ($options['block'] === true) {
                $options['block'] = __FUNCTION__;
            }
            $this->_View->append($options['block'], $out);
            $out = '';
        }
        unset($options['block']);
        
        $url = '#';
        $onClick = 'document.' . $formName . '.submit();';
        if ($confirmMessage) {
            $options['onclick'] = $this->_confirm($confirmMessage, $onClick, '', $options);
        } else {
            $options['onclick'] = $onClick . ' ';
        }
        
        $out .= $this->Html->link($title, $url, $options);
        
        return $out;
    }
}
