<?php
namespace NInterface;
interface BlogInterface{
    /**
     * @param string $id
     * @param string $title
     * @return mixed
     */
    function getList($id = "",$title="");
    
}