<?php

namespace Modules\Portfolio\Events\Handlers;

use Maatwebsite\Sidebar\Group;
use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Modules\Core\Sidebar\AbstractAdminSidebar;

class RegisterPortfolioSidebar extends AbstractAdminSidebar
{
    /**
     * @param Menu $menu
     * @return Menu
     */
    public function extendWith(Menu $menu)
    {
        $menu->group(trans('core::sidebar.content'), function (Group $group) {
            $group->item(trans('portfolio::portfolios.title.portfolios'), function (Item $item) {
                $item->icon('fa fa-copy');
                $item->weight(10);
                $item->authorize(
                     /* append */
                );
                $item->item(trans('portfolio::portfolios.title.portfolios'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.portfolio.portfolio.create');
                    $item->route('admin.portfolio.portfolio.index');
                    $item->authorize(
                        $this->auth->hasAccess('portfolio.portfolios.index')
                    );
                });
                $item->item(trans('portfolio::categories.title.categories'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.portfolio.category.create');
                    $item->route('admin.portfolio.category.index');
                    $item->authorize(
                        $this->auth->hasAccess('portfolio.categories.index')
                    );
                });
                $item->item(trans('portfolio::brands.title.brands'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.portfolio.brand.create');
                    $item->route('admin.portfolio.brand.index');
                    $item->authorize(
                        $this->auth->hasAccess('portfolio.brands.index')
                    );
                });
// append



            });
        });

        return $menu;
    }
}
