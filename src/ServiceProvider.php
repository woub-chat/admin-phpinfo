<?php

namespace Admin\Extend\AdminPhpinfo;

use Admin\ExtendProvider;
use Admin\Core\ConfigExtensionProvider;
use Admin\Extend\AdminPhpinfo\Extension\Config;
use Admin\Extend\AdminPhpinfo\Extension\Install;
use Admin\Extend\AdminPhpinfo\Extension\Navigator;
use Admin\Extend\AdminPhpinfo\Extension\Uninstall;
use Admin\Extend\AdminPhpinfo\Extension\Permissions;
use Exception;

/**
 * Class ServiceProvider
 * @package Admin\Extend\AdminPhpinfo
 */
class ServiceProvider extends ExtendProvider
{
    /**
     * Extension ID name
     * @var string
     */
    public static $name = "bfg/admin-phpinfo";

    /**
     * Extension call slug
     * @var string
     */
    static $slug = "bfg_admin_phpinfo";

    /**
     * Extension description
     * @var string
     */
    public static $description = "Show php information in bfg admin";

    /**
     * @var string
     */
    protected $navigator = Navigator::class;

    /**
     * @var string
     */
    protected $install = Install::class;

    /**
     * @var string
     */
    protected $uninstall = Uninstall::class;

    /**
     * @var string
     */
    protected $permissions = Permissions::class;

    /**
     * @var ConfigExtensionProvider|string
     */
    protected $config = Config::class;

    /**
     * @return void
     * @throws Exception
     */
    public function boot(): void
    {
        parent::boot();

        $this->loadViewsFrom(
            __DIR__ . '/../views',
            'bfg-admin-phpinfo-extension'
        );
    }
}

