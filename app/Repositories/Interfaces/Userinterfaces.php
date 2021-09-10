<?php 
  namespace App\Repositories\Interfaces;
  interface UserInterfaces 
  {
    public function _add($data);
    public function _edit($id);
    public function _update($id,$data);
    public function _delete($id);
  }
?>