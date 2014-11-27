<?php

/**
 * Class VideoController
 */
class VideoController extends \BaseController
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return Response::json(Video::where('is_watched', '=', 0)->with('tags')->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $video = Video::create(array(
            'youtube_id'    => Input::get('youtube_id'),
            'name'          => Input::get('name'),
            'description'   => Input::get('description'),
        ));

        if (is_array(Input::get('tags'))) {
            foreach (Input::get('tags') as $tag) {
                $tagModel = Tag::firstOrNew(array('text' => $tag['text']));
                $tagModel->save();
                $video->tags()->attach($tagModel->id);
            }
        }

        return Response::json(array('success' => true));
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id)
    {
        $video = Video::find($id);
        $video->update(Input::all());

        return Response::json(array('success' => true));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        Video::destroy($id);

        return Response::json(array('success' => true));
    }
}
