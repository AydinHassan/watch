<?php

/**
 * Class VideoTableSeeder
 */
class VideoTableSeeder extends Seeder
{

    /**
     * @return void
     */
    public function run()
    {
        DB::table('videos')->delete();

        $tagIds = Tag::all()->lists('id');
        $videos = [];


        $videos[] = Video::create(array(
            'youtube_id'    => '8ET_gl1qAZ0',
            'name'          => 'Git',
            'description'   => 'Advanced Git with Linus.',
            'is_watched'    => false,
        ));

        foreach ($videos as $video) {
            $video->tags()->attach($this->getRandomTags($tagIds));
        }
    }

    /**
     * @param array $tags
     * @return array
     */
    public function getRandomTags(array $tags)
    {
        $randomTags = array_rand($tags, rand(1, count($tags)));

        if (!is_array($randomTags)) {
            return $tags[$randomTags];
        } else {
            return array_intersect_key($tags, array_flip($randomTags));
        }
    }
}
