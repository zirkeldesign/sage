<?php

namespace App\Blocks;

use Log1x\AcfComposer\Block;
use Illuminate\Support\Str;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Accordion extends Block
{

    /**
     * An array of post types the block will be available to.
     *
     * @var array
     */
    protected $post_types = [];

    /**
     * Data to be passed to the block before registering.
     *
     * @return array
     */
    public function register()
    {
        return [
            'name'        => __('Accordion'),
            'description' => __('Displays an accordion'),
            'icon'        => '<svg viewBox="0 0 24 24"><path d="M1 6v12h22V6zm7 3h8v2H8zm8 7H8v-1h8zm2-2H6v-1h12z"/></svg>',
            'category'    => 'layout',
            'mode'        => 'auto',
        ];
    }

    /**
     * Fields to be attached to the block.
     *
     * @return array
     */
    public function fields()
    {
        $field = new FieldsBuilder('accordion');

        $field
            ->addTab('general')
            ->addSelect('title_tag')
            ->addChoices('h3', 'h4', 'h5', 'b', 'span')
            ->addTab('items')
            ->addRepeater('items', ['layout' => 'row', 'min' => 1])
            ->addText('title')
            ->addWysiwyg('content')
            ->addText('id')
            ->addTrueFalse('is_open')
            ->endRepeater();

        return $field->build();
    }

    /**
     * Data to be passed to the rendered block.
     *
     * @return array
     */
    public function with()
    {
        return [
            'items' => $this->items(),
            'type' => 'single', // or: 'multiple'
            'title_tag' => \get_field('title_tag') ?? 'h3',
        ];
    }

    /**
     * Returns the items field.
     *
     * @return array
     */
    public function items()
    {
        return collect(\get_field('items') ?? [])->map(
            function ($item) {
                if (!$item['id'] && trim($item['title'])) {
                    $item['id'] = Str::slug($item['title']);
                }
                return $item;
            }
        );
    }
}
