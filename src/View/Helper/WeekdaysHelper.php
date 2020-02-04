<?php
namespace App\View\Helper;

use Cake\View\Helper;

class WeekdaysHelper extends Helper
{
    public function int2str($weekday)
    {
        // Logic to create specially formatted link goes here...
        $dowMap = array('Dom', 'Lun', 'Mar', 'Mer', 'Gio', 'Ven', 'Sab');
        return $dowMap[$weekday];
    }
}
?>