<?php

declare(strict_types=1);

namespace Infiright\SampleRequest\Ui\Component\Form;

use Magento\Framework\View\Element\ComponentVisibilityInterface;
use Magento\Ui\Component\Form\Fieldset;

class HiddenTabFieldset extends Fieldset implements ComponentVisibilityInterface
{
    public function isComponentVisible(): bool
    {
        return false;
    }
}
