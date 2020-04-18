<?php
namespace App\Http\Controllers;

use App\Workflows\Company\Code\WorkflowCompanyCreate;
use App\Workflows\Company\Code\WorkflowCompanyDelete;
use App\Workflows\Company\Code\WorkflowCompanyList;
use App\Workflows\Company\Code\WorkflowCompanyRead;
use App\Workflows\Company\Code\WorkflowCompanyUpdate;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * @author Ruan Haarhoff <ruan@aptic.com>
 * @since 20200418 Initial creation.
 */
class CompanyController extends Controller
{
    /**
     * @param Request $request
     *
     * @return Response
     * @throws Exception
     */
    public function create(Request $request): Response
    {
        $company = WorkflowCompanyCreate::execute(
            $request->get('name'),
            $request->get('email'),
            $request->get('founded')
        );

        return new Response($company->toArray());
    }

    /**
     * @param int $id
     *
     * @return Response
     * @throws Exception
     */
    public function read(int $id): Response
    {
        $company = WorkflowCompanyRead::execute($id);

        return new Response($company->toArray());
    }

    /**
     * @param Request $request
     * @param int $id
     *
     * @return Response
     * @throws Exception
     */
    public function update(Request $request, int $id): Response
    {
        $company = WorkflowCompanyUpdate::execute(
            $id,
            $request->get('name'),
            $request->get('email'),
            $request->get('founded'),
            null
        );

        return new Response($company->toArray());
    }

    /**
     * @param int $id
     *
     * @return Response
     * @throws Exception
     */
    public function delete(int $id): Response
    {
        $company = WorkflowCompanyDelete::execute($id);

        return new Response($company->toArray());
    }

    /**
     * @return Response
     * @throws Exception
     */
    public function list(): Response
    {
        $allCompany = WorkflowCompanyList::execute();

        return new Response($allCompany);
    }
}
