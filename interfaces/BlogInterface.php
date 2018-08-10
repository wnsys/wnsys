<?php
namespace Interfaces;
interface BlogInterface{
    /**
     * @param string $id
     * @param string $title
     * @return mixed
     */
    function getList($id = "",$title="");
    
}