<?php
namespace App\Workflows\Company\Generated;

use App\Company;
use App\Workflows\Common\Workflow;
use Exception;

/**
 * Auto generated.
 */
abstract class WorkflowCompanyCreateBase extends Workflow
{
    /**
     * Field constants.
     */
    const FIELD_NAME = 'name';
    const FIELD_EMAIL = 'email';
    const FIELD_FOUNDED = 'founded';
    const FIELD_IS_COMPANY_UNIQUE = 'isCompanyUnique';
    const FIELD_IS_FOUNDED_BEFORE_CURRENT_DATE = 'isFoundedBeforeCurrentDate';
    const FIELD_COMPANY = 'company';

    /**
    * @var string
    */
    private $name;

    /**
    * @var string
    */
    private $email;

    /**
    * @var string
    */
    private $founded;

    /**
    * @var bool
    */
    private $isCompanyUnique;

    /**
    * @var bool
    */
    private $isFoundedBeforeCurrentDate;

    /**
    * @var Company
    */
    private $company;

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
                'name',
                'email',
                'founded',
            ]
        );
        
        if (array_key_exists('name', $data)) {
            $this->name = $data['name'];
        }

        if (array_key_exists('email', $data)) {
            $this->email = $data['email'];
        }

        if (array_key_exists('founded', $data)) {
            $this->founded = $data['founded'];
        }

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
            $this->executeAssertCompanyUnique();
        } catch(Exception $exception) {
            throw $exception;
        }
    }
    
    /**
     * @param string $email
     *
     * @return bool
     */
    abstract protected function assertCompanyUnique(
        string $email
    );

    /**
     * @param string $founded
     *
     * @return bool
     */
    abstract protected function assertFoundedBeforeCurrentDate(
        string $founded
    );

    /**
     * @param string $name
     * @param string $email
     * @param string $founded
     *
     * @return Company
     */
    abstract protected function createCompany(
        string $name,
        string $email,
        string $founded
    );

    
    /**
     */
    private function executeAssertCompanyUnique()
    {
        try {
            $this->isCompanyUnique = $this->assertCompanyUnique(
                $this->email
            );
        } catch(Exception $exception) {
            throw $exception;
        }

        $this->executeAssertFoundedBeforeCurrentDate();
    }

    /**
     */
    private function executeAssertFoundedBeforeCurrentDate()
    {
        try {
            $this->isFoundedBeforeCurrentDate = $this->assertFoundedBeforeCurrentDate(
                $this->founded
            );
        } catch(Exception $exception) {
            throw $exception;
        }

        $this->executeCreateCompany();
    }

    /**
     */
    private function executeCreateCompany()
    {
        try {
            $this->company = $this->createCompany(
                $this->name,
                $this->email,
                $this->founded
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
        $this->result = $this->company;
    }
}
