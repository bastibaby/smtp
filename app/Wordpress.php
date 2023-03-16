<?php

namespace App;

use WP_Query;

/**
 * Class WordpressPostModel
 * @package Theme\Models
 */
class Wordpress {

	/**
     * Define the post type object to use on the queries
     * @var string
     **/
    protected $postType;

    /**
     * @var array
     */
    private $query = [];

    /**
     * Add post status to the query.
     * @param string $type
     * @return array
     */
    public function status($type)
    {
        $this->query['post_status'] = $type;

        return $this;
    }

    /**
     * Use search parameter in query
     * @param string $s
     * @return array $this
     */
    public function search($s)
    {
        $this->query['s'] = $s;

        return $this;
    }

    /**
     * Get posts based on query option define on method chaining
     * @return array
     */
    public function get()
    {
        $this->query['post_type'] = $this->postType;
        $this->query['post_status'] = 'publish';

        $query = new WP_Query($this->query);
        
        return $query;
    }
    /**
     * Add category to the query
     * @param array/string $category
     * @param string $type = slug, id
     * @return $this
     */
    public function inCategory($category, $type)
    {
        if ($type == 'id') {
            $this->query['category__in'] = $category;
        } elseif ($type == 'slug') {
            $this->query['category_name'] = $category;
        }

        return $this;
    }

    /**
     * Add category to the query
     * @param array $categories
     * @return $this
     */
    public function notInCategory($categories)
    {
        $this->query['category__not_in'] = $categories;

        return $this;
    }

    /**
     * Add category, tags and taxonomies to the query
     * @param bool/array $tax
     * @return $this
     */
    public function inTerm($tax, $relation = '')
    {
        $field = (isset($tax['field'])) ? $tax['field'] : 'slug';

        if (!isset($this->query['tax_query'])) {
            $this->query['tax_query'] = [
                [
                    'taxonomy'  => $tax['tax'],
                    'field'     => $field,
                    'terms'     => $tax['term'],
                ]
            ];
        } else {
            $this->query['tax_query'][] = [
                'taxonomy'  => $tax['tax'],
                'field'     => $field,
                'terms'     => $tax['term'],
            ];
        }

        $this->query['tax_query']['relation']  = !empty($relation) ? $relation : 'AND';
        
        return $this;
    }

    /**
     * Add meta query to the query
     * @param bool/array $meta
     * @param string $compare
     * @param string $type
     * @return $this
     */
    public function withMetaQuery($meta, $compare = '=', $type = false)
    {
        $this->query['meta_query']  = [
            [
                'key'     => $meta['key'],
                'value'   => $meta['value'],
                'compare' => $compare,
            ] 
        ];

        if ($type) {
            $this->query['meta_query'][0]['type'] = $type;
        }
        
        return $this;
    }
    /**
     * Add page number to the query
     * @param int $page_num
     * @return $this
     */
    public function withPagination($page_num = 1)
    {
        $this->query['paged'] = $page_num;

        return $this;
    }

    /**
     * Add author to query
     * @param int $authorId
     * @return $this
     */
    public function author($authorId)
    {
        $this->query['author'] = $authorId;

        return $this;
    }

    /**
     * Set post per page display for query
     * @param int $num
     * @return object
     */
    public function postsPerPage($num = 8)
    {
        $this->query['posts_per_page'] = $num;

        return $this;
    }

    /**
     * Set meta orderby for query
     * meta_value_num for meta_Query
     * @param string $orderby
     * @param string $order
     * @return object
     */
    public function orderBy($orderby, $order = 'DESC')
    {
        $this->query['orderby'] = $orderby;
        $this->query['order']   = $order;

        return $this;
    }

    /**
     * Set to get parent pages only
     * @return object
     */
    public function parentOnly()
    {
        $this->query['post_parent'] = 0;

        return $this;
    }

    /**
     * Set meta ordering for query
     * @param string $meta_key
     * @param string $order
     * * @param string $orderby
     * @return object
     */
    public function orderByMeta($meta_key, $order, $orderby)
    {
        $this->query['meta_key'] = $meta_key;
        $this->query['order'] = $order;
        $this->query['orderby'] = $orderby;
        return $this;
    }

    /**
     * Set post to ignore in query
     * @param array/object $list
     * @return object
     */
    public function excludePosts($list)
    {
        $this->query['post__not_in'] = $list;

        return $this;
    }

    /**
     * Retrive specific postt
     * @param array/object $ids
     * @return object
     */
    public function postIn($ids)
    {
        $this->query['post__in'] = $ids;

        return $this;
    }

    /**
     * Return posts by date
     * @param string $day
     * @param string $month
     * @param string year
     * @param array $query
     * @return object
     */
    public function byDate($day, $month, $year)
    {
        if ($day) {
            $this->query['date_query']['day']   = $day;
        }
        if ($month) {
            $this->query['date_query']['month'] = $month;
        }
        if ($year) {
            $this->query['date_query']['year']  = $year;
        }

        return $this;
    }

    /**
     * Return custom search query
     * @param string $type
     * @param array $query
     * @return object
     */
    public function customQuery($type, $query)
    {
        $this->query[$type] = $query;

        return $this;
    }

    public function reset()
    {
        return $this->query = [];
    }
    
    /**
     * Return custom random posts
     * @return object
     */
    public function random()
    {
        $this->query['orderby'] = 'rand';

        return $this;
    }
}