<?php
namespace App\Http\Controllers;

use App\Workflows\Client\Code\WorkflowClientCreate;
use App\Workflows\Client\Code\WorkflowClientDelete;
use App\Workflows\Client\Code\WorkflowClientList;
use App\Workflows\Client\Code\WorkflowClientRead;
use App\Workflows\Client\Code\WorkflowClientUpdate;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * @author Ruan Haarhoff <ruan@aptic.com>
 * @since 20200418 Initial creation.
 */
class ClientController extends Controller
{
    /**
     * @param Request $request
     * @param int $companyId
     *
     * @return Response
     * @throws Exception
     */
    public function create(Request $request, int $companyId): Response
    {
        $client = WorkflowClientCreate::execute(
            $companyId,
            $request->get('name'),
            $request->get('email'),
            $request->get('joined')
        );

        return new Response($client->toArray());
    }

    /**
     * @param int $companyId
     * @param int $id
     *
     * @return Response
     * @throws Exception
     */
    public function read(int $companyId, int $id): Response
    {
        $client = WorkflowClientRead::execute($companyId, $id);

        return new Response($client->toArray());
    }

    /**
     * @param Request $request
     * @param int $companyId
     * @param int $id
     *
     * @return Response
     * @throws Exception
     */
    public function update(Request $request, int $companyId, int $id): Response
    {
        $client = WorkflowClientUpdate::execute(
            $companyId,
            $id,
            $request->get('name'),
            $request->get('email'),
            $request->get('joined')
        );

        return new Response($client->toArray());
    }

    /**
     * @param int $companyId
     * @param int $id
     *
     * @return Response
     * @throws Exception
     */
    public function delete(int $companyId, int $id): Response
    {
        $client = WorkflowClientDelete::execute($companyId, $id);

        return new Response($client->toArray());
    }

    /**
     * @param int $companyId
     *
     * @return Response
     * @throws Exception
     */
    public function list(int $companyId): Response
    {
        $allClient = WorkflowClientList::execute($companyId);

        return new Response($allClient);
    }
}
