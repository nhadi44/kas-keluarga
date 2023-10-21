<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class modal extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct($id, $title, $headerClass, $formId)
    {
        $this->id = $id;
        $this->title = $title;
        $this->headerClass = $headerClass;
        $this->formId = $formId;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.modal', [
            'id' => $this->id,
            'title' => $this->title,
            'headerClass' => $this->headerClass,
            'formId' => $this->formId,
        ]);
    }
}
