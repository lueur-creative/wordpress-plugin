<?php

function wpem_change_expire_date_time($expire_date, $event)
{
  var_dump($event);
  return $event->_event_end_date ?? $event->_event_start_date;
}
add_filter('wpem_expire_date_time', 'wpem_change_expire_date_time', 10, 2);
