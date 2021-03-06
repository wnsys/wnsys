<?php
namespace Rpc\Process;
class Process{
    public $mpid=0;
    public $works=[];
    public $max_precess=1;
    public $new_index=0;
    public $handle;
    public function __construct($max_precess = 1, $handle){
        try {
            \swoole_set_process_name(sprintf('php-ps:%s', 'master'));
            $this->max_precess = $max_precess;
            $this->mpid = posix_getpid();
            $this->handle = $handle;
            $this->run();
            $this->processWait();
        }catch (\Exception $e){
            die('ALL ERROR: '.$e->getMessage());
        }
    }

    public function run(){
        for ($i=0; $i < $this->max_precess; $i++) {
            $this->CreateProcess();
        }
    }

    /**
     * @param null $index
     * @param $handle
     * @return mixed
     */
    public function CreateProcess($index=null){
        $handle = $this->handle;
        $process = new \swoole_process(function(\swoole_process $worker)use($index,$handle){
            if(is_null($index)){
                $index=$this->new_index;
                $this->new_index++;
            }
            \swoole_set_process_name(sprintf('php-ps:%s',$index));
            $handle();

        }, false, false);
        $pid=$process->start();
        $this->works[$index]=$pid;
        return $pid;
    }
    public function checkMpid(&$worker){
        if(!\swoole_process::kill($this->mpid,0)){
            $worker->exit();
            // 这句提示,实际是看不到的.需要写到日志中
            echo "Master process exited, I [{$worker['pid']}] also quit\n";
        }
    }

    public function rebootProcess($ret){
        $pid=$ret['pid'];
        $index=array_search($pid, $this->works);
        if($index!==false){
            $index=intval($index);
            $new_pid=$this->CreateProcess($index);
            echo "rebootProcess: {$index}={$new_pid} Done\n";
            return;
        }
        throw new \Exception('rebootProcess Error: no pid');
    }

    public function processWait(){
        while(1) {
            if(count($this->works)){
                $ret = \swoole_process::wait();
                if ($ret) {
                    //掉了就删除，子进程都挂了，主进程结束
                    $pid=$ret['pid'];
                    $index=array_search($pid, $this->works);
                    unset($this->works[$index]);
                    //掉了重启
                    //$this->rebootProcess($ret);
                }
            }else{
                break;
            }
        }
    }
}