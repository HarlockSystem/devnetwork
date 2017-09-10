<?php

namespace DNW\Util;

use DNW\Manager\PostManager;
use DNW\Manager\TagManager;
use DNW\Entity\Post;

/**
 * Description of TagTool
 *
 * @author linkus
 */
class TagTool
{
    protected $postMng;
    protected $tagMng;

    public function __construct(TagManager $tagMng, PostManager $postMng)
    {
        $this->postMng = $postMng;
        $this->tagMng = $tagMng;
    }

    protected function sanitizeTags($tags)
    {
        $data = [];
        $arrTags = explode(',', $tags);
        foreach ($arrTags as $tagRaw) {
            $data[] = strtolower(str_replace(' ', '_', trim($tagRaw)));
        }
        return array_unique($data);
    }

    public function addTags($tagsRaw)
    {
        $tags = [];
        $names = $this->sanitizeTags($tagsRaw);

        foreach ($names as $name) {
            $tag = $this->tagMng->findOneBy(['name' => $name]);
            if (!$tag) {
                $tag = $this->tagMng->create($name);
            }
            $tags[] = $tag;
        }
        return $tags;
    }

    public function addTagsToPost(Post $post, $tagsRaw = null)
    {
        $this->tagMng->removeAllTag($post);
        
        if(empty($tagsRaw)){
            return;
        }
        
        $tags = $this->addTags($tagsRaw);

        foreach ($tags as $tag){
            $this->tagMng->addPostTag($post, $tag);
        }
        
    }

}
