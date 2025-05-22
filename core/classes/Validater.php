<?

class Validater{
    protected $data = [];
    protected $errors =[];
    protected $validetors_list=['required','min','max','match'];
    protected $messages =[
        'required'=>':fieldname: обязятельное для заполнения',
        'min' => ':fieldname: должно содержать минимум :rulevalue: символов',
        'max' => ':fieldname: должно содержать максимум :rulevalue: символов',
    ];

    public function validate($data=[],$rules=[])
    {
        $this->data = $data;
        
        foreach($data as $fieldName => $value)
        {
            if(in_array($fieldName,array_keys($rules)))
            {
                $this->checkAndValidate([
                        'fieldname'=>$this->translateField($fieldName),
                        'value'=>$value,
                        'rules'=>$rules[$fieldName]
                ]);
            }
        }

        return $this;
    }

    protected function checkAndValidate(array $field)
    {
        foreach($field['rules'] as $rule_name =>$rule_value){
            if(in_array($rule_name,$this->validetors_list))
            {
                if(!call_user_func_array([$this,$rule_name],[$field['value'],$rule_value]))
                {
                    $this->addError(
                        $field['fieldname'],
                        str_replace([':fieldname:',':rulevalue:'],
                            [$field['fieldname'],$rule_value],
                            $this->messages[$rule_name])
                    );
                }
            }
        }
    }

    public function hasErrors()
    {
        return !empty($this->errors);
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function listErrors($fieldName)
    {
        $errors_list ='';

        if(isset($this->errors[$fieldName]))
        {
            $errors_list .= "<ul class='invalid-feedback d-block'>";

            foreach($this->errors[$fieldName] as $messages)
            {
                $errors_list .= "<li class='invalid-feedback d-block'>{$messages}</li>";
            }

            $errors_list .= '</ul>';
        }

        return $errors_list;
    }

    protected function addError($fieldName, $error)
    {
        $this->errors[$fieldName][] = $error;
    }

    protected function required($value,$rule_value)
    {
        return !empty($value);
    }

    protected function min($value, $rule_value)
    {
        return strl($value) >= $rule_value;
    }

    protected function max($value, $rule_value)
    {
        return strl($value) <= $rule_value;
    }

    protected function match($value, $rule_value)
    {
        return $value === $this->data[$rule_value];
    }

    private function translateField(string $fieldname)
    {
        switch($fieldname)
        {
            case 'due_date': return'Дата завершения'; 
            case 'title': return'Название'; 
            case 'description': return'Описание'; 
            case 'priority': return'Приоритет';
            case 'username': return 'Логин';
            case 'password': return 'Пароль';
        }
    }
}