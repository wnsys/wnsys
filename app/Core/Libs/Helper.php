<?php
function is_mobile(){
    return (new \Mobile_Detect())->isMobile();
}