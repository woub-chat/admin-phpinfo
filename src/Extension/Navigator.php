<?php

namespace Admin\Extend\AdminPhpinfo\Extension;

use Admin\Core\NavigatorExtensionProvider;
use Admin\Extend\AdminPhpinfo\PhpinfoController;
use Admin\Interfaces\ActionWorkExtensionInterface;

/**
 * Class Navigator
 * @package Admin\Extend\AdminPhpinfo\Extension
 */
class Navigator extends NavigatorExtensionProvider implements ActionWorkExtensionInterface {

    /**
     * @return void
     */
    public function handle(): void
    {
        $this->item(
            'Php info',
            'php_info',
            [PhpinfoController::class, 'index']
        )->icon_php();
    }
}
