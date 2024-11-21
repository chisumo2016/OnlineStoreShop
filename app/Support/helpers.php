<?php
/**Set Sidebar item active**/
function setActive(array $route) //pass route name $route
{
    if (is_array($route)){
        foreach ($route as $r){
            /**current route**/
            if (request()->routeIs($r)){
                return 'active';
            }
        }
    }
}
