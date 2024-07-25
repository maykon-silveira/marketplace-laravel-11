<?php

/** Link ativa na barra lateral do admin */
function ativadorLinks(array $route)
{
  if(is_array($route)){
     foreach($route as $ms){
       if(request()->routeIs($ms)){
          return 'active';
       }
     }
  }
}
