<?php
namespace NInterface;
interface BlogInterface{
    /**
     * @param string $id
     * @param string $title
     * @wnRequestMethod method="get" value="/blog/list"
     * @return mixed
     */
    function getList($id = "",$title="");
    
}