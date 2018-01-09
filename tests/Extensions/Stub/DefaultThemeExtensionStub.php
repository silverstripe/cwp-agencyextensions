<?php

namespace CWP\AgencyExtensions\Tests\Extensions\Stub;



use SilverStripe\Core\Extension;
use SilverStripe\Dev\TestOnly;


/**
 * A stub that imitates a CWP agency's implementation of adding custom scripts or styles
 */
class DefaultThemeExtensionStub extends Extension implements TestOnly
{
    public function updateBaseStyles(&$styles)
    {
        $styles['all'][] = 'agency-extensions/tests/Extensions/Stub/agencytest.css';
    }

    public function updateBaseScripts(&$scripts)
    {
        $scripts[] = 'agency-extensions/tests/Extensions/Stub/agencytest.js';
    }
}
