<?php
namespace App\Repositories\Interfaces;
interface CmsInterface{
    public function _update($id,$data);
    public function _view_cms($status);
    
}
?>