<?php

namespace App\Blocks;

use Log1x\AcfComposer\Block;
use StoutLogic\AcfBuilder\FieldsBuilder;

class IconList extends Block
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
            'name'        => __('Icon List'),
            'description' => __('Displays a list with icons'),
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
        $field = new FieldsBuilder('icon_list');

        $field
            ->addRepeater('items', ['min' => 1, 'max' => 10])
            ->addText('icon')
            ->addText('content')
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
        ];
    }

    /**
     * Returns the items field.
     *
     * @return array
     */
    public function items()
    {
        return \get_field('items') ?? [
            [
                'icon' => 'icon-bag',
                'content' => 'Wir liefern Ihnen Strom aus Solar- und Windkraftwerken im Umkreis von 50 Kilometern.',
            ],
            [
                'icon' => 'icon-bag',
                'content' => 'Sie unterstützen so das Umweltengagement vor Ort.',
            ],
            [
                'icon' => 'icon-bag',
                'content' => 'Sie stärken langfristig die Wirtschaft in Ihrer Region.',
            ],
        ];
    }
}
