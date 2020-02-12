<?php

namespace App\Blocks;

use Log1x\AcfComposer\Block;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Hero extends Block
{
    /**
     * Default field type configuration.
     *
     * @return array
     */
    protected $defaults = [];

    /**
     * Data to be passed to the block before registering.
     *
     * @return array
     */
    public function register()
    {
        return [
            'name'        => __('Hero'),
            'description' => __('Adds an hero component'),
            'icon'        => '<svg viewBox="0 0 24 24"><path d="M1 6v12h22V6zm7 3h8v2H8zm8 7H8v-1h8zm2-2H6v-1h12z"/></svg>',
            'category'    => 'layout',
            'align'       => 'full',
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
        $background = new FieldsBuilder('background');
        $background
            ->addTab('Background')
            ->addImage('background_image')
            ->addTrueFalse('fixed')
            ->setInstructions("Check to add a parallax effect where the background image doesn't move when scrolling")
            ->addColorPicker('background_color');

        $hero = new FieldsBuilder('hero');
        $hero
            ->addTab('Content')
            ->addText('title')
            ->addText('sub_title')
            ->addFields($background);

        return $hero->build();
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
        return get_field('items') ?: [];
    }
}
