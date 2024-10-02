<?php 

class Job
{
    private $job_id;

    public function __construct($job_id)
    {
        $this->job_id   =   $job_id;
    }

    public function viewJob()
    {
        $job_id =   $this->job_id;

        $job    =   R::findOne("jobs", "WHERE id = ?", [$job_id]);

        if($job)
        {
            return $job;
        }
    }
}


?>