<?php

namespace ZIMZIM\ToolsBundle\PagerFanta\View;

use ZIMZIM\ToolsBundle\PagerFanta\View\Template\FoundationTemplate;
use Pagerfanta\View\DefaultView;

class FoundationView extends DefaultView
{
    protected function createDefaultTemplate()
    {
        return new FoundationTemplate();
    }

    protected function getDefaultProximity()
    {
        return 3;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'foundation';
    }
}