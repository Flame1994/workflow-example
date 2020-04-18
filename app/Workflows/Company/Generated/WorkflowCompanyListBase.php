<?php
namespace App\Workflows\Company\Generated;

use App\Company;
use App\Workflows\Common\Workflow;
use Exception;

/**
 * Auto generated.
 */
abstract class WorkflowCompanyListBase extends Workflow
{
    /**
     * Field constants.
     */
    const FIELD_ALL_COMPANY = 'allCompany';

    /**
    * @var Company[]
    */
    private $allCompany;

    /**
     * @param array $data
     *
     * @throws Exception
     */
    public function __construct(array $data)
    {
        $this->setAllProperty($data);

        parent::__construct($data);
    }

    /**
     * @param array $data
     *
     * @throws Exception
     */
    private function setAllProperty(array $data)
    {
        $this->assertDataHasAllKey(
            $data,
            [
            ]
        );
        
    }

    /**
     * @throws Exception
     */
    public function run()
    {
        $this->start();
    }

    /**
     * @throws Exception
     */
    protected function start()
    {
        try {
            $this->executeGetAllCompany();
        } catch(Exception $exception) {
            throw $exception;
        }
    }
    
    /**
     *
     * @return Company[]
     */
    abstract protected function getAllCompany(
    );

    
    /**
     */
    private function executeGetAllCompany()
    {
        try {
            $this->allCompany = $this->getAllCompany(
            );
        } catch(Exception $exception) {
            throw $exception;
        }

        $this->executeEnd();
    }

    /**
     */
    protected function executeEnd()
    {
        $this->result = $this->allCompany;
    }
}
