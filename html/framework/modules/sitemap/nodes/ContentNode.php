<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 14.07.18
 * Time: 12:12
 */

namespace app\modules\sitemap\nodes;

use DateTime;
use elfuvo\sitemap\interfaces\SitemapInterface;
use elfuvo\sitemap\models\SitemapItem;
use krok\content\models\Content;
use yii\helpers\Url;

/**
 * Class ContentNode
 *
 * @package app\modules\sitemap\nodes
 */
class ContentNode implements SitemapInterface
{
    /**
     * @return array
     */
    public static function getSitemapTree(): array
    {
        $nodes = [];

        $list = Content::find()->language()->hidden()->all();

        foreach ($list as $row) {
            $node = new SitemapItem([
                'location' => Url::to(['/content/default/index', 'alias' => $row->alias], true),
                'title' => $row->title,
                'lastModified' => (new DateTime($row->updatedAt))->format('Y-m-d'),
            ]);

            array_push($nodes, $node);
        }

        return $nodes;
    }
}
