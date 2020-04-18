<?php
namespace App\Http\Controllers;

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
     *
     * @return Response
     */
    public function create(Request $request): Response
    {
        return new Response();
    }

    /**
     * @param int $id
     *
     * @return Response
     */
    public function read(int $id): Response
    {
        return new Response();
    }

    /**
     * @param Request $request
     * @param int $id
     *
     * @return Response
     */
    public function update(Request $request, int $id): Response
    {
        return new Response();
    }

    /**
     * @param int $id
     *
     * @return Response
     */
    public function delete(int $id): Response
    {
        return new Response();
    }

    /**
     * @return Response
     */
    public function list(): Response
    {
        return new Response();
    }
}
