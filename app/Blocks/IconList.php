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
            'name' => 'Icon List',
            'description' => 'Displays a list with icons',
            'category' => 'formatting',
        ];
    }

    /**
     * Fields to be attached to the block.
     *
     * @return array
     */
    public function fields()
    {
        $tarifffeatures = new FieldsBuilder('tarifffeatures');

        $tarifffeatures
            ->addRepeater('items')
            ->addText('icon')
            ->addText('content')
            ->endRepeater();

        return $tarifffeatures->build();
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
                'content' => 'Wir liefern Ihnen Strom aus Solar- und Windkraftwerken im Umkreis von 50 Kilometern.',
            ],
        ];
    }
}
