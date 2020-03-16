<?php

namespace App\Blocks;

use Illuminate\Support\Str;
use Log1x\AcfComposer\Block;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Accordion extends Block
{
    /**
     * The display name of the block.
     *
     * @var string
     */
    public $name = 'Accordion';

    /**
     * The description of the block.
     *
     * @var string
     */
    public $description = 'Displays an accordion';

    /**
     * The category this block belongs to.
     *
     * @var string
     */
    public $category = 'layout';

    /**
     * The icon of this block.
     *
     * @var string|array
     */
    public $icon = '<svg viewBox="0 0 24 24"><path d="M1 6v12h22V6zm7 3h8v2H8zm8 7H8v-1h8zm2-2H6v-1h12z"/></svg>';

    /**
     * An array of block keywords.
     *
     * @var array
     */
    public $keywords = [];

    /**
     * An array of post types the block will be available to.
     *
     * @var array
     */
    public $post_types = [];

    /**
     * The default display mode of the block that is shown to the user.
     *
     * @var string
     */
    public $mode = 'preview';

    /**
     * The block alignment class.
     *
     * @var string
     */
    public $align = '';

    /**
     * Features supported by the block.
     *
     * @var array
     */
    public $supports = [];

    /**
     * Data to be passed to the rendered block.
     *
     * @return array
     */
    public function with()
    {
        return [
            'items'     => $this->items(),
            'type'      => 'single',                          // or: 'multiple'
            'title_tag' => \get_field('title_tag') ?? 'h3',
            'padding'   => 0,
        ];
    }

    /**
     * Assets to be enqueued when rendering the block.
     *
     * @return void
     */
    public function enqueue()
    {
        //
    }

    /**
     * The block field group.
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
