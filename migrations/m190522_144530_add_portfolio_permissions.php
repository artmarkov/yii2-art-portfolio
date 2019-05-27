<?php

use artsoft\db\PermissionsMigration;

class m190522_144530_add_portfolio_permissions extends PermissionsMigration
{

    public function beforeUp()
    {
        $this->addPermissionsGroup('portfolioManagement', 'Portfolio Management');
    }

    public function afterDown()
    {
        $this->deletePermissionsGroup('portfolioManagement');
    }

    public function getPermissions()
    {
        return [
            'portfolioManagement' => [
                'links' => [
                    '/admin/portfolio/*',
                    '/admin/portfolio/default/*',
                    '/admin/portfolio/category/*',
                    '/admin/portfolio/menu/*',
                ],
                'viewPortfolios' => [
                    'title' => 'View Portfolios',
                    'links' => [
                        '/admin/portfolio/default/index',
                        '/admin/portfolio/default/view',
                        '/admin/portfolio/default/grid-sort',
                        '/admin/portfolio/default/grid-page-size',
                    ],
                    'roles' => [
                        self::ROLE_AUTHOR,
                    ],
                ],
                'editPortfolios' => [
                    'title' => 'Edit Portfolios',
                    'links' => [
                        '/admin/portfolio/default/update',
                        '/admin/portfolio/default/paste-link',
                    ],
                    'roles' => [
                        self::ROLE_AUTHOR,
                    ],
                    'childs' => [
                        'viewPortfolios',
                    ],
                ],
                'createPortfolios' => [
                    'title' => 'Create Portfolios',
                    'links' => [
                        '/admin/portfolio/default/create',
                    ],
                    'roles' => [
                        self::ROLE_AUTHOR,
                    ],
                    'childs' => [
                        'viewPortfolios',
                    ],
                ],
                'deletePortfolios' => [
                    'title' => 'Delete Portfolios',
                    'links' => [
                        '/admin/portfolio/default/delete',
                        '/admin/portfolio/default/bulk-delete',
                    ],
                    'roles' => [
                        self::ROLE_MODERATOR,
                    ],
                    'childs' => [
                        'viewPortfolios',
                    ],
                ],
                'fullPortfolioAccess' => [
                    'title' => 'Full Portfolio Access',
                    'roles' => [
                        self::ROLE_MODERATOR,
                    ],
                ],
                'viewPortfolioCategories' => [
                    'title' => 'View Portfolios Categories',
                    'links' => [
                        '/admin/portfolio/category/index',
                        '/admin/portfolio/category/grid-sort',
                        '/admin/portfolio/category/grid-page-size',
                    ],
                    'roles' => [
                        self::ROLE_AUTHOR,
                    ],
                    'childs' => [
                        'viewPortfolios',
                    ],
                ],
                'editPortfolioCategories' => [
                    'title' => 'Edit Portfolio Categories',
                    'links' => [
                        '/admin/portfolio/category/update',
                        '/admin/portfolio/category/bulk-activate',
                        '/admin/portfolio/category/bulk-deactivate',

                    ],
                    'roles' => [
                        self::ROLE_MODERATOR,
                    ],
                    'childs' => [
                        'viewPortfolios',
                    ],
                ],
                'createPortfolioCategories' => [
                    'title' => 'Create Portfolio Categories',
                    'links' => [
                        '/admin/portfolio/category/create',
                    ],
                    'roles' => [
                        self::ROLE_MODERATOR,
                    ],
                    'childs' => [
                        'viewPortfolios',
                    ],
                ],
                'deletePortfolioCategories' => [
                    'title' => 'Delete Portfolio Categories',
                    'links' => [
                        '/admin/portfolio/category/delete',
                        '/admin/portfolio/category/bulk-delete',
                    ],
                    'roles' => [
                        self::ROLE_ADMIN,
                    ],
                    'childs' => [
                        'viewPortfolios',
                    ],
                ],
                'fullPortfolioCategoryAccess' => [
                    'title' => 'Full Portfolio Categories Access',
                    'roles' => [
                        self::ROLE_MODERATOR,
                    ],
                ],
                'viewPortfolioMenu' => [
                    'title' => 'View Menu',
                    'links' => [
                        '/admin/portfolio/menu/index',
                        '/admin/portfolio/menu/grid-sort',
                        '/admin/portfolio/menu/grid-page-size',
                    ],
                    'roles' => [
                        self::ROLE_AUTHOR,
                    ],
                    'childs' => [
                        'viewPortfolios',
                    ],
                ],
                'editPortfolioMenu' => [
                    'title' => 'Edit Portfolio Menu',
                    'links' => [
                        '/admin/portfolio/menu/update',
                        '/admin/portfolio/menu/bulk-activate',
                        '/admin/portfolio/menu/bulk-deactivate',
                    ],
                    'roles' => [
                        self::ROLE_MODERATOR,
                    ],
                    'childs' => [
                        'viewPortfolioMenu',
                    ],
                ],
                'createPortfolioMenu' => [
                    'title' => 'Create Portfolio Menu',
                    'links' => [
                        '/admin/portfolio/menu/create',
                    ],
                    'roles' => [
                        self::ROLE_MODERATOR,
                    ],
                    'childs' => [
                        'viewPortfolioMenu',
                    ],
                ],
                'deletePortfolioMenu' => [
                    'title' => 'Delete Portfolio Menu',
                    'links' => [
                        '/admin/portfolio/menu/delete',
                        '/admin/portfolio/menu/bulk-delete',
                    ],
                    'roles' => [
                        self::ROLE_ADMIN,
                    ],
                    'childs' => [
                        'viewPortfolioMenu',
                    ],
                ],
                'fullPortfolioMenuAccess' => [
                    'title' => 'Full Portfolio Menu Access',
                    'roles' => [
                        self::ROLE_MODERATOR,
                    ],
                ],
            ],
        ];
    }

}
