<?php

/**
 * Class TagController
 */
class TagController extends \BaseController
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return Response::json(Tag::get());
    }
}
