<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;

class Input extends Component
{
    
    public $label;
    public $name;
    public $value;
    public $type;
    public $isRequired;
    public $textarea;
    public $isDate;
    public $placeholder;
    public $classField;
    public $classLabel;

    public function __construct($label, $name, $placeholder = '', $value = '', $classField = 'col-lg-10 col-md-9', $classLabel = 'col-lg-2 col-md-3', $type = 'text', $isRequired = false, $textarea = false, $isDate = false)
    {
        $this->label = $label;
        $this->classField = $classField;
        $this->classLabel = $classLabel;
        $this->isDate = $isDate;
        $this->placeholder = $placeholder;
        $this->name = $name;
        $this->textarea = $textarea;
        $this->value = $value;
        $this->type = $type;
        $this->isRequired = $isRequired;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form.input');
    }
}
