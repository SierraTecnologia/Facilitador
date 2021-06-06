<?php

namespace Facilitador\Http\Resources;

use Population\Manipule\Entities\PostEntity;
use Population\Manipule\Entities\TagEntity;
use function SiUtils\to_object;

/**
 * Class PostResource.
 *
 * @package App\Http\Resources
 */
class PostResource extends PostPlainResource
{
    /**
     * @var PostEntity
     */
    public $resource;

    /**
     * @inheritdoc
     */
    public function toArray($request)
    {
        return array_merge(
            parent::toArray($request), [
            'photo' => to_object($this->resource->getPhoto(), PhotoResource::class),
            'tags' => collect($this->resource->getTags())->map(
                function (TagEntity $tag) {
                    return to_object($tag, TagPlainResource::class);
                }
            ),
            ]
        );
    }
}
